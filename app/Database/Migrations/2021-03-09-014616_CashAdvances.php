<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CashAdvances extends Migration
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
            'request_date' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'amount' => [
                'type' => 'DOUBLE',
            ],
            'repayment' => [
                'type' => 'DOUBLE',
            ],
            'balance' => [
                'type' => 'DOUBLE',
            ],
            'date_paid' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
             'is_paid' => [
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => 0,
                'default' => 0
            ],
            'purpose' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cash_advances');
    }

    public function down()
    {
        $this->forge->dropTable('cash_advances');
    }
}
