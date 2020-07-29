<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <div class="row">
        <div class="col-lg-10">
            <form action="<?= base_url('Lihat_Pekerjaan'); ?>" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-outline-secondary">Ok</button>
                    </div>
                    <select name="kode_proyek" class="custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                        <option value="" selected>Pilih Proyek...</option>
                        <?php foreach ($proyek as $r) : ?>
                            <option value="<?= $r['kode_proyek']; ?>"><?= $r['nama_proyek']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>

            <?php if (null == ($this->input->post('kode_proyek'))) { ?>

            <?php } else { ?>
                <?php
                if ($status == 1) {
                    ?>
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Proyek</th>
                                <th scope="col">Kode Pekerjaan</th>
                                <th scope="col">Nama Pekerjaan</th>
                                <th scope="col">Bobot</th>
                                <th scope="col">Bobot Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $jml = 0;
                            $jmlr = 0;
                            ?>
                            <?php foreach ($pekproy as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $p['nama_proyek']; ?></td>
                                    <td><?= $p['kode_pekerjaan']; ?></td>
                                    <td><?= $p['nama_pekerjaan']; ?></td>
                                    <td><?= $p['bobot']; ?> %</td>
                                    <td><?= $p['bobot_realisasi']; ?> %</td>
                                </tr>
                                <?php $i++;
                                $jml += $p['bobot'];
                                $jmlr += $p['bobot_realisasi'];
                                ?>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4">Jumlah </td>
                                <td><?= $jml; ?> %</td>
                                <td><?= $jmlr; ?> %</td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo 'Isi terlebih dahulu pekerjaannya';
                } //endif status
            } //end if post
            ?>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->