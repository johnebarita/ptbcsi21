<?php namespace App\Database\Seeds;

use App\Controllers\ZKLib\ZKLib;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Position;
use App\Models\Eloquent\User;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        service('eloquent');
        $faker = Factory::create();
        $this->db->table('employees')->insert([
            'firstname' => 'John',
            'lastname' => 'Ebarita',
            'email' => 'john@gmail.com',
            'marital_status_id' => rand(1, 3),
            'position_id' => 1,
            'monthly_pay' => 16000.00,
            'basic_pay' => round(16000 * 12 / 313, 2),
            'username' => 'admin',
            'password_hash' => password_hash('123123123', PASSWORD_DEFAULT),
            'activate_hash' => Str::random(32),
            'is_active' => true,
        ]);
        $this->db->table('assigned_roles')->insert(['employee_id' => 1, 'role_id' => 1]);

        $this->db->table('employees')->insert([
            'firstname' => 'Maricris Joy',
            'lastname' => 'Annunciacion',
            'email' => 'mara@gmail.com',
            'marital_status_id' => rand(1, 3),
            'position_id' => 1,
            'monthly_pay' => 16000.00,
            'basic_pay' => round(16000 * 12 / 313, 2),
            'username' => 'payroll',
            'password_hash' => password_hash('123123123', PASSWORD_DEFAULT),
            'activate_hash' => Str::random(32),
            'is_active' => true,
        ]);
        $this->db->table('assigned_roles')->insert(['employee_id' => 2, 'role_id' => 2]);

        $this->db->table('employees')->insert([
            'firstname' => 'Mariel',
            'lastname' => 'Boiser',
            'email' => 'mariel@gmail.com',
            'marital_status_id' => rand(1, 3),
            'position_id' => 1,
            'monthly_pay' => 16000.00,
            'basic_pay' => round(16000 * 12 / 313, 2),
            'username' => 'mariel',
            'password_hash' => password_hash('123123123', PASSWORD_DEFAULT),
            'activate_hash' => Str::random(32),
            'is_active' => true,
        ]);
        $this->db->table('assigned_roles')->insert(['employee_id' => 3, 'role_id' => 3]);

        foreach (range(4, 20) as $number) {
            $firstname = $faker->firstName;
            $lastname = $faker->lastName;
            $email = Str::random(5) . '@gmail.com';
            if ($number < 7) {
                $this->db->table('employees')->insert(
                    [
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                        'marital_status_id' => rand(1, 4),
                        'position_id' => 1,
                        'monthly_pay' => 16000.00,
                        'basic_pay' => round(16000 * 12 / 313, 2),
                        'sss_no' => '1',
                        'pagibig_no' => '1',
                        'philhealth_no' => '1',
                        'tin_no' => '1',
                        'username' => strtolower(str_replace(' ', '', $firstname)),
                        'password_hash' => password_hash('123123123', PASSWORD_DEFAULT),
                        'activate_hash' => Str::random(32),
                        'is_active' => true,
                    ]);
            } else {
                $this->db->table('employees')->insert(
                    [
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => Str::random(5) . '@gmail.com',
                        'marital_status_id' => rand(1, 3),
                        'position_id' => 1,
                        'monthly_pay' => 16000.00,
                        'basic_pay' => round(16000 * 12 / 313, 2),
                        'username' => strtolower(str_replace(' ', '', $firstname)),
                        'password_hash' => password_hash('123123123', PASSWORD_DEFAULT),
                        'activate_hash' => Str::random(32),
                        'is_active' => true,
                    ]);
            }
            $this->db->table('assigned_roles')->insert(['employee_id' => $number, 'role_id' => 3]);
        }

        $this->zk = new ZKLib('192.168.1.100');


        if ($this->zk->connect()) {
            $employees = Employee::all();
            foreach ($employees as $employee) {
                $this->zk->setUser($employee->id, $employee->id, strtoupper($employee->lastname . ' ' . $employee->firstname), '');
            }
            $this->zk->disconnect();
        }
    }
}
