            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('pesan')): ?>
                                  <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible border-0 fade show" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span class="material-symbols-rounded">close</span>
                                      </button>
                                      <?= session()->getFlashdata('pesan') ?>
                                  </div>
                                <?php endif ?>
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Data Pembelajaran</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addRelasi">Tambah</button>
                                            <button class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <table id="zero_config" class="table table-striped no-wrap v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="1">#</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Mata Pelajaran</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Guru</th>
                                                <th class="border-0 font-weight-medium text-muted" width="1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($relations as $relasi): ?>
                                            <tr>
                                                <td class="px-2 py-3"><?= $no++; ?></td>
                                                <td class="px-2 py-3"><?= $relasi['subject_name']; ?></td>
                                                <td class="px-2 py-3"><?= $relasi['fullname']; ?></td>
                                                <td class="px-2 py-3">
                                                    <div class="btn-group">
                                                        <a title="Ubah Data" class="btn btn-md btn-round btn-light" href="#" data-toggle="modal" data-target="#editKelas<?= $relasi['id']; ?>" >
                                                            <i class="fa fa-pen"></i>
                                                        </a>

                                                        <a title="Hapus Data" class="btn btn-md btn-round btn-light" href="#" data-toggle="modal" data-target="#deleteKelas<?= $relasi['id']; ?>">
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
                                                            <h4 class="modal-title" id="myModalLabel">Ubah Data Kelas</h4>
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
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?= $relasi['id']; ?>">
                                                            <input type="hidden" name="classid" value="<?= $relasi['class_group_id']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <button type="button" class="btn btn-round btn-light"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-round btn-primary" name="upRelasi">Simpan</button>
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
                                                                <form action="<?= base_url(); ?>/data/relation/delete" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" name="id" value="<?= $relasi['id']; ?>">
                                                                    <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                                    <button type="submit" name="delKelas" class="btn btn-light btn-round my-2">Iya</button>
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
                                <div id="addRelasi" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Tambah Data Pembelajaran</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <form action="<?= base_url(); ?>/data/relation/create" method="post">
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label>Mata Pelajaran</label>
                                                        <select class="form-control" name="subject" required="">
                                                            <option value="" selected="" disabled=""></option>
                                                           <?php foreach ($subjects as $subject): ?>
                                                               <option value="<?= $subject['id']; ?>"><?= $subject['subject_name']; ?></option>
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
                                            <input type="hidden" name="redirect" value="<?= $uri->getPath() ?>">
                                            <input type="hidden" name="classgroup" value="<?= $uri->getSegment(4) ?>">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-round btn-light"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-round btn-primary" name="addRelasi">Simpan</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
            <?= $this->endSection(); ?>