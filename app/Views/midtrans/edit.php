<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <form action="/midtrans/update/<?= $hasil['order_id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" value="<?= old('order_id'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="hidden" name="order_id" value="<?= $hasil['order_id']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="order_id" class="col-sm-2 col-form-label">order_id</label>
                    <div class="col-sm-10">
                        <input readonly type="number" class="form-control <?= ($validation->hasError('order_id')) ? 'is-invalid' : ''; ?>" value="<?= (old('order_id')) ? old('order_id') : $hasil['order_id'] ?>" id="order_id" name="order_id">
                        <div class="invalid-feedback"><?= $validation->getError('order_id'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="gross_amount" class="col-sm-2 col-form-label">gross_amount</label>
                    <div class="col-sm-10">
                        <input readonly type="text" class="form-control <?= ($validation->hasError('gross_amount')) ? 'is-invalid' : ''; ?>" value="  <?= number_format(old('gross_amount')) ? old('gross_amount') : $hasil['gross_amount'] ?>" id="gross_amount" name="gross_amount">
                        <div class="invalid-feedback"><?= $validation->getError('gross_amount'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="va_number" class="col-sm-2 col-form-label">va_number</label>
                    <div class="col-sm-10">
                        <input readonly type="number" class="form-control <?= ($validation->hasError('va_number')) ? 'is-invalid' : ''; ?>  " value="<?= (old('va_number')) ? old('va_number') : $hasil['va_number'] ?>" id="va_number" name="va_number">
                        <div class="invalid-feedback"><?= $validation->getError('va_number'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="transaction_time" class="col-sm-2 col-form-label">transaction_time</label>
                    <div class="col-sm-10">
                        <input readonly type="text" class="form-control <?= ($validation->hasError('transaction_time')) ? 'is-invalid' : ''; ?>  " value="<?= (old('transaction_time')) ? old('transaction_time') : $hasil['transaction_time'] ?>" id="transaction_time" name="transaction_time">
                        <div class="invalid-feedback"><?= $validation->getError('transaction_time'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                    <div class="col-sm-10">
                        <input readonly type="number" class="form-control <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?>  " value="<?= (old('nisn')) ? old('nisn') : $hasil['nisn'] ?>" id="nisn" name="nisn">
                        <div class="invalid-feedback"><?= $validation->getError('nisn'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">name</label>
                    <div class="col-sm-10">
                        <input readonly type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>  " value="<?= (old('name')) ? old('name') : $hasil['name'] ?>" id="name" name="name">
                        <div class="invalid-feedback"><?= $validation->getError('name'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">kelas</label>
                    <div class="col-sm-10">
                        <input readonly type="text" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>  " value="<?= (old('kelas')) ? old('kelas') : $hasil['kelas'] ?>" id="kelas" name="kelas">
                        <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="bulan" class="col-sm-2 col-form-label">Monthly Payment</label>
                    <div class="col-sm-10">
                        <input readonly type="text" class="form-control <?= ($validation->hasError('bulan')) ? 'is-invalid' : ''; ?>  " value="<?= (old('bulan')) ? old('bulan') : $hasil['bulan'] ?>" id="bulan" name="bulan">
                        <div class="invalid-feedback"><?= $validation->getError('bulan'); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="status_code" class="col-sm-2 col-form-label ">Status</label>
                    <div class="col-sm-10">

                        <select name="status_code" id="status_code" class="<?= ($validation->hasError('status_code')) ? 'is-invalid' : ''; ?> form-select ">
                            <option value=""></option>
                            <option value="201" <?php if ($hasil['status_code'] == '201') echo 'selected' ?>>Pending</option>
                            <option value="200" <?php if ($hasil['status_code'] == '200') echo 'selected' ?>>Settlement</option>

                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>