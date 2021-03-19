<?php


namespace App\Controllers;


class PayrollReportController extends BaseController
{
    public function index()
    {

        $data = [
            'blog_title' => 'My Blog Title',
            'blog_heading' => 'My Blog Heading'
        ];

        return $this->blade->run('reports.payroll.index',$data);
    }
}