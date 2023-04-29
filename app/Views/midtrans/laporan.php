<html>
<style>
    table,
    th,
    td {
        border: 1px solid;
    }

    .card-body {
        text-align: center;
    }
</style>

<center>
    <div class="card-body">


        <H1>Data Pembayaran SPP</H1>
        <h2>SMK BINA INFORMATIKA</h2>


        <div class="table-responsive" id="main-data">
            <table class="table table-dark table-hover table-bordered table-striped" id="table-data">
                <thead class="bg-dark text-white">
                    <tr>
                        <?php if (in_groups('Admin')) : ?>
                            <th scope="col">NISN</th>
                            <th scope="col">Name</th>
                            <th scope="col">kelas</th>
                        <?php endif ?>
                        <th scope="col">monthly_payment</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Gross Amount</th>
                        <th scope="col">Payment Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Bank</th>
                        <th scope="col">VA Number</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order as $o) : ?>
                        <tr>
                            <?php if (in_groups('Admin')) : ?>
                                <td> <?= $o->nisn ?> </a></td>
                                <td class="text-capitalize"><?= $o->name ?></td>
                                <td class="text-capitalize"><?= $o->kelas ?></td>
                            <?php endif ?>
                            <td class="text-capitalize"><?= $o->bulan ?></td>
                            <td><?= $o->order_id ?></td>
                            <td>Rp. <?= number_format($o->gross_amount) ?></td>
                            <?php if ($o->payment_type == 'credit card') : ?>
                                <td><?= '<div class="badge bg_light text-capitalize">Credit Card</div>' ?></td>
                            <?php else : ?>
                                <td><?= '<div class="badge bg_light text-capitalize">Bank Transfer</div>' ?></td>
                            <?php endif ?>
                            <td><?= $o->time_stamp ?></td>
                            <td class="text-uppercase"><?= $o->bank ?></td>
                            <td><?= $o->va_number ?></td>
                            <?php if ($o->status_code == 200) : ?>
                                <td><?= '<div class="badge badge-success">Success</div>' ?></td>
                            <?php else : ?>
                                <td><?= '<div class="badge badge-warning">Pending</div>' ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</center>

</html>