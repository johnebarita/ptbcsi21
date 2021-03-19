<?php


namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;

class ScheduleSeeder extends Seeder
{

    public function run()
    {
        $this->db->table('schedules')->insert(['time_in'=>'8:00','time_out'=>'5:00']);
    }
}