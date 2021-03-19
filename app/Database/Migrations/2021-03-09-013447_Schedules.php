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
            'time_in' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'time_out' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'working_days' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
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
