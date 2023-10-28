            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-header">
                                <h3>Ubah Tugas</h3>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url(); ?>/learn/interactive/update/" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= $detail->disid; ?>">
                                    <div class="form-group">
                                        <label>Tema</label>
                                        <input type="text" name="tema" class="form-control" required value="<?= $detail->title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control" id="MataPelajaran" name="subject" required>
                                            <option disabled=""></option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option <?= ($subject['subject_id'] == $detail->subject_id) ? 'selected' : '' ?> value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select class="form-control" name="class" required>
                                            <option disabled=""></option>
                                            <?php foreach ($classes as $class): ?>
                                                <option <?= ($class['class_group_id'] == $detail->class_group_id) ? 'selected' : '' ?> value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>                                                   
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tgl" value="<?= $detail->date; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <input type="time" class="form-control" name="start" value="<?= $detail->time_start; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Berakhir</label>
                                        <input type="time" class="form-control" name="finish" value="<?= $detail->time_start; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="acak" class="form-control" name="status" required>
                                            <option <?= ($detail->status == 0) ? 'selected' : '' ?> value="0">NONAKTIF</option>
                                            <option <?= ($detail->status == 1) ? 'selected' : '' ?> value="1">AKTIF</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Ubah" class="btn btn-cyan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>