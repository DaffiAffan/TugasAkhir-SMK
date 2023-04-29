<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <h1>Petugas</h1>
            <form action="/petugas/save" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" value="<?= old('id_petugas'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_petugas" class="col-sm-2 col-form-label">Nama Petugas</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control <?= ($validation->hasError('nama_petugas')) ? 'is-invalid' : ''; ?>  " value="<?= old('nama_petugas'); ?>" id="nama_petugas" name="nama_petugas">
                        <div class="invalid-feedback"><?= $validation->getError('nama_petugas'); ?></div>
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
                    <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>  " value="<?= old('alamat'); ?>" id="alamat" name="alamat">
                        <div class="invalid-feedback"><?= $validation->getError('alamat'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="hak_akses" class="col-sm-2 col-form-label ">Hak Akses</label>
                    <div class="col-sm-10">
                        <select name="hak_akses" id="hak_akses" class="<?= ($validation->hasError('hak_akses')) ? 'is-invalid' : ''; ?> form-select">
                            <option value=""></option>
                            <option value="Admin">Admin</option>
                            <option value="Petugas">Petugas</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('hak_akses'); ?></div>
                    </div>
                </div>

                <button type="submit" onclick="return confirm(' Pastikan Kembali Hak Akses Sudah Bener ');" class="btn btn-primary">Tambah </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>