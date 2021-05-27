<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
        $this->call('LeaveTypeSeeder');
        $this->call('MaritalStatusSeeder');
        $this->call('SssLookupSeeder');
        $this->call('ScheduleSeeder');
        $this->call('PositionSeeder');
        $this->call('EmployeeSeeder');
        $this->call('LatePenaltySeeder');
        $this->call('HolidaySeeder');
        $this->call('TimeSheetSeeder');

        $this->call('TaxDeductionSeeder');
    }
}
