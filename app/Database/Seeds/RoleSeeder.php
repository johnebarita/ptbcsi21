<?php


namespace App\Database\Seeds;



use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('roles')->insert(['name'=>'Admin']);
        $this->db->table('roles')->insert(['name'=>'Payroll Master']);
        $this->db->table('roles')->insert(['name'=>'Employee']);
    }
}