<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{

    protected $table = 'pembayaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_pembayaran', 'id_petugas', 'nisn', 'tgl_bayar', 'bulan_dibayar', 'tahun_dibayar', 'id_spp', 'jumlah_dibayar'];
}
