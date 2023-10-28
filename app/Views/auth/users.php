            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <?php if (session()->getFlashdata('pesan')): ?>
                             	<div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible border-0 fade show" role="alert">
                                	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    	<span aria-hidden="true">×</span>
                                	</button>
                                 	<?= session()->getFlashdata('pesan') ?>
                            	</div>
                            <?php endif ?>
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Daftar User</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v fa-fw"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#uploadsiswa" href="#">Upload</a>
                                                <a class="dropdown-item" href="#">Update</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table no-wrap v-middle mb-0 table-striped">
                                        <thead>
                                            <tr class="border-0">
                                            	<th class="border-0 font-14 font-weight-medium text-muted">#
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">User
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Role
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Join Date</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php $no=1; foreach ($users as $user): ?>
                                            <tr>
                                            	<td class="border-top-0 text-muted px-2 py-4 font-14"><?= $no++ ?></td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img src="<?= base_url('img/profile/'.$user['user_img']) ?>" alt="user" class="rounded-circle" width="45" height="45"></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                            	<?= $user['fullname']; ?>
                                                            </h5>
                                                            <span class="text-muted font-14"><?= $user['email']; ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14"><span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none"><?= $user['level']; ?></span></td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14"><?= $user['created_at']; ?></td>
                                                <td class="font-weight-medium text-dark border-top-0 px-2 py-4">
                                                     <button class="btn btn-warning btn-sm btn-round" title="Reset Password" onclick="reset_record(<?= $user['id']; ?>)">Reset Password</i></button>

							                         <button class="btn btn-danger btn-sm btn-round" title="Hapus" onclick="delete_record(<?= $user['id']; ?>)">Hapus</i></button>

							                        <form method="POST" action="<?= base_url('/setting/user/ustatus/'.$user['id']); ?>" accept-charset="UTF-8" class="status" style="display:inline-block">
							                          <?= csrf_field(); ?>
							                          <input name="active" type="hidden" value="<?= $user['active'] == '1' ? '0' : '1' ?>">
							                          <button class="btn btn-<?= $user['active'] == '1' ? 'success' : 'danger' ?> btn-sm btn-round" id="btn-toggle" title="<?= $user['active'] == '1' ? 'Nonaktifkan' : 'Aktifkan' ?>"><i class="fas fa-toggle-<?= $user['active'] == '1' ? 'on' : 'off' ?> fa-fw"></i></button>
							                        </form>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ######################################################## -->

            <!-- Modal Import Siswa -->
            <div id="uploadsiswa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Upload Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/setting/users/import">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="form-group">
                                        <label class="form-label">Role</label>
                                        <select class="form-control" name="role">
                                            <?php foreach ($groups as $group): ?>
                                                <option value="<?= $group['id']; ?>"><?= $group['name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">File</label>
                                        <input class="form-control" name="upload" type="file">
                                    </div>
                                    <p>Format Upload download <a href="<?= base_url(); ?>/temp/user/create.xlsx"><strong>Disini </strong></a></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="nilaipnk" class="btn btn-primary btn-round" value="Upload">
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="deleteUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <form action="<?= base_url(); ?>/setting/users/delete" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="user_id" class="user_id">
                                    <button type="submit" name="delKelas" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                </form>                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="resetPass" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-warning">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan mengubah data ini ?</p>
                                <form action="<?= base_url(); ?>/setting/users/reset" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="user_id" class="user_id">
                                    <button type="submit" name="reset" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                </form>                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function delete_record(user_id) {
                    status = 'delete';
                    $('#deleteUser').modal('show');
                    $('.user_id').val(user_id);
                }

                function reset_record(user_id) {
                    status = 'reset';
                    $('#resetPass').modal('show');
                    $('.user_id').val(user_id);
                }
            </script>
            <?= $this->endSection(); ?>