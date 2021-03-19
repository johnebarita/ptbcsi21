<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addresses extends Migration
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
            'employee_id'        => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
            ],
            'city'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'postal_code'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('employee_id','employees','id','CASCADE','CASCADE');
        $this->forge->createTable('addresses');
	}

	public function down()
	{
      $this->forge->dropTable('addresses');
	}
}
