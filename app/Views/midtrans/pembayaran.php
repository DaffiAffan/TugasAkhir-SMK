<?php

use Faker\Provider\Base;
?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container col-md-6 py-2 my-3">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3><?= $title ?></h3>
        </div>
        <div class="card-body">
            <form action="/midtrans/finish" method="post" id="payment-form">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">NISN</label>
                        </div>
                        <div class="col-md-6">
                            <label for="">: <strong><?= user()->nisn ?></strong></label>
                            <input type="hidden" id="nisn" name="nisn" value="<?= user()->nisn ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Nama</label>
                        </div>
                        <div class="col-md-6">
                            <label for="">: <strong><?= $siswa['0']['nama']; ?></strong></label>
                            <input type="hidden" id="name" name="name" value="<?= $siswa['0']['nama']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Kelas</label>
                        </div>
                        <div class="col-md-6">
                            <label for="">: <strong><?= $siswa['0']['kelas']; ?>-<?= $siswa['0']['nama_kelas']; ?></strong></label>
                            <input type="hidden" id="kelas" name="kelas" value="<?= $siswa['0']['kelas']; ?>-<?= $siswa['0']['nama_kelas']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Pembayaran Bulan</label>
                        </div>
                        <div class="col-md-6">
                            <select name="id_bulan" id="id_bulan" class="form-select">
                                <?php foreach ($bulan as $b) : ?>
                                    <option value="<?= $b->id_bulan ?>"><?= $b->bulan ?></option>
                                <?php endforeach ?>
                            </select>
                            <p style=" font-size: 12px;">Pastikan sudah melihat history pembayaran, sebelum lakukan pembayaran baru. </p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Perihal Pembayaran</label>
                        </div>
                        <div class="col-md-6">
                            <label for="">: <strong>Pembayaran SPP</strong></label>
                            <input type="hidden" id="nama_pembayaran" name="nama_pembayaran" value="Pembayaran SPP">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" style="font-size:30px;">Total Pembayaran :</label>
                        </div>
                        <div class="col-md">
                            <label for="" style="font-size:35px;font-weight:600;">Rp. <?= number_format($siswa['0']['nominal']); ?></label>
                        </div>
                        <input type="hidden" id="total" value="<?= $siswa['0']['nominal']; ?>" name="total">
                    </div>
                </div>

                <!-- Don't Delete this element -->
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">

                <button type="submit" id="pay-button" class="btn btn-primary">Bayar</button>
            </form>

            <!-- Button -->
        </div>
    </div>
</div>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-DSgmZaS2y8Pp4pJT"></script>
<script type="text/javascript">
    $('#pay-button').click(function(e) {
        e.preventDefault();
        $(this).attr("disabled", "disabled");

        const first_name = $('#first_name').val();
        const last_name = $('#last_name').val();
        const kelas = $('#kelas').val();
        const nisn = $('#nisn').val();
        const address = $('#address').val();
        const phone = $('#phone').val();
        const total = $('#total').val();
        const nama_pembayaran = $('#nama_pembayaran').val();

        $.ajax({
            url: '<?= base_url() ?>/midtrans/token',
            type: "POST",
            data: {
                name: name,
                kelas: kelas,
                nisn: nisn,
                address: address,
                phone: phone,
                total: total,
                nama_pembayaran: nama_pembayaran
            },
            cache: false,

            success: function(data) {
                //location = data;
                console.log(data);
                console.log('token = ' + data);
                $('#pay-button').removeAttr('disabled');

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {
                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();

                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();

                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    })
</script>

<?= $this->endSection() ?>