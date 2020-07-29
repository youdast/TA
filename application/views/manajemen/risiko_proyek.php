<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <div class="row">
        <div class="col-lg-10">
            <form action="<?= base_url('manajemen/risiko_proyek'); ?>" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-outline-secondary">Ok</button>
                    </div>
                    <select name="kode_proyek" class="custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                        <option value="" selected>Pilih Proyek...</option>
                        <?php foreach ($kproyek as $r) : ?>
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
                    <h4>
                        Berikut ini merupakan prioritas mitigasi dari hasil perhitungan menggunakan metode House Of Risk.
                    </h4>
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Mitigasi</th>
                                <th scope="col">Mitigasi</th>
                                <th scope="col">ETD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($ETD as $e) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $e['kode_mitigasi']; ?></td>
                                    <td><?= $e['mitigasi']; ?></td>
                                    <td><?= $e['ETD']; ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php
            } else { ?>
                    <p>
                        Data Tidak Tersedia, pastikan hal-hal berikut ini sudah dilakukan :
                        <br>
                        1. Masukan Data Risk Event, Risk Agent, Mitigasi
                        <br>
                        2. Masukan Nilai Relasi Risiko (Relasi Risk Event dan Risk Agent)
                        <br>
                        3. Masukan Nilai Relasi Mitigasi (Relasi Risk Agent dan Mitigasi)
                    </p>
                <?php } //endif status
        } //end if post
        ?>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->