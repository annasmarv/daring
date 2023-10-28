            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php foreach ($modul as $row): ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <form  action="<?= base_url(); ?>/data/modul/edit/<?= $row['id']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Ubah Materi <?= $row['title']; ?></h4>
                                        <div class="ml-auto">
                                            <button type="submit" value="ubah" name="e_modul" class="btn btn-md btn-cyan btn-round">Simpan</button></a>
                                            <a href="<?= base_url(); ?>/data/modul/<?= $row['id']; ?>"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <input type="hidden" name="modul_id" value="<?= $row['id']; ?>">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mata Pelajaran</label>
                                                <select class="form-control form-select" id="Mata Pelajaran" name="subject_id" required>
                                                    <option disabled="" selected=""></option>
                                                    <?php foreach ($subjects as $subject): ?>
                                                        <option <?= ($subject['subject_id'] == $row['subject_id'] ? 'selected' : '') ?> value="<?= $subject['subject_id']; ?>">
                                                            <?= $subject['subject_name']; ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-1">
                                                <label>Kelas</label>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="kelas" name="kelas[]" required multiple="multiple" class="btn-round">
                                            <?php $kelass = explode(',', str_replace('+', '', $row['class_group_id']));
                                                    foreach ($classes as $y) {  ?>
                                                        <option value="+<?= $y['id']; ?>+" 
                                                            <?php foreach ($kelass as $x) {
                                                                if ($y['id'] == $x){echo "selected"; }
                                                            } ?> >
                                                            <?= $y['class_group_name']; ?>
                                                        </option>
                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tema</label>
                                                <input type="text" class="form-control" id="tema" name="title" aria-describedby="tema" placeholder="Tema" value="<?= $row['title']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Youtube</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text btn-round">https://youtu.be/</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="yt" name="youtube" aria-describedby="tema" placeholder="Masukkan Kode Video Youtube" value="<?= $row['youtube']; ?>">
                                                </div>
                                                <small id="name1" class="badge badge-default badge-info form-text text-white float-left">Contoh : https://youtu.be/4qPrgreMTTI</small><br>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Materi</label>
                                                <textarea class="editorz" name="content" rows="20"><?= $row['content']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="is_active" required>
                                                    <option <?php if ($row['is_active']==1){echo "selected";} ?> value="1">Aktif</option>
                                                    <option <?php if ($row['is_active']==0){echo "selected";} ?> value="0">Nonaktif</option>
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
            <?php endforeach ?>
            <?= $this->endSection(); ?>