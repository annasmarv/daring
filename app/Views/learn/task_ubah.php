            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= base_url(); ?>/learn/task/update" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Ubah Tugas <?= $detail->task_name; ?></h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button type="submit" class="btn btn-md btn-cyan btn-round">Simpan</button>
                                                <a href="<?= base_url(); ?>/learn/task"><button type="button" class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $detail->taskid; ?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label>Nama Tugas</label>
                                            <input type="text" name="task_name" class="form-control" value="<?= $detail->task_name; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Mata Pelajaran</label>
                                            <select class="form-control" id="MataPelajaran" name="subject" required>
                                                <option selected="" disabled=""></option>
                                                <?php foreach ($subjects as $subject): ?>
                                                    <option <?= ($subject['subject_id'] == $detail->subject_id) ? 'selected' : '' ?> value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>Kelas</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="class" required>
                                                <option selected="" disabled=""></option>
                                                <?php foreach ($classes as $class): ?>
                                                    <option <?= ($class['class_group_id'] == $detail->class_group_id) ? 'selected' : '' ?> value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Soal</label>
                                            <select class="form-control" id="quest_code" name="quest_bank_id" required>
                                                <option selected="" disabled=""></option>
                                                <?php foreach ($questbank as $bank): ?>
                                                    <option <?= ($bank['id'] == $detail->quest_bank_id) ? 'selected' : '' ?>  value="<?= $bank['id']; ?>"><?= $bank['quest_code']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Soal</label>
                                            <input type="text" class="form-control" name="quest_total" value="<?= $detail->quest_total; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Mulai</label>
                                            <input type="date" class="form-control" name="start" value="<?= $detail->task_date_start; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Berakhir</label>
                                            <input type="date" class="form-control" name="finish" value="<?= $detail->task_date_finish; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Acak Soal</label>
                                            <select id="acak" class="form-control" name="random" required>
                                                <option <?= ($detail->task_status == 0) ? 'selected' : '' ?> value="0">Tidak</option>
                                                <option <?= ($detail->task_status == 1) ? 'selected' : '' ?> value="1">Ya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label>Status</label>
                                            <select id="acak" class="form-control" name="status" required>
                                                <option <?= ($detail->task_status == 0) ? 'selected' : '' ?> value="0">NONAKTIF</option>
                                                <option <?= ($detail->task_status == 1) ? 'selected' : '' ?> value="1">AKTIF</option>
                                            </select>
                                            <input type="hidden" name="teacher_id" value="<?= user()->id;?>">
                                        </div>
                                        <div class="form-group">
                                        <input type="submit" name="submit" value="Simpan" class="btn btn-md btn-round btn-cyan">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>