<div class="container-fluid py-4">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <!-- <a href="<?= base_url(); ?>GudangFarmasi/tambahObat" type="button" class="btn btn-outline-primary float-end" ps-3>Tambah Obat Baru</a> -->
                    <h6>Daftar Pengguna Sistem Informasi Puskesmas</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table id="datatable" class="table align-items-center mb-0 stripe" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Password</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_user as $user) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs font-weight-bold mb-0"><?= $i; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $user['username']; ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $user['password']; ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $user['role']; ?></p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <a class="badge badge-sm bg-primary" data-bs-toggle="modal" data-bs-target="#exampleModalMessage<?= $user['id_user']; ?>">Edit Role</a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalMessage<?= $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Role Pengguna</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('Admin/updateRole'); ?>" method="post">
                                                        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>" />
                                                        <input type="hidden" name="username" value="<?= $user['username']; ?>" />
                                                        <input type="hidden" name="password" value="<?= $user['password']; ?>" />
                                                        <select name="role" value="<?= $user['role']; ?>" class="form-control" id="exampleFormControlSelect1" placeholder="Kategori Pengadaan" required>
                                                            <option value="Loket" selected>Loket</option>
                                                            <option value="Poliklinik">Poliklinik</option>
                                                            <option value="Gudang Farmasi">Gudang Farmasi</option>
                                                            <option value="Apotek">Apotek</option>
                                                            <option value="Pustu">Puskesmas Pembantu</option>
                                                            <option value="Poned">Poned</option>
                                                        </select>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i += 1; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>