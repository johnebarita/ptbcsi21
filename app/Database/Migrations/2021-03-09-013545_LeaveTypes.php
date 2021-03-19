<?php namespace App\Database\Migrations;


use CodeIgniter\Database\Migration;

class LeaveTypes extends Migration
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
                'constraint' => '50',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('leave_types');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('leave_types');
    }
}
