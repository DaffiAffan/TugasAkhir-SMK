<?php

namespace App\Controllers;


use App\Models\PetugasModel;
use App\Models\AkunModel;
use App\Models\GroupUsersModel;
use Myth\Auth\Password;
use CodeIgniter\CodeIgniter;

class Petugas extends BaseController
{
    protected $petugas;
    public function __construct()
    {
        $this->petugas = new PetugasModel();
        $this->groupuser = new GroupUsersModel();
        $this->akun = new AkunModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_petugas') ?  $this->request->getVar('page_petugas') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $cari = $this->petugas->search($keyword);
        } else {
            $cari = $this->petugas;
        }

        $data = [
            'title' => 'petugas',
            'hasil' => $cari->paginate(6, 'petugas'),
            'pager' => $this->petugas->pager,
            'currentPage' => $currentPage,
        ];
        return view('petugas/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'tambah data',
            'validation' => \Config\Services::validation()

        ];
        return view('petugas/create', $data);
    }

    public function save()
    {
        if (!$this->validate([

            'nama_petugas' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'alpha_numeric_space' => 'Hanya boleh angka dan huruf',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                ]
            ],
            'hak_akses' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',

                ]
            ],

        ])) {

            return redirect()->to('/petugas/create')->withInput();
        }


        $this->petugas->save([
            // 'id_petugas' => $this->request->getVar('id_petugas'),
            'nama_petugas' => $this->request->getVar('nama_petugas'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'hak_akses' => $this->request->getVar('hak_akses')
        ]);


        // session()->setFlashdata('pesan', 'Data masuk tuh');

        return redirect()->to('/petugas');
    }

    public function delete($id_petugas)
    {
        $query = $this->akun->select('id_petugas')->where('id_petugas', $id_petugas)->get()->getNumRows();
        if ($query > 0) {
            session()->setFlashdata('pesan', 'Data sedang di pakai');
            return redirect()->to('/petugas');
        } else {

            $this->petugas->delete($id_petugas);

            // session()->setFlashdata('pesan', 'Data ilang tuh');

            return redirect()->to('/petugas');
        }
    }

    public function edit($id_petugas)
    {
        $data = [
            'title' => 'ubah data',
            'hasil' => $this->petugas->getpetugas($id_petugas),
            'validation' => \Config\Services::validation()


        ];
        return view('petugas/edit', $data);
    }

    public function update($id_petugas)
    {
        if (!$this->validate([

            'nama_petugas' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'alpha_numeric_space' => 'Hanya boleh angka dan huruf',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                ]
            ],
            'hak_akses' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',

                ]
            ],
        ])) {
            return redirect()->to('/petugas/edit/' . $this->request->getVar('id_petugas'))->withInput();
        }
        $this->petugas->save(
            [
                'id_petugas' => $id_petugas,
                'nama_petugas' => $this->request->getVar('nama_petugas'),
                'alamat' => $this->request->getVar('alamat'),
                'no_telp' => $this->request->getVar('no_telp'),
                'hak_akses' => $this->request->getVar('hak_akses')
            ]
        );

        // session()->setFlashdata('pesan', 'ubah tuh');

        return redirect()->to('/petugas');
    }

    public function akun()
    {

        $data = [
            'title' => 'Akun petugas',
            'petugas' => $this->petugas->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('layout/register_petugas', $data);
    }

    public function proses()
    {
        if (!$this->validate([

            'id_petugas' => [
                'rules' => 'required|is_unique[users.id_petugas]',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                    'is_unique' => 'petugas ini sudah di buatkan akun',
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',

                ]
            ],
            'username' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'alpha_numeric_space' => 'cuman boleh huruf',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                ]
            ],
            'pass_confirm' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'matches' => 'password gak sama',
                ]
            ],

        ]))

            $password = $this->request->getVar('password');
        $proses = [
            'id_petugas' => $this->request->getVar('id_petugas'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password_hash' => Password::hash($password),
            'active' => 1
        ];

        $this->akun->insert($proses);

        $AkunBaru = $this->akun->insertID();

        $akses = $this->petugas->find($this->request->getVar('id_petugas'));

        $hak = $akses["hak_akses"];

        if ($hak == "Admin") {

            $group = 1;
        } else {
            $group = 2;
        }


        $proses = [
            'user_id' => $AkunBaru,
            'group_id' => $group,
        ];

        $this->groupuser->insert($proses);

        // session()->setFlashdata('pesan', 'Data masuk tuh');

        return redirect()->to('/petugas');
    }
}
