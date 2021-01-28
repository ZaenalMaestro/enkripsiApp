<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dekripsi extends BaseController
{
	private $videoModel;
	public function __construct()
	{
		# Insialisasi model
		$this->videoModel = new DashboardModel();
	}

	// menampilkan form dashboard
	public function index()
	{
		# hapus semua file di folder temp
		delete_all_video_temp();
		
		$data = [
			'title' => 'Dekripsi',
			'active' => 'dekripsi',
			'data'	=> $this->videoModel->findAll()
		];
		return view('dekripsi', $data);
	}
}
