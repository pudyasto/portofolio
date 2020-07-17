<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'category'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'description'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'image'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
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
		$this->forge->createTable('product');
	}

	public function down()
	{
		$this->forge->dropTable('product');
	}
}
