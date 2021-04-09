<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PositionSeeder extends Seeder
{
	public function run()
	{
        $this->db->table('positions')->insert(['position'=>'Programming','rate'=>16000,'schedule_id'=>1]);
	}
}
