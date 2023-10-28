			<?= $this->extend('templates/index'); ?>            
			<?= $this->section('content'); ?>
            <?php date_default_timezone_set('Asia/Jakarta'); ?>      
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
                                    <h4 class="card-title">Pertemuan</h4>
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
                                    <table id="myDataTable1" style="width: 100%" class="ttable table-striped v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="5">#</th>
                                                <th class="border-0 font-weight-medium text-muted">Topik</th>
                                                <th class="border-0 font-weight-medium text-muted" width="150">Mata Pelajaran</th>
                                                <th class="border-0 font-weight-medium text-muted" width="50">Kelas</th>
                                                <th class="border-0 font-weight-medium text-muted" width="100">Materi</th>
                                                <th class="border-0 font-weight-medium text-muted" width="100">Tugas</th>
                                                <th class="border-0 font-weight-medium text-muted" width="100">Interaktif</th>
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
                            <h4 class="modal-title" id="myModalLabel">Pertemuan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="<?= base_url(); ?>/learn/meet/create" method="post" class="mt4-">
                            <?php csrf_field() ?>
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Topik Pertemuan</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control" name="subject" required id="sel_mapel">
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select class="form-control" name="class" required id="sel_class">
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($classes as $class): ?>
                                                <option value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Materi</label>
                                        <select class="form-control" name="modul" id="sel_materi">
                                            <option selected=""></option>
                                            <?php foreach ($modul as $materi): ?>
                                                <option value="<?= $materi['mid']; ?>"><?= $materi['title']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label>Tugas</label>
                                        <select class="form-control" name="task" id="sel_tugas">
                                            <option selected=""></option>
                                           
                                        </select>
                                    </div>  
                                    <div class="form-group">
                                        <label>Interaktif</label>
                                        <select class="form-control" name="inter" id="sel_inter">
                                            <option selected=""></option>
                                          
                                        </select>
                                    </div>                                           
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="acak" class="form-control" name="status" required>
                                            <option value="0">NONAKTIF</option>
                                            <option value="1">AKTIF</option>
                                        </select>
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
            <!-- EDIT modal content -->

            <!-- Warning Alert Modal -->
            <div id="statusMeet" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-warning">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Ubah Status!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan merubah data ini?</p>
                                <form id="s_meet" action="<?= base_url() ?>/learn/meet/status" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" class="meet_id">
                                    <input type="hidden" id="s_status" name="status" class="meet_status">
                                    <button type="submit" name="upSttsModul" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="deleteMeet" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <form action="<?= base_url(); ?>/learn/meet/delete" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="meet_id" id="meet_id">
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
                        url: '<?= base_url(); ?>/learn/meet/get_meet'
                    },
                    order: [[0,"desc"]],
                    columns: [
                        {data: 'meetid', nama: 'meetid'},
                        {data: 'meetname', nama: 'meetname'
                        // ,
                        //     render: function (data, type, row) {
                        //         return "<a href=\"<?= base_url(); ?>/meet/"+row.meetid+"\" class=\"text-secondary border-bottom pb-1 border-secondary\">"+row.meetname+"</a>";
                        //     }
                        },
                        {data: 'sbjk', nama: 'sbjk'},
                        {data: 'class', nama: 'class'},
                        {data: 'modul', nama: 'modul'},
                        {data: 'task', nama: 'task'},
                        {data: 'discuss', nama: 'discuss'},
                        {data: 'status', nama: 'status'},
                        {
                            "data": function(data) {
                                return `
                                        <div class="dropdown sub-dropdown">
                                            <a class="btn-link dropdown-toggle" type="button" id="dd11" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd11">
                                                <a class="dropdown-item" href="<?= base_url(); ?>/learn/meet/ubah/`+data.meetid+`">Edit</a>
                                                <a class="dropdown-item meet-delete" onclick="delete_record('`+data.meetid+`')" href="#">Hapus</a>
                                                <a class="dropdown-item" href="<?= base_url(); ?>/learn/meet/pdf/`+data.meetid+`/`+data.class_group_id+`">PDF</a>
                                            </div>
                                        </div> `
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
                                "targets" : 7,
                                "render" : function(data, type, row) {
                                    var btn2 = ""
                                    if (data == 1) { btn2 = "<a href=\"#\" class=\"text-secondary border-bottom pb-1 border-secondary inter-status\" onclick=\"status_record('"+row.meetid+"')\" data-status=\"0\">AKTIF</a>"
                                    }else{ btn2 = "<a href=\"#\" class=\"text-secondary border-bottom pb-1 border-secondary inter-status\" onclick=\"status_record('"+row.meetid+"')\" data-status=\"1\">NONAKTIF</a>"
                                    }
                                    return btn2;
                                }
                            }
                        ]
                });
            </script>
            <script>
                function delete_record(meet_id) {
                    status = 'delete';
                    $('#deleteMeet').modal('show');
                    $('#meet_id').val(meet_id);
                }

                function status_record(meet_id) {
                    $('#statusMeet').modal('show');
                    $('.meet_id').val(meet_id);
                    $.ajax({
                        url: "<?php echo base_url('learn/meet/show'); ?>"+ '/' + meet_id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#s_meet').serialize(),
                        success: function(res) {
                            console.log('my message' + meet_id);
                            if (res.success == true) {
                                $('#s_status').val(res.data.status);
                            }
                        }
                    });
                }
            </script>
            <script type='text/javascript'>

                var baseURL= "<?php echo base_url();?>";                
                $(document).ready(function(){
                    
                    $('#sel_class').change(function(){
                        var subject_id = $('#sel_mapel option:selected').val();
                        var class_id = $(this).val();
                
                        $.ajax({
                            url:'<?=base_url()?>/learn/meet/get_task_meet',
                            method: 'post',
                            data: {class_id: class_id, subject_id: subject_id},
                            dataType: 'json',
                            success: function(response){
                                // Remove options 
                                $('#sel_tugas').find('option').not(':first').remove();
                                // Add options
                                $.each(response,function(index,data){
                                    $('#sel_tugas').append('<option value="'+data['id']+'">'+data['task_name']+'</option>');
                                });
                            },
                        });

                        $.ajax({
                            url:'<?=base_url()?>/learn/interactive/get_inter_meet',
                            method: 'post',
                            data: {class_id: class_id, subject_id: subject_id},
                            dataType: 'json',
                            success: function(response){
                                // Remove options 
                                $('#sel_inter').find('option').not(':first').remove();
                                // Add options
                                $.each(response,function(index,data){
                                    $('#sel_inter').append('<option value="'+data['id']+'">'+data['title']+'</option>');
                                });
                            },
                        });

                        $.ajax({
                            url:'<?=base_url()?>/data/modul/get_modul_meet',
                            method: 'post',
                            data: {class_id: class_id, subject_id: subject_id},
                            dataType: 'json',
                            success: function(response){
                                // Remove options 
                                $('#sel_materi').find('option').not(':first').remove();
                                // Add options
                                $.each(response,function(index,data){
                                    $('#sel_materi').append('<option value="'+data['id']+'">'+data['title']+'</option>');
                                });
                            },
                        });
                    });
                }) ;
                </script>

            <?= $this->endSection(); ?>