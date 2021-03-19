<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SssLookups extends Migration
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
                'type' => 'DOUBLE',
            ],
            'to' => [
                'type' => 'DOUBLE',
            ],
            'salary_credit' => [
                'type' => 'DOUBLE',
            ],
            'ss_er' => [
                'type' => 'DOUBLE',
            ],
            'ss_ee' => [
                'type' => 'DOUBLE',
            ],
            'ss_total' => [
                'type' => 'DOUBLE',
            ],
            'ec_er' => [
                'type' => 'DOUBLE',
            ],
            'tc_er' => [
                'type' => 'DOUBLE',
            ],
            'tc_ee' => [
                'type' => 'DOUBLE',
            ],
            'tc_total' => [
                'type' => 'DOUBLE',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
       $this->forge->addPrimaryKey('id');
       $this->forge->createTable('sss_lookups');
	}

	public function down()
	{
      $this->forge->dropTable('sss_lookups');
	}
}
