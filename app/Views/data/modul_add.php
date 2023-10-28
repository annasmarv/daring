            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <form action="<?= base_url(); ?>/data/modul/create" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Tambah Materi</h4>
                                        <div class="ml-auto">
                                            <button type="submit" value="ubah" name="e_modul" class="btn btn-md btn-cyan btn-round">Simpan</button></a>
                                            <a href="<?= base_url(); ?>/data/modul"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mata Pelajaran</label>
                                                <select class="form-control form-select" id="Mata Pelajaran" name="subject" required>
                                                    <option selected="" disabled=""></option>
                                                    <?php foreach ($subjects as $subject): ?>
                                                        <option value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-1">
                                                <label>Kelas</label>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="kelas" name="kelas[]" required multiple="multiple">
                                                    <?php foreach ($classes as $class): ?>
                                                        <option value="+<?= $class['class_group_id']; ?>+"><?= $class['class_group_name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tema</label>
                                                <input type="text" class="form-control" id="tema" name="title" aria-describedby="tema" placeholder="Tema" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Youtube</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text btn-round">https://youtu.be/</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="yt" name="youtube" aria-describedby="tema" placeholder="Masukkan Kode Video Youtube">
                                                </div>
                                                <small id="name1" class="badge badge-default badge-info form-text text-white float-left">Contoh : https://youtu.be/4qPrgreMTTI</small><br>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Materi</label>
                                                <textarea class="editorz" rows="15" name="content"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="is_active" required>
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Nonaktif</option>
                                                </select>
                                            </div>
                                            <button type="submit" value="Simpan" name="s_modul" class="btn btn-md btn-round btn-cyan mt-2">Simpan</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>
