<?php namespace App\Database\Seeds;

use App\Models\Eloquent\Position;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
	public function run()
	{
	    $faker = Factory::create();
		foreach (range(1,20) as $number){
		    if($number<7){
                $this->db->table('employees')->insert(['firstname'=>$faker->firstName,'lastname'=>$faker->lastName,'marital_status_id'=>rand(1,3),'position_id'=>1,'monthly_pay'=>16000.00,'basic_pay'=>round(16000*12/313,2),'sss_no'=>'1','pagibig_no'=>'1','philhealth_no'=>'1','tin_no'=>'1']);
            }else{
                $this->db->table('employees')->insert(['firstname'=>$faker->firstName,'lastname'=>$faker->lastName,'marital_status_id'=>rand(1,3),'position_id'=>1,'monthly_pay'=>16000.00,'basic_pay'=>round(16000*12/313,2)]);
            }
        }
	}
}
