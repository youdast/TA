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
                            Data Relasi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
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
            <form action="<?= base_url('Manajemen_Risiko/relasi_mitigasi'); ?>" method="post">
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

            <?php } else {
            if ($status == 1) { ?>
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#ubahRMModal">Ubah Nilai Relasi</a>

                    <!-- matriks -->
                    <?php
                    for ($i = 0; $i < count($Nilai); $i++) {
                        $nil[$i] = $Nilai[$i]['nilai'];
                    }
                    $val = array_chunk($nil, count($AllMitigasi));
                    ?>

                    <table class="table table-editable">
                        <tr>
                            <th rowspan="2">To Be treated risk agent (Aj)</th>
                            <th colspan="<?= count($Mitigasi); ?>" style="text-align:center">Preventive Action (PAk)</th>
                        </tr>
                        <tr>
                            <?php foreach ($Mitigasi as $Mit) : ?>
                                <th scope="col"><?= $Mit['kode_mitigasi']; ?></th>
                            <?php endforeach; ?>
                        </tr>
                        <?php for ($i = 0; $i < count($Agent); $i++) { ?>
                            <tr>
                                <th scope="row"><?php echo $Agent[$i]['kode_risk_agent']; ?></th>
                                <?php
                                for ($j = 0; $j < count($Mitigasi); $j++) { ?>
                                    <td>
                                        <?php echo $val[$i][$j]; ?>
                                    </td>
                                <?php }
                        } ?>
                    </table>



                    <!-- end matriks -->

                <?php } else { ?>
                    <br>
                    <p>
                        Data Relasi tidak tersedia, hal tersebut dapat disebabkan oleh :
                        <br>
                        1. Data Relasi belum pernah dimasukan.
                        <br>
                        2. Data Risk Agent dan Mitigasi belum dimasukan.
                        <br>
                        Silhakan refresh halaman untuk memasukan nilai default (0) dari relasi risiko (* Jika Data Risk Agent dan Mitigasi Sudah Tersedia)
                    </p>
                <?php  }
        } ?>

        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal ubah -->
<div class="modal fade" id="ubahRMModal" tabindex="-1" role="dialog" aria-labelledby="ubahRMModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahRMModalLabel">Ubah Data Relasi Mitigasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Manajemen_Risiko/ubahRM'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="kode_proyek" name="kode_proyek" value="<?= $this->input->post('kode_proyek'); ?>">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Risk Agent</label>
                        </div>
                        <select name="kode_risk_agent" class="custom-select" id="inputGroupSelect01">
                            <option value="" selected>Pilih...</option>
                            <?php foreach ($AllAgent as $a) : ?>
                                <option value="<?= $a['kode_risk_agent']; ?>"><?= $a['kode_risk_agent']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Mitigasi</label>
                        </div>
                        <select name="kode_mitigasi" class="custom-select" id="inputGroupSelect01">
                            <option value="" selected>Pilih...</option>
                            <?php foreach ($AllMitigasi as $a) : ?>
                                <option value="<?= $a['kode_mitigasi']; ?>"><?= $a['kode_mitigasi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="nilai" placeholder="Nilai" name="nilai">
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