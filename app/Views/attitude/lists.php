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
                                            <button class="btn btn-md btn-light btn-round dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Export
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">PDF</a>
                                                <a class="dropdown-item" href="#">Excel</a>
                                            </div>
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
                                                <th class="border-0 font-weight-medium text-muted" width="15">Poin</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($list as $li): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><a href="<?= base_url('attitude/student/'.$li['user_id']) ?>" class="text-secondary border-bottom pb-1 border-secondary"><?= $li['fullname']; ?></a></td>
                                                    <td><?= $li['class_group_name'] ?></td>
                                                    <td><strong class="<?= $li['total_poin']<0 ? 'text-danger' : 'text-success'; ?>"><?= $li['total_poin'] ?></strong></td>
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

            <?= $this->endSection(); ?>