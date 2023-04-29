<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\CodeIgniter;

class Dashboard extends BaseController
{

    protected $siswa;
    public function __construct()
    {
        $this->siswa = new SiswaModel();
    }

    public function index()
    {
        // $nisn = user()->nisn;
        // dd($nisn);
        $data = [
            'title' => 'Dashboard',
            // 'nisn' => $this->siswa->where($nisn)->findAll()
        ];
        if (in_groups('Siswa')) :
            return view('Siswa/index_siswa', $data);
        endif;
        return view('index', $data);
    }

    public function login()
    {

        $data = [
            'title' => 'login'
        ];
        return view('Auth/login', $data);
    }
    // public function login()
    // {

    //     $data = [
    //         'title' => 'login'
    //     ];
    //     return view('Auth/login', $data);
    // }

    public function register()
    {

        $data = [
            'title' => 'register'
        ];
        return view('Auth/register', $data);
    }
}
