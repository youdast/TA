<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data User <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
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
    <a href="" class="btn btn-primary mb-3 tombolTambahDataU" data-toggle="modal" data-target="#tambahUModal">Tambah Data User</a>

    <table class=" table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role Id</th>
                <th scope="col">Status Aktif</th>
                <th scope="col" width="200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $p) : ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['email']; ?></td>
                    <td><?= $p['role_id']; ?></td>
                    <td><?php
                        if ($p['status_aktif'] == 1) {
                            $status = 'Aktif';
                        } else {
                            $status = 'Tidak Aktif';
                        }
                        echo $status; ?></td>
                    <td>
                        <a href="" class="badge badge-success ubahmodalU" data-toggle="modal" data-target="#ubahUModal" data-id="<?= $p['id']; ?>">Ubah</a>
                        <a href="" class="badge badge-danger hapusmodalU" data-toggle="modal" data-target="#hapusUModal" data-id="<?= $p['id']; ?>">Hapus</a>
                    </td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahUModal" tabindex="-1" role="dialog" aria-labelledby="tambahUModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/tambah'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Password" id="password" name="password">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Role</label>
                        </div>
                        <select name="role_id" class="custom-select" id="inputGroupSelect01">
                            <option value="" selected>Pilih...</option>
                            <option value="1">Admin</option>
                            <option value="2">Direktur</option>
                            <option value="3">Site Manager</option>
                            <option value="4">Pelaksana Lapangan</option>
                        </select>
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
<div class="modal fade" id="ubahUModal" tabindex="-1" role="dialog" aria-labelledby="ubahUModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahUModalLabel">Ubah Data Proyek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/ubah'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="uid" name="id">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="unama" name="nama">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" id="uemail" name="email">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Role</label>
                        </div>
                        <select name="role_id" class="custom-select" id="urole_id">
                            <option value="" selected>Pilih...</option>
                            <option value="1">Admin</option>
                            <option value="2">Direktur</option>
                            <option value="3">Site Manager</option>
                            <option value="4">Pelaksana Lapangan</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Status</label>
                        </div>
                        <select name="status_aktif" class="custom-select" id="ustatus_aktif">
                            <option value="" selected>Pilih...</option>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="hapus" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal hapus -->
<div class="modal fade" id="hapusUModal" tabindex="-1" role="dialog" aria-labelledby="hapusUModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusUModalLabel">Hapus Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <pre>Apakah anda yakin untuk menghapus data ini? </pre>
                <form action="<?= base_url('admin/hapus'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hid" name="id">
                    </div>
                    <div class="form-group">
                        <input type="text" disabled class="form-control" id="hnama" name="nama">
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