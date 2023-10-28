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
                                    <h4 class="card-title">Daftar Tahun Ajaran</h4>
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
                                    <table id="zero_config" style="width: 100%" class="table table-striped v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="5">#</th>
                                                <th class="border-0 font-weight-medium text-muted">Tahun Ajaran</th>
                                                <th class="border-0 font-weight-medium text-muted">Kode</th>
                                                <th class="border-0 font-weight-medium text-muted">Status</th>
                                                <th class="border-0 font-weight-medium text-muted" width="65"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($periodyears as $row): ?>
                                            <tr>
                                            	<td><?= $no++; ?></td>
                                            	<td><?= $row['name']; ?></td>
                                                <td><?= $row['id']; ?></td>
                                                <td><button class="btn btn-md btn-round btn-<?= $row['is_active']==1?'cyan':'danger'; ?>"><?= $row['is_active']==1?'AKTIF':'TIDAK'; ?></button></td>
                                            	<td>
                                            		<div class="btn-group">
                                                        <a title="Ubah Data" class="btn btn-md btn-round btn-light" href="" >
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <a title="Hapus Data" class="btn btn-md btn-round btn-light" href="#">
                                                            <i class="text-danger fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                            	</td>
                                            </tr>
                                            <?php endforeach ?>
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
                            <h4 class="modal-title" id="myModalLabel">Tambah Daftar Tahun Ajaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="<?= base_url(); ?>/data/tasktype/create" method="post" class="mt4-">
                            <?php csrf_field() ?>
                            <div class="modal-body">
                            	<div class="form-group">
                            		<label>Penilaian</label>
                            		<input class="form-control" type="text" name="task_type_name">
                            	</div>
                            	<div class="form-group">
                            		<label>Kode</label>
                            		<input class="form-control" type="text" name="task_type_code" maxlength="5">
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
                            	
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" name="addTask">Simpan</button>
                            </div>
                        </form>
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
                        url: "<?php echo base_url('learn/task/show'); ?>"+ '/' + task_id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#s_task').serialize(),
                        success: function(res) {
                            // console.log('my message' + inter_id);
                            if (res.success == true) {
                                $('.task_status').val(res.data.task_status);
                            }
                        }
                    });
                }
            </script>
            <?= $this->endSection(); ?>