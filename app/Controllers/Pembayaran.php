<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use CodeIgniter\CodeIgniter;

class Pembayaran extends BaseController
{
    protected $pembayaran;
    public function __construct()
    {
        $this->pembayaran = new PembayaranModel();
        $this->siswa = new SiswaModel();
    }

    public function index()
    {
        $hasil = $this->pembayaran->findAll();
        $data = [
            'title' => 'pembayaran',

            'hasil' => $hasil
        ];
        return view('pembayaran/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'tambah data',
            'pembayaran' => $this->pembayaran->findAll(),
            'siswa' => $this->siswa->findAll(),
            'validation' => \Config\Services::validation()

        ];
        return view('pembayaran/create', $data);
    }
}
