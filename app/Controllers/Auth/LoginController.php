<?php
namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Eloquent\Employee;
use App\Models\UserModel;
use CodeIgniter\Controller;
use Config\Services;


class LoginController extends BaseController
{
	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Authentication settings.
	 */
	protected $config;


    //--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('Auth');
	}

    //--------------------------------------------------------------------

	/**
	 * Displays login form or redirects if user is already logged in.
	 */
	public function login()
	{
		if ($this->session->isLoggedIn) {
			return redirect()->back();
		}

        return $this->blade->run('auth.login');
	}

    //--------------------------------------------------------------------

	/**
	 * Attempts to verify user's credentials through POST request.
	 */
	public function attemptLogin()
	{
		// validate request
		$rules = [
			'username'		=> 'required',
			'password' 	=> 'required|min_length[5]',
		];

		if (! $this->validate($rules)) {
			return redirect()->to('login')
				->withInput()
				->with('errors', $this->validator->getErrors());
		}

		// check credentials
	    $user = Employee::where('username',$this->request->getPost('username'))->get();
		if (count($user)==0 || ! password_verify($this->request->getPost('password'), $user[0]->password_hash)) {
			return redirect()->to('login')->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// check activation
		if (!$user[0]->is_active) {
			return redirect()->to('login')->withInput()->with('error', lang('Auth.notActivated'));
		}

		// login OK, save user data to session
		$this->session->set('isLoggedIn', true);
		$this->session->set('userData', [
		    'id' 			=> $user[0]->id  ,
		    'name' 			=> $user[0]->firstname.' '.$user[0]->lastname,
		    'email' 		=> $user[0]->email,
		    'new_email' 	=> $user[0]->new_email,
		    'role' 	=> $user[0]->role()->role->name,
		]);

		if($user[0]->role()->role->name=='Employee'){
            return redirect()->to('dtr');
        }
        return redirect()->to('dashboard');


    }

    //--------------------------------------------------------------------

	/**
	 * Log the user out.
	 */
	public function logout()
	{
		$this->session->remove(['isLoggedIn', 'userData']);

		return redirect()->to('login');
	}

}
