        <?= $this->extend('templates/index'); ?>
        <?= $this->section('content'); ?>
        <?php date_default_timezone_set('Asia/Jakarta'); $isTime = date('H:i'); $isDate = date('Y-m-d'); ?>

            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-8 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat Datang, <?= user()->fullname; ?>
                        </h3>

                    </div>
                    <?php if (in_groups('admin')) { ?>
                    <div class="col-4 text-right">
                        <div class="from-group">
                            <form method="get" action="<?php base_url(); ?>">
                                <div class="row">
                                    <div class="col-9">
                                        <input type="date" name="date" class="form-control" value="<?= (isset($_GET['date'])) ? $_GET['date'] : date('Y-m-d') ?>">
                                    </div>
                                    <div class="col-2">
                                    <input type="submit" class="btn btn-md btn-cyan btn-round" value="SET">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div>
<?php if (in_groups('student')) { ?>
                <?php if ($level[0]['class_level_id'] == 3) : ?>
<!--                <div class="timerskl">
                    <div id="timer">
                        <div class='timerskldiv' id="days"></div>
                        <div class='timerskldiv' id="hours"></div>
                        <div class='timerskldiv' id="minutes"></div>
                        <div class='timerskldiv' id="seconds"></div>
                    </div>
                    <div class="texttimer">
                        <p>Menuju Pengumuman Kelulusan</p>
                    </div>
                </div> -->
                <?php endif ?> 

                <div class="mb-4">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Sedang Berlangsung</h3>
                </div>
                <div class="row d-flex flex-row flex-nowrap overflow-auto">
                <?php if ($level[0]['class_level_id'] == 3 && date('Y-m-d H:i:s') >= '2023-05-05 17:00:00') : ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="<?= base_url(); ?>/skl/announcement">
                                <div class="card card-s" style="color: black;">
                                    <div class="bg-warning" style="background-image: url('<?= base_url(); ?>/img/favicon.png')!important;background-size: 50px;background-position: center;background-repeat: no-repeat;height: 100px;">
                                    </div>
                                    <div class="px-3 py-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-0 text-center">
                                                    <b>Pengumuman kelulusan klik disini</b><?//= $class['class_group_name']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif ?>
                        
                        <?php if (($isTime >= '17:00') && ($isTime <= '23:59')): ?>
                   <!-- <div class="col-6 col-md-4 col-lg-3">
                            <a href="#" data-toggle="modal" data-target="#modalRapor">
                                <div class="card card-s" style="color: black;">
                                    <div class="bg-warning" style="background-image: url('<?= base_url(); ?>/img/favicon.png')!important;background-size: 50px;background-position: center;background-repeat: no-repeat;height: 100px;">
                                    </div>
                                    <div class="px-3 py-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-0">
                                                    <b>Rapor Semester 2022/2023 Ganjil</b><?//= $class['class_group_name']; ?>
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted"><?//= $class['fullname']; ?></small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                    <?php endif ?> 

 <!--                        <?php if (($isTime >= '06:30') && ($isTime <= '08:00')): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="#" data-toggle="modal" data-target="#modalAbsen">
                                <div class="card card-s" style="color: black;">
                                    <div class="bg-warning" style="background-image: url('<?= base_url(); ?>/img/favicon.png')!important;background-size: 50px;background-position: center;background-repeat: no-repeat;height: 100px;">
                                    </div>
                                    <div class="px-3 py-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-0">
                                                    <b>Absensi</b><?//= $class['class_group_name']; ?>
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">06.30 - 08.00<?//= $class['fullname']; ?></small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif ?> -->

                        <?php foreach ($tasks as $task): ?>
                        <?php if (($isDate >= $task['task_date_start']) && ($isDate <= $task['task_date_finish']) ): ?>
                            <div class="col-8 col-md-5 col-lg-4">
                                <a href="<?= base_url(); ?>/student/tasks/<?= $task['id']; ?>">
                                    <div class="card card-s" style="color: black;">
                                        <div class="bg-warning" style="background-image: url('<?= base_url(); ?>/img/favicon.png')!important;background-size: 50px;background-position: center;background-repeat: no-repeat;height: 100px;">
                                        </div>
                                        <div class="px-3 py-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="mb-0">Tugas : 
                                                        <b><?= $task['task_name']; ?> </b> - <?= $task['subject_name']; ?>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted"><?= $task['task_date_start'].' s.d '.$task['task_date_finish']; ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif ?>
                        <?php endforeach ?>
                    
                </div>

                <!-- <div class="row mt-3">
                    <div class="col-12 col-md-7 col-lg-5">
                        <div class="card bg-warning">
                            <div class="card-body text-white">
                                <div class="row">
                                    <div class="col-10">
                                        <p class="mb-0">Kamu belum mengerjakan tugas XXX dan 7 tugas lainnya</p>
                                    </div>
                                    <div class="middle col-2 text-right">
                                        <button class="btn btn-secondary">></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <?php } ?>

                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <?php if (in_groups('admin')): ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Daftar Rencana Pembelajaran</h4>
                                    <div class="ml-auto">
                                        <a href="">Selengkapnya</a>
                                    </div>
                                </div>
                                <table id="rencanaPembelajaran" style="width: 100%" class="table table-striped v-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th width="5">No</th>
                                            <th>Judul</th>
                                            <th width="100">Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Daftar Jurnal Pembelajaran</h4>
                                    <div class="ml-auto">
                                        <a href="">Selengkapnya</a>
                                    </div>
                                </div>
                                <table id="jurnalPembelajaran" style="width: 100%" class="table table-striped v-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th width="5">No</th>
                                            <th>Judul</th>
                                            <th width="100">Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif ?>
                        <div class="card">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                      <h4 class="mb-0 card-title">Jadwal Hari Ini</h4>
                                    </div>
                                    <div class="col-4 text-right">
                                          <?= tgl_indo(date('Y-m-d')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mt-4 activity">
                                    <?php if (in_groups(['teacher'])): ?>
                                    <?php foreach ($sch as $x): ?>
                                        <p class="mb-0"><strong><?= $x['subject_name'].' - '.$x['class_group_name'] ?></strong></p>
                                        <div class="mt-0">
                                            <span class="font-14 material-symbols-rounded">schedule</span>
                                            <span><?= substr($x['time_start'], 0, 5).' - '.substr($x['time_finish'], 0, 5); ?></span></div>
                                        <div class="mt-0">
                                            <span class="font-14 material-symbols-rounded">location_on</span>
                                            <span class="font-weight">Ruang 1</span>
                                        </div>
                                        <hr>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                      <h4 class="mb-0 card-title">Pengumuman</h4>
                                    </div>
                                    <?php if (in_groups(['admin','teacher'])): ?>
                                        <div class="col-4 text-right">
                                          <a href = "#" data-toggle="modal" data-target="#addNews" class="btn btn-sm btn-primary btn-round"><i class="text-white fa fa-plus"></i></a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>

                            <!--Content Scroll Modal -->
                            <div class="modal fade" id="addNews" tabindex="-1" role="dialog"
                                aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-full-width" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="<?= base_url(); ?>/home/create">
                                            <? csrf_field(); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="scrollableModalTitle">Buat Pengumuman</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Judul</label>
                                                        <input type="text" class="form-control" name="title" placeholder="Judul" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Pengumuman</label>
                                                        <textarea class="editorz" name="news"></textarea>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Kirim" name="addNews" class="btn btn-cyan btn-round">
                                                <button type="button" class="btn btn-secondary btn-round"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </form>
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
                                <div class="mt-4 activity">
                                    <?php foreach ($news as $x): ?>
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                    <i data-feather="bell"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2"><?= $x['title']; ?> <?php if (($x['teacher_id'] == user()->id) || (in_groups('admin'))) {
                                                echo "&nbsp;<a href='javascript:void(0)' data-toggle='modal' data-target='#updateNews".$x['newsid']."'><i class='text-primary fa fa-pen'></i></a>
                                                        &nbsp;<a href='javascript:void(0)' data-toggle='modal' data-target='#deleteNews".$x['newsid']."'><i class='text-danger fa fa-trash'></i></a>";
                                            } ?></h5>
                                                <span class="font-weight-light font-14 text-muted"><b><?= $x['fullname']; ?></b></span><br>
                                                <span class="font-weight-light font-14 text-muted"><?= $x['created_at']; ?></span><br>
                                                <br>
                                                <p class="font-14 mb-2 text-muted"><?= $x['news']; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="updateNews<?= $x['newsid']; ?>" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-full-width" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="<?= base_url(); ?>/home/update">
                                                        <? csrf_field(); ?>
                                                        <input type="hidden" value="<?= $x['newsid']; ?>" name="id">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="scrollableModalTitle">Ubah Pengumuman</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Judul</label>
                                                                    <input type="text" class="form-control" name="title" placeholder="Judul" required value="<?= $x['title']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Pengumuman</label>
                                                                    <textarea id="class-news" class="editorz" name="news"><?= $x['news'] ?></textarea>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" value="Kirim" name="addNews" class="btn btn-cyan btn-round">
                                                            <button type="button" class="btn btn-secondary btn-round"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                        <div id="deleteNews<?= $x['newsid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-danger">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-wrong h1"></i>
                                                            <h4 class="mt-2"><b>Perhatian!</b></h4>
                                                            <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                                            <form action="<?= base_url(); ?>/home/delete" method="post">
                                                                <? csrf_field(); ?>
                                                                <input type="hidden" name="id"  value="<?= $x['newsid']; ?>" >
                                                                <button type="submit" name="delNews" value="del" class="btn btn-light btn-round my-2">Iya</button>
                                                                <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                                            </form>
                                                                                    
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalAbsen" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Kirim Data Absensi</b></h4>
                                <!-- <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p> -->
                                <form action="<?= base_url(); ?>/student/absen/send" method="post">
                                    <? csrf_field(); ?>
                                    <button type="submit" name="delNews" value="del" class="btn btn-light my-2">Iya</button>
                                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Tidak</button>
                                </form>
                                                        
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?php if (in_groups('student')): ?>
            <div id="modalRapor" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <embed type="application/pdf" src="<?= base_url().'/unduh/rapor/'.'RAPOR '.user()->fullname.' - '.get_classgroup_user(user()->id)->class_group_name.'.pdf'; ?>" width="100%" height="400"></embed>
                                <a href="<?= base_url(); ?>/unduh/rapor/RAPOR <?= user()->fullname.' - '.get_classgroup_user(user()->id)->class_group_name;?>.pdf" class="btn btn-cyan btn-round">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>

            <script src="<?= base_url(); ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url(); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>
            <script>
                $('#rencanaPembelajaran').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?= base_url(); ?>/learn/plan/get_learn_plan/1'
                    },
                    order: [[0,"desc"]],
                    columns: [
                        {data: 'pid', nama: 'pid'},
                        {data: 'title', nama: 'title',
                            render: function (data, type, row) {
                                return "<a href=\"<?= base_url(); ?>/learn/plan/review/"+row.pid+"\" class=\"text-secondary border-bottom pb-1 border-secondary\">"+row.title+"</a>";
                            }
                        },
                        {data: 'teacher_name', nama: 'teacher_name'}
                    ],
                    columnDefs : [
                            { 
                                "data": null,
                                "targets" : 0,
                                render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }
                        ]
                });
            </script>
            <script>
                $('#jurnalPembelajaran').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?= base_url(); ?>/learn/journal/get_journal_learn'
                    },
                    order: [[0,"desc"]],
                    columns: [
                        {data: 'jid', nama: 'jid'},
                        {data: 'classname', nama: 'classname',
                            render: function (data, type, row) {
                                return "<a href=\"<?= base_url(); ?>/learn/journal/review/"+row.jid+"\" class=\"text-secondary border-bottom pb-1 border-secondary\">"+row.sbjk+" - "+row.classname+"</a>";
                            }
                        },
                        {data: 'teacher_name', nama: 'teacher_name'}
                    ],
                    columnDefs : [
                            { 
                                "data": null,
                                "targets" : 0,
                                render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }
                        ]
                });
            </script>
            <?= $this->endSection(); ?>
