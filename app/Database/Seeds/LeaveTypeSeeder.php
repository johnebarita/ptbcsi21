<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
	public function run()
	{
        $this->db->table('leave_types')->insert(["name"=>"Sick Leave"]);
        $this->db->table('leave_types')->insert(["name"=>"Maternity Leave"]);
        $this->db->table('leave_types')->insert(["name"=>"Emergency Leave"]);
        $this->db->table('leave_types')->insert(["name"=>"Another Leave"]);
	}
}
