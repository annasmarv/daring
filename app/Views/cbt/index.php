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
                                    <h4 class="card-title">Daftar Ujian</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
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
                                    <table id="myDataTable1" style="width: 100%" class="table table-striped v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="5">#</th>
                                                <th class="border-0 font-weight-medium text-muted">Nama Tugas</th>
                                                <th class="border-0 font-weight-medium text-muted" width="200">Mata Pelajaran</th>
                                                <th class="border-0 font-weight-medium text-muted" width="50">Kelas</th>
                                                <th class="border-0 font-weight-medium text-muted" width="200">Waktu Ujian</th>
                                                <th class="border-0 font-weight-medium text-muted" width="65">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
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
                        <form action="<?= base_url(); ?>/learn/task/create" method="post" class="mt4-">
                            <?php csrf_field() ?>
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Nama Tugas</label>
                                        <input type="text" name="task_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control" id="MataPelajaran" name="subject" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label>Kelas</label>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="class" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($classes as $class): ?>
                                                <option value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Soal</label>
                                        <select class="form-control" id="quest_code" name="quest_bank_id" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($questbank as $bank): ?>
                                                <option value="<?= $bank['id']; ?>"><?= $bank['quest_code']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Soal</label>
                                        <input type="text" class="form-control" name="quest_total" required>
                                        <small id="" class="form-text text-white badge badge-danger">*Maks. <small id="jumsoal1"></small></small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="start" value="<?= date("Y-m-d"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Berakhir</label>
                                        <input type="date" class="form-control" name="finish" value="<?= date("Y-m-d"); ?>" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Kesempatan Mengerjakan</label>
                                        <input type="number" name="limit" class="form-control" value="1" required>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Acak Soal</label>
                                        <select id="acak" class="form-control" name="random" required>
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <label>Status</label>
                                        <select id="acak" class="form-control" name="status" required>
                                            <option value="0">NONAKTIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                        <input type="hidden" name="teacher_id" value="<?= user()->id;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" name="addTask">Simpan</button>
                            </div>
                        </form>
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
                        <form action="<?= base_url(); ?>/learn/task/update" method="post" class="mt4-">
                            <?php csrf_field() ?>
                            <input type="hidden" name="id" class="task_id">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Nama Tugas</label>
                                        <input type="text" name="task_name" class="form-control task_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control" id="MataPelajaran" name="subject" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label>Kelas</label>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="class" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($classes as $class): ?>
                                                <option value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Soal</label>
                                        <select class="form-control" id="quest_code" name="quest_bank_id" required>
                                            <option selected="" value="saa"></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Soal</label>
                                        <input type="text" class="form-control" name="quest_total" required>
                                        <small id="" class="form-text text-white badge badge-danger">*Maks. <small id="jumsoal11"></small></small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="start" value="<?= date("Y-m-d"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Berakhir</label>
                                        <input type="date" class="form-control" name="finish" value="<?= date("Y-m-d"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kesempatan Mengerjakan</label>
                                        <input type="number" name="limit" class="form-control" value="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Acak Soal</label>
                                        <select id="acak" class="form-control" name="random" required>
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <label>Status</label>
                                        <select id="acak" class="form-control" name="status" required>
                                            <option value="0">NONAKTIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                        <input type="hidden" name="teacher_id" value="<?= user()->id;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" name="addTask">Simpan</button>
                            </div>
                        </form>
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
                                    <button type="submit" name="upSttsModul" class="btn btn-light my-2">Iya</button>
                                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Tidak</button>
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
                                    <button type="submit" name="delKelas" class="btn btn-light my-2">Iya</button>
                                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Tidak</button>
                                </form>                          
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script src="<?= base_url(); ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url(); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>
            <script>
                $('#myDataTable1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?= base_url(); ?>/ujian/get_ujian/<?= null !== get_cookie('periodyear')?get_cookie('periodyear'):period()->id ?>'
                    },
                    order: [[0,"desc"]],
                    columns: [
                        {data: 'ujianid', className: 'border-top-0 px-2 py-4'},
                        {data: 'taskname', className: 'border-top-0 px-2 py-4',
                            render: function (data, type, row) {
                                return "<a href=\"<?= base_url(); ?>/ujian/"+row.ujianid+"\" class=\"text-secondary border-bottom pb-1 border-secondary\">"+row.taskname+"</a> &nbsp; <span class=\"badge badge-light\">"+row.task_type_code+"</span>";
                            }
                        },
                        {data: 'sbjk', className: 'border-top-0 px-2 py-4'},
                        {data: 'class', className: 'border-top-0 px-2 py-4'},
                        {data: 'datestart', className: 'border-top-0 px-2 py-4',
                            render: function (data, type, row) {
                                return row.datestart + '<br> <span class="text-muted font-14">' +row.timestart + ' s.d ' + row.timefinish + '</span>';
                            }
                        },
                        {data: 'status', className: 'border-top-0 px-2 py-4'}
                    ],
                    columnDefs : [
                            { 
                                "data": null,
                                "targets" : 0,
                                render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                                "searchable" : false,
                                "targets" : 5,
                                "render" : function(data, type, row) {
                                    var btn2 = ""
                                    if (data == 1) { btn2 = "<a href=\"#\" class=\"text-secondary border-bottom pb-1 border-secondary task-status\" onclick=\"status_record('"+row.ujianid+"')\" data-status=\"0\">AKTIF</a>"
                                    }else{ btn2 = "<a href=\"#\" class=\"text-secondary border-bottom pb-1 border-secondary task-status\" onclick=\"status_record('"+row.ujianid+"')\" data-status=\"1\">NONAKTIF</a>"
                                    }
                                    return btn2;
                                }
                            }
                        ]
                });
            </script>
            <?= $this->endSection(); ?>