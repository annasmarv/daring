            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-header">
                                <h3>Ubah Data</h3>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url(); ?>/learn/meet/update/" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= $detail->meetid; ?>">
                                    <div class="form-group">
                                        <label>Topik</label>
                                        <input type="text" name="meet_name" class="form-control" required value="<?= $detail->meet_name; ?>">
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
                                        <label>Materi</label>
                                        <select class="form-control" name="modul">
                                            <option selected=""></option>
                                            <?php foreach ($modul as $materi): ?>
                                                <option <?= ($materi['mid'] == $detail->modul_id ? 'selected' : '') ?> value="<?= $materi['mid']; ?>"><?= $materi['title']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label>Tugas</label>
                                        <select class="form-control" name="task">
                                            <option selected=""></option>
                                            <?php foreach ($tasks as $task): ?>
                                                <option <?= ($task['id'] == $detail->task_id ? 'selected' : '') ?> value="<?= $task['id']; ?>"><?= $task['task_name']." - ".$task['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>  
                                    <div class="form-group">
                                        <label>Interaktif</label>
                                        <select class="form-control" name="inter" >
                                            <option selected=""></option>
                                            <?php foreach ($inters as $inter): ?>
                                                <option <?= ($inter['id'] == $detail->interaktif_id ? 'selected' : '') ?> value="<?= $inter['id']; ?>"><?= $inter['title']." - ".$inter['class_group_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
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