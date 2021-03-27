<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TimeSheets extends Migration
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
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATETIME'
            ],
            'morning_in' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true
            ],
            'morning_out' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'morning_time' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'afternoon_in' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'afternoon_out' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'afternoon_time' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'overtime_in' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'overtime_out' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'overtime_time' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'pre' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'ot' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'late' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null'=>true,
            ],
            'on_leave' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => 0
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('time_sheets');
    }

    public function down()
    {
        $this->forge->dropTable('time_sheets');
    }
}
