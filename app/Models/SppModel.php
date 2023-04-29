<?php

namespace App\Models;

use CodeIgniter\Model;

class SppModel extends Model
{

    protected $table = 'spp';
    protected $primaryKey = 'id_spp';
    protected $allowedFields = ['tahun', 'kompetensi_keahlian', 'nominal'];

    public function getspp($id_spp = false)
    {
        if ($id_spp == false) {
            return $this->findAll();
        }
        return $this->where(['id_spp' => $id_spp])->first();
    }

    public function search($keyword)
    {
        return $this->table('spp')->like('kompetensi_keahlian', $keyword)->orLike('nominal', $keyword)->orLike('tahun', $keyword);
    }
}
