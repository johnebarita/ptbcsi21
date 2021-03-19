<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AttendanceSummaries extends Migration
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
            'date' => [
                'type' => 'DATETIME',
            ],
            'present' => [
                'type' => 'INT',
            ],
            'late' => [
                'type' => 'INT',
            ],
            'absent' => [
                'type' => 'INT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('attendance_summaries');
    }

    public function down()
    {
        $this->forge->dropTable('attendance_summaries');
    }
}
