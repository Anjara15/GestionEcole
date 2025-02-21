<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $request = service('request');
        $model = new UserModel();
        $username = $request->getPost('username');
        $password = $request->getPost('password');

        $user = $model->checkLogin($username, $password);

        if ($user) {
            $session->set('isLoggedIn', true);
            $session->set('user_id', $user['id']);
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('msg', 'Identifiants incorrects');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}