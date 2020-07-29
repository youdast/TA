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
                            Pelaporan Proggress Pekerjaan <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
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
            <form action="<?= base_url('Progress_Proyek/progress_pekerjaan'); ?>" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-outline-secondary">Ok</button>
                    </div>
                    <select name="kode_proyek" class="custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                        <option value="" selected>Pilih Proyek...</option>
                        <?php foreach ($proyek as $p) : ?>
                            <option value="<?= $p['kode_proyek']; ?>"><?= $p['nama_proyek']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
            <?php if (null == ($this->input->post('kode_proyek'))) {
                ?>
                <table class=" table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Proyek</th>
                            <th scope="col">Kode Pekerjaan</th>
                            <th scope="col">Nama Pekerjaan</th>
                            <th scope="col">Bobot Realisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;

                        ?>
                        <?php foreach ($progress as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $p['tanggal']; ?></td>
                                <td><?= $p['nama_proyek']; ?></td>
                                <td><?= $p['kode_pekerjaan']; ?></td>
                                <td><?= $p['nama_pekerjaan']; ?></td>
                                <td><?= $p['bobot_realisasi']; ?> %</td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            <?php } else { ?>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPPModal">Tambah Progress Pekerjaan</a>
                <table class=" table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Kode Pekerjaan</th>
                            <th scope="col">Nama Pekerjaan</th>
                            <th scope="col">Bobot Realisasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;

                        ?>
                        <?php foreach ($progproy as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $p['tanggal']; ?></td>
                                <td><?= $p['kode_pekerjaan']; ?></td>
                                <td><?= $p['nama_pekerjaan']; ?></td>
                                <td><?= $p['bobot_realisasi']; ?> %</td>
                                <td>
                                    <a href="" class="badge badge-success ubahmodalPP" data-toggle="modal" data-target="#ubahPPModal" data-kode_proyek="<?= $this->input->post('kode_proyek'); ?>" data-kode_pekerjaan="<?= $p['kode_pekerjaan']; ?>" data-tanggal="<?= $p['tanggal']; ?>">Ubah</a>
                                    <a href="" class="badge badge-danger hapusmodalPP" data-toggle="modal" data-target="#hapusPPModal" data-kode_proyek="<?= $this->input->post('kode_proyek'); ?>" data-kode_pekerjaan="<?= $p['kode_pekerjaan']; ?>" data-tanggal="<?= $p['tanggal']; ?>">Hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            <?php } ?>

        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal tambah -->
<div class="modal fade" id="tambahPPModal" tabindex="-1" role="dialog" aria-labelledby="tambahPPModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPPModalLabel">Tambah Data Progress Pekerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Progress_Proyek/tambahPP'); ?>" method="post">
                    <table>
                        <div class="form-group">
                            <tr>
                                <td><input type="hidden" class="form-control" id="kode_proyek" name="kode_proyek" value="<?= $this->input->post('kode_proyek'); ?>"></td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                                <td>Tanggal </td>
                                <td><input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>"></td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <?php
                            for ($i = 0; $i < count($pegproy); $i++) { ?>
                                <tr>
                                    <td><?= $pegproy[$i]['nama_pekerjaan']; ?> </td>
                                    <?php
                                    if (null == $bobotr) {
                                        $bobotr = 0;
                                    }
                                    ?>
                                    <td><input type="text" class="form-control" name="<?= $i ?>" placeholder="Bobot Realisasi 0~100%" value="<?= $bobotr[$i]['bobot_realisasi']; ?>"></td>
                                </tr>
                            <?php }
                            ?>
                        </div>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<div class="modal fade" id="ubahPPModal" tabindex="-1" role="dialog" aria-labelledby="ubahPPModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPPModalLabel">Ubah Data Progress</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Progress_Proyek/ubahPP'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_proyek" placeholder="Kode Proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_pekerjaan" placeholder="Kode Pekerjaan" name="kode_pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="utanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="ubobot_realisasi" placeholder="Bobot" name="bobot_realisasi">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal hapus -->
<div class="modal fade" id="hapusPPModal" tabindex="-1" role="dialog" aria-labelledby="hapusPPModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusPPModalLabel">Hapus Data Progress</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <pre>Apakah anda yakin untuk menghapus data ini? </pre>
                <pre id="datasatu"></pre>
                <pre id="datadua"></pre>
                <pre id="datatiga"></pre>
                <form action="<?= base_url('Progress_Proyek/hapusPP'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_proyek" placeholder="Kode Proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_pekerjaan" placeholder="Kode Pekerjaan" name="kode_pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="htanggal" placeholder="Tanggal" name="tanggal">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>