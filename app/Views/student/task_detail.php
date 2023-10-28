            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row border-bottom">
                                    <div class="col-9 col-md-10 col-lg-11">
                                        <h4 class="card-title"><?= $task['task_name']; ?></h4>
                                        <h4><?= $task['subject_name']; ?></h4>
                                        <div class="px-2 mt-2 mb-2">
                                            <div class="badge badge-pill badge-<?= ($task['task_status'] == 1 ? 'success': 'danger'); ?>"><?= ($task['task_status'] == 1 ? 'Online': 'Offline') ?></div>
                                            <div class="badge badge-pill badge-light">Tugas</div>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-2 col-lg-1">
                                        <h4 class="card-title text-center">Nilai</h4>
                                        <div class="alert alert-secondary text-center px-1" data-toggle='modal' data-target='#nilai' role="alert">
                                            <strong>N/A</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="mb-1"><i class="far fa-clock">&nbsp;</i> Waktu Pengerjaan : <?= tgl_indo($task['task_date_start'])." s.d ".tgl_indo($task['task_date_finish']); ?></p>
                                    <p class="mb-1"><i class="fa fa-exclamation-triangle">&nbsp;</i> Dateline : <?= tgl_indo($task['task_date_finish']); ?></p>
                                    <p class="mb-1"><i class="far fa-clipboard">&nbsp;</i> <?= $task['quest_total']; ?> Soal</p>
                                </div>
                                

                                <br><br>
                                <?php if ($task['task_status'] == 1): ?>
                                <form method="post" action="<?= base_url(); ?>/student/exam/start">
                                    <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                                    <input type="hidden" name="quest_id" value="<?= $task['quest_bank_id']; ?>">
                                    <input type="hidden" name="limit" value="<?= $task['quest_total']; ?>">
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $isToday = date("Y-m-d");
                                    $start = $task['task_date_start'];
                                    $finish = $task['task_date_finish'];
                                    if (isset($status['status'])) {
                                        $statusx = $status['status'];
                                    }else{
                                        $statusx = 1;
                                    }

                                    if ($statusx == 9) {
                                        echo "<button class='btn btn-danger btn-block' disabled>SELESAI</button>&nbsp;";
                                    }elseif ($isToday < $start) { ?>
                                        <button disabled="" class="btn btn-primary disabled" > BELUM DIMULAI</button> <?php
                                    }elseif ($isToday <= $finish && $isToday >= $start) { ?>
                                        <button type="submit" class="btn btn-success btn-block" > MULAI</button>
                                    <?php }else{ ?>
                                        <button class="btn btn-danger btn-block" disabled>Terlambat </button>
                                    <?php } ?>
                                </form>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>

            <div class="modal fade" id="nilai" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Hasil Pengerjaan Tugas</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tr>
                                    <td>Jenis</td>
                                    <td>Nilai</td>
                                </tr>
                                <tr>
                                    <td>Pilihan Ganda</td>
                                    <td><?= isset($NA1->NA) ? $NA1->NA : 0 ?></td>
                                </tr>
                                <tr>
                                    <td>Uraian*</td>
                                    <td><?= (isset($NA2->NA)) ? $NA2->NA : 0 ?></td>
                                </tr>
                                <tr>
                                    <td><b>Nilai Akhir</b></td>
                                    <td><b><?= (isset($NA->NA)) ? $NA->NA :0 ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?= $this->endSection(); ?>