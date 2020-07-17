<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profile extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE,
			],
			'full_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'birth_date'       => [
				'type'           => 'DATE',
			],
			'birth_place'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'quotes'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'about_me'       => [
				'type'           => 'TEXT',
			],
			'address'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'city'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'phone'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
			],
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'linkedin'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'instagram'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'facebook'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'twitter'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('profile');
	}

	public function down()
	{
		$this->forge->dropTable('profile');
	}
}
