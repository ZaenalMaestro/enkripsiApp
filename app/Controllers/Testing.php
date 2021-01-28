<?php

namespace App\Controllers;

use phpseclib3\Crypt\Twofish;
use App\Models\TestingModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;

class Testing extends ResourceController
{
	use ResponseTrait;
	private $testingModel;
	private $twofish;

	public function __construct()
	{
		# Insialisasi model
		$this->testingModel = new TestingModel();
		# insialisasi algoritma twofish
		$this->twofish = new Twofish('ecb');
		$this->twofish->setKeyLength(256);
	}

	#getdata
	public function getDataTesting()
	{
		$data = $this->testingModel->findAll();

		# kembalikan array kosong jika data didatabase kosong
		if (empty($data)) {
			return $this->respond(['data' => []]);
		}

		$nomor = 1;
		foreach ($data as $uji) {
			$uji['nomor'] = $nomor++;
			$response['data'][] = $uji;
		}
		return $this->respond($response);
	}


	# fungsi untuk menguji kecepatan enkripsi
	public function ujiKecepatan()
	{
		# menangkap request data user
		$data = [
			'video' => $_FILES['video'],
			'key' 	=> $this->request->getPost('key'),
			'ukuran_file' 	=> $this->request->getPost('ukuran_file'),
		];
		// uji kecepatan enkripsi		
		$enkripsi = $this->enkripsi($data);
		$dekripsi = $this->dekripsi($data, $enkripsi['nama_file']);
		$time = [
			'kecepatan_enkripsi' => $enkripsi['waktu_enkripsi'] . ' detik',
			'kecepatan_dekripsi' => $dekripsi . ' detik',
		];

		// simpan hasil kedatabase
		$this->testingModel->save([
			'nama_file' => $data['video']['name'],
			'ukuran_file' => $data['ukuran_file'],
			'kecepatan_enkripsi' => $time['kecepatan_enkripsi'],
			'kecepatan_dekripsi' => $time['kecepatan_dekripsi']
		]);

		return $this->respond($time);
	}

	# meng-enkripsi video dan menyimpan datanya kedatabase
	private function enkripsi($data)
	{

		#ubah nama file upload
		$uniqid = uniqid();
		$filename = 'pengujian_' . $uniqid . '_';
		$filename .= $data['video']['name'];

		# memindahkan video ke folder public/video
		move_uploaded_file($data['video']['tmp_name'], "video/testing/$filename");

		# set key enkripsi 
		$this->twofish->setPassword($data['key']);

		# get data video yg baru saja dipindahkan ke folder public/video/testing		
		$video = file_get_contents("video/testing/" . $filename);

		#uji kecepatan enkripsi video
		$start_time = microtime(true);
		# proses enkripsi
		$enkripsi = $this->twofish->encrypt($video);

		$end_time = microtime(true);

		#hitung kecepatan enkripsi
		$waktuEnkripsi = ($end_time - $start_time);

		file_put_contents("video/testing/" . $filename, $enkripsi);

		# kembalikan nilai uji enkripsi
		$result = [
			'waktu_enkripsi' => round($waktuEnkripsi, 4),
			'nama_file' => $filename
		];
		return $result;
	}

	# meng-enkripsi video dan menyimpan datanya kedatabase
	private function dekripsi($data, $filename)
	{
		# set key enkripsi 
		$this->twofish->setPassword($data['key']);

		# get data video yg baru saja dipindahkan ke folder public/video		
		$video = file_get_contents("video/testing/" . $filename);

		#uji kecepatan dekripsi
		$start_time = microtime(true);
		#dekripsi video
		$dekripsi = $this->twofish->decrypt($video);
		$end_time = microtime(true);

		#hitung kecepatan dekripsi
		$waktuDekripsi = ($end_time - $start_time);

		// hapus video
		unlink("video/testing/" . $filename);

		# kembalikan nilai uji dekripsi
		return round($waktuDekripsi, 4);
	}
}
