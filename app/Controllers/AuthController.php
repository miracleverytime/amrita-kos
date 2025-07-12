<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel,
        $adminModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->adminModel = new AdminModel();
    }

    public function hash()
    {
        echo password_hash('wifiburik14', PASSWORD_DEFAULT);
    }

    public function index()
    {
        $data = [
            "title" => "Login"
        ];
        if (session()->get('isLogin')) {
            session()->destroy();
        }
        return view('auth/login.php', $data);
    }

    public function register()
    {
        $data = [
            "title" => "Register"
        ];
        return view("auth/register.php", $data);
    }


    public function prosesLogin()
    {

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $models = [
            'user'  => $this->userModel,
            'admin' => $this->adminModel,
        ];

        foreach ($models as $role => $model) {
            $user = $model->where('email', $email)->first();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $sessionData = [
                        'email'      => $user['email'],
                        'password'   => $user['password'],
                        'nama'       => $user['nama'] ?? '',
                        'role'       => $role,
                        'isLogin'    => true,
                    ];

                    // Tambahkan no. hp hanya jika role adalah user
                    if ($role === 'user' && isset($user['no_hp'])) {
                        $sessionData['id_user'] = $user['id_user'];
                        $sessionData['no_hp'] = $user['no_hp'];
                    } elseif ($role === 'admin' && isset($user['id_admin'])) {
                        $sessionData['id_admin'] = $user['id_admin'];
                    }


                    session()->set($sessionData);
                    // Redirect sesuai role
                    if ($role === 'user') {
                        return redirect()->to('/user/dashboard');
                    } elseif ($role === 'admin') {
                        return redirect()->to('/admin/dashboard');
                    }
                } else {
                    return redirect()->back()->with('error', 'Password salah');
                }
            }
        }

        return redirect()->back()->with('error', 'Email tidak ditemukan');
    }

    public function prosesRegister()
    {
        $data = $this->request->getPost();

        $this->userModel->insert([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'no_hp' => $data['no_hp'],
        ]);

        return redirect()->to('/')->with('success', 'Registrasi berhasil!');
    }

    public function dashAdmin()
    {
        return view('admin/dashboard.php');
    }

    public function dashUser()
    {
        echo "login user berhasil";
    }
}
