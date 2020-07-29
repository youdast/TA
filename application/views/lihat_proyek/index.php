<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>


    <div class="row">
        <div class="col-lg-10">
            <table class=" table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Proyek</th>
                        <th scope="col">Nama Proyek</th>
                        <th scope="col">Alamat Proyek</th>
                        <th scope="col" width="150px">Biaya Proyek</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Lama Proyek</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($proyek as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['kode_proyek']; ?></td>
                            <td><?= $p['nama_proyek']; ?></td>
                            <td><?= $p['alamat_proyek']; ?></td>
                            <td align="right">Rp. <?= number_format($p['biaya_proyek']); ?></td>
                            <td align="center"><?php
                                                $tglm = strtotime($p['tanggal_mulai']);
                                                echo date('d-m-Y', $tglm); ?></td>
                            <td align="center"><?php
                                                $tgls = strtotime($p['tanggal_selesai']);
                                                echo date('d-m-Y', $tgls); ?></td>
                            <td align="center"><?= $p['lama_proyek']; ?> minggu</td>
                            <td align="left"><?= $p['status']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->