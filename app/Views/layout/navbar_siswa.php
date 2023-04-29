    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="container-fluid">

                <!-- <a class="navbar-brand" href="#">udin ngap</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/siswa/detail/<?= user()->nisn; ?>">Data siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/midtrans">History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/midtrans/pembayaran">Transaksi</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="collapse navbar-collapse" id="navbarNav">
                <span class="nav-link"><?= user()->username; ?></span>
            </div>

            <div class="collapse navbar-collapse">
                <a href="<?= base_url('logout'); ?>" onclick="return confirm('bener nih???');" class="btn btn-danger">LOGOUT</a>
            </div>
        </div>
    </nav>