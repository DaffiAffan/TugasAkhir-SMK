<?= $this->extend('Auth/templates/index'); ?>



<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4"><?= lang('Auth.register') ?></h3>
                </div>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <div class="card-body">
                    <form action="<?= route_to('register') ?>" method="post">
                        <?= csrf_field() ?>


                        <div class="form-floating mb-3">
                            <input class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" type="text" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" />
                            <label for="username"><?= lang('Auth.username') ?></label>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" type="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" />
                                    <label for="inputPassword"><?= lang('Auth.password') ?></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control  <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" type="password" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" />
                                    <label for="inputPasswordConfirm"><?= lang('Auth.repeatPassword') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"> <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button></div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">

                    <!-- <div class="small"><a href="/dashboard/login">Have an account? Go to login</a></div> -->

                    <p>
                        <a href="<?= route_to('login') ?>"><?= lang('Auth.alreadyRegistered') ?> <?= lang('Auth.signIn') ?></a>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>