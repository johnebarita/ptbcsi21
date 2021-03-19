<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
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
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'middle' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'birth_date' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'marital_status_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'mobile_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'tel_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'contact_person_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'monthly_pay' => [
                'type' => 'double',
            ],
            'is_fixed_salary' => [
                'type' => 'TINYINT',
                'constraint' => '1',
            ],
            'basic_pay' => [
                'type' => 'DOUBLE',
            ],
            'allowance' => [
                'type' => 'DOUBLE',
            ],
            'sss_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'philhealth_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'pagibig_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'tin_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'user_role_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'employee_login_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
//            'address_id'         => [
//                'type'           => 'INT',
//                'constraint'     => '11',
//                'unsigned'       => true,
//            ],
            'can_ot' => [
                'type' => 'TINYINT',
                'constraint' => '1',
            ],
            'position_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'bank_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'office_location' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'date_hired' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'employee_status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'internet_allowance' => [
                'type' => 'DOUBLE',
            ],
            'transportation_allowance' => [
                'type' => 'DOUBLE',
            ],
            'meal_allowance' => [
                'type' => 'DOUBLE',
            ],
            'phone_allowance' => [
                'type' => 'DOUBLE',
            ],
            'total_allowance' => [
                'type' => 'DOUBLE',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => '1',
            ],
            'new_email' => [
                'type' => 'varchar',
                'constraint' => 191,
                'null' => true
            ],
            'password_hash' => [
                'type' => 'varchar',
                'constraint' => 191
            ],
            'activate_hash' => [
                'type' => 'varchar',
                'constraint' => 191,
                'null' => true
            ],
            'activated' => [
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => 0,
                'default' => 0
            ],
            'reset_hash' => [
                'type' => 'varchar',
                'constraint' => 191,
                'null' => true
            ],
            'reset_expires' => [
                'type' => 'bigint',
                'null' => true
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('marital_status_id', 'marital_statuses', 'id', 'CASCADE', "CASCADE");
//        $this->forge->addForeignKey('address_id','addresses','id');
        $this->forge->addForeignKey('position_id', 'positions', 'id', 'CASCADE', "CASCADE");
        $this->forge->createTable('employees');
	}

	public function down()
	{
      $this->forge->dropTable('employees');
	}
}
