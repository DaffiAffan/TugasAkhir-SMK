<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <h1>spp</h1>
            <form action="/spp/save" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" value="<?= old('id_spp'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tahun" class="col-sm-2 col-form-label ">Tahun Ajaran</label>
                    <div class="col-sm-10">
                        <select name="tahun" id="tahun" class="<?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?> form-select ">
                            <option value=""></option>
                            <option value="2021/2022">2021/2022</option>
                            <option value="2022/2023">2022/2023</option>
                            <option value="2023/2024">2023/2024</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('tahun'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= ($validation->hasError('nominal')) ? 'is-invalid' : ''; ?>  " value="<?= old('nominal'); ?>" id="nominal" name="nominal" maxlength="5">
                        <div class="invalid-feedback"><?= $validation->getError('nominal'); ?></div>
                    </div>
                </div>

                <!-- <div class="row mb-3">
                    <label for="id_kelas" class="col-sm-2 col-form-label ">id_kelas</label>
                    <div class="col-sm-10">
                        <select name="id_kelas" id="id_kelas" class="<?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?>">
                            <option value=""></option>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id_kelas']; ?>"><?= $k['kelas']; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('id_kelas'); ?></div>
                    </div>
                </div> -->

                <div class="row mb-3">
                    <label for="kompetensi_keahlian" class="col-sm-2 col-form-label ">Kompetensi Keahlian</label>
                    <div class="col-sm-10">
                        <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="<?= ($validation->hasError('kompetensi_keahlian')) ? 'is-invalid' : ''; ?> form-select ">
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

                <button type="submit" onclick="return confirm(' Pastikan Kembali Tahun Ajarannya ');" class="btn btn-primary">Tambah </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>