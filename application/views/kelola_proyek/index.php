<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>


    <div class="row">
        <div class="col-lg-10">
            <?php if ($this->session->flashdata('flash')) : ?>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Data proyek <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <a href="" class="btn btn-primary mb-3 tombolTambahData" data-toggle="modal" data-target="#tambahProyekModal">Tambah Data Proyek</a>
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
                        <th scope="col" width="200px">Aksi</th>
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
                            <td>
                                <a href="" class="badge badge-success ubahmodalP" data-toggle="modal" data-target="#ubahProyekModal" data-kode_proyek="<?= $p['kode_proyek']; ?>">Ubah</a>
                                <a href="" class="badge badge-danger hapusmodalP" data-toggle="modal" data-target="#hapusPModal" data-kode_proyek="<?= $p['kode_proyek']; ?>">Hapus</a>
                                <a href="<?= base_url(); ?>Kelola_Proyek/updateStatus/<?= $p['kode_proyek']; ?>" class="badge badge-primary ">Refresh</a>
                            </td>

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


<!-- Modal -->
<div class="modal fade" id="tambahProyekModal" tabindex="-1" role="dialog" aria-labelledby="tambahProyekModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahProyekModalLabel">Tambah Data Proyek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Kelola_Proyek/tambah'); ?>" method="post">
                    <div class="form-group">
                        <?php
                        //kode_pekerjaan
                        $p = count($proyek) + 1;
                        $nol = "00";
                        $pstr = strval($p);
                        $jumlah = strlen($pstr);
                        if ($jumlah == 1) {
                            $nol = "00";
                        } elseif ($jumlah == 2) {
                            $nol = "0";
                        } elseif ($jumlah == 3) {
                            $nol = "";
                        }

                        $tanggal = str_replace("-", "", date('m-y'));
                        $kode_p = "" . $nol . $p . "-" . $tanggal . "-";
                        ?>
                        <input type="hidden" class="form-control" id="kode_proyek" name="kode_proyek" value="<?= $kode_p ?>">
                    </div>
                    <div class="form-group">
                        Nama Proyek
                        <input type="text" class="form-control" id="nama_proyek" name="nama_proyek">
                    </div>
                    <div class="form-group">
                        Alamat
                        <input type="text" class="form-control" id="alamat_proyek" name="alamat_proyek">
                    </div>
                    <div class="form-group">
                        Biaya Proyek
                        <input type="text" class="form-control" id="biaya_proyek" name="biaya_proyek">
                    </div>
                    <div class="form-group">
                        <!-- Waktu Proyek
                        <input type="text" class="form-control" id="waktu_proyek" placeholder="Waktu Proyek" name="waktu_proyek"> -->
                        <div class="form-group">
                            Tanggal Mulai <input type="date" class="form-control" id="startDate" width="276" name="tanggal_mulai" />
                            Tanggal Selesai <input type="date" class="form-control" id="endDate" width="276" name="tanggal_selesai" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah -->
<div class="modal fade" id="ubahProyekModal" tabindex="-1" role="dialog" aria-labelledby="ubahProyekModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahProyekModalLabel">Ubah Data Proyek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Kelola_Proyek/ubah'); ?>" method="post">
                    <div class="form-group">
                        Kode Proyek
                        <input type="text" class="form-control" id="ukode_proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        Nama Proyek
                        <input type="text" class="form-control" id="unama_proyek" name="nama_proyek">
                    </div>
                    <div class="form-group">
                        Alamat
                        <input type="text" class="form-control" id="ualamat_proyek" name="alamat_proyek">
                    </div>
                    <div class="form-group">
                        Biaya Proyek
                        <input type="text" class="form-control" id="ubiaya_proyek" name="biaya_proyek">
                    </div>
                    <div class="form-group">
                        <!-- Waktu Proyek
                        <input type="text" class="form-control" id="waktu_proyek" placeholder="Waktu Proyek" name="waktu_proyek"> -->
                        <div class="form-group">
                            Tanggal Mulai <input class="form-control" id="ustartDate" width="276" name="tanggal_mulai" />
                            Tanggal Selesai <input class="form-control" id="uendDate" width="276" name="tanggal_selesai" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal hapus -->
<div class="modal fade" id="hapusPModal" tabindex="-1" role="dialog" aria-labelledby="hapusPModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusPModalLabel">Hapus Data Proyek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <pre>Apakah anda yakin untuk menghapus data ini? </pre>
                <form action="<?= base_url('Kelola_Proyek/hapus'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="text" disabled class="form-control" id="hnama_proyek" name="nama_proyek">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>