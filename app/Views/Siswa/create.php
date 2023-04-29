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
                        <input type="hidden" value="<?= old('id_siswa'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="number" class="form-control <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?>  " value="<?= old('nisn'); ?>" id="nisn" name="nisn" maxlength="8">
                        <div class="invalid-feedback"><?= $validation->getError('nisn'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="number" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>  " value="<?= old('nis'); ?>" id="nis" name="nis" maxlength="8">
                        <div class="invalid-feedback"><?= $validation->getError('nis'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>  " value="<?= old('nama'); ?>" id="nama" name="nama">
                        <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="no_telp" class="col-sm-2 col-form-label">No Telfon</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="number" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>  " value="<?= old('no_telp'); ?>" id="no_telp" name="no_telp" maxlength="12">
                        <div class="invalid-feedback"><?= $validation->getError('no_telp'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_kelas" class="col-sm-2 col-form-label ">Kelas</label>
                    <div class="col-sm-10">
                        <select name="id_kelas" id="id_kelas" class="<?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?> form-select ">
                            <option value=""></option>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?> - <?= $k['kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('id_kelas'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_spp" class="col-sm-2 col-form-label ">SPP</label>
                    <div class="col-sm-10">
                        <select name="id_spp" id="id_spp" class="<?= ($validation->hasError('id_spp')) ? 'is-invalid' : ''; ?> form-select ">
                            <option value=""></option>
                            <?php foreach ($spp as $k) : ?>
                                <option value="<?= $k['id_spp']; ?>"><?= $k['tahun']; ?> - <?= $k['kompetensi_keahlian']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('id_spp'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>  " value="<?= old('alamat'); ?>" id="alamat" name="alamat">
                        <div class="invalid-feedback"><?= $validation->getError('alamat'); ?></div>
                    </div>
                </div>

                <button type="submit" onclick="return confirm(' Pastikan NISN Dan NIS Sudah Benar ');" class="btn btn-primary">Tambah </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>