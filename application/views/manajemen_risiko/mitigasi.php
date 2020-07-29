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
                            Data Mitigasi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
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
            <form action="<?= base_url('Manajemen_Risiko/mitigasi'); ?>" method="post">
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
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMModal">Tambah Data Mitigasi</a>
            <?php if (null == ($this->input->post('kode_proyek'))) { ?>
                <table class=" table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Proyek</th>
                            <th scope="col">Nama Proyek</th>
                            <th scope="col">Kode Mitigasi</th>
                            <th scope="col">Mitigasi</th>
                            <th scope="col">Difficulty</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mit as $re) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $re['kode_proyek']; ?></td>
                                <td><?= $re['nama_proyek']; ?></td>
                                <td><?= $re['kode_mitigasi']; ?></td>
                                <td><?= $re['mitigasi']; ?></td>
                                <td><?= $re['difficulty']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success ubahmodalM" data-toggle="modal" data-target="#ubahMModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_mitigasi="<?= $re['kode_mitigasi']; ?>">Ubah</a>
                                    <a href="" class="badge badge-danger hapusmodalM" data-toggle="modal" data-target="#hapusMModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_mitigasi="<?= $re['kode_mitigasi']; ?>">Hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <table class=" table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Proyek</th>
                            <th scope="col">Nama Proyek</th>
                            <th scope="col">Kode Mitigasi</th>
                            <th scope="col">Mitigasi</th>
                            <th scope="col">Difficulty</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($datamit as $re) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $re['kode_proyek']; ?></td>
                                <td><?= $re['nama_proyek']; ?></td>
                                <td><?= $re['kode_mitigasi']; ?></td>
                                <td><?= $re['mitigasi']; ?></td>
                                <td><?= $re['difficulty']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success ubahmodalM" data-toggle="modal" data-target="#ubahMModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_mitigasi="<?= $re['kode_mitigasi']; ?>">Ubah</a>
                                    <a href="" class="badge badge-danger hapusmodalM" data-toggle="modal" data-target="#hapusMModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_mitigasi="<?= $re['kode_mitigasi']; ?>">Hapus</a>
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
<div class="modal fade" id="tambahMModal" tabindex="-1" role="dialog" aria-labelledby="tambahMModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMModalLabel">Tambah Data Mitigasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Manajemen_Risiko/tambahM'); ?>" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Proyek</label>
                        </div>
                        <select name="kode_proyek" class="custom-select" id="inputGroupSelect01">
                            <option value="" selected>Pilih...</option>
                            <?php foreach ($proyek as $r) : ?>
                                <option value="<?= $r['kode_proyek']; ?>"><?= $r['nama_proyek']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_mitigasi" placeholder="Kode Mitigasi" name="kode_mitigasi">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mitigasi" placeholder="Mitigasi" name="mitigasi">
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" max="10" class="form-control" id="difficulty" placeholder="Difficulty" name="difficulty">
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

<!-- Modal ubah -->
<div class="modal fade" id="ubahMModal" tabindex="-1" role="dialog" aria-labelledby="ubahMModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahMModalLabel">Ubah Data Mitigasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Manajemen_Risiko/ubahM'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_proyek" placeholder="Kode Proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_mitigasi" placeholder="Kode Mitigasi" name="kode_mitigasi">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="umitigasi" placeholder="Mitigasi" name="mitigasi">
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" max="10" class="form-control" id="udifficulty" placeholder="Difficulty" name="difficulty">
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
<div class="modal fade" id="hapusMModal" tabindex="-1" role="dialog" aria-labelledby="hapusMModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusMModalLabel">Hapus Data Mitigasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <pre>Apakah anda yakin untuk menghapus data ini? </pre>
                <form action="<?= base_url('Manajemen_Risiko/hapusM'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_proyek" placeholder="Kode Proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_mitigasi" placeholder="Kode Mitigasi" name="kode_mitigasi">
                    </div>
                    <div class="form-group">
                        <input type="text" disabled class="form-control" id="hmitigasi" name="mitigasi">
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