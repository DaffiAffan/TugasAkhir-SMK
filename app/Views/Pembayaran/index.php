<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <h1>Pembayaran</h1>
            <a href="pembayaran/create" class=" btn btn-primary">Tambah</a>

            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID Pembayaran</th>
                        <th scope="col">Tanggal Pembayaran </th>
                        <th scope="col">Jumlah Pembayaran </th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($hasil as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $k['id_pembayaran']; ?></td>
                            <td><?= $k['tgl_bayar']; ?></td>
                            <td><?= $k['jumlah_dibayar']; ?></td>
                            <td>
                                <a href="" class=" btn btn-warning">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection(''); ?>