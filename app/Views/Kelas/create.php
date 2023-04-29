<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <h1>Kelas</h1>
            <form action="/Kelas/save" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" value="<?= old('id_kelas'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label ">Kelas</label>
                    <div class="col-sm-10">
                        <select name="kelas" id="kelas" class="<?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?> form-select">
                            <option value=""></option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kompetensi_keahlian" class="col-sm-2 col-form-label ">Kompetensi Keahlian</label>
                    <div class="col-sm-10">
                        <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="<?= ($validation->hasError('kompetensi_keahlian')) ? 'is-invalid' : ''; ?> form-select">
                            <option value=""></option>
                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                            <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                            <option value="Broadcast TV">Broadcast TV</option>
                            <option value="Multimedia">Multimedia</option>
                            <option value="Animasi">Animasi</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('kompetensi_keahlian'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?>  " value="<?= old('nama_kelas'); ?>" id="nama_kelas" name="nama_kelas">
                        <div class="invalid-feedback"><?= $validation->getError('nama_kelas'); ?></div>
                    </div>
                </div>

                <button type="submit" onclick="return confirm(' Pastikan Kembali Kelasnya Sudah Bener ');" class="btn btn-primary">Tambah </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>