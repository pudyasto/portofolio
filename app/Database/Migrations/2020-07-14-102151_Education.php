<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Education extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'institute'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'graduate'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'date_start'       => [
				'type'           => 'DATE',
			],
			'date_finish'       => [
				'type'           => 'DATE',
				'null'           => TRUE,
			],
			'description'       => [
				'type'           => 'TEXT',
			],
			'created_at'       => [
				'type'           => 'DATETIME',
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
			],
			'deleted_at'       => [
				'type'           => 'DATETIME',
				'null'           => TRUE,
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('education');
	}

	public function down()
	{
		$this->forge->dropTable('education');
	}
}
