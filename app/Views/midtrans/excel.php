<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=List.xls");

?>
<html>

<body>
    <table border="1">
        <thead>
            <tr>
                <?php if (!in_groups('Siswa')) : ?>
                    <th scope="col">NISN</th>
                    <th scope="col">Name</th>
                <?php endif ?>
                <th scope="col">monthly_payment</th>
                <th scope="col">Order Id</th>
                <th scope="col">Gross Amount</th>
                <th scope="col">Payment Type</th>
                <th scope="col">Date</th>
                <th scope="col">Bank</th>
                <th scope="col">VA Number</th>
                <th scope="col">Guide</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $o) : ?>
                <tr>
                    <?php if (!in_groups('Siswa')) : ?>
                        <td> <a href="/siswa/detail/<?= $o->nisn ?>"> <?= $o->nisn ?> </a></td>
                        <td class="text-capitalize"><?= $o->name ?></td>
                    <?php endif ?>
                    <td class="text-capitalize"><?= $o->monthly_payment ?></td>

                    <?php if (!in_groups('Siswa')) : ?>
                        <td> <a href="/midtrans/edit/<?= $o->order_id ?>"><?= $o->order_id ?></td>
                    <?php endif ?>
                    <?php if (in_groups('Siswa')) : ?>
                        <td><?= $o->order_id ?></td>
                    <?php endif ?>

                    <td>Rp. <?= number_format($o->gross_amount) ?></td>
                    <?php if ($o->payment_type == 'credit card') : ?>
                        <td><?= '<div class="badge text-capitalize">Credit Card</div>' ?></td>
                    <?php else : ?>
                        <td><?= '<div class="badge  text-capitalize">Bank Transfer</div>' ?></td>
                    <?php endif ?>
                    <td><?= $o->time_stamp ?></td>
                    <td class="text-uppercase"><?= $o->bank ?></td>
                    <?php if (!in_groups('Siswa')) : ?>
                        <td> <a onclick="return confirm('ini hapus data loh yakin ???');" href="/midtrans/delete/<?= $o->order_id ?>"><?= $o->va_number ?></td>
                    <?php endif ?>
                    <?php if (in_groups('Siswa')) : ?>
                        <td> <?= $o->va_number ?></td>
                    <?php endif ?>
                    <td><a class="btn badge badge-danger" href="<?= $o->pdf_url ?>" target="_blank">PDF</a></td>
                    <?php if ($o->status_code == 200) : ?>
                        <td><?= '<div class="badge badge-success">Success</div>' ?></td>
                    <?php else : ?>
                        <td><?= '<div class="badge badge-warning">Pending</div>' ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>