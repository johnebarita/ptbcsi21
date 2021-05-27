<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notes extends Migration
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
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'employee_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true
            ],
            'noteable_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'noteable_type' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default null',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('notes');
    }

    public function down()
    {
        $this->forge->dropTable('notes');
    }
}
