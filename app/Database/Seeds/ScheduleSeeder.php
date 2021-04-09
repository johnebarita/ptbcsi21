<?php


namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;

class ScheduleSeeder extends Seeder
{

    public function run()
    {
        $this->db->table('schedules')->insert(['morning_in'=>'08:00','morning_out'=>'12:00','afternoon_in'=>'13:00','afternoon_out'=>'17:00','working_days'=>'0,1,2,3,4,5']);
    }
}