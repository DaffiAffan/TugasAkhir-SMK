    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="#">udin ngap</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                        <?php if (in_groups('Admin')) : ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Siswa</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="/siswa">Siswa</a></li>
                                    <li><a class="dropdown-item" href="/siswa/akun">Akun siswa</a></li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/spp">Spp</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/kelas">Kelas</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Petugas</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="/petugas">Petugas</a></li>
                                    <li><a class="dropdown-item" href="/petugas/akun">Akun Petugas</a></li>

                                </ul>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="/midtrans/laporan">Laporan</a>
                            </li> -->
                        <?php endif; ?>

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/pembayaran">Pembayaran</a>
                        </li> -->
                        <?php if (in_groups('Petugas')) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/siswa">Siswa</a>
                            </li>
                        <?php endif ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/midtrans">History</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- <small>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= user()->username; ?></span>
            </small> -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <span class="nav-link"><?= user()->username; ?></span>
            </div>

            <div class="collapse navbar-collapse">
                <a href="<?= base_url('logout'); ?>" onclick="return confirm('bener nih???');" class="btn btn-danger">LOGOUT</a>
            </div>
        </div>
    </nav>