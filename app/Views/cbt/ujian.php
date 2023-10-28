			<?= $this->extend('templates/index'); ?>            
			<?= $this->section('content'); ?> 
            <?php $uri = service('uri'); ?>          
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
                                    <h4 class="card-title">Jadwal Ujian</h4>
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
                                <form method="get" action="" class="mt-3 form-horizontal">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select class="form-control" name="tasktype">
                                                    <?php foreach ($tasktypes as $tt): ?>
                                                        <option <?= $tt['id']==$filter ? 'selected' : '' ?> value="<?= $tt['id']; ?>"><?= $tt['task_type_name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-round btn-cyan" name="" value="FILTER">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                                <th class="border-0 font-weight-medium text-muted" width="5"><i class="fas fa-ellipsis-v"></i></th>
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
                            <h4 class="modal-title" id="myModalLabel">Buat Jadwal Ujian</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">close</i></button>
                        </div>
                        <form action="<?= base_url(); ?>/ujian/create" method="post" class="mt4-">
                            <?php csrf_field() ?>
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Judul Ujian</label>
                                        <input type="text" name="task_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipe Ujian</label>
                                        <select class="form-control" name="task_type_id" required>
                                            <option value="" selected disabled></option>
                                            <?php foreach ($tasktypes as $tt): ?>
                                                <option value="<?= $tt['id']; ?>"><?= $tt['task_type_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label>Kelas</label>
                                        <select class="form-control" name="class" id="sel_class" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($classes as $class): ?>
                                                <option value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control" id="sel_mapel" name="subject" required>
                                            <option selected="" value=""></option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Kode Soal</label>
                                        <select class="form-control" id="questbank" name="quest_bank_id" required>
                                            <option selected="" value=""></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Soal</label>
                                        <input type="text" class="form-control" id="quest_total" name="quest_total" required>
                                        <small id="" class="form-text text-white badge badge-danger">*Maks. <small id="jumsoal1"></small></small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Ujian</label>
                                        <input type="date" class="form-control" name="datestart" value="<?= date("Y-m-d"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <input type="time" class="form-control" name="timestart" value="<?php echo date("H:i"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Berakhir</label>
                                        <input type="time" class="form-control" name="timefinish" value="<?php echo date("H:i"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Token</label>
                                        <input type="text" value="<?= strtoupper(random_string('alpha', 6)); ?>" class="form-control" name="token" required>
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
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-round" name="addTask">Simpan</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="copyTask" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Salin Jadwal Ujian</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">close</i></button>
                        </div>
                        <form action="<?= base_url(); ?>/ujian/create" method="post" class="mt4-">
                            <?php csrf_field() ?>
                            <input type="hidden" class="ssubject" name="subject">
                            <input type="hidden" class="squest_bank_id" name="quest_bank_id">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Judul Ujian</label>
                                        <input type="text" name="task_name" class="form-control stask_name" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label>Kelas</label>
                                        <select class="form-control" name="class" id="sel_class" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($classes as $class): ?>
                                                <option value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipe Ujian</label>
                                        <select class="form-control stask_type_id" name="task_type_id" required>
                                            <option value="" selected disabled></option>
                                            <?php foreach ($tasktypes as $tt): ?>
                                                <option value="<?= $tt['id']; ?>"><?= $tt['task_type_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Soal</label>
                                        <input type="text" class="form-control squest_total" id="quest_total" name="quest_total" required>
                                        <small id="" class="form-text text-white badge badge-danger">*Maks. <small id="jumsoal1"></small></small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Ujian</label>
                                        <input type="date" class="form-control sdatestart" name="datestart" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <input type="time" class="form-control stimestart" name="timestart" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Berakhir</label>
                                        <input type="time" class="form-control stimefinish" name="timefinish" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Token</label>
                                        <input type="text" value="" class="form-control stoken" name="token" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Acak Soal</label>
                                        <select id="acak" class="form-control sacak" name="random" required>
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <label>Status</label>
                                        <select id="acak" class="form-control sstatus" name="status" required>
                                            <option value="0">NONAKTIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
                                        <input type="hidden" name="teacher_id" value="<?= user()->id;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-round" name="addTask">Simpan</button>
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
                                <form id="s_task" action="<?= base_url() ?>/ujian/status" method="post">
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
                                <form action="<?= base_url(); ?>/ujian/delete" method="post">
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
            <script src="<?= base_url(); ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url(); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>
            <script>
                $('#myDataTable1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?= base_url(); ?>/ujian/get_ujian_all/<?= null !== get_cookie('periodyear')?get_cookie('periodyear'):period()->id ?>/<?= $filter ?>'
                    },
                    order: [[0,"desc"]],
                    columns: [
                        {data: 'ujianid', className: 'border-top-0 px-2 py-4'},
                        {data: 'taskname', className: 'border-top-0 px-2 py-4',
                            render: function (data, type, row) {
                                return "<a href=\"<?= base_url(); ?>/ujian/"+row.ujianid+"\" class=\"text-secondary border-bottom pb-1 border-secondary\">"+row.taskname+ "</a> &nbsp; <span class=\"badge badge-light\">"+row.task_type_code+"</span>";
                            }
                        },
                        {data: 'sbjk', className: 'border-top-0 px-2 py-4'},
                        {data: 'class', className: 'border-top-0 px-2 py-4'},
                        {data: 'datestart', className: 'border-top-0 px-2 py-4',
                            render: function (data, type, row) {
                                return row.datestart + '<br> <span class="text-muted font-14">' +row.timestart + ' s.d ' + row.timefinish + '</span>';
                            }
                        },
                        {data: 'status', className: 'border-top-0 px-2 py-4'},
                        {data: 'ujianid', className: 'border-top-0 px-2 py-4',
                            "orderable" : false,
                            render: function(data, type, row) {
                                return "<div class=\"dropdown sub-dropdown\"><a class=\"btn-link dropdown-toggle\" type=\"button\" id=\"dd11\" data-toggle=\"dropdown\"><i class=\"fas fa-ellipsis-v\"></i></a><div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"dd11\"><a class=\"dropdown-item\" href=\"<?= base_url(); ?>/ujian/ubah/"+row.ujianid+"\">Edit</a><a href=\"#\" class=\"dropdown-item task-delete\" onclick=\"copy_record('"+row.ujianid+"')\">Salin</a><a href=\"#\" class=\"dropdown-item task-delete\" onclick=\"delete_record('"+row.ujianid+"')\">Hapus</a></div></div>";
                            }
                        }
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
            <script>
                function delete_record(task_id) {
                    status = 'delete';
                    $('#deleteTask').modal('show');
                    $('.task_id').val(task_id);
                }

                function status_record(task_id) {
                    $('#statusTask').modal('show');
                    $('.task_id').val(task_id);
                    $.ajax({
                        url: "<?php echo base_url('ujian/show'); ?>"+ '/' + task_id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#s_task').serialize(),
                        success: function(res) {
                            // console.log('my message' + inter_id);
                            if (res.success == true) {
                                $('.task_status').val(res.data.status);
                            }
                        }
                    });
                }

                function copy_record(task_id) {
                    $('#copyTask').modal('show');
                    $.ajax({
                        url: "<?php echo base_url('ujian/show'); ?>"+ '/' + task_id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#s_task').serialize(),
                        success: function(res) {
                            // console.log('my message' + inter_id);
                            if (res.success == true) {
                                $('.stask_name').val(res.data.task_name);
                                $('.ssubject').val(res.data.subject_id);
                                $('.sclass').val(res.data.class_group_id).trigger('change');
                                $('.stask_type_id').val(res.data.task_type_id).trigger('change');
                                $('.squest_bank_id').val(res.data.quest_bank_id);
                                $('.squest_total').val(res.data.quest_total);
                                $('.sdatestart').val(res.data.task_date_start);
                                $('.stimestart').val(res.data.time_start);
                                $('.stimefinish').val(res.data.time_finish);
                                $('.stoken').val(res.data.token);
                                $('.sacak').val(res.data.random).trigger('change');
                                $('.sstatus').val(res.data.status).trigger('change');
                                $('.task_status').val(res.data.status).trigger('change');
                            }
                        }
                    });
                }
            </script>
            <script>
                $("#questbank").change(function(){
                    var soal = $("#questbank").val();
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: '<?= base_url(); ?>/quest/count_soal',
                        data: "soal="+soal,
                        success: function(msg){     
                            
                            if(msg == ''){
                                alert('Tidak ada data Kota');
                            }   
                            
                            else{
                                $("#quest_total").val(msg);
                                $("#jumsoal1").html(msg);                                     
                            }
                        }
                    });            
                });
                </script>
                <script type='text/javascript'>
                    var baseURL= "<?php echo base_url();?>";
                    $(document).ready(function(){
                        $('#sel_class').change(function(){
                            var class_id = $(this).val();
                            // AJAX request
                            $.ajax({
                                url:'<?=base_url()?>/ujian/get_subject_by_classgroup',
                                method: 'post',
                                data: {class_id: class_id},
                                dataType: 'json',
                                success: function(response){
                                    $('#sel_mapel').find('option').not(':first').remove();
                                    // Add options
                                    $.each(response,function(index,data){
                                    $('#sel_mapel').append('<option value="'+data['id']+'">'+data['subject_name']+'</option>');
                                    });
                                }
                            });
                        });

                        $('#sel_mapel').change(function(){
                            var subject = $(this).val();
                            $.ajax({
                                url:'<?=base_url()?>/questbank/getQuestbank',
                                method: 'post',
                                data: {subject_id: subject},
                                dataType: 'json',
                                success: function(response){
                                    $('#questbank').find('option').not(':first').remove();
                                    $.each(response,function(index,data){
                                        $('#questbank').append('<option value="'+data['id']+'">'+data['quest_code']+'</option>');
                                    });
                                }
                            });
                        });
                    });
                    </script>

            <?= $this->endSection(); ?>