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
                                    <h4 class="card-title">Bank Soal</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addBankSoal">Tambah</button>
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
                                                <th class="border-0 font-weight-medium text-muted" width="1">#</th>
                                                <th class="border-0 font-weight-medium text-muted">Kode Soal</th>
                                                <th class="border-0 font-weight-medium text-muted">Mata Pelajaran</th>
                                                <th class="border-0 font-weight-medium text-muted" width="1"></th>
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
<!--  ------------------------------------------------------------------------------------------------------ -->
            <!-- sample modal content -->
            <div id="addBankSoal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Tambah Bank Soal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="<?= base_url(); ?>/questbank/create" method="post">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control" id="Mata Pelajaran" name="subject" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                            <?php endforeach ?>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Soal</label>
                                        <input type="text" class="form-control" name="code" placeholder="Kode Soal" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Opsi Pilihan Jawab</label>
                                        <select id="abc" class="form-control" name="option" required>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-round" name="addBankSoal">Simpan</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- sample modal content -->
            <div id="editBank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Ubah Bank Soal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form id="s_bank" action="<?= base_url(); ?>/questbank/update" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" class="bank_id">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control subject" id="Mata Pelajaran" name="subject" required>
                                            <option selected="" disabled=""></option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                            <?php endforeach ?>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Soal</label>
                                        <input type="text" class="form-control code" name="code" maxlength="20" placeholder="Kode Soal" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Opsi Pilihan Jawab</label>
                                        <select id="abc" class="form-control option" name="option" required>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-round" name="addBankSoal">Simpan</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="deleteBank" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <form action="<?= base_url(); ?>/questbank/delete" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" class="bank_id">
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
                        url: '<?= base_url(); ?>/questbank/get_quest_bank/<?= null !== get_cookie('periodyear')?get_cookie('periodyear'):period()->id ?>'
                    },
                    columns: [
                        {data: 'bankid', nama: 'bankid'},
                        {data: 'quest_code', nama: 'quest_code',
                            render: function (data, type, row) {
                                return "<a class=\"text-secondary border-bottom pb-1 border-secondary\" href=\"<?= base_url(); ?>/questbank/"+row.bankid+"\">"+row.quest_code+"</a>";
                            }
                        },
                        {data: 'sbjk', nama: 'sbjk'},
                        {data: 'bankid', nama: 'bankid'
                            // "orderable" : false,
                            // render: function(data, type, row) {
                            //     return "<div class=\"dropdown sub-dropdown\"><a class=\"btn-link dropdown-toggle\" type=\"button\" id=\"dd11\" data-toggle=\"dropdown\" data-id=\""+row.bankid+"\"><i class=\"fas fa-ellipsis-v\"></i></a><div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"dd11\"><a class=\"dropdown-item bank-edit\" onclick=\"show_record('"+row.bankid+"')\" href=\"#\">Edit</a><a href=\"#\" class=\"dropdown-item bank-delete\" onclick=\"delete_record('"+row.bankid+"')\">Hapus</a></div></div>";
                            // }
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
                                "targets" : 3,
                                "orderable": false,
                                "render" : function(data, type, row) {
                                    return `<div class="btn-group">
                                                        <a title="Lihat Data" class="btn btn-md btn-round btn-light" href="<?= base_url();?>/questbank/`+row.bankid+`" >
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a title="Ubah Data" class="btn btn-md btn-round btn-light bank-edit" href="#" onclick="show_record('`+row.bankid+`')">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <a title="Hapus Data" class="btn btn-md btn-round btn-light bank-delete" href="#" onclick="delete_record('`+row.bankid+`')">
                                                            <i class="text-danger fa fa-trash"></i>
                                                        </a>
                                                    </div>`;
                                }
                            }
                        ]
                });
            </script>
            <script>
                function delete_record(bank_id) {
                    status = 'delete';
                    $('#deleteBank').modal('show');
                    $('.bank_id').val(bank_id);
                }

                function show_record(bank_id) {
                    $('#editBank').modal('show');
                    $('.bank_id').val(bank_id);
                    $.ajax({
                        url: "<?php echo base_url('questbank/show'); ?>"+ '/' + bank_id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#s_bank').serialize(),
                        success: function(res) {
                            if (res.success == true) {
                                // console.log('my message' + res.data.quest_code);
                                $('.subject').val(res.data.subject_id);
                                $('.code').val(res.data.quest_code);
                                $('.option').val(res.data.quest_option);
                            }
                        }
                    });
                }
            </script>
            <?= $this->endSection(); ?>