<?php namespace App\Controllers;

use App\Models\TestingModel;

class Pengujian extends BaseController
{
	public function index()
	{
		# hapus semua file di folder temp
		delete_all_video_temp();

		# Insialisasi model
		$this->testingModel = new TestingModel();
		$data = [
			'title' => 'Pengujian',
			'active' => 'pengujian'
		];
		return view('pengujian', $data);
	}
}

