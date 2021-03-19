<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
	public function run()
	{
        $this->db->table('marital_statuses')->insert(["status"=>"Single"]);
        $this->db->table('marital_statuses')->insert(["status"=>"Married"]);
        $this->db->table('marital_statuses')->insert(["status"=>"Widowed"]);
        $this->db->table('marital_statuses')->insert(["status"=>"Divorced"]);
	}
}
