<?php

namespace App\Controllers;

use phpseclib3\Crypt\Twofish;
use phpseclib3\Crypt\Random;
use App\Models\DashboardModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;

class EnkripsiUpdate extends ResourceController
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


	# meng-enkripsi video dan menyimpan datanya kedatabase
	public function enkripsi()
	{
		# menangkap request data user
		$data = [
			'id' 	=> $_POST['id'],
			'name' 	=> $_POST['name'],
			'key' 	=> $_POST['key']
		];

		$NamaFileBaru = str_replace('dekripsi', 'enkripsi', $data['name']);
		rename("video/" . $data['name'], "video/$NamaFileBaru");

		# get data video yg akan dienkripsi		
		$video = file_get_contents("video/" . $NamaFileBaru);

		// #enkripsi video
		$this->twofish->setPassword($data['key']);
		$enkripsi = $this->twofish->encrypt($video);
		file_put_contents("video/" . $NamaFileBaru, $enkripsi);

		# simpan data kedalam database
		$this->videoModel->save([
			'id' => $data['id'],
			'nama_video' => $NamaFileBaru,
			'status' => 'enkripsi'
		]);

		# kembalikan response ke user
		return $this->respond($data);
	}

	# meng-enkripsi video dan menyimpan datanya kedatabase
	public function dekripsi()
	{
		# menangkap request data user
		$data = [
			'id' 	=> $_POST['id'],
			'name' 	=> $_POST['name'],
			'key' 	=> $_POST['key']
		];

		try {
			# get data video yg akan didekripsi		
			$video = file_get_contents("video/" . $data['name']);

			// #dekripsi video
			$this->twofish->setPassword($data['key']);
			$dekripsi = $this->twofish->decrypt($video);
			file_put_contents("video/" . $data['name'], $dekripsi);

			# ubah nama
			$NamaFileBaru = str_replace('enkripsi', 'dekripsi', $data['name']);
			rename("video/" . $data['name'], "video/$NamaFileBaru");

			# simpan data kedalam database
			$this->videoModel->save([
				'id' => $data['id'],
				'nama_video' => $NamaFileBaru,
				'status' => 'dekripsi'
			]);

			# kembalikan response ke user
			return $this->respond(['status' => 200]);
		} catch (Exception $th) {
			return $this->respond(['status' => 500]);
		}
	}
}
