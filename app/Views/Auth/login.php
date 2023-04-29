<?= $this->extend('Auth/templates/index'); ?>



<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4"><?= lang('Auth.loginTitle') ?></h3>
                </div>
                <div class="card-body">

                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <form action="<?= base_url(); ?><?= route_to('login') ?>" method="post">

                        <?= csrf_field() ?>


                        <div class="form-floating mb-3">
                            <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" type="text" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" />
                            <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" type="password" placeholder="<?= lang('Auth.password') ?>" />
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><a class="btn btn-primary btn-block" href="Dashboard"><?= lang('Auth.loginAction') ?></a></div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="/dashboard/register">Need an account? Sign up!</a></div>
                    <div class="small"><a href="https://wa.link/3koaxk" target="_blank">Perlu bantuan? hubungi admin</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>