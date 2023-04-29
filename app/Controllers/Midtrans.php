<?php

// use App\Models\CheckoutModel;

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\BulanModel;
use App\Models\CheckoutModel;
use Dompdf\Dompdf;

class Midtrans extends BaseController
{
    protected $db, $builder, $checkout;


    public function __construct()
    {
        $this->siswa = new SiswaModel();
        $this->order = new CheckoutModel();
        $this->bulan = new BulanModel();

        // $this->checkout = new CheckoutModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('order');

        \Midtrans\Config::$serverKey = 'SB-Mid-server-ezlpAgPNokNNrxOtPoa2vlTo';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function index()
    {
        if (in_groups('Siswa')) {
            $this->builder
                ->SELECT('*')
                ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan');
            $this->builder->where('nisn', user()->nisn);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        } else {
            $this->builder
                ->SELECT('*')
                ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan')
                ->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        }

        $data = [
            'title' => 'Payment List',
            'order' => $query

                ->getResult()
        ];
        return view('midtrans/index', $data);
    }

    public function history_detail($nisn)
    {

        $this->builder
            ->SELECT('*')
            ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan');;
        $this->builder->where('nisn', $nisn);
        $this->builder->orderBy('order_id', 'DESC');
        $query = $this->builder->get();

        $data = [
            'title' => 'Detail Pembayaran siswa',
            'order' => $query->getResult()
        ];
        return view('siswa/history_detail', $data);
    }

    public function search_filter()
    {
        if ($this->request->isAJAX()) {
            $minval = $this->request->getVar('first_date');
            $maxval = $this->request->getVar('last_date');

            if (in_groups('Siswa')) {
                $this->builder->where('nisn', user()->nisn);
                $this->builder->where('transaction_time >=', $minval);
                $this->builder->where('transaction_time <=', $maxval);
                $this->builder->orderBy('order_id', 'DESC');
                $query = $this->builder->get();
            } else {
                $this->builder->where('transaction_time >=', $minval);
                $this->builder->where('transaction_time <=', $maxval);
                $this->builder->orderBy('order_id', 'DESC');
                $query = $this->builder->get();
            }

            $data = [
                'order' => $query->getResult()
            ];
            $msg = [
                'data' => view('midtrans/ajax_filter_date', $data)
            ];
            echo json_encode($msg);
        } // Search Filter With ajax request
    }

    public function pembayaran()


    {
        $nisn = user()->nisn;

        $this->builder->select('');
        $this->builder->where('nisn', $nisn);
        $query = $this->builder->get();
        $cek = $query->getResultArray();

        $this->bulan->select('');
        foreach ($cek as $c) {
            $this->bulan->where('id_bulan !=', $c['id_bulan']);
        }
        $this->query = $this->bulan->get();

        $data = [
            'title' => 'Invoice',
            'bulan' => $this->query->getResult(),
            'siswa' => $this->siswa
                ->SELECT('*')
                ->JOIN('kelas', 'kelas.id_kelas=siswa.id_kelas')
                ->JOIN('spp', 'spp.id_spp=siswa.id_spp')
                ->where('nisn', $nisn)
                ->find()
        ];

        return view('midtrans/pembayaran', $data);
    }

    public function token()
    {


        $first_name = $this->request->getVar('first_name');
        $last_name = $this->request->getVar('last_name');
        $kelas = $this->request->getVar('kelas');
        $nisn = $this->request->getVar('nisn');
        $phone = $this->request->getVar('phone');
        $address = $this->request->getVar('address');
        $total = $this->request->getVar('total');
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');

        $transaction_details = array(
            'order_id' => time(),
            'gross_amount' => $total, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $total,
            'quantity' => 1,
            'name' => $nama_pembayaran
        );

        // Optional
        $item_details = array($item1_details);

        // Optional
        $billing_address = array(
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'address'       => $address,
            'nisn'          => $nisn,
            'city'          => "Semarang",
            'postal_code'   => "16602",
            'phone'         => $phone,
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'kelas'         => $kelas,
            // 'nisn'         => $nisn,
            'phone'         => $phone,
            'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
        );

        // Optional, remove this to display all available payment methods
        // $enable_payments = array('credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel');

        // Fill transaction details
        $transaction = array(
            // 'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );


        error_log(json_encode($transaction));
        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $result = json_decode($this->request->getVar('result_data'), true);



        // Pengkondisian Pembayaran Kartu Kredit    
        if ($result['payment_type'] == 'credit_card') {

            $creditcard = 'credit card';

            $savedata = [
                'order_id' => $result['order_id'],
                'name' => user()->username,
                'nisn' => user()->nisn,
                'kelas' => $this->request->getVar('kelas'),
                'id_bulan' => $this->request->getVar('id_bulan'),
                'gross_amount' => $result['gross_amount'],
                'payment_type' => $creditcard,
                'transaction_time' => $result['transaction_time'],
                'bank' => $result['bank'],
                'va_number' => 'N/A',
                'pdf_url' => $result['redirect_url'],
                'status_code' => $result['status_code']
            ];

            $simpan = $this->builder->insert($savedata);
            if ($simpan) {
                session()->setFlashData('pesan', 'Transaksi baru ditambahkan');
                return redirect()->to('/midtrans');
            } else {
                echo 'gagal';
            }
            // Pengkondisian transfer Mandiri
        } else if ($result['payment_type'] == 'echannel') {


            $savedata = [
                'order_id' => $result['order_id'],
                'name' => user()->username,
                'nisn' => user()->nisn,
                'kelas' => $this->request->getVar('kelas'),
                'id_bulan' => $this->request->getVar('id_bulan'),
                'gross_amount' => $result['gross_amount'],
                'payment_type' => 'bank transfer',
                'transaction_time' => $result['transaction_time'],
                'bank' => 'mandiri',
                'va_number' => $result['bill_key'],
                'pdf_url' => $result['pdf_url'],
                'status_code' => $result['status_code']
            ];

            $simpan = $this->builder->insert($savedata);
            if ($simpan) {
                session()->setFlashData('pesan', 'Transaksi baru ditambahkan');
                return redirect()->to('/midtrans');
            } else {
                echo 'gagal';
            }

            // Pengkondisian Transfer Bank Permata
        } else if (isset($result['permata_va_number'])) {
            $savedata = [
                'order_id' => $result['order_id'],
                'name' => user()->username,
                'nisn' => user()->nisn,
                'kelas' => $this->request->getVar('kelas'),
                'id_bulan' => $this->request->getVar('id_bulan'),
                'gross_amount' => $result['gross_amount'],
                'payment_type' => 'bank transfer',
                'transaction_time' => $result['transaction_time'],
                'bank' => 'permata',
                'va_number' => $result['permata_va_number'],
                'pdf_url' => $result['pdf_url'],
                'status_code' => $result['status_code']
            ];

            $simpan = $this->builder->insert($savedata);
            if ($simpan) {
                session()->setFlashData('pesan', 'Transaksi baru ditambahkan');
                return redirect()->to('/midtrans');
            } else {
                echo 'gagal';
            }
        } else {

            if ($result['payment_type'] == 'bank_transfer') {
                $banktransfer =  'bank transfer';
            }
            $savedata = [
                'order_id' => $result['order_id'],
                'name' => user()->username,
                'nisn' => user()->nisn,
                'kelas' => $this->request->getVar('kelas'),
                'id_bulan' => $this->request->getVar('id_bulan'),
                'gross_amount' => $result['gross_amount'],
                'payment_type' => $banktransfer,
                'transaction_time' => $result['transaction_time'],
                'bank' => $result['va_numbers'][0]['bank'],
                'va_number' => $result['va_numbers'][0]['va_number'],
                'pdf_url' => $result['pdf_url'],
                'status_code' => $result['status_code'],
            ];

            $simpan = $this->builder->insert($savedata);

            if ($simpan) {
                session()->setFlashData('pesan', 'Data baru ditambahkan');
                return redirect()->to('/midtrans');
            } else {
                echo 'gagal';
            }
        }
    }

    public function edit($o)
    {
        $data = [

            'title' => 'ubah data',
            'hasil' => $this->order
                ->SELECT('*')
                ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan')
                ->getorder($o),
            'validation' => \Config\Services::validation()
        ];

        return view('midtrans/edit', $data);
    }

    public function update($order_id)
    {

        if (!$this->validate([
            'status_code' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'buset ini pilih dulu dong',
                    'integer' => 'hanya boleh angka',
                ]
            ],

        ])) {
            return redirect()->to('/midtrans/edit/' . $this->request->getVar('order_id'))->withInput();
        }

        $savedata = [
            'order_id' => $order_id,
            'status_code' => $this->request->getVar('status_code'),
        ];
        $simpN = $this->builder->where('order_id', $order_id);
        $simpan = $this->builder->update($savedata);

        if ($simpan) {
            // session()->setFlashData('pesan', 'Data baru ditambahkan');
            return redirect()->to('/midtrans');
        } else {
            echo 'gagal';
        }
    }

