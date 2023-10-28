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
                                    <h4 class="card-title">Penilaian Sikap</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <a href="<?= base_url(); ?>/attitude" class="btn btn-md btn-cyan btn-round">Tambah</a>
                                            <a href="<?= base_url(); ?>/"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" style="width: 100%" class="table table-striped v-middle mb-0">
                                        <thead class="">
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="1">#</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Nama</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Kelas</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Uraian</th>
                                                <th class="border-0 font-weight-medium text-muted" width="15">Poin</th>
                                                <th class="border-0 font-weight-medium text-muted" width="50">Petugas</th>
                                                <th class="border-0 font-weight-medium text-muted" ></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($list as $li): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $li['fullname'] ?></td>
                                                    <td><?= $li['class_group_name'] ?></td>
                                                    <td><?= $li['description'] ?></td>
                                                    <td class="text-<?= ($li['type'] == 0 ? 'danger' : ($li['type'] == 1 ? 'success' : '')); ?>">
                                                        <?= ($li['type'] == 0 ? '-' : ($li['type'] == 1 ? '+' : '')).$li['point'] ?>
                                                        
                                                    </td>
                                                    <td><?= $li['teacher_name'] ?></i></td>
                                                    <td width="1"><a class="attdesc-delete text-danger" onclick="delete_record('<?= $li['id'] ?>')" href="#"><i class="fa fa-trash"></i></a></td>
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
            <div id="deleteModul" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <p class="mt-2"><?php //= $rows['title']; ?></p>
                                <form action="<?= base_url(); ?>/attitude/delete" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" class="attid">
                                    <button type="submit" name="delModul" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function delete_record(modul_id) {
                    $('#deleteModul').modal('show');
                    $('.attid').val(modul_id);
                }
            </script>
            <?= $this->endSection(); ?>