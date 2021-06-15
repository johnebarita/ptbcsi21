<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use eftec\bladeone\BladeOne;

class PayrollFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!isset(session()->userData)){
            return redirect()->to('login');
        }
       if(session()->userData['role']=='Employee'){
           return redirect()->back();
       }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}