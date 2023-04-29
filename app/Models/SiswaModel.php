<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $allowedFields = ['nisn', 'nis', 'nama', 'id_kelas', 'alamat', 'no_telp', 'id_spp'];

    public function getsiswa($nisn = false)
    {
        if ($nisn == false) {
            return $this->findAll();
        }
        return $this->where(['nisn' => $nisn])->first();
    }

    public function search($keyword)
    {
        return $this->table('siswa')->like('nisn', $keyword)->orLike('nama', $keyword)->orLike('nama_kelas', $keyword)->orLike('kelas', $keyword);
    }
}
