<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Siswa</h1>
            <form action="/Siswa/save" method="POST">

                <?= csrf_field(); ?>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" value="<?= old('id_pembayaran'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_petugas" class="col-sm-2 col-form-label">Petugas</label>
                    <div class="col-sm-10">
                        <?= user()->username; ?>
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="id_spp" class="col-sm-2 col-form-label ">Siswa</label>
                    <div class="col-sm-10">
                        <select name="nisn" id="nisn" class="<?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?> form-select ">
                            <option value=""></option>
                            <?php foreach ($siswa as $k) : ?>
                                <option value="<?= $k['nisn']; ?>"><?= $k['nama']; ?> - <?= $k['nisn']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('nisn'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">waktu pembayaran</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?>  " value="<?= old('nama_kelas'); ?>" id="nama_kelas" name="nama_kelas">
                        <div class="invalid-feedback"><?= $validation->getError('nama_kelas'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="bulan_dibayar" class="col-sm-2 col-form-label "> Bulan Bayar</label>
                    <div class="col-sm-10">
                        <select name="bulan_dibayar" id="bulan_dibayar" class="<?= ($validation->hasError('bulan_dibayar')) ? 'is-invalid' : ''; ?> form-select">
                            <option value=""></option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('kompetensi_keahlian'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tahun_dibayar" class="col-sm-2 col-form-label "> Tahun Bayar</label>
                    <div class="col-sm-10">
                        <select name="tahun_dibayar" id="tahun_dibayar" class="<?= ($validation->hasError('tahun_dibayar')) ? 'is-invalid' : ''; ?> form-select">
                            <option value=""></option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('tahun_dibayar'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_spp" class="col-sm-2 col-form-label ">ID SPP</label>
                    <div class="col-sm-10">
                        <select name="nisn" id="nisn" class="<?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?> form-select ">
                            <option value=""></option>
                            <?php foreach ($siswa as $k) : ?>
                                <option value="<?= $k['nisn']; ?>"><?= $k['id_spp']; ?> - <?= $k['nisn']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('nisn'); ?></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>