    public function delete($order_id)
    {
        $hapus = $this->builder->where('order_id', $order_id);
        $hapus = $this->builder->delete();

        // session()->setFlashdata('pesan', 'Data ilang tuh');

        if ($hapus) {
            // session()->setFlashData('pesan', 'Data baru ditambahkan');
            return redirect()->to('/midtrans');
        } else {
            echo 'gagal';
        }
    }


    public function excel()
    {
        $minval = $this->request->getVar('first_date');
        $maxval = $this->request->getVar('last_date');

        if (in_groups('Siswa')) {
            $this->builder->where('nisn', user()->nisn);
            $this->builder->where('transaction_time >=', $minval);
            $this->builder->where('transaction_time <=', $maxval);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        } else {
            $this->builder->where('transaction_time >=', $minval);
            $this->builder->where('transaction_time <=', $maxval);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        }

        $data = [
            'list' => $query->getResult(),
            'title' => 'Excel'
        ];
        return view('midtrans/excel', $data);
    }

    public function laporan()
    {
        if (in_groups('Siswa')) {
            $this->builder->where('nisn', user()->nisn);

            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        } else {
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        }

        $data = [
            'title' => 'Payment List',
            'order' => $query->getResult()
        ];
        return view('midtrans/laporan', $data);
    }

