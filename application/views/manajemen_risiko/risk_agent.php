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
                            Data risk agent <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
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
            <form action="<?= base_url('Manajemen_Risiko/risk_agent'); ?>" method="post">
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
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahRAModal">Tambah Data Risk Agent</a>
            <?php if (null == ($this->input->post('kode_proyek'))) { ?>
                <table class=" table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Proyek</th>
                            <th scope="col">Nama Proyek</th>
                            <th scope="col">Kode Risk Agent</th>
                            <th scope="col">Risk Agent</th>
                            <th scope="col">Occurence</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($risk as $re) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $re['kode_proyek']; ?></td>
                                <td><?= $re['nama_proyek']; ?></td>
                                <td><?= $re['kode_risk_agent']; ?></td>
                                <td><?= $re['risk_agent']; ?></td>
                                <td><?= $re['occurence']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success ubahmodalRA" data-toggle="modal" data-target="#ubahRAModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_risk_agent="<?= $re['kode_risk_agent']; ?>">Ubah</a>
                                    <a href="" class="badge badge-danger hapusmodalRA" data-toggle="modal" data-target="#hapusRAModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_risk_agent="<?= $re['kode_risk_agent']; ?>">Hapus</a>
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
                            <th scope="col">Kode Risk Agent</th>
                            <th scope="col">Risk Agent</th>
                            <th scope="col">Occurence</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($RiskA as $re) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $re['kode_proyek']; ?></td>
                                <td><?= $re['nama_proyek']; ?></td>
                                <td><?= $re['kode_risk_agent']; ?></td>
                                <td><?= $re['risk_agent']; ?></td>
                                <td><?= $re['occurence']; ?></td>
                                <td>
                                    <a href="" class="badge badge-success ubahmodalRA" data-toggle="modal" data-target="#ubahRAModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_risk_agent="<?= $re['kode_risk_agent']; ?>">Ubah</a>
                                    <a href="" class="badge badge-danger hapusmodalRA" data-toggle="modal" data-target="#hapusRAModal" data-kode_proyek="<?= $re['kode_proyek']; ?>" data-kode_risk_agent="<?= $re['kode_risk_agent']; ?>">Hapus</a>
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
<div class="modal fade" id="tambahRAModal" tabindex="-1" role="dialog" aria-labelledby="tambahRAModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRAModalLabel">Tambah Data Risk Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Manajemen_Risiko/tambahRA'); ?>" method="post">
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
                        <input type="text" class="form-control" id="kode_risk_agent" placeholder="Kode Risk Agent" name="kode_risk_agent">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="risk_agent" placeholder="Risk Agent" name="risk_agent">
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" max="10" class="form-control" id="occurence" placeholder="Occurence" name="occurence">
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
<div class="modal fade" id="ubahRAModal" tabindex="-1" role="dialog" aria-labelledby="ubahRAModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahRAModalLabel">Ubah Data Risk Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Manajemen_Risiko/ubahRA'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_proyek" placeholder="Kode Proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_risk_agent" placeholder="Kode Risk Agent" name="kode_risk_agent">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="urisk_agent" placeholder="Risk Agent" name="risk_agent">
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" max="10" class="form-control" id="uoccurence" placeholder="Occurence" name="occurence">
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
<div class="modal fade" id="hapusRAModal" tabindex="-1" role="dialog" aria-labelledby="hapusRAModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusRAModalLabel">Hapus Data Risk Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <pre>Apakah anda yakin untuk menghapus data ini? </pre>
                <form action="<?= base_url('Manajemen_Risiko/hapusRA'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_proyek" placeholder="Kode Proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_risk_agent" placeholder="Kode Risk Agent" name="kode_risk_agent">
                    </div>
                    <div class="form-group">
                        <input type="text" disabled class="form-control" id="hrisk_agent" name="risk_agent">
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