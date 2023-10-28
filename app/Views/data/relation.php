            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php
            $timModel = new App\Models\Data\RelationTeamModel();
            ?>
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
                                    <h4 class="card-title">Data Relasi</h4>
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
                                    <table id="zero_config" class="table no-wrap v-middle mb-0 table-striped">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-14 font-weight-medium text-muted">#</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted" width="700">Relasi</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted" width="700">Tim</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted" width="1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($relations as $relasi): ?>
                                            <tr>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14"><?= $no++; ?></td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                                <?= $relasi['fullname']; ?>
                                                            </h5>
                                                            <span class="text-muted font-14"><?= $relasi['subject_name']; ?> | <?= $relasi['class_group_name']; ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="popover-icon">
                                                        <?php foreach ($timModel->get_relation_team($relasi['id']) as $row): ?>
                                                            <a title="<?= $row['fullname']; ?>" class="btn btn-danger rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)"><?= initial($row['fullname']); ?></a>
                                                        <?php endforeach ?>
                                                        
                                                        <a class="btn btn-success text-white rounded-circle btn-circle font-20" href="javascript:void(0)">+</a>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">
                                                    <div class="btn-group">
                                                        <a class="btn btn-md btn-light btn-round" title="Ubah Data" href="#" data-toggle="modal" data-target="#editKelas<?= $relasi['id']; ?>">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <a class="btn btn-md btn-light btn-round" title="Hapus Data" href="#" data-toggle="modal" data-target="#deleteKelas<?= $relasi['id']; ?>">
                                                            <i class="text-danger fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- sample modal content -->
                                            <div id="editKelas<?= $relasi['id']; ?>" class="modal fade" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Ubah Data Relasi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×</button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/relation/update" method="post">
                                                        <?= csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="form-body">
                                                                <div class="form-group">
                                                                    <label>Mata Pelajaran</label>
                                                                    <select class="form-control" name="subject" required>
                                                                        <option selected="" disabled=""></option>
                                                                        <?php foreach ($subjects as $subject): ?>
                                                                            <option <?= ($relasi['subject_id'] == $subject['id']) ? 'selected' :'' ?> value="<?= $subject['id'];?>">
                                                                                <?= $subject['subject_name'];?>
                                                                            </option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama Kelas</label>
                                                                    <select class="form-control" name="classid" required>
                                                                        <option selected="" disabled=""></option>
                                                                        <?php foreach ($classgroup as $class): ?>
                                                                            <option <?= ($relasi['class_group_id'] == $class['id']) ? 'selected' :'' ?> value="<?= $class['id'];?>">
                                                                                <?= $class['class_group_name'];?>
                                                                            </option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Guru</label>
                                                                    <select class="form-control teacher" name="teacher" required="">
                                                                        <option value="" selected="" disabled=""></option>
                                                                       <?php foreach ($teachers as $teacher): ?>
                                                                           <option <?= ($relasi['teacher_id'] == $teacher['id']) ? 'selected' :'' ?> value="<?= $teacher['id']; ?>"><?= $teacher['fullname']; ?></option>
                                                                       <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?= $relasi['id']; ?>">
                                                            <button type="button" class="btn btn-light"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary" name="addKelas">Simpan</button>
                                                        </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->

                                            <div id="deleteKelas<?= $relasi['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content modal-filled bg-danger">
                                                        <div class="modal-body p-4">
                                                            <div class="text-center">
                                                                <i class="dripicons-wrong h1"></i>
                                                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                                                <b><p><?= $relasi['fullname']." ".$relasi['subject_name']." ".$relasi['class_group_name']; ?></p></b>
                                                                <form action="<?= base_url(); ?>/data/relation/delete" method="post">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="id" value="<?= $relasi['id']; ?>">
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
                                                <h4 class="modal-title" id="myModalLabel">Tambah Relasi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <form action="<?= base_url(); ?>/data/relation/create" method="post">
                                                <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label>Mata Pelajaran</label>
                                                        <select class="form-control" name="subject" required>
                                                            <option selected="" disabled=""></option>
                                                            <?php foreach ($subjects as $subject): ?>
                                                                <option value="<?= $subject['id'];?>">
                                                                    <?= $subject['subject_name'];?>
                                                                </option>
                                                            <?php endforeach ?>     
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Kelas</label>
                                                        <select class="form-control" name="classgroup" required>
                                                            <option selected="" disabled=""></option>
                                                            <?php foreach ($classgroup as $class): ?>
                                                                <option value="<?= $class['id'];?>">
                                                                    <?= $class['class_group_name'];?>
                                                                </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Guru</label>
                                                        <select class="form-control" name="teacher" required="">
                                                            <option value="" selected="" disabled=""></option>
                                                           <?php foreach ($teachers as $teacher): ?>
                                                               <option value="<?= $teacher['id']; ?>"><?= $teacher['fullname']; ?></option>
                                                           <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary" name="addKelas">Simpan</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
            <?= $this->endSection(); ?>