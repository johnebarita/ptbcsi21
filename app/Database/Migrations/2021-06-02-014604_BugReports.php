<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BugReports extends Migration
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
            'bug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tester' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'reference' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'urgency' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'remarks' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'date_reported' => [
                'type' => 'DATETIME',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('bug_reports');
    }

    public function down()
    {
        $this->forge->dropTable('bug_reports');
    }
}
