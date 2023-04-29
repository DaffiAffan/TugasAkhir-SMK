<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <h1>Kelas</h1>
            <form action="/Kelas/update/<?= $hasil['id_kelas']; ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" value="<?= old('id_kelas'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" name="id_kelas" value="<?= $hasil['id_kelas']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label ">Kelas</label>
                    <div class="col-sm-10">
                        <?= $hasil['kelas']; ?>
                        <select hidden name="kelas" id="kelas" class="<?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?> form-select ">
                            <option value=""></option>
                            <option value="10" <?php if ($hasil['kelas'] == '10') echo 'selected' ?>>10</option>
                            <option value="11" <?php if ($hasil['kelas'] == '11') echo 'selected' ?>>11</option>
                            <option value="12" <?php if ($hasil['kelas'] == '12') echo 'selected' ?>>12</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kompetensi_keahlian" class="col-sm-2 col-form-label ">Kompetensi Keahlian</label>
                    <div class="col-sm-10">
                        <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="<?= ($validation->hasError('kompetensi_keahlian')) ? 'is-invalid' : ''; ?> form-select">
                            <option value=""></option>
                            <option value="Rekayasa Perangkat Lunak" <?php if ($hasil['kompetensi_keahlian'] == 'Rekayasa Perangkat Lunak') echo 'selected' ?>>Rekayasa Perangkat Lunak</option>
                            <option value="Teknik Komputer Jaringan" <?php if ($hasil['kompetensi_keahlian'] == 'Teknik Komputer Jaringan') echo 'selected' ?>>Teknik Komputer Jaringan</option>
                            <option value="Broadcast TV" <?php if ($hasil['kompetensi_keahlian'] == 'Broadcast TV') echo 'selected' ?>>Broadcast TV</option>
                            <option value="Multimedia" <?php if ($hasil['kompetensi_keahlian'] == 'Multimedia') echo 'selected' ?>>Multimedia</option>
                            <option value="Animasi" <?php if ($hasil['kompetensi_keahlian'] == 'Animasi') echo 'selected' ?>>Animasi</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('kompetensi_keahlian'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?>  " value="<?= (old('nama_kelas')) ? old('nama_kelas') : $hasil['nama_kelas'] ?>" id="nama_kelas" name="nama_kelas" maxlength="5">
                        <div class="invalid-feedback"><?= $validation->getError('nama_kelas'); ?></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>