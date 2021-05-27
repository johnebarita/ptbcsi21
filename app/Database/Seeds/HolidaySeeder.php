<?php


namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;

class HolidaySeeder extends Seeder
{
    public function run()
    {
        $this->db->table('holidays')->insert(["name" => "test", "type" => 'Regular', 'start' => "2021-05-07 00:00:00", 'end' => "2021-05-07 00:00:00"]);
        $this->db->table('holidays')->insert(["name" => "test 2", "type" => 'Regular', 'start' => "2021-05-07 00:00:00", 'end' => "2021-05-07 00:00:00"]);
    }
}