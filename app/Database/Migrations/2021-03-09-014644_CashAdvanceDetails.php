<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CashAdvanceDetails extends Migration
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
            'cash_advance_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'payroll_range' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'payroll_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'amount_paid' => [
                'type' => 'DOUBLE',
            ],
            'amount_changed' => [
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => 0,
                'default' => 0
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cash_advance_details');
    }

    public function down()
    {
        $this->forge->dropTable('cash_advance_details');
    }
}
