<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sessions extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'ip_address'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '45',
			],
			'timestamp'       => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'data' => [
				'type'           => 'TEXT',
				'null'           => TRUE,
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('ci_sessions');
	}

	public function down()
	{
		$this->forge->dropTable('ci_sessions');
	}
}
