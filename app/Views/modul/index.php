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
                                    <h4 class="card-title">Daftar Materi Belajar</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <a href="<?= base_url(); ?>/data/modul/add" class="btn btn-md btn-cyan btn-round">Tambah</a>
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
                                                <th class="border-0 font-weight-medium text-muted">Tema</th>
                                                <th class="border-0 font-weight-medium text-muted">Mata Pelajaran</th>
                                                <th style="" class="border-0 font-weight-medium text-muted"></i></th>
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
            <!-- Warning Alert Modal -->
            <div id="statusModul" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-warning">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Ubah Status!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan merubah data ini?</p>
                                <form id="s_modul" action="<?= base_url() ?>/data/modul/status" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" class="modul_id">
                                    <input type="hidden" name="status" class="modul_status">
                                    <button type="submit" name="upSttsModul" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="delModul" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <p class="mt-2"><?php //= $rows['title']; ?></p>
                                <form action="/data/modul/delete" method="post">
                                    <input class="modul" type="hidden" name="id" value="<?php //= $rows['id']; ?>">
                                    <button type="submit" name="delModul" class="btn btn-light btn-round my-2">Iya</button>
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
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?= base_url(); ?>/data/modul/get_modul/<?= null !== get_cookie('periodyear')?get_cookie('periodyear'):period()->id ?>'
                    },
                    columns: [
                        {data: 'modulid', nama: 'modulid'},
                        {data: 'title', nama: 'title'},
                        {data: 'sbjk', nama: 'sbjk'},
                        {data: 'is_active', className:'is_active'}
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
                                "targets" : 1,
                                "render" : function(data, type, row) {
                                    var btn = "<a class=\"text-secondary border-bottom pb-1 border-secondary\" href=\" <?= base_url();?>/data/modul/"+row.modulid+"\">"+row.title+"</a>";
                                    return btn;
                                }
                            },
                            {
                                "searchable" : true,
                                "targets" : 3,
                                "render" : function(data, type, row) {
                                    var btn2 = ""
                                    if (data == 1) { btn2 = "<a title=\"Nonaktifkan\" href=\"#\" class=\"btn btn-md btn-round btn-light modul-status\" onclick=\"status_record('"+row.modulid+"')\" data-status=\"0\"><i class=\"text-success fa fa-toggle-on\"></i></a>"
                                    }else{ btn2 = "<a title=\"Aktifkan\" href=\"#\" class=\"btn btn-md btn-round btn-light modul-status\" onclick=\"status_record('"+row.modulid+"')\" data-status=\"1\"><i class=\"text-danger fa fa-toggle-off\"></i></a>"
                                    }
                                    return `<div class="btn-group">
                                                        <a title="Lihat Data" class="btn btn-md btn-round btn-light" href="<?= base_url();?>/data/modul/`+row.modulid+`" >
                                                            <i class="fa fa-eye"></i>
                                                        </a>`
                                                        +btn2+
                                                        `<a title="Hapus Data" class="btn btn-md btn-round btn-light" href="#" onclick="delete_record(`+row.modulid+`)">
                                                            <i class="text-danger fa fa-trash"></i>
                                                        </a>
                                                    </div>`;
                                }
                            }
                        ]
                });
            </script>
            <script>
                function delete_record(modul_id) {
                    $('#delModul').modal('show');
                    $('.modul').val(modul_id);
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