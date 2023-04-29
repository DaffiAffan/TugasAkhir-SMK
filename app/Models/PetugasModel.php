<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{

    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $allowedFields = ['alamat', 'hak_akses', 'nama_petugas', 'no_telp'];

    public function getpetugas($id_petugas = false)
    {
        if ($id_petugas == false) {
            return $this->findAll();
        }
        return $this->where(['id_petugas' => $id_petugas])->first();
    }

    public function search($keyword)
    {
        return $this->table('petugas')->like('nama_petugas', $keyword)->orLike('hak_akses', $keyword)->orLike('alamat', $keyword)->orLike('no_telp', $keyword);
    }
}
