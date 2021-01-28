<?php

namespace App\Controllers;

use phpseclib3\Crypt\Twofish;
use phpseclib3\Crypt\Random;
use App\Models\DashboardModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;

class DeleteVideo extends ResourceController
{
	# hapus video
	public function deleteSingle()
	{
		$filename = $this->request->getPost('filename');
		unlink("video/temp/$filename");
	}

	public function deleteAllVideo(){

	}
}
