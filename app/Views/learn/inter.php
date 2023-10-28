			<?= $this->extend('templates/index'); ?>            
			<?= $this->section('content'); ?>
            <?php date_default_timezone_set('Asia/Jakarta'); ?>      
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <b>Kelas Interaktif</b>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <button class="btn btn-sm btn-cyan" data-toggle="modal"
                                        data-target="#addTask"><i class="fa fa-plus"> Tambah</i></button>
                                        <!-- <button class="btn btn-sm btn-danger"><i class="fa fa-upload"> Upload</i></button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('pesan')): ?>
                                    <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php endif ?>
                                <div class="table-responsive">
                                    <table id="myDataTable1" style="width: 100%" class="table wrap v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th width="5">#</th>
                                                <th>Tema</th>
                                                <th width="150">Mata Pelajaran</th>
                                                <th width="50">Kelas</th>
                                                <th width="100">Tanggal</th>
                                                <th width="100">Waktu</th>
                                                <th width="65">Status</th>
                                                <th width="5"><i class="fas fa-ellipsis-v"></i></th>
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
                            <h4 class="modal-title" id="myModalLabel">Kelas Interaktif</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="<?= base_url(); ?>/learn/interactive/create" method="post" class="mt4-">
                            <?php csrf_field() ?>
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Tema</label>
                                        <input type="text" name="tema" class="form-control" required>
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
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select class="form-control" name="class" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($classes as $class): ?>
                                                <option value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>                                                   
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tgl" value="<?php echo date("Y-m-d"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <input type="time" class="form-control" name="start" value="<?php echo date("H:i"); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Berakhir</label>
                                        <input type="time" class="form-control" name="finish" value="<?php echo date("H:i"); ?>" required>
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
                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" name="addTask">Simpan</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- EDIT modal content -->

            <!-- Warning Alert Modal -->
            <div id="statusTask" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-warning">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Ubah Status!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan merubah data ini?</p>
                                <form id="s_inter" action="<?= base_url() ?>/learn/interactive/status" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" class="inter_id">
                                    <input type="hidden" id="s_status" name="status" class="inter_status">
                                    <button type="submit" name="upSttsModul" class="btn btn-light my-2">Iya</button>
                                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Tidak</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="deleteInter" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <form action="<?= base_url(); ?>/learn/interactive/delete" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="inter_id" id="inter_id">
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
                        url: '<?= base_url(); ?>/learn/interactive/get_interactive'
                    },
                    order: [[0,"desc"]],
                    columns: [
                        {data: 'did', nama: 'did'},
                        {data: 'title', nama: 'title',
                            render: function (data, type, row) {
                                return "<a href=\"<?= base_url(); ?>/ch/?x=<?= base64_encode(user()->id);?>&id="+row.did+"\" class=\"text-secondary border-bottom pb-1 border-secondary\">"+row.title+"</a>";
                            }
                        },
                        {data: 'sbjk', nama: 'sbjk'},
                        {data: 'class', nama: 'class'},
                        {data: 'date', nama: 'date'},
                        {data: 'sbjk',
                            render: function (data, type, row) {
                                return row.time_start + ' - ' + row.time_finish;
                            }
                        },
                        {data: 'status', nama: 'status'},
                        {
                            "data": function(data) {
                                return `
                                        <div class="dropdown sub-dropdown">
                                            <a class="btn-link dropdown-toggle" type="button" id="dd11" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd11">
                                                <a class="dropdown-item" href="<?= base_url(); ?>/learn/interactive/ubah/`+data.did+`">Edit</a>
                                                <a class="dropdown-item inter-delete" onclick="delete_record('`+data.did+`')" href="#">Hapus</a>
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
                                "targets" : 6,
                                "render" : function(data, type, row) {
                                    var btn2 = ""
                                    if (data == 1) { btn2 = "<a href=\"#\" class=\"text-secondary border-bottom pb-1 border-secondary inter-status\" onclick=\"status_record('"+row.did+"')\" data-status=\"0\">AKTIF</a>"
                                    }else{ btn2 = "<a href=\"#\" class=\"text-secondary border-bottom pb-1 border-secondary inter-status\" onclick=\"status_record('"+row.did+"')\" data-status=\"1\">NONAKTIF</a>"
                                    }
                                    return btn2;
                                }
                            }
                        ]
                });
            </script>
            <script>
                function delete_record(inter_id) {
                    status = 'delete';
                    $('#deleteInter').modal('show');
                    $('#inter_id').val(inter_id);
                }

                function status_record(inter_id) {
                    $('#statusTask').modal('show');
                    $('.inter_id').val(inter_id);
                    $.ajax({
                        url: "<?php echo base_url('learn/interactive/show'); ?>"+ '/' + inter_id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#s_inter').serialize(),
                        success: function(res) {
                            // console.log('my message' + inter_id);
                            if (res.success == true) {
                                $('#s_status').val(res.data.status);
                            }
                        }
                    });
                }
            </script>

            <?= $this->endSection(); ?>