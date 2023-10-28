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
                                        <td>Waktu Pengerjaan</td><td>:</td><td><?= $detail->time_start.' s.d '.$detail->time_finish; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td><td>:</td><td><?= ($detail->status == 1) ? 'AKTIF' : 'NONAKTIF' ?></td>
                                    </tr>
                                </table>
                               
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url(); ?>/ujian/export_excel_rekap_tugas/<?=$detail->ujianid ?>" class="btn btn-md btn-cyan"><b>Unduh Rekap</b> <i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                <th>Jawab</th>
                                                <th>Status</th>
                                                <th>Kelola</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php $no = 1; foreach ($userlists as $list): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $list['username']; ?></td>
                                                    <td><?= $list['fullname']; ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><a href="#" class="badge badge-default badge-danger form-text text-white">Reset Status</a> | <a href="<?= base_url(); ?>/correction/truncate/<?= $list['user_id']; ?>/<?= $list['task_id']; ?>" class="badge badge-default badge-warning form-text text-white">Hapus Jawaban</a></td>
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
            <?= $this->endSection(); ?>