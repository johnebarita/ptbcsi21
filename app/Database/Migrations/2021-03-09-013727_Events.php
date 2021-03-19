<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Events extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 50,

            ],
            'start' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'end' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'note' =>[
                'type' =>'VARCHAR',
                'constraint' =>255
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
       $this->forge->addPrimaryKey('id');
       $this->forge->createTable('events');
	}

	public function down()
	{
      $this->forge->dropTable('events');
	}
}
