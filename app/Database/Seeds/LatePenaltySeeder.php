<?php


namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;

class LatePenaltySeeder extends Seeder
{
    public function run()
    {
        $this->db->table('late_penalties')->insert(["from"=>"0:30","to"=>"0:59","equivalent"=>"1:00"]);
        $this->db->table('late_penalties')->insert(["from"=>"1:00","to"=>"1:59","equivalent"=>"2:00"]);
        $this->db->table('late_penalties')->insert(["from"=>"2:00","to"=>"2:59","equivalent"=>"3:00"]);
        $this->db->table('late_penalties')->insert(["from"=>"3:00","to"=>"3:59","equivalent"=>"4:00"]);
    }
}