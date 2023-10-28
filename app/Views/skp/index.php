			<?= $this->extend('templates/index'); ?>            
			<?= $this->section('content'); ?>
            <style type="text/css">
                table tr td .is_active{
                    width: 10px!important;
                }
            </style>         
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('pesan')): ?>
                                    <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><span class="material-symbols-rounded">close</span></span>
                                        </button>
                                    <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php endif ?>
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title"><?= $title; ?></h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addSkp">Tambah</button>
                                            <button type="button" class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v fa-fw"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Upload</a>
                                                <a class="dropdown-item" href="#">Print</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="myDataTable1" style="width: 100%" class="table table-striped  v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="1">#</th>
                                                <th class="border-0 font-weight-medium text-muted">Periode</th>
                                                <th style="" class="border-0 font-weight-medium text-muted"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($skp as $row): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><a href="<?= base_url('skp/detail/'.$row['id']); ?>"><?= strtoupper($row['month_name']); ?></a></td>
                                                <td></td>
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
            <div id="addSkp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Buat SKP</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"><span class="material-symbols-rounded">close</span></button>
                                            </div>
                                            <form action="<?= base_url(); ?>/skp/create" method="post">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Periode</label>
                                                        <select name="month_id" class="form-control form-select">
                                                            <?php foreach ($months as $month): ?>
                                                                <option value="<?= $month['id']; ?>"><?= $month['month_name']; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-round btn-light"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-round btn-primary" name="addKelas">Simpan</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

            <script src="<?= base_url(); ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url(); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>

            <script>
                function delete_record(modul_id) {
                    $('#deleteModul').modal('show');
                    $('#inter_id').val(modul_id);
                }

                function status_record(modul_id) {
                    $('#statusModul').modal('show');
                    $('.modul_id').val(modul_id);
                    $.ajax({
                        url: "<?php echo base_url('data/modul/show'); ?>"+ '/' + modul_id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#s_modul').serialize(),
                        success: function(res) {
                             console.log('my message' + res.data.is_active);
                            if (res.success == true) {
                                $('.modul_status').val(res.data.is_active);
                            }
                        }
                    });
                }
            </script>
            <?= $this->endSection(); ?>