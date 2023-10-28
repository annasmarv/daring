<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
        <div class="container-fluid">
            <div class="row">
                    <div class="col-12">
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
                                    <h4 class="card-title"><?= $title; ?></h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addTask">Tambah</button>
                                            <button class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v fa-fw"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Print</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <?php foreach ($weeks as $week): ?>
                                    <div id="accordion<?= $week['week_id'];?>" class="custom-accordion mb-1">
                                        <div class="card mb-0 border-bottom-1" style="border-bottom:1px solid white;">
                                            <?php
                                            $wk = $week['week_id'];

                                            $wks = $week['week_schedule'];
                                            if ($wks == 1) {
                                                $wks = 2;
                                            }elseif($wks == 2) {
                                                $wks = 1;
                                            }
                                            ?>
                                            <div class="card-header bg-<?= $week['week_schedule'] == 1 ? 'warning' : 'success' ?>" style="border-radius: 0px" id="heading<?= $week['week_id'];?>">
                                                <h5 class="m-0">
                                                    <a class="custom-accordion-title d-block pt-2 pb-2 text-dark d-flex justify-content-between" data-toggle="collapse" href="#collapse<?= $week['week_id'];?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <span>
                                                            <strong><?= $week['week_name'];?></strong> (<?= tgl_indo($week['date_start']).' s.d '.tgl_indo($week['date_finish']);?>) <?= count_schedule_by_week($week['week_schedule']) ?>
                                                        </span>
                                                        <span>
                                                            <strong><?= round(percent_by_week($wk)/count_schedule_by_week($week['week_schedule']),2).'%'; ?></strong> 
                                                            <i class="fa fa-chevron-down"></i>
                                                        </span>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse<?= $week['week_id'];?>" class="collapse <?= date('Y-m-d') >= $week['date_start'] && date('Y-m-d') <= $week['date_finish'] ? 'show' : ''; ?>" aria-labelledby="heading<?= $week['week_id'];?>" data-parent="#accordion<?= $week['week_id'];?>" style="">
                                                <div class="card-body p-0">
                                                    <?php if ($week['week_schedule'] == 1): ?>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><a href="<?= base_url(); ?>/learn/journal/plans/<?= $week['week_id']; ?>">Rencana Pembelajaran</a></span>
                                                                <span class="material-symbols-rounded text-success"></span>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Senin</strong></span>
                                                            </div>
                                                            <?php foreach ($monday1 as $d): ?>
                                                            <?php
                                                                if (!empty(journal(hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']))['percent'])) 
                                                                {
                                                                    $persen = journal(hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']))['percent'];
                                                                }else{
                                                                    $persen = 0;
                                                                }
                                                            ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 || $wk==6 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 || $wk==6 ? '' : ($wk==1 || $wk==6 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Selasa</strong></span>
                                                            </div>
                                                            <?php foreach ($tuesday1 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Rabu</strong></span>
                                                            </div>
                                                            <?php foreach ($wednesday1 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Kamis</strong></span>
                                                            </div>
                                                            <?php foreach ($thursday1 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Jum'at</strong></span>
                                                            </div>
                                                            <?php foreach ($friday1 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                    </ul>
                                                    <?php elseif ($week['week_schedule'] == 2): ?>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><a href="<?= base_url(); ?>/learn/journal/plans/<?= $week['week_id']; ?>">Rencana Pembelajaran</a></span>
                                                                <span class="material-symbols-rounded text-success"></span>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Senin</strong></span>
                                                            </div>
                                                            <?php foreach ($monday2 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Selasa</strong></span>
                                                            </div>
                                                            <?php foreach ($tuesday2 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Rabu</strong></span>
                                                            </div>
                                                            <?php foreach ($wednesday2 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Kamis</strong></span>
                                                            </div>
                                                            <?php foreach ($thursday2 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Jum'at</strong></span>
                                                            </div>
                                                            <?php foreach ($friday2 as $d): ?>
                                                            <div class="d-flex justify-content-between mb-1">
                                                                <span><a class="<?= $wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5 ? '' : ($wk==1 || $wk==2 || $wk==3 || $wk==4 || $wk==5  ? '' : ($wk==1 ? '' : (percent_by_week($wk-1) !== null && percent_by_week($wk-1)/count_schedule_by_week($wks) >= 75 ? '' : 'disabled'))) ?>" href="<?= base_url();?>/learn/journal/create/<?= $d['relation_id'].'/'.$week['week_id'].'/'.hash('sha1',$d['relation_id'].'-'.$week['week_id'].'-'.$d['scheduleid']).'/'.$d['scheduleid'];?>"><?= $d['subject_name'].' - '.$d['class_group_name'] ?></a></span>
                                                                <div class="popover-icon text-center">
                                                                    <a style="width: 60px;" class="btn btn-<?= persencolor($persen); ?> btn-round btn-md font-12" href="javascript:void(0)"><?= $persen; ?>%</a>
                                                                </div>
                                                            </div>
                                                            <?php endforeach ?>
                                                        </li>
                                                    </ul>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADD modal content -->
            <div id="addTask" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Buat Jadwal Tugas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- ADD modal content -->
            <div id="updateTask " class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Ubah Jadwal Tugas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- Warning Alert Modal -->
            <div id="statusTask" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-warning">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Ubah Status!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan merubah data ini?</p>
                                <form id="s_task" action="<?= base_url() ?>/learn/task/status" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" class="task_id">
                                    <input type="hidden" name="status" class="task_status">
                                    <button type="submit" name="upSttsModul" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="deleteTask" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <form action="<?= base_url(); ?>/learn/task/delete" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="task_id" class="task_id">
                                    <button type="submit" name="delKelas" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                </form>                          
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
<?= $this->endSection() ?>