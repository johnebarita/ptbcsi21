<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TestUsers extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
       $this->forge->addPrimaryKey('id');
       $this->forge->createTable('test_users');
	}

	public function down()
	{
      $this->forge->dropTable('test_users');
	}
}
