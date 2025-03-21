<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */
/**
 * Giriş Controller.
 */
namespace App\Controllers;
use App\Models\User;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $session = session();
        $model = new User();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ]);
            return redirect()->to('/admin');
        }

        return redirect()->back()->with('error', 'Geçersiz e-posta veya şifre');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
