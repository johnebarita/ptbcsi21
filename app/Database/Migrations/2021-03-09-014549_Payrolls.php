<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payrolls extends Migration
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
                'constraint' => '11',
                'unsigned' => true,
            ],
            'from' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'to' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'dtr_time' => [
                'type' => 'DOUBLE',
            ],
            'absent' => [
                'type' => 'DOUBLE',
            ],
            'late' => [
                'type' => 'INT',
            ],
            'basic_salary' => [
                'type' => 'DOUBLE',
            ],
            'allowance' => [
                'type' => 'DOUBLE',
            ],
            'normal_ot' => [
                'type' => 'DOUBLE',
            ],
            'normal_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_sunday_ot' => [
                'type' => 'DOUBLE',
            ],
            'rd_sunday_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_regular_ot' => [
                'type' => 'DOUBLE',
            ],
            'rd_regular_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_double_ot' => [
                'type' => 'DOUBLE',
            ],
            'rd_double_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_special_ot' => [
                'type' => 'DOUBLE',
            ],
            'rd_special_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_sunday_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_regular_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_double_pay' => [
                'type' => 'DOUBLE',
            ],
            'rd_special_pay' => [
                'type' => 'DOUBLE',
            ],
            'nd_regular_ot' => [
                'type' => 'DOUBLE',
            ],
            'nd_regular_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'nd_double_ot' => [
                'type' => 'DOUBLE',
            ],
            'nd_double_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'nd_special_ot' => [
                'type' => 'DOUBLE',
            ],
            'nd_special_ot_pay' => [
                'type' => 'DOUBLE',
            ],
            'nd_regular_pay' => [
                'type' => 'DOUBLE',
            ],
            'nd_double_pay' => [
                'type' => 'DOUBLE',
            ],
            'nd_special_pay' => [
                'type' => 'DOUBLE',
            ],
            'total_ot' => [
                'type' => 'DOUBLE',
            ],
            'other_income' => [
                'type' => 'DOUBLE',
            ],
            'gross_pay' => [
                'type' => 'DOUBLE',
            ],
            'with_tax' => [
                'type' => 'DOUBLE',
            ],
            'phi' => [
                'type' => 'DOUBLE',
            ],
            'sss' => [
                'type' => 'DOUBLE',
            ],
            'hdmf' => [
                'type' => 'DOUBLE',
            ],
            'cash_advance' => [
                'type' => 'DOUBLE',
            ],
            'sss_loan' => [
                'type' => 'DOUBLE',
            ],
            'hdmf_loan' => [
                'type' => 'DOUBLE',
            ],
            'other_deduction' => [
                'type' => 'DOUBLE',
            ],
            'total_deduction' => [
                'type' => 'DOUBLE',
            ],
            'net_pay' => [
                'type' => 'DOUBLE',
            ],
            'can_ot' => [
                'type' => 'TINYINT',
                'constraint' => '1',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payrolls');
    }

    public function down()
    {
        $this->forge->dropTable('payrolls');
    }
}
