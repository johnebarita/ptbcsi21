<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Schedules extends Migration
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
            'morning_in' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'morning_out' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'afternoon_in' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'afternoon_out' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'working_days' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null'=>true,
            ],
            'custom' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'default'=>false
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
       $this->forge->addPrimaryKey('id');
       $this->forge->createTable('schedules');
	}

	public function down()
	{
      $this->forge->dropTable('schedules');
	}
}
