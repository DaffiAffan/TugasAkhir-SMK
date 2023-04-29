<?php

namespace App\Models;

use CodeIgniter\Model;

class BulanModel extends Model
{
    protected $table = ['bulan'];
    protected $primaryKey = ['id_bulan'];
    // protected $allowedFields = ['order_id', 'nisn', 'id_bulan', 'kelas', 'name',  'gross_amount', 'payment_type', 'transaction_time', 'bank', 'va_number', 'pdf_url', 'status_code'];

    public function getbulan($id_bulan = false)
    {
        if ($id_bulan == false) {
            return $this->findAll();
        }
        return $this->where(['id_bulan' => $id_bulan])->first();
    }
}
