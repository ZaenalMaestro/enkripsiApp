<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Video extends Migration
{
	public function up()
	{
		// membuat colom untuk tabel ci_news
		$this->forge->addField([
			'id INT NOT NULL AUTO_INCREMENT',
			'nama_video VARCHAR(255)',
			'key_twofish VARCHAR(255)',
			'content TEXT',
			'status ENUM("enkripsi", "dekripsi")',
			'PRIMARY KEY(id)'
		]);

		// membuat table news
		$this->forge->createTable('video', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('video');
	}
}
