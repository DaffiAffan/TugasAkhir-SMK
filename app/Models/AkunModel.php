<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamp = true;

    // allowed fields masih bisa di tambah nama atau yang lain
    protected $allowedFields = ['email', 'nisn', 'id_petugas', 'username', 'password_hash', 'active'];

    // public function akun($akun = false)
    // {
    //     if ($akun == false) {
    //         return $this->findAll();
    //     }
    //     return $this->where(['id' => $akun])->first();
    // }
}
