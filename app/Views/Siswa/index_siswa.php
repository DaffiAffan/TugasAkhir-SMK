<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <center>
                <h1>HALLO</h1>

                <h2>SELAMAT DATANG </h2>
                <h3><?= user()->username; ?></h3>
            </center>

        </div>
    </div>
</div>

<?= $this->endSection(''); ?>