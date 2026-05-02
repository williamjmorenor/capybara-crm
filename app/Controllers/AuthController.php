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

    public function profile(): string
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));

        if (! $user) {
            return redirect()->to('/logout');
        }

        return view('profile/edit.php', [
            'title' => 'My Profile',
            'user'  => $user,
        ]);
    }

    public function profileUpdate()
    {
        $userModel = new \App\Models\UserModel();
        $userId    = session()->get('user_id');
        $user      = $userModel->find($userId);

        if (! $user) {
            return redirect()->to('/logout');
        }

        $rules = [
            'name'  => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[150]',
        ];

        $password = $this->request->getPost('password');
        if ($password !== null && $password !== '') {
            $rules['password'] = 'min_length[6]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        if ($email !== $user['email'] && $userModel->where('email', $email)->where('id !=', $userId)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('errors', ['email' => 'That email address is already taken.']);
        }

        $updateData = [
            'name'  => $this->request->getPost('name'),
            'email' => $email,
        ];

        if ($password !== null && $password !== '') {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $updateData);

        if (session()->get('user_name') !== $updateData['name']) {
            session()->set('user_name', $updateData['name']);
        }

        return redirect()->to('/profile')->with('success', 'Your profile has been updated.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
