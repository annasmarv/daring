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
                                    <h4 class="card-title">Data Siswa</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addSiswa">Tambah</button>
                                            <button class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v fa-fw"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#uploadsiswa" href="#">Upload</a>
                                                <a class="dropdown-item" href="#">Print</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped no-wrap v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="1">#</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">NIS</th>
                                                <th class="border-0 font-weight-medium text-muted">Nama</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Kelas</th>
                                                <th class="border-0 font-weight-medium text-muted" width="5">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($students as $student): ?>
                                            <tr>
                                                <td class="px-2 py-3"><?= $no++; ?></td>
                                                <td><?= $student['username']; ?></td>
                                                <td><?= $student['fullname']; ?></td>
                                                <td><?= $student['class_group_name']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-md btn-light btn-round" title="Lihat Data" href="<?= base_url(); ?>/data/student/profile/<?= $student['id']; ?>" >
                                                        <i class="fa fa-user"></i>
                                                        </a>
                                                    
                                                        <a class="btn btn-md btn-light btn-round" title="Hapus Data" href="#" data-toggle="modal" data-target="#deleteKelas<?= $student['id']; ?>">
                                                            <i class="text-danger fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- sample modal content -->
                                            <div id="editKelas<?= $student['id']; ?>" class="modal fade" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Ubah Data Kelas</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×</button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/classgroup/update" method="post">
                                                            <?= csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="form-body">
                                                                <div class="form-group">
                                                                    <label>Tingkat</label>
                                                                    <select class="form-control tingkat" name="tingkat" required>
                                                                        <option selected="" disabled=""></option>
                                                                                                                                     
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jurusan</label>
                                                                    <select class="form-control jurusan" name="jurusan" required>
                                                                        <option selected="" disabled=""></option>
                                                               
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama Kelas</label>
                                                                    <input type="text" class="form-control" name="kodekelas" maxlength="20" required value="<?= $student['id'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Wali Kelas</label>
                                                                    <select class="form-control walas" name="walas" required="">
                                                                        <option value="" selected="" disabled=""></option>
                                                                
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="class_id" value="<?= $student['id']; ?>">
                                                            <button type="button" class="btn btn-light"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary" name="addKelas">Simpan</button>
                                                        </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->

                                            <div id="deleteKelas<?= $student['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content modal-filled bg-danger">
                                                        <div class="modal-body p-4">
                                                            <div class="text-center">
                                                                <i class="dripicons-wrong h1"></i>
                                                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                                                <form action="<?= base_url(); ?>/data/classgroup/delete" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" name="class_id" value="<?= $student['id']; ?>">
                                                                    <button type="submit" name="delKelas" class="btn btn-light my-2">Iya</button>
                                                                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Tidak</button>
                                                                </form>
                                                                                        
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="1">#</th>
                                                <th width="10">Tingkat</th>
                                                <th width="10">Jurusan</th>
                                                <th width="10">Nama Kelas</th>
                                                <th width="10">
                                                    <i class="fa fa-list"></i>
                                                    <i class="fa fa-key"></i>
                                                    <i class="fa fa-trash"></i>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- ================================================================================ -->
            <!-- Modal Import Siswa -->
            <div id="uploadsiswa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Upload Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/data/student/import">
                            <div class="modal-body">
                                <div class="container">
                                    <input class="form-control" name="upload" type="file"><br /><br>
                                    <!-- <p>Format Upload download <a href="<?= base_url(); ?>/temp/rapor/catatan.xlsx"><strong>Disini </strong></a></p> -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="nilaipnk" class="btn btn-primary btn-round" value="Upload">
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?= $this->endSection(); ?>