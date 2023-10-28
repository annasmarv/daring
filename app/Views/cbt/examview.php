            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h3 class="card-title">Informasi Tugas</h3><br>
                                 
                                <table>
                                    <tr>
                                        <td width="150">Guru</td><td width="30">:</td><td><?= $detail->fullname; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mata Pelajaran</td><td>:</td><td><?= $detail->subject_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Tugas</td><td>:</td><td><a href="<?= base_url()."/questbank/".$detail->quest_bank_id; ?>"><?= $detail->task_name; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td><td>:</td><td><?= $detail->class_group_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pengerjaan</td><td>:</td><td><?= $detail->time_start.' s.d '.$detail->time_finish; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td><td>:</td><td><?= ($detail->status == 1) ? 'AKTIF' : 'NONAKTIF' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="btn-group">
                                        <button class="btn btn-md btn-cyan btn-round" data-toggle="modal"
                                        data-target="#genujian"><i class="fa fa-plus"> Generate Data</i></button>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="<?= base_url(); ?>/ujian/cbt"><button class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted">#</th>
                                                <th class="border-0 font-weight-medium text-muted">NIS</th>
                                                <th class="border-0 font-weight-medium text-muted">Nama Siswa</th>
                                                <th class="border-0 font-weight-medium text-muted">NA</th>
                                                <th class="border-0 font-weight-medium text-muted">Status</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10"></th>
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php $no = 1; foreach ($userlists as $list): ?>
                                                <tr>
                                                    <td class="border-top-0 px-2 py-4" align="center"><?= $no++; ?></td>
                                                    <td class="border-top-0 px-2 py-4"><?= $list['username']; ?></td>
                                                    <td class="border-top-0 px-2 py-4"><?= $list['fullname']; ?></td>
                                                    <td class="border-top-0 px-2 py-4"><?= $list['NA'] ?></td>
                                                    <td class="border-top-0 px-2 py-4 "><?= ($list['status'] == 9 ? '<div class="mt-3 p-1 text-center alert alert-success btn-round" role="alert">Selesai</div>' : ($list['status'] == 1 ? '<div class="mt-3 p-1 text-center alert alert-danger btn-round" role="alert">Belum Selesai</div>' : '<div class="mt-3 p-1 text-center alert alert-dark btn-round" role="alert">Belum Mulai</div>')) ?></td>
                                                    <td class="border-top-0 px-2 py-4">
                                                        <div class="btn-group">
                                                            <a class="btn btn-md btn-light btn-round" title="Lihat Jawaban Siswa" href="#"><i class="text-primary fa fa-print"></i></a>
                                                            <a class="btn btn-md btn-light btn-round" title="Koreksi Jawaban Isian" href="<?= base_url(); ?>/correction/<?= $list['user_id']; ?>/<?= $list['task_id']; ?>"><i class="text-primary fa fa-stream"></i></a>
                                                            <a class="btn btn-md btn-light btn-round" title="Reset Status" class="text-warning" href="#"><i class="text-warning fa fa-sync-alt"></i></a>
                                                            <a class="btn btn-md btn-light btn-round" title="Hapus Jawaban" href="<?= base_url(); ?>/correction/truncate/<?= $list['user_id']; ?>/<?= $list['task_id']; ?>" class="text-danger"><i class=" text-danger fa fa-eraser"></i></a>
                                                            <button class="btn btn-md btn-light btn-round" data-toggle="modal" data-target="#gensoal<?= $list['id'] ?>"><i class="fa fa-sync"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <div id="gensoal<?= $list['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Daftar Siswa</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/ujian/generatesoal">
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <input type="hidden" name="user_id" value="<?= $list['user_id'] ?>">
                                                                        <input type="hidden" name="task_id" value="<?= $detail->ujianid ?>">
                                                                        <input type="hidden" name="token" value="<?= $detail->token ?>">
                                                                        <input type="hidden" name="quest_bank_id" value="<?= $detail->quest_bank_id ?>">
                                                                        <input type="hidden" name="uri" value="<?= $uri->getPath() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="submit" name="nilaipnk" class="btn btn-primary" value="Simpan">
                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
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


<!--  -->
            <div id="genujian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Daftar Siswa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/ujian/generateujian/<?=$detail->ujianid ?>">
                            <div class="modal-body">
                                <div class="container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th width="5">No</th>
                                                <th width="10"><input type="checkbox" class="check_all1"></th>
                                                <th>Nama Siswa</th>
                                            </tr>
                                        </thead>
                                        <?php $no =1; foreach ($studentclass as $student): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><input type="checkbox" value="<?= $student['userid'] ?>" name="userid[]" class="chkboxes1"></td>
                                            <input type="hidden" name="task_id" value="<?= $detail->ujianid ?>">
                                            <input type="hidden" name="token" value="<?= $detail->token ?>">
                                            <input type="hidden" name="uri" value="<?= $uri->getPath() ?>">
                                            <td><?= $student['fullname']; ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="nilaipnk" class="btn btn-primary" value="Simpan">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
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