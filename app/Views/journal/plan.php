            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <form action="<?= base_url(); ?>/learn/plan/create/<?= $uri->getSegment(4) ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Rencana Pembelajaran</h4>
                                        <div class="ml-auto">
                                            <button type="submit" value="ubah" name="e_modul" class="btn btn-md btn-cyan btn-round">Simpan</button></a>
                                            <a href="<?= base_url(); ?>/learn/journal/plans/<?= $uri->getSegment(4) ?>"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mata Pelajaran</label>
                                                <select class="form-control" id="Mata Pelajaran" name="subject_id" required>
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
                                                <select class="form-control" id="kelas" name="class_group_id[]" required multiple="multiple">
                                                    <?php foreach ($classes as $class): ?>
                                                        <option value="+<?= $class['class_group_id']; ?>+"><?= $class['class_group_name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tema</label>
                                                <input type="text" class="form-control" id="tema" name="title" aria-describedby="tema" value="" placeholder="Tema" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Alokasi Waktu</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" id="alokasi_jp" name="alokasi" placeholder="Alokasi Waktu" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text btn-round">JP</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tujuan Pembelajaran</label>
                                                <textarea class="editorz" rows="15" name="goal"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kegiatan Pembelajaran</label>
                                                <textarea class="editorz" rows="15" name="activity"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Asesmen</label>
                                                <textarea class="editorz" rows="15" name="asesmen"></textarea>
                                            </div>
                                            <br>
                                            <button type="submit" value="Simpan" name="s_modul" class="btn btn-md btn-round btn-cyan">Simpan</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>
