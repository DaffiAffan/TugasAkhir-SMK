<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupUsersModel extends Model
{

    protected $table = 'auth_groups_users';
    protected $primaryKey = 'user_id';
    protected $useTimestamp = true;

    // allowed fields masih bisa di tambah nama atau yang lain
    protected $allowedFields = ['group_id', 'user_id'];

    // public function akun($akun = false)
    // {
    //     if ($akun == false) {
    //         return $this->findAll();
    //     }
    //     return $this->where(['id' => $akun])->first();
    // }
}
