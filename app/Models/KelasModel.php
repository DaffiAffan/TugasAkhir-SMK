<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['nama_kelas', 'kompetensi_keahlian', 'kelas'];

    public function getkelas($id_kelas = false)
    {
        if ($id_kelas == false) {
            return $this->findAll();
        }
        return $this->where(['id_kelas' => $id_kelas])->first();
    }

    public function search($keyword)
    {
        return $this->table('kelas')->like('kelas', $keyword)->orLike('nama_kelas', $keyword)->orLike('kompetensi_keahlian', $keyword);
    }
}
