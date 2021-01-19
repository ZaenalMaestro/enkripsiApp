<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
   protected $table      = 'video';
   protected $allowedFields = ['nama_video', 'key_twofish', 'status'];
}
