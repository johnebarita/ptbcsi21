<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssignedRoles extends Migration
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
                'unsigned' => true,
                'null' => true
            ],
            'role_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', "CASCADE");
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', "CASCADE");
        $this->forge->createTable('assigned_roles');
    }

    public function down()
    {
        $this->forge->dropTable('assigned_roles');
    }
}
