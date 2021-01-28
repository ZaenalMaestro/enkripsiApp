<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
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
		// hapus semua file difolder temp
		delete_all_video_temp();
		
		$data = [
			'title' => 'Dashboard',
			'active' => 'dashboard',
			'data'	=> $this->videoModel->findAll()
		];
		return view('dashboard', $data);
	}

	
}
