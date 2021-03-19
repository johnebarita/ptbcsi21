<?php namespace App\Database\Seeds;

use App\Models\Eloquent\TimeSheet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use CodeIgniter\Database\Seeder;

class TimeSheetSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 20) as $number) {

            $period = CarbonPeriod::create(Carbon::createFromFormat('n',1)->firstOfMonth(), Carbon::now());

            foreach ($period as $date) {
                if($date->format('D')!='Sun'){
                    $this->db->table('time_sheets')->insert(['employee_id'=>$number,'date'=>$date->format('Y-m-d'),'morning_in' => '08:00', 'morning_out' => '12:00', 'morning_time' => '4', 'afternoon_in' => '01:00', 'afternoon_out' => '05:00', 'afternoon_time' => '4','pre'=>'8']);
                }
            }
        }
    }
}
