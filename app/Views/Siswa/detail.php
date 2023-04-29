<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <h5>Data Siswa</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">SMK Bina Informatika</h5>
                    <table>

                        <body>
                            <tr>
                                <td>NISN </td>
                                <td> : <?= $hasil["nisn"]; ?></td>
                            </tr>
                            <tr>
                                <td>NIS </td>
                                <td> : <?= $hasil["nis"]; ?></td>
                            </tr>
                            <tr>
                                <td>Nama </td>
                                <td> : <?= $hasil["nama"]; ?></td>
                            </tr>
                            <tr>
                                <td>Kelas </td>
                                <td> : <?= $hasil["kelas"]; ?>-<?= $hasil["nama_kelas"]; ?></td>
                            </tr>
                            <tr>
                                <td>No Telfon </td>
                                <td> : <?= $hasil["no_telp"]; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat </td>
                                <td> : <?= $hasil["alamat"]; ?></td>
                            </tr>
                            <tr>
                                <td>Tahun Ajaran </td>
                                <td> : <?= $hasil["tahun"]; ?></td>
                            </tr>

                        </body>
                    </table>
                </div>
            </div>
            <?php if (in_groups('Admin')) : ?>
                <a href="/siswa/edit/<?= $hasil['nisn']; ?>" class=" btn btn-warning">Edit</a>
                <form action="/siswa/<?= $hasil['id_siswa']; ?>" method="POST" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class=" btn btn-danger" onclick="return confirm('bener nih???');">Delete</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>