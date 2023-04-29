<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $table = ['order'];
    protected $primaryKey = ['order_id'];
    protected $allowedFields = ['order_id', 'nisn', 'id_bulan', 'kelas', 'name',  'gross_amount', 'payment_type', 'transaction_time', 'bank', 'va_number', 'pdf_url', 'status_code'];

    public function getorder($order_id = false)
    {
        if ($order_id == false) {
            return $this->findAll();
        }
        return $this->where(['order_id' => $order_id])->first();
    }
}
