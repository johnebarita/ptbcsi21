<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/10/2020
 * Time: 5:11 PM
 */

namespace App\Controllers;


class AuthController extends BaseController
{
    public function index()
    {
        return redirect()->route('dashboard');
        return view('template\template');
    }
}