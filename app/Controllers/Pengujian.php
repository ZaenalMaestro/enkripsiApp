<?php namespace App\Controllers;

use App\Models\TestingModel;

class Pengujian extends BaseController
{
	public function index()
	{
		# Insialisasi model
		$this->testingModel = new TestingModel();
		$data = [
			'title' => 'Pengujian',
			'active' => 'pengujian'
		];
		return view('pengujian', $data);
	}
}

