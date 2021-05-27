<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Holidays extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'start' => [
                'type' => 'DATETIME',
            ],
            'end' => [
                'type' => 'DATETIME',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('holidays');
    }

    public function down()
    {
        $this->forge->dropTable('holidays');
    }
}
