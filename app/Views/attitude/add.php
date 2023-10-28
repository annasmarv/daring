            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <form action="<?= base_url(); ?>/attitude/create" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
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
                                            <?php if (has_permission('kesiswaan')): ?>
                                            <a href="<?= base_url(); ?>/attitude/lists" class="btn btn-md btn-cyan btn-round"><i class="fa fa-bars"></i></a>
                                            <?php endif ?>
                                            <a href="<?= base_url(); ?>/attitude/history" class="btn btn-md btn-cyan btn-round"><i class="fa fa-clock"></i></a>
                                            <a href="<?= base_url(); ?>/"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Pilih Siswa<span class="text-danger">*</span></label>
                                                <select required id="" class="select2 form-control form-select" name="user_id">
                                                        <option selected disabled>Pilih Siswa</option>
                                                    <?php foreach ($students as $student): ?>
                                                        <option value="<?= $student['id'] ?>"><?= $student['fullname'].' ('.$student['class_group_name'].')'; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Pilih Aspek<span class="text-danger">*</span> </label>
                                                <select required id="selAtt" class="form-control form-select select2" name="attdesc_id">
                                                        <option selected disabled>Pilih Aspek</option>
                                                    <?php foreach ($attitudes as $attitude): ?>
                                                        <option value="<?= $attitude['id']."|".($attitude['type'] == 0 ? '-' : ($attitude['type'] == 1 ? '+' : '')).$attitude['point'] ?>"><?= $attitude['description']; ?> (<?= ($attitude['type'] == 0 ? '-' : ($attitude['type'] == 1 ? '+' : '')).$attitude['point'] ?>)</option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Bukti dukung</label>
                                                <input type="file" name="files" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" value="Simpan" name="s_modul" class="btn btn-md btn-round btn-cyan mt-2">Simpan</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>
