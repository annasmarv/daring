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
                                <!-- <ul class="nav nav-tabs nav-bordered mb-3">
                                    <li class="nav-item">
                                        <a href="#task-1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-lg-block">Peserta</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#task-2" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span class="d-lg-block">Ringkasan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#task-3" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-lg-block">Pertanyaan</span>
                                        </a>
                                    </li>
                                </ul> -->
                                <form method="post" action="<?= base_url('ujian/saven1/'.$detail->ujianid); ?>">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="btn-group">
                                            <a href="<?= base_url(); ?>/ujian/export_excel_rekap_tugas/<?=$detail->ujianid ?>" class="btn btn-md btn-cyan btn-round"><b>Unduh Rekap</b> <i class="fa fa-file-excel"></i></a>
                                            <a href="<?= base_url(); ?>/ujian/export_excel_analisis_jawaban/<?=$detail->ujianid ?>" class="btn btn-md btn-success btn-round"><b>Analisis Jawaban</b> <i class="fa fa-file-excel"></i></a>
                                            <input type="submit" name="save" value="Simpan" class="btn btn-md btn-cyan btn-round">
                                        </div>
                                        <div class="ml-auto">
                                            <a href="<?= base_url(); ?>/ujian"><button class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
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
                                                        <td class="border-top-0 px-2 py-4" align="center"><?= $no++; ?></td>
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
                                                                <a class="btn btn-md btn-light btn-round" title="Koreksi Jawaban Isian" href="<?= base_url(); ?>/correction/<?= $list['user_id']; ?>/<?= $list['task_id']; ?>"><i class="text-primary fa fa-stream"></i></a>
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
            <?= $this->endSection(); ?>