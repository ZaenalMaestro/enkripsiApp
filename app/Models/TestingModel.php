<?php

namespace App\Models;

use CodeIgniter\Model;

class TestingModel extends Model
{
   protected $table      = 'pengujian';
   protected $allowedFields = ['nama_file', 'ukuran_file', 'kecepatan_enkripsi', 'kecepatan_dekripsi'];
}
