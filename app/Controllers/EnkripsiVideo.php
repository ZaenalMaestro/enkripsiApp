<?php

namespace App\Controllers;

use phpseclib3\Crypt\Twofish;
use phpseclib3\Crypt\Random;
use App\Models\DashboardModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;

class EnkripsiVideo extends ResourceController
{
	use ResponseTrait;
	private $videoModel;
	private $twofish;

	public function __construct()
	{
		# Insialisasi model
		$this->videoModel = new DashboardModel();
		# insialisasi algoritma twofish
		$this->twofish = new Twofish('ecb');
		$this->twofish->setKeyLength(256);
	}

	#getdata
	public function getData()
	{
		$data = $this->videoModel->findAll();
		$nomor = 1;		

		# kembalikan array kosong jika data didatabase kosong
		if (empty($data)) {
			return $this->respond(['data' => []]);
		}

		foreach ($data as $video) {
			$video['nomor'] = $nomor++;
			$video['aksi'] = [
				"status" => $video['status'],
				"id" => $video['id'],
				"nama_video" => $video['nama_video'],
			];
			$respons['data'][] = $video;
		}
		return $this->respond($respons);
	}

	# meng-enkripsi video dan menyimpan datanya kedatabase
	public function enkripsi()
	{
		# menangkap request data user
		$data = [
			'video' => $_FILES['video'],
			'key' 	=> $this->request->getPost('key')
		];

		#ubah nama file upload
		$uniqid = uniqid();
		$filename = 'enkripsi_' . $uniqid . '_';
		$filename .= $data['video']['name'];

		# memindahkan video ke folder public/video
		move_uploaded_file($data['video']['tmp_name'], "video/$filename");

		# set key enkripsi 
		$this->twofish->setPassword($data['key']);

		# get data video yg baru saja dipindahkan ke folder public/video		
		$video = file_get_contents("video/" . $filename);

		#enkripsi video
		$enkripsi = $this->twofish->encrypt($video);
		file_put_contents("video/" . $filename, $enkripsi);

		# simpan data kedalam database
		$this->videoModel->save([
			'nama_video' => $filename,
			'key_twofish' => password_hash($data['key'], PASSWORD_DEFAULT),
			'status' => 'enkripsi'
		]);

		# kembalikan response ke user
		return $this->respond(['status' => 200]);
	}

	# meng-enkripsi video dan menyimpan datanya kedatabase
	public function dekripsi()
	{
		# menangkap request data user
		$data = [
			'video' => $_FILES['video'],
			'key' 	=> $this->request->getPost('key')
		];

		#ubah nama file upload
		$uniqid = uniqid();
		$filename = 'dekripsi_' . $uniqid . '_';
		$filename .= $data['video']['name'];

		# memindahkan video ke folder public/video
		move_uploaded_file($data['video']['tmp_name'], "video/$filename");

		# set key enkripsi 
		$this->twofish->setPassword($data['key']);

		# get data video yg baru saja dipindahkan ke folder public/video		
		try {
			$video = file_get_contents("video/" . $filename);
			// #dekripsi video
			$dekripsi = $this->twofish->decrypt($video);
			file_put_contents("video/" . $filename, $dekripsi);

			# simpan data kedalam database
			$this->videoModel->save([
				'nama_video' => $filename,
				'key_twofish' => password_hash($data['key'], PASSWORD_DEFAULT),
				'status' => 'dekripsi'
			]);

			# kembalikan response ke user
			return $this->respond(['status' => 200]);
		} catch (Exception $error) {
			// hapus vidoe yg baru saja diupload
			unlink("video/$filename");

			# kembalikan response ke user
			return $this->respond(['status' => 500]);
		}
	}
}
