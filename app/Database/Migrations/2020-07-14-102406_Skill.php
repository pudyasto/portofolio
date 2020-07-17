<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Skill extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'description'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'percent'       => [
				'type'           => 'INT',
				'constraint'     => '3',
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
		$this->forge->createTable('skill');
	}

	public function down()
	{
		$this->forge->dropTable('skill');
	}
}
