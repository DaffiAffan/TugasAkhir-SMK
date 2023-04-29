<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SppModel;
use App\Models\kelasModel;
use App\Models\AkunModel;
use App\Models\GroupUsersModel;
use Myth\Auth\Password;
use CodeIgniter\CodeIgniter;

class Siswa extends BaseController
{
    protected $siswa;
    public function __construct()
    {
        $this->siswa = new SiswaModel();
        $this->groupuser = new GroupUsersModel();
        $this->akun = new AkunModel();
        $this->kelas = new kelasModel();
        $this->spp = new SppModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_siswa') ?  $this->request->getVar('page_siswa') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $cari = $this->siswa->search($keyword);
        } else {
            $cari = $this->siswa;
        }

        $data = [
            'title' => 'Siswa',

            'hasil' => $cari
                ->SELECT('*')
                ->JOIN('kelas', 'kelas.id_kelas=siswa.id_kelas')
                ->paginate(6, 'siswa'),
            'pager' => $this->siswa->pager,
            'currentPage' => $currentPage,

        ];
        return view('Siswa/index', $data);
    }


    public function create()
    {
        $data = [
            'pilihan' => '',
            'title' => 'tambah data',
            'kelas' => $this->kelas->findAll(),
            'spp' => $this->spp->findAll(),
            'siswa' => $this->siswa->findAll(),
            'validation' => \Config\Services::validation()


        ];
        return view('Siswa/create', $data);
    }

    public function save()
    {
        if (!$this->validate([

            'nisn' => [
                'rules' => 'required|is_unique[siswa.nisn]|integer',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'is_unique' => 'eh gak boleh sama dong nisn nya ',
                    'integer' => 'cuman boleh angka'
                ]
            ],
            'nis' => [
                'rules' => 'required|is_unique[siswa.nis]|integer',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'is_unique' => 'eh gak boleh sama dong nis nya',
                    'integer' => 'cuman boleh angka'
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'alpha_space' => 'cuman boleh huruf',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
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
            'id_spp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],

        ])) {

            return redirect()->to('/Siswa/create')->withInput();
        }


        $this->siswa->save([
            'id_siswa' => $this->request->getVar('id_siswa'),
            'nisn' => $this->request->getVar('nisn'),
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'id_spp' => $this->request->getVar('id_spp')
        ]);


        // session()->setFlashdata('pesan', 'Data masuk tuh');

        return redirect()->to('/siswa');
    }

    public function delete($id_siswa)
    {
        $query = $this->akun->select('nisn')->where('nisn', $id_siswa)->get()->getNumRows();
        if ($query > 0) {
            session()->setFlashdata('pesan', 'Data sedang di pakai');
            return redirect()->to('/siswa');
        } else {

            $this->siswa->delete($id_siswa);

            // session()->setFlashdata('pesan', 'Data ilang tuh');

            return redirect()->to('/siswa');
        }
    }

    public function edit($nisn)
    {
        $data = [
            'title' => 'ubah data',
            'hasil' => $this->siswa->getsiswa($nisn),
            'kelas' => $this->kelas->findAll(),
            'spp' => $this->spp->findAll(),
            'validation' => \Config\Services::validation()


        ];
        return view('/siswa/edit', $data);
    }

    public function update($nisn)
    {
        if (!$this->validate([

            'nisn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',

                ]
            ],
            'nis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'alpha_space' => 'cuman boleh huruf',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
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
            'id_spp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],

        ])) {
            return redirect()->to('/siswa/edit/' . $this->request->getVar('nisn'))->withInput();
        }
        $this->siswa->save(
            [
                'nisn' => $nisn,
                'id_siswa' => $this->request->getVar('id_siswa'),
                'nis' => $this->request->getVar('nis'),
                'nama' => $this->request->getVar('nama'),
                'id_kelas' => $this->request->getVar('id_kelas'),
                'alamat' => $this->request->getVar('alamat'),
                'no_telp' => $this->request->getVar('no_telp'),
                'id_spp' => $this->request->getVar('id_spp')
            ]
        );

        // session()->setFlashdata('pesan', 'ubah tuh');

        return redirect()->to('/siswa');
    }

    public function detail($nisn)
    {
        $data = [
            'title' => 'Detail Siswa',
            'hasil' => $this->siswa
                ->SELECT('*')
                ->JOIN('kelas', 'kelas.id_kelas=siswa.id_kelas')
                ->JOIN('spp', 'spp.id_spp=siswa.id_spp')
                ->getsiswa($nisn),
            'kelas' => $this->kelas->findAll(),
            'spp' => $this->spp->findAll(),
            'validation' => \Config\Services::validation()


        ];

        // gak ada 
        // if (empty($data['siswa'])) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Gak ada siswa' . $id_siswa . ' nya');
        // }

        return view('siswa/detail', $data);
    }

    public function akun()
    {

        $data = [
            'title' => 'Akun Siswa',
            'siswa' => $this->siswa->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('layout/register', $data);
    }

    public function proses()
    {
        if (!$this->validate([

            'nisn' => [
                'rules' => 'required|is_unique[users.nisn]',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                    'is_unique' => 'siswa ini sudah di buatkan akun',
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

        ])) {

            if ('password'  != 'pass_confirm') {

                return redirect()->to('/Siswa/akun')->withInput();
            }
        }

        // dd($this->request->getVar());

        $password = $this->request->getVar('password');
        $proses = [
            'nisn' => $this->request->getVar('nisn'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password_hash' => Password::hash($password),
            'active' => 1
        ];

        $this->akun->insert($proses);

        $AkunBaru = $this->akun->insertID();

        $proses = [
            'user_id' => $AkunBaru,
            'group_id' => 3,
        ];

        $this->groupuser->insert($proses);

        // session()->setFlashdata('pesan', 'Data masuk tuh');

        return redirect()->to('/siswa');
    }
}
