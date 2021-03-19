<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Overtimes extends Migration
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
            'request_date' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'overtime_in' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'overtime_out' => [
                'type' => 'VARCHAR',
                'constraint' => '50',

            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'pending',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('overtimes');
    }

    public function down()
    {
        $this->forge->dropTable('overtimes');
    }
}
