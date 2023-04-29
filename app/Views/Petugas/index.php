<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <?php if (session()->get('pesan')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <h1>Petugas</h1>
            <a href="petugas/create" class=" btn btn-primary">Tambah</a>
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form" autocomplete="off" placeholder=" cari apaan???" name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">cari</button>
                </div>
            </form>
            <table class="table table-dark table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Petugas </th>
                        <th scope="col">Alamat </th>
                        <th scope="col">No Telfon</th>
                        <th scope="col">Hak Akses </th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($hasil as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $k['nama_petugas']; ?></td>
                            <td><?= $k['alamat']; ?></td>
                            <td><?= $k['no_telp']; ?></td>
                            <td><?= $k['hak_akses']; ?></td>
                            <td>
                                <a href="/petugas/edit/<?= $k['id_petugas']; ?>" class=" btn btn-warning">Edit</a>
                                <form action="/petugas/<?= $k['id_petugas']; ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class=" btn btn-danger" onclick="return confirm('bener nih???');">Delete</button>
                                </form>
                                <!-- <a href="" class=" btn btn-danger">Delete</a> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('petugas', 'pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>