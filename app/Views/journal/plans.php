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
                                            <span aria-hidden="true"><span class="material-symbols-rounded">close</span></span>
                                        </button>
                                    <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php endif ?>
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Rencana Pembelajaran</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <a href="<?= base_url('learn/journal/plan/'.$uri->getSegment(4)) ?>" class="btn btn-md btn-cyan btn-round">Tambah</a>
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
                                                <th class="border-0 font-weight-medium text-muted">Tema</th>
                                                <th class="border-0 font-weight-medium text-muted" width="200">Mata Pelajaran</th>
                                                <th class="border-0 font-weight-medium text-muted" width=""></th>
                                                <th class="border-0 font-weight-medium text-muted" width="65"></th>
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
            <div id="deleteTask" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <form action="<?= base_url(); ?>/learn/plan/delete" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="plan_id" class="plan_id">
                                    <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
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
                        url: '<?= base_url(); ?>/learn/plan/get_learn_plan/<?= $uri->getSegment(4) ?>'
                    },
                    order: [[0,"desc"]],
                    columns: [
                        {data: 'pid', nama: 'pid'},
                        {data: 'title', nama: 'title',
                            render: function (data, type, row) {
                                return "<a href=\"<?= base_url(); ?>/learn/plan/index/"+row.pid+"\" class=\"text-secondary border-bottom pb-1 border-secondary\">"+row.title+"</a>";
                            }
                        },
                        {data: 'sbjk', nama: 'sbjk'},
                        {data: 'percent', nama: 'percent'},
                        {data: 'pid', nama: 'pid'},
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
                                "targets" : 3,
                                "render" : function(data, type, row) {
                                    if (data > 50) { var btn = "success"
                                    }else if (data > 0) {
                                        var btn = "warning"
                                    }else{
                                        var btn = "danger"
                                    }
                                    return `<div class="popover-icon text-center">
                                                <a class="btn btn-`+btn+` btn-round btn-md font-12" href="javascript:void(0)">`+data+`%</a>
                                            </div>`;
                                }
                            },
                            {
                                "searchable" : false,
                                "targets" : 4,
                                "render" : function(data, type, row) {
                                    return `<div class="btn-group text-center">
                                                        <a target="_blank" class="btn btn-md btn-round btn-light" href="<?= base_url();?>/learn/plan/pdf/`+row.pid+`" >
                                                            <i class="material-symbols-rounded">print</i>
                                                        </a>
                                                        <a title="Hapus Data" class="btn btn-md btn-round btn-light" href="#" onclick="delete_record('`+row.pid+`')">
                                                            <i class="text-danger material-symbols-rounded">delete</i>
                                                        </a>
                                                    </div>`;
                                }
                            }
                        ]
                });
            </script>
            <script>
                function delete_record(pid) {
                    status = 'delete';
                    $('#deleteTask').modal('show');
                    $('.plan_id').val(pid);
                }
            </script>
            <script>
                $("#quest_code").change(function(){
                    
                    var soal = $("#quest_code").val();
                    
                    $("#imgLoad").show("");       
                    // mengirim dan mengambil data
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: <?= base_url(); ?>"/quest/count_soal",
                        data: "soal="+soal,
                        success: function(msg){     
                            
                            if(msg == ''){
                                alert('Tidak ada data Kota');
                            }   
                            
                            else{
                                $("#jumsoal1").html(msg);                                                     
                            }   
                        
                            $("#imgLoad").hide();
                        }
                    });            
                });
                </script>

            <?= $this->endSection(); ?>