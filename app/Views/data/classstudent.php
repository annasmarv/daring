            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <form action="<?= base_url(); ?>/data/student/changeclass" method="POST">
                            <!-- Modal Import Siswa -->
                            <div id="pindahsiswa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Pindah Siswa</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <select name="kelas" class="form-control">
                                                    <option value="">Keluar Rombel</option>
                                                    <option value="0">Lulus</option>
                                                    <?php foreach ($class as $kelas): ?>
                                                        <option value="<?= $kelas['id']; ?>">Pindah Ke <?= $kelas['class_group_name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>   
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="nilaipnk" class="btn btn-primary btn-round" value="Pindah">
                                            <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
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
                                            <button type="button" class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addSiswa">Tambah</button>
                                            <button type="button" class="btn btn-md btn-success btn-round" data-toggle="modal" data-target="#pindahsiswa">Pindah</button>
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
                                    <table id="zero_config" class="table table-striped no-wrap v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted"><input type="checkbox" name="" class="check_all"></th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">NIS</th>
                                                <th class="border-0 font-weight-medium text-muted" width="200">Nama</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($students as $student): ?>
                                            <tr>
                                                <td class="px-2 py-3"><input type="checkbox" name="studentid[]" class="chkboxes" value="<?= $student['studentid'] ?>"></td>
                                                <td class="px-2 py-3"><?= $student['username']; ?></td>
                                                <td class="px-2 py-3"><a class="text-secondary" href="<?= base_url('data/student/profile/'.$student['id']); ?>"><?= $student['fullname']; ?></a></td>
                                                <td class="px-2 py-3"><?= $student['class_group_name']; ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
<!-- ================================================================================ -->
            <!-- Modal Import Siswa -->
            <div id="addSiswa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Daftar Siswa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/data/student/transfer/<?= $class_id ?>">
                            <div class="modal-body">
                                <div class="container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th width="10"><input type="checkbox" class="check_all1"></th>
                                                <th>Nama Siswa</th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($studentfree as $free): ?>
                                        <tr>
                                            <td><input type="checkbox" value="<?= $free['studentid'] ?>" name="idstudent[]" class="chkboxes1"></td>
                                            <td><?= $free['fullname']; ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="nilaipnk" class="btn btn-primary btn-round" value="Simpan">
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script type="text/javascript">
              $(function() {
                $('.check_all').click(function() {
                    $('.chkboxes').prop('checked', this.checked);
                });
              });
            </script>
            <script type="text/javascript">
              $(function() {
                $('.check_all1').click(function() {
                    $('.chkboxes1').prop('checked', this.checked);
                });
              });
            </script>
            <?= $this->endSection(); ?>