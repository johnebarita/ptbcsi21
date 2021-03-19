<?php


namespace App\Controllers\Auth;


use App\Controllers\BaseController;
use App\Models\Eloquent\Employee;
use App\Models\UserModel;

class Login extends BaseController
{

    public function index()
    {
        if ($this->session->isLoggedIn) {
            return redirect()->route('dashboard.index');
        }
        return view('login\index');
    }

    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->route('login.index')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $employee = Employee::where('email', $this->request->getPost('email'))->first();

        if (is_null($employee) ||
            !password_verify($this->request->getPost('password'), $employee['password_hash'])
        ) {
            return redirect()->to('login')->withInput()->with('error', lang('Auth.wrongCredentials'));
        }

        // check activation
        if (!$employee['activated']) {
            return redirect()->to('login')->withInput()->with('error', lang('Auth.notActivated'));
        }

        // login OK, save user data to session
        $this->session->set('isLoggedIn', true);
        $this->session->set('auth_user', [
            'id' => $employee['id'],
            'name' => $employee['name'],
            'email' => $employee['email'],
            'new_email' => $employee['new_email']
        ]);

        return redirect()->route('dashboard.index');
    }

    public function logout()
    {
        $this->session->remove(['isLoggedIn', 'auth_user']);

        return redirect()->route('login.index');
    }
}