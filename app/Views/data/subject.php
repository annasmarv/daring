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
                                    <h4 class="card-title">Data Mata Pelajaran</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addKelas">Tambah</button>
                                            <button type="button" class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v fa-fw"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Upload</a>
                                                <a class="dropdown-item" href="#">Print</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="1">#</th>
                                                <th class="border-0 font-weight-medium text-muted" width="500">Mata Pelajaran</th>
                                                <th class="border-0 font-weight-medium text-muted" width="1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($subjects as $subject): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $subject['subject_name']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button title="Ubah Data" class="btn btn-md btn-round btn-light" data-toggle="modal" class="subject-edit" data-target="#editSubject<?= $subject['id']; ?>">
                                                            <i class="fa fa-pen"></i>
                                                        </button>
                                                        <button title="Hapus Data" class="btn btn-md btn-round btn-light" data-toggle="modal" class="subject-delete" data-target="#delSubject<?= $subject['id']; ?>">
                                                            <i class="text-danger fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                                <!-- sample modal content -->
                                                <div id="editSubject<?= $subject['id']; ?>" class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Ubah Data Mata Pelajaran</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">×</button>
                                                            </div>
                                                            <form action="<?= base_url(); ?>/data/subject/update" method="post">
                                                                <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Kode</label>
                                                                        <input type="text" class="form-control" name="subject_code" maxlength="4" required value="<?= $subject['subject_code']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <input type="text" class="form-control" name="subject_name" required value="<?= $subject['subject_name']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="subject_id" value="<?= $subject['id']; ?>">
                                                                <button type="button" class="btn btn-light btn-round"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary btn-round" name="upSubject">Simpan</button>
                                                            </div>
                                                            </form>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <div id="delSubject<?= $subject['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content modal-filled bg-danger">
                                                            <div class="modal-body p-4">
                                                                <div class="text-center">
                                                                    <i class="dripicons-wrong h1"></i>
                                                                    <h4 class="mt-2"><b>Perhatian!</b></h4>
                                                                    <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                                                    <b><p><?= $subject['subject_name']; ?></p></b>
                                                                    <form action="<?= base_url(); ?>/data/subject/delete" method="post">
                                                                        <input type="hidden" name="subject_id" value="<?= $subject['id']; ?>">
                                                                        <button type="submit" name="delSubject" class="btn btn-light btn-round my-2">Iya</button>
                                                                        <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                                                    </form>
                                                                                            
                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- ================================================================================ -->
                                <!-- sample modal content -->
                                <div id="addKelas" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Tambah Mata Pelajaran</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <form action="<?= base_url(); ?>/data/subject/create" method="post">
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label>Kode</label>
                                                        <input type="text" class="form-control" name="subject_code" maxlength="4" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mata Pelajaran</label>
                                                        <input type="text" class="form-control" name="subject_name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-round"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary btn-round" name="addSubject">Simpan</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
            <?= $this->endSection(); ?>