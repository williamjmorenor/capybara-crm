<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in') === true) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function loginPost()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->findByEmail($email);

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        if (! $user['active']) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        session()->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'user_role' => $user['role'],
        ]);

        return redirect()->to('/dashboard')->with('success', 'Welcome back, ' . $user['name'] . '!');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
