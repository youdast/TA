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
                            Data pekerjaan <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
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
            <form action="<?= base_url('Kelola_Pekerjaan'); ?>" method="post">
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
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPKModal">Tambah Data Pekerjaan</a>
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Proyek</th>
                                <th scope="col">Kode Pekerjaan</th>
                                <th scope="col">Nama Pekerjaan</th>
                                <th scope="col">Bobot</th>
                                <th scope="col">Bobot Realisasi</th>
                                <th scope="col">Aksi</th>
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
                                    <td>
                                        <a href="" class="badge badge-success ubahmodalPK" data-toggle="modal" data-target="#ubahPKModal" data-kode_proyek="<?= $p['kode_proyek']; ?>" data-kode_pekerjaan="<?= $p['kode_pekerjaan']; ?>">Ubah</a>
                                        <a href="" class="badge badge-danger hapusmodalPK" data-toggle="modal" data-target="#hapusPKModal" data-kode_proyek="<?= $p['kode_proyek']; ?>" data-kode_pekerjaan="<?= $p['kode_pekerjaan']; ?>">Hapus</a>
                                    </td>
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
                    ?>
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPKModal">Tambah Data Pekerjaan</a>
                    <br>
                    <h3 class="h3">Isi Terlebih Dahulu Data Pekerjaan.</h3>
                <?php } //endif status
            } //end if post
            ?>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahPKModal" tabindex="-1" role="dialog" aria-labelledby="tambahPKModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPKModalLabel">Tambah Data Pekerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Kelola_Pekerjaan/tambah'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_proyek" value="<?= $this->input->post('kode_proyek'); ?>" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <?php
                        //kode_pekerjaan
                        $pk = count($pekproy) + 1;
                        $nol = "00";
                        $pkstr = strval($pk);
                        $jumlah = strlen($pkstr);
                        if ($jumlah == 1) {
                            $nol = "00";
                        } elseif ($jumlah == 2) {
                            $nol = "0";
                        } elseif ($jumlah == 3) {
                            $nol = "";
                        }
                        $kode_pk = "" . substr($this->input->post('kode_proyek'), 0, 3) . "-" . $nol . $pk;

                        //bobot
                        $jmlbbt = 0;
                        foreach ($pekproy as $p) :
                            $jmlbbt += $p['bobot'];
                        endforeach;
                        $bbt = 100 - $jmlbbt;
                        ?>
                        <input type="text" class="form-control" id="kode_pekerjaan" value="<?= $kode_pk; ?>" name="kode_pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_pekerjaan" placeholder="Nama Pekerjaan" name="nama_pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="text" min="0" max="<?= $bbt; ?>" class="form-control" id="bobot" placeholder="Bobot 0~100" name="bobot">
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
<div class="modal fade" id="ubahPKModal" tabindex="-1" role="dialog" aria-labelledby="ubahPKModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPKModalLabel">Ubah Data Pekerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Kelola_Pekerjaan/ubah'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ukode_pekerjaan" name="kode_pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="unama_pekerjaan" placeholder="Nama Pekerjaan" name="nama_pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="text" min="0" class="form-control" id="ubobot" placeholder="Bobot 0~100" name="bobot">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="tambah" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal hapus -->
<div class="modal fade" id="hapusPKModal" tabindex="-1" role="dialog" aria-labelledby="hapusPKModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusPKModalLabel">Hapus Data Pekerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <pre>Apakah anda yakin untuk menghapus data ini? </pre>
                <form action="<?= base_url('Kelola_Pekerjaan/hapus'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_proyek" name="kode_proyek">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hkode_pekerjaan" name="kode_pekerjaan">
                    </div>
                    <div class="form-group">
                        <input type="text" disabled class="form-control" id="hnama_pekerjaan" name="nama_pekerjaan">
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