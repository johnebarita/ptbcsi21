<?php


namespace App\Controllers;


use App\Models\Eloquent\Course;
use App\Models\Eloquent\Student;
use CodeIgniter\Config\Services;
use CodeIgniter\View\Parser;
use eftec\bladeone\BladeOne;

class AttendanceReportController extends BaseController
{

    public function index()
    {
        $data['filter'] = 'monthly';

        return $this->blade->run('reports.attendance.attendance', $data);
    }
}