    public function pdf()
    {
        $minval = $this->request->getVar('first_date');
        $maxval = $this->request->getVar('last_date');
        $dompdf = new Dompdf();
        if (in_groups('Siswa')) {
            $this->builder
                ->SELECT('*')
                ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan')
                ->where('nisn', user()->nisn);
            $this->builder->where('transaction_time >=', $minval);
            $this->builder->where('transaction_time <=', $maxval);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        } else {
            $this->builder
                ->SELECT('*')
                ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan')
                ->where('transaction_time >=', $minval);
            $this->builder->where('transaction_time <=', $maxval);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        }

        $data = [
            'title' => 'Payment List',
            'order' => $query->getResult()
        ];

        // return view('midtrans/laporan', $data);
        $html =  view('midtrans/laporan', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_SPP.pdf', array(
            "Attachment" => false
        ));
    }

    public function pdfall()
    {
        $dompdf = new Dompdf();
        if (in_groups('Siswa')) {
            $this->builder
                ->SELECT('*')
                ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan')
                ->where('nisn', user()->nisn);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        } else {
            $this->builder
                ->SELECT('*')
                ->JOIN('bulan', 'bulan.id_bulan=order.id_bulan')
                ->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        }

        $data = [
            'title' => 'Payment List',
            'order' => $query->getResult()
        ];

        // return view('midtrans/laporan', $data);
        $html =  view('midtrans/laporan', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_SPP.pdf', array(
            "Attachment" => false
        ));
    }
}
