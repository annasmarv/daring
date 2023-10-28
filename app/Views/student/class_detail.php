            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php date_default_timezone_set('Asia/Jakarta') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title"><?php foreach ($subject as $s) { echo $s; } ?> - <?php foreach ($class as $c) { echo $c; } ?></h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table wrap v-middle mb-0">
                                        <tbody>
                                            <?php foreach ($tasks as $task): ?>
                                            <tr>
                                                <td class="border-top-1 px-2 py-4">
                                                    <a <?= ($task['task_status']==1 ? 'href="'.base_url().'/student/tasks/'.$task['taskid'].'"' : '')  ?>>
                                                        <div class="d-flex no-block align-items-center">
                                                            <div class="mr-4"><img src="<?= base_url() ?>/img/default.svg" alt="user" class="rounded-circle" width="45" height="45" /></div>
                                                            <div class="">
                                                                <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= $task['task_name']; ?></h5>
                                                                <span class="text-muted font-14">Tugas</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <a <?= ($task['task_status']==1 ? 'href="'.base_url().'/student/tasks/'.$task['taskid'].'"' : '')  ?>><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-<?= ($task['task_status'] == 1 ? 'success' : 'danger') ?>"><?= ($task['task_status'] == 1 ? 'Mulai' : 'Nonaktif') ?></button></a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            
                                            <?php foreach ($moduls as $modul): ?>
                                            <tr>
                                                <td class="border-top-1 px-2 py-4">
                                                    <a <?= ($modul['is_active'] == 1 ? 'href="'. base_url().'/student/classes/read/'.$modul['modulid'].'"' : '' )?>>
                                                        <div class="d-flex no-block align-items-center">
                                                            <div class="mr-4"><img src="<?= base_url() ?>/img/default.svg" alt="user" class="rounded-circle" width="45" height="45" />
                                                            </div>
                                                            <div class="">
                                                                <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= $modul['title']; ?></h5>
                                                                <span class="text-muted font-14">Materi Belajar</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <a <?= ($modul['is_active'] == 1 ? 'href="'.base_url().'/student/classes/read/'.$modul['modulid'].'"' : '' )?>><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-<?= ($modul['is_active'] == 1 ? 'success' : 'danger') ?>"><?= ($modul['is_active'] == 1 ? 'Baca' : 'Nonaktif') ?></button></a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?> 
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div id="accordion" class="custom-accordion mb-4">
                                    <?php foreach ($meets as $meet): ?>
                                    <div class="card mb-0 border-bottom-1" style="border-bottom:1px solid white;">
                                        <div class="card-header bg-success" style="border-radius: 10px" id="heading<?= $meet['meetid']; ?>">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title d-block pt-2 pb-2 text-white" data-toggle="collapse" href="#collapse<?= $meet['meetid']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                                    <?= $meet['meet_name']; ?><span class="float-right"><i class="fa fa-arrow-down"></i></span>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapse<?= $meet['meetid']; ?>" class="collapse" aria-labelledby="heading<?= $meet['meetid']; ?>" data-parent="#accordion" style="">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table wrap v-middle mb-0">
                                                        <tbody>
                                                            <?php if ($meet['interaktif_id'] != 0): ?>
                                                            <tr>
                                                                <td class="border-top-1 px-2 py-4">
                                                                    <a <?= ($meet['inter_status'] == 1 ? 'href="'. base_url().'/ch/?x='.base64_encode(user()->id).'&id='.$meet['interaktif_id'].'"' : '' )?>>
                                                                        <div class="d-flex no-block align-items-center">
                                                                            <div class="mr-4"><img
                                                                                    src="<?= base_url() ?>/img/default.svg"
                                                                                    alt="user" class="rounded-circle" width="45"
                                                                                    height="45" /></div>
                                                                            <div class="">
                                                                                <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= $meet['discuss']; ?></h5>
                                                                                <span class="text-muted font-14">Interaktif</span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td align="center">
                                                                    <a <?= ($meet['inter_status'] == 1 ? 'href="'. base_url().'/ch/?x='.base64_encode(user()->id).'&id='.$meet['interaktif_id'].'"' : '' )?>><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-<?= ($meet['inter_status'] == 1 ? 'success' : 'danger') ?>"><?= ($meet['inter_status'] == 1 ? 'Join' : 'Nonaktif') ?></button></a>
                                                                </td>
                                                            </tr>
                                                            <?php endif ?>
                                                            <?php if ($meet['task_id'] != 0): ?>
                                                            <tr>
                                                                <td class="border-top-1 px-2 py-4">
                                                                    <a <?= ($meet['task_status']==1 ? 'href="'.base_url().'/student/tasks/'.$meet['task_id'].'"' : '')  ?>>
                                                                        <div class="d-flex no-block align-items-center">
                                                                            <div class="mr-4"><img
                                                                                    src="<?= base_url() ?>/img/default.svg"
                                                                                    alt="user" class="rounded-circle" width="45"
                                                                                    height="45" /></div>
                                                                            <div class="">
                                                                                <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= $meet['task']; ?></h5>
                                                                                <span class="text-muted font-14">Tugas</span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td align="center">
                                                                    <a <?= ($meet['task_status']==1 ? 'href="'.base_url().'/student/tasks/'.$meet['task_id'].'"' : '')  ?>><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-<?= ($meet['task_status'] == 1 ? 'success' : 'danger') ?>"><?= ($meet['task_status'] == 1 ? 'Mulai' : 'Nonaktif') ?></button></a>
                                                                </td>
                                                            </tr>
                                                            <?php endif ?>
                                                            <?php if ($meet['modul_id'] != 0): ?>
                                                            <tr>

                                                                <td class="border-top-1 px-2 py-4">
                                                                    <a <?= ($meet['is_active'] == 1 ? 'href="'. base_url().'/student/classes/read/'.$meet['modul_id'].'"' : '' )?>>
                                                                        <div class="d-flex no-block align-items-center">
                                                                            <div class="mr-4"><img
                                                                                    src="<?= base_url() ?>/img/default.svg"
                                                                                    alt="user" class="rounded-circle" width="45"
                                                                                    height="45" /></div>
                                                                            <div class="">
                                                                                <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= $meet['modul']; ?></h5>
                                                                                <span class="text-muted font-14">Materi Belajar</span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td align="center">
                                                                    <a <?= ($meet['is_active'] == 1 ? 'href="<?= base_url(); ?>/student/classes/read/'.$meet['modul_id'].'"' : '' )?>><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-<?= ($meet['is_active'] == 1 ? 'success' : 'danger') ?>"><?= ($meet['is_active'] == 1 ? 'Baca' : 'Nonaktif') ?></button></a>
                                                                </td>
                                                            </tr>
                                                            <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-->
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?= $this->endSection();  ?>