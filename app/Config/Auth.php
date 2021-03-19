<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'login' => 'auth\login',
        'register' => 'auth\register',
        'forgot-password' => 'auth\forgot',
        'reset-password' => 'auth\reset',
        'account' => 'auth\account'
    ];

    // Layout for the views to extend
    public $viewLayout = 'auth\layout';
}
