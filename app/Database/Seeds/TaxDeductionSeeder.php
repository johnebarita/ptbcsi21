<?php


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Illuminate\Support\Carbon;

class TaxDeductionSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('tax_deductions')->insert(['from'=>Carbon::now()->startOfYear(),'type'=>'pag-ibig','lowest'=>1,'highest'=>1500-0.01,'employer_share'=>1,'employee_share'=>2]);
        $this->db->table('tax_deductions')->insert(['from'=>Carbon::now()->startOfYear(),'type'=>'pag-ibig','lowest'=>1500,'highest'=>100000,'employer_share'=>2,'employee_share'=>2]);
        $this->db->table('tax_deductions')->insert(['from'=>'2022-01-01 00:00:00','type'=>'philhealth','lowest'=>10000,'highest'=>70000,'employer_share'=>1.75,'employee_share'=>1.75]);
        $this->db->table('tax_deductions')->insert(['from'=>'2022-01-01 00:00:00','type'=>'philhealth','lowest'=>10000,'highest'=>80000,'employer_share'=>2,'employee_share'=>2]);
        $this->db->table('tax_deductions')->insert(['from'=>'2023-01-01 00:00:00','type'=>'philhealth','lowest'=>10000,'highest'=>90000,'employer_share'=>2.25,'employee_share'=>2.25]);
        $this->db->table('tax_deductions')->insert(['from'=>'2024-01-01 00:00:00','type'=>'philhealth','lowest'=>10000,'highest'=>100000,'employer_share'=>2.5,'employee_share'=>2.5]);
        $this->db->table('tax_deductions')->insert(['from'=>'2021-01-01 00:00:00','type'=>'sss','lowest'=>3250,'highest'=>20250,'employer_share'=>8.5,'employee_share'=>4.5]);
    }
}