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

            <h1>Siswa</h1>
            <?php if (in_groups('Admin')) : ?>
                <a href="siswa/create" class=" btn btn-primary">Tambah</a>
            <?php endif ?>


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
                        <th scope="col">Nisn</th>
                        <th scope="col">Nama </th>
                        <th scope="col">kelas</th>
                        <th scope="col">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($hasil as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $k['nisn']; ?></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['nama_kelas']; ?>-<?= $k['kelas']; ?></td>
                            <td>
                                <a href="/siswa/detail/<?= $k['nisn']; ?>" class=" btn btn-warning">Detail</a>
                                <a href="/midtrans/history_detail/<?= $k['nisn']; ?>" class=" btn btn-danger">History</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('siswa', 'pagination'); ?>

        </div>
    </div>
</div>

<?= $this->endSection(''); ?>