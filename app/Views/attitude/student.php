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
                                            <!-- <a href="<?= base_url(); ?>/attitude" class="btn btn-md btn-cyan btn-round">Tambah</a> -->
                                            <a href="<?= base_url(); ?>/attitude"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10 col-md-8 col-6 p-0">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-secondary">
                                                <h1 class="font-light text-white"><?= $list[0]['fullname']; ?></h1>
                                                <h6 class="text-white"><?= $list[0]['class_group_name']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 p-0">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-<?= $sum<0 ? 'danger' : 'success'; ?> text-center">
                                                <h1 class="font-light text-white"><?= $sum ?></h1>
                                                <h6 class="text-white">Total Poin</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" style="width: 100%" class="table table-striped v-middle mb-0">
                                        <thead class="">
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted">Riwayat</th>
                                                <th class="border-0 font-weight-medium text-muted"></th>
                                                <th class="border-0 font-weight-medium text-muted" width="15">Poin</th>
                                                <th class="border-0 font-weight-medium text-muted" width="50">Petugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($list as $li): ?>
                                                <tr>
                                                    <td><?= explode(" ", $li['created_at'])[0] ?></td>
                                                    <td><?= $li['description'] ?></td>
                                                    <td class="text-<?= ($li['type'] == 0 ? 'danger' : ($li['type'] == 1 ? 'success' : '')); ?>">
                                                        <?= ($li['type'] == 0 ? '-' : ($li['type'] == 1 ? '+' : '')).$li['point'] ?>
                                                        
                                                    </td>
                                                    <td><?= $li['teacher_name'] ?></i></td>
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