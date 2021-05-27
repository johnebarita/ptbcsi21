<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LatePenalties extends Migration
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
            'from' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true
            ],
            'to' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'equivalent' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
       $this->forge->addPrimaryKey('id');
       $this->forge->createTable('late_penalties');
	}

	public function down()
	{
      $this->forge->dropTable('late_penalties');
	}
}
