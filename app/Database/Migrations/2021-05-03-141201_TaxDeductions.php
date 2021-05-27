<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TaxDeductions extends Migration
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
            'from' => [
                'type' => 'DATETIME'
            ],
            'to' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true
            ],
            'employer_share'=>[
                'type' => 'DOUBLE',
                'null' => true
            ],
            'employee_share'=>[
                'type' => 'DOUBLE',
                'null' => true
            ],
            'lowest'=>[
                'type' => 'DOUBLE',
                'null' => true
            ],
            'highest'=>[
                'type' => 'DOUBLE',
                'null' => true
            ],
            'range_increment'=>[
                'type' => 'DOUBLE',
                'null' => true
            ],
            'credit_increment'=>[
                'type' => 'DOUBLE',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tax_deductions');
    }

    public function down()
    {
        $this->forge->dropTable('tax_deductions');
    }
}
