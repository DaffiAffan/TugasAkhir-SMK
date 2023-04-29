<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\SiswaModel;
use CodeIgniter\CodeIgniter;

class Kelas extends BaseController
{
    protected $kelas;

    // use \Myth\Auth\AuthTrait;

    public function __construct()
    {
        // $this->restrictToGroups('Admin', site_url('kelas'));
        $this->siswa = new SiswaModel();
        $this->kelas = new KelasModel();
    }


    public function index()
    {

        // $this->restrictToGroups('Admin', site_url('kelas'));
        // $hasil = $this->kelas->findAll();

        $currentPage = $this->request->getVar('page_kelas') ?  $this->request->getVar('page_kelas') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $cari = $this->kelas->search($keyword);
        } else {
            $cari = $this->kelas;
        }

        $data = [
            'title' => 'kelas',
            'hasil' => $cari->paginate(6, 'kelas'),
            'pager' => $this->kelas->pager,
            'currentPage' => $currentPage,
        ];
        return view('Kelas/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'tambah data',
            'validation' => \Config\Services::validation()

        ];
        return view('kelas/create', $data);
    }

    public function save()
    {
        if (!$this->validate([

            'nama_kelas' => [
                'rules' => 'required|max_length[5]|alpha_numeric_space',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'max_length' => 'Maksimal 5 huruf',
                    'alpha_numeric_space' => 'Hanya boleh angka dan huruf',
                ]
            ],
            'kompetensi_keahlian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',

                ]
            ],

        ])) {

            return redirect()->to('/kelas/create')->withInput();
        }

        $this->kelas->save([
            'id_kelas' => $this->request->getVar('id_kelas'),
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'kompetensi_keahlian' => $this->request->getVar('kompetensi_keahlian'),
            'kelas' => $this->request->getVar('kelas')
        ]);

        // session()->setFlashdata('pesan', 'Data masuk tuh');

        return redirect()->to('/kelas');
    }

    public function delete($id_kelas)
    {
        $query = $this->siswa->select('id_kelas')->where('id_kelas', $id_kelas)->get()->getNumRows();
        if ($query > 0) {
            session()->setFlashdata('pesan', 'Data sedang di pakai');
            return redirect()->to('/kelas');
        } else {

            $this->kelas->delete($id_kelas);

            session()->setFlashdata('pesan', 'Data ilang tuh');

            return redirect()->to('/kelas');
        }
    }

    public function edit($id_kelas)
    {
        $data = [
            'title' => 'ubah data',
            'hasil' => $this->kelas->getkelas($id_kelas),
            'validation' => \Config\Services::validation()


        ];
        return view('kelas/edit', $data);
    }

    public function update($id_kelas)
    {
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'required|max_length[5]|alpha_numeric_space',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'max_length' => 'Maksimal 5 huruf',
                    'alpha_numeric_space' => 'Hanya boleh angka dan huruf',

                ]
            ],
            'kompetensi_keahlian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],
        ])) {
            return redirect()->to('/kelas/edit/' . $this->request->getVar('id_kelas'))->withInput();
        }
        $this->kelas->save(
            [
                'id_kelas' => $id_kelas,
                'nama_kelas' => $this->request->getVar('nama_kelas'),
                'kompetensi_keahlian' => $this->request->getVar('kompetensi_keahlian'),
                'kelas' => $this->request->getVar('kelas')
            ]
        );

        // session()->setFlashdata('pesan', 'ubah tuh');

        return redirect()->to('/kelas');
    }
}
