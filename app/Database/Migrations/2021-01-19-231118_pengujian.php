<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengujian extends Migration
{
	public function up()
	{
		// membuat table pengujian
		$this->forge->addField([
			'id INT NOT NULL AUTO_INCREMENT',
			'nama_file VARCHAR (255)',
			'ukuran_file VARCHAR (255)',
			'kecepatan_enkripsi VARCHAR (255)',
			'kecepatan_dekripsi VARCHAR (255)',
			'PRIMARY KEY(id)'
		]);

		$this->forge->createTable('pengujian', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// hapus table pengujian
		$this->forge->dropTable('pengujian');
	}
}
