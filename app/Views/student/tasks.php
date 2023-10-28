            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-bordered mb-3">
                                    <li class="nav-item">
                                        <a href="#task-1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-lg-block">Daftar Tugas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#task-2" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span class="d-lg-block">Dikerjakan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#task-3" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-lg-block">Selesai</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#task-4" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-lg-block">Terlewati</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="task-1">
                                        <div class="row">
                                            <?php $no = 1; foreach ($task1 as $task): ?>
                                            <?php $isToday = date('Y-m-d'); if ( $isToday < $task['task_date_finish'] ): ?>
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <a href="<?= base_url(); ?>/student/tasks/<?= $task['id']; ?>">
                                                    <div class="card card-s border" style="color: black;">
                                                        <div class="px-3 py-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="mb-0">
                                                                        <b><?= $task['task_name']." - ".$task['subject_name']; ?></b>
                                                                    </p>

                                                                    <div class="px-2 mt-4">
                                                                        <div class="badge badge-pill badge-success">Online</div>
                                                                        <div class="badge badge-pill badge-light">Tugas</div>
                                                                    </div>
                                                                    <div class="mt-2 border-top">
                                                                        <p class="card-text">
                                                                            <small class="text-muted">Dateline : <?= tgl_indo($task['task_date_finish']); ?></small>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="task-2">
                                        <div class="row">
                                            <?php $no = 1; foreach ($task2 as $task): ?> 
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <a href="<?= base_url(); ?>/student/tasks/<?= $task['id']; ?>">
                                                    <div class="card card-s border" style="color: black;">
                                                        <div class="px-3 py-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="mb-0">
                                                                        <b><?= $task['task_name']." - ".$task['subject_name']; ?></b>
                                                                    </p>

                                                                    <div class="px-2 mt-4">
                                                                        <div class="badge badge-pill badge-success">Online</div>
                                                                        <div class="badge badge-pill badge-light">Tugas</div>
                                                                    </div>
                                                                    <div class="mt-2 border-top">
                                                                        <p class="card-text">
                                                                            <small class="text-muted">Dateline : <?= tgl_indo($task['task_date_finish']); ?></small>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="task-3">
                                        <div class="row">
                                            <?php $no = 1; foreach ($task3 as $task): ?> 
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <a href="<?= base_url(); ?>/student/tasks/<?= $task['id']; ?>">
                                                    <div class="card card-s border" style="color: black;">
                                                        <div class="px-3 py-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="mb-0">
                                                                        <b><?= $task['task_name']." - ".$task['subject_name']; ?></b>
                                                                    </p>

                                                                    <div class="px-2 mt-4">
                                                                        <div class="badge badge-pill badge-success">Online</div>
                                                                        <div class="badge badge-pill badge-light">Tugas</div>
                                                                    </div>
                                                                    <div class="mt-2 border-top">
                                                                        <p class="card-text">
                                                                            <small class="text-muted">Dateline : <?= tgl_indo($task['task_date_finish']); ?></small>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="task-4">
                                        <div class="row">
                                            <?php $no = 1; foreach ($task1 as $task): ?> 
                                            <?php $isToday = date('Y-m-d'); if ( $isToday > $task['task_date_finish'] ): ?>
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <a href="<?= base_url(); ?>/student/tasks/<?= $task['id']; ?>">
                                                    <div class="card card-s border" style="color: black;">
                                                        <div class="px-3 py-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="mb-0">
                                                                        <b><?= $task['task_name']." - ".$task['subject_name']; ?></b>
                                                                    </p>

                                                                    <div class="px-2 mt-4">
                                                                        <div class="badge badge-pill badge-success">Online</div>
                                                                        <div class="badge badge-pill badge-light">Tugas</div>
                                                                    </div>
                                                                    <div class="mt-2 border-top">
                                                                        <p class="card-text">
                                                                            <small class="text-muted">Dateline : <?= tgl_indo($task['task_date_finish']); ?></small>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>