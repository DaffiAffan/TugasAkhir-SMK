<?php

namespace App\Controllers;

use App\Models\SppModel;
use App\Models\SiswaModel;
use App\Models\kelasModel;
use CodeIgniter\CodeIgniter;

class Spp extends BaseController
{

    protected $spp;
    public function __construct()
    {
        $this->kelas = new kelasModel();
        $this->siswa = new SiswaModel();
        $this->spp = new SppModel();
    }

    public function index()
    {

        $currentPage = $this->request->getVar('page_spp') ?  $this->request->getVar('page_spp') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $cari = $this->spp->search($keyword);
        } else {
            $cari = $this->spp;
        }

        $data = [

            'title' => 'Spp',
            'hasil' => $cari->paginate(6, 'spp'),
            'pager' => $this->spp->pager,
            'currentPage' => $currentPage,
        ];

        return view('Spp/index', $data);
    }

    public function create()
    {
        $data = [

            'title' => 'tambah data',
            'kelas' => $this->kelas->findAll(),
            'validation' => \Config\Services::validation()

        ];
        return view('Spp/create', $data);
    }

    public function save()
    {
        if (!$this->validate([

            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],
            'nominal' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'integer' => 'cuman boleh angka',
                ]
            ],
            'kompetensi_keahlian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],

        ])) {

            return redirect()->to('/spp/create')->withInput();
        }


        $this->spp->save([
            'id_spp' => $this->request->getVar('id_spp'),
            'tahun' => $this->request->getVar('tahun'),
            'nominal' => $this->request->getVar('nominal'),
            'kompetensi_keahlian' => $this->request->getVar('kompetensi_keahlian')
        ]);


        // session()->setFlashdata('pesan', 'Data masuk tuh');

        return redirect()->to('/Spp');
    }

    public function delete($id_spp)
    {
        $query = $this->siswa->select('id_spp')->where('id_spp', $id_spp)->get()->getNumRows();
        if ($query > 0) {
            session()->setFlashdata('pesan', 'Data sedang di pakai');
            return redirect()->to('/spp');
        } else {

            $this->spp->delete($id_spp);

            // session()->setFlashdata('pesan', 'Data ilang tuh');

            return redirect()->to('/spp');
        }
    }

    public function edit($id_spp)
    {
        $data = [
            'title' => 'ubah data',
            'kelas' => $this->kelas->findAll(),
            'hasil' => $this->spp->getspp($id_spp),
            'validation' => \Config\Services::validation()


        ];
        // dd($data);
        return view('spp/edit', $data);
    }

    public function update($id_spp)
    {
        if (!$this->validate([

            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],
            'nominal' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'buset ini isi dulu dong',
                    'integer' => 'cuman boleh angka',
                ]
            ],
            'kompetensi_keahlian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                ]
            ],

        ])) {
            return redirect()->to('/spp/edit/' . $this->request->getVar('id_spp'))->withInput();
        }
        $this->spp->save(
            [
                'id_spp' => $id_spp,
                'tahun' => $this->request->getVar('tahun'),
                'nominal' => $this->request->getVar('nominal'),
                'kompetensi_keahlian' => $this->request->getVar('kompetensi_keahlian')
            ]
        );

        // session()->setFlashdata('pesan', 'ubah tuh');

        return redirect()->to('/spp');
    }
}
