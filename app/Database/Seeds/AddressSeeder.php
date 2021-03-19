<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddressSeeder extends Seeder
{
	public function run()
	{
		$this->db->table('addresses')->insert(["city"=>"Cebu","postal_code"=>"123456"]);
	}
}
