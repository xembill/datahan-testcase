<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class Profile extends BaseController
{
    public function index()
    {
        // Oturumdaki kullanıcıyı view'a gönder
        $data['user'] = session()->get('user');
        return view('admin/profile/index', $data);
    }

    public function update()
    {
        helper(['form']);

        $rules = [
            'email' => 'required',
            'password' => 'permit_empty|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Lütfen formu kontrol ediniz.');
            return redirect()->back()->withInput();
        }

        $session = session();
        $user = $session->get('user'); // Oturumdaki kullanıcıyı çek
        $userModel = new User();

        $data = [
            'email' => $this->request->getPost('email')
        ];

        if($this->request->getPost('password')){
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($user['id'], $data);

        // Güncellenmiş veriyi oturuma da yansıtmak için:
        $session->set('user', array_merge($user, $data));

        session()->setFlashdata('success', 'Profil başarıyla güncellendi.');
        return redirect()->back();
    }
}
