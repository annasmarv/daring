            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
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
                                        <td>Nama Tugas</td><td>:</td><td><?= $detail->task_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td><td>:</td><td><?= $detail->class_group_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pengerjaan</td><td>:</td><td><?= $detail->task_date_start.' s.d '.$detail->task_date_finish; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td><td>:</td><td><?= ($detail->task_status == 1) ? 'AKTIF' : 'NONAKTIF' ?></td>
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
                                <form method="post" action="<?= base_url('learn/task/saven1/'.$detail->taskid); ?>">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-md btn-danger btn-round" data-toggle="modal" data-target="#uploadnilai"><b>Upload Nilai</b></a>
                                            <a href="<?= base_url(); ?>/learn/task/export_excel_rekap_tugas/<?=$detail->taskid ?>" class="btn btn-md btn-success btn-round"><b>Unduh Rekap</b></a>
                                            <!-- <a href="<?= base_url(); ?>/learn/task/reload/<?=$detail->taskid ?>" class="btn btn-md btn-warning btn-round"><b>Reload Data</b> <i class="material-symbols-rounded"></i></a> -->
                                            <input type="submit" name="save" value="Simpan" class="btn btn-md btn-cyan btn-round">
                                        </div>
                                        <div class="ml-auto">
                                            <a href="<?= base_url(); ?>/learn/task"><button type="button" class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped v-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-0 font-weight-medium text-muted">#</th>
                                                    <th class="border-0 font-weight-medium text-muted">NIS</th>
                                                    <th class="border-0 font-weight-medium text-muted">Nama Siswa</th>
                                                    <th class="border-0 font-weight-medium text-muted">N1</th>
                                                    <th class="border-0 font-weight-medium text-muted">N2</th>
                                                    <th class="border-0 font-weight-medium text-muted">NA</th>
                                                    <th class="border-0 font-weight-medium text-muted">Status</th>
                                                    <th class="border-0 font-weight-medium text-muted" width="10"></th>
                                                </tr>
                                            </thead>
                                            <tbody>                                            
                                                <?php $no = 1; foreach ($userlists as $list): ?>
                                                    <tr>
                                                        <td class="border-top-0 px-2 py-4"><?= $no++; ?></td>
                                                        <td class="border-top-0 px-2 py-4"><?= $list['username']; ?></td>
                                                        <td class="border-top-0 px-2 py-4"><?= $list['fullname']; ?></td>
                                                        <td class="border-top-0 px-2 py-4"><?= $list['NA'] ?></td>
                                                        <input type="hidden" name="id[]" value="<?= $list['id'] ?>">
                                                        <td class="border-top-0 px-2 py-4"><input class="text-center" style="width:50px" type="number" name="N2[]" value="<?= $list['N2'] ?>"></td>
                                                        <td class="border-top-0 px-2 py-4"><?= $list['NA']+$list['N2'] ?></td>
                                                        <td class="border-top-0 px-2 py-4 "><?= ($list['status'] == 9 ? '<div class="mt-3 p-1 text-center alert alert-success btn-round" role="alert">Selesai</div>' : ($list['status'] == 1 ? '<div class="mt-3 p-1 text-center alert alert-danger btn-round" role="alert">Belum Selesai</div>' : '<div class="mt-3 p-1 text-center alert alert-dark btn-round" role="alert">Belum Mulai</div>')) ?></td>
                                                        <td class="border-top-0 px-2 py-4">
                                                            <div class="btn-group">
                                                                <a class="btn btn-md btn-light btn-round" title="Lihat Jawaban Siswa" href="#"><i class="text-primary fa fa-print"></i></a>
                                                                <a class="btn btn-md btn-light btn-round" title="Koreksi Jawaban Isian" href="<?= base_url(); ?>/learn/correction/<?= $list['user_id']; ?>/<?= $list['task_id']; ?>"><i class="text-primary fa fa-stream"></i></a>
                                                                <a class="btn btn-md btn-light btn-round" title="Reset Status" class="text-warning" href="#"><i class="text-warning fa fa-sync-alt"></i></a>
                                                                <a class="btn btn-md btn-light btn-round" title="Hapus Jawaban" href="<?= base_url(); ?>/learn/correction/truncate/<?= $list['user_id']; ?>/<?= $list['task_id']; ?>" class="text-danger"><i class=" text-danger fa fa-eraser"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="uploadnilai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Upload Nilai</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/learn/task/importnilai/<?= $detail->taskid; ?>">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="form-group">
                                        <label class="form-label">File</label>
                                        <input class="form-control" name="upload" type="file">
                                    </div>
                                    <p>Format Upload download <a href="<?= base_url(); ?>/learn/task/temp/<?= $detail->taskid; ?>"><strong>Disini </strong></a></p>
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