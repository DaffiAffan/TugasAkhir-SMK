<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<div class="container">
    <div class="row">
        <div class="col">

            <div class="card">
                <h2 class="card-header"><?= lang('Auth.register') ?></h2>
                <div class="card-body">

                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <form action="/petugas/proses" method="post">
                        <?= csrf_field() ?>


                        <div class="form-group">
                            <label for="id_spp" class="col-sm-2 col-form-label ">petugas</label>
                            <div class="col-sm-10">
                                <select name="id_petugas" id="id_petugas" class="<?= ($validation->hasError('id_petugas')) ? 'is-invalid' : ''; ?> form-select ">
                                    <option value=""></option>
                                    <?php foreach ($petugas as $k) : ?>
                                        <option value="<?= $k['id_petugas']; ?>"><?= $k['nama_petugas']; ?> - <?= $k['hak_akses']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= $validation->getError('id_petugas'); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <label for="email"><?= lang('Auth.email') ?></label>
                                <input type="email" id="emial" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>  " name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <label for="username"><?= lang('Auth.username') ?></label>
                                <input type="text" id="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>  " name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" autocomplete="off">
                                <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <label for="password"><?= lang('Auth.password') ?></label>
                                <input type="password" id="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?> " placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                <input type="password" id="pass_confirm" name="pass_confirm" class="form-control <?= ($validation->hasError('pass_confirm')) ? 'is-invalid' : ''; ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                <div class="invalid-feedback"><?= $validation->getError('pass_confirm'); ?></div>
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary"><?= lang('Auth.register') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>