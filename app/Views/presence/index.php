<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="get" action="">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="from-group">
                                            <div class="row">
                                                <div class="col-2" style="max-width: 50%!important">
                                                    <input type="date" name="date" class="form-control" value="<?= $date; ?>">
                                                </div>
                                                <div class="col-10" style="max-width: 50%!important">
                                                    <select name="class_id" class="form-control">
                                                        <option selected="" disabled="">Pilih Kelas</option>
                                                        <?php foreach ($class_group as $class): ?>
                                                            <option <?= ($class['id']==$class_id) ? 'selected' : '' ?>  value="<?= $class['id']; ?>"><?= $class['class_group_name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addTask">SET</button>
                                                    <?php  
                                                    if ($class_id && $date) { ?>
                                                        <a href="<?= base_url() ?>/data/absensi/maps?date=<?= $date; ?>&class_id=<?= $class_id; ?>" class=" btn btn-cyan btn-md btn-round"><i class="fa fa-map-marked-alt"> Maps</i></a>
                                                        <a href="<?= base_url() ?>/data/absensi/export_excel_rekap_absensi?date=<?= $date; ?>&class_id=<?= $class_id; ?>" class=" btn btn-success btn-md btn-round"><i class="fa fa-file-excel"></i></a>
                                                    <?php } ?>
                                                </div>
                                                <button type="button" class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v fa-fw"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="#">Print</a>
                                                    <a class="dropdown-item" href="#">Export</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="get" action="">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <?php if (in_groups('teacher')): ?>
                                                <select class="form-control2 form-select select2" name="rel">
                                                    <option></option>
                                                    <?php foreach ($rel as $row): ?>
                                                    <option <?= ($_GET['rel'] == $row['id'] ? 'selected' : '') ?> value="<?= $row['id']; ?>"><?= $row['subject_name']." - ".$row['class_group_name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            <?php endif ?>
                                            <?php if (in_groups('admin')): ?>
                                                    <select id="rel" name="rel" class="form-control form-select select2" >
                                                        <option></option>
                                                        <?php foreach ($rel as $row): ?>
                                                        <option <?= ($_GET['rel'] == $row['id'] ? 'selected' : '') ?> value="<?= $row['id']; ?>"><?= $row['subject_name']." - ".$row['class_group_name']." - ".$row['fullname'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select class="form-control form-select" name="month">
                                                <option></option>
                                                    <?php if (20211%2 == 0): ?>
                                                        <option <?= ($_GET['month'] == date('Y')."-01" ? 'selected' : '') ?> value="<?= date('Y'); ?>-01">Januari</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-02" ? 'selected' : '') ?> value="<?= date('Y'); ?>-02">Februari</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-03" ? 'selected' : '') ?> value="<?= date('Y'); ?>-03">Maret</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-04" ? 'selected' : '') ?> value="<?= date('Y'); ?>-04">April</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-05" ? 'selected' : '') ?> value="<?= date('Y'); ?>-05">Mei</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-06" ? 'selected' : '') ?> value="<?= date('Y'); ?>-06">Juni</option>
                                                    <?php else : ?>
                                                        <option <?= ($_GET['month'] == date('Y')."-07" ? 'selected' : '') ?> value="<?= date('Y'); ?>-07">Juli</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-08" ? 'selected' : '') ?> value="<?= date('Y'); ?>-08">Agustus</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-09" ? 'selected' : '') ?> value="<?= date('Y'); ?>-09">September</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-10" ? 'selected' : '') ?> value="<?= date('Y'); ?>-10">Oktober</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-11" ? 'selected' : '') ?> value="<?= date('Y'); ?>-11">November</option>
                                                        <option <?= ($_GET['month'] == date('Y')."-12" ? 'selected' : '') ?> value="<?= date('Y'); ?>-12">Desember</option>
                                                    <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Filter">
                                            <?php if ($_GET['submit'] == 'Filter'): ?>
                                                <a href="<?= base_url(); ?>/presence/export?rel=<?= $_GET['rel']; ?>&month=<?= $_GET['month']; ?>&submit=Filter" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Export</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-ressponsive">
                                <?php if (isset($_GET['rel']) && isset($_GET['month'])): ?>
                                    
                                <table class="table">
                                    <?php
                                        $db = db_connect();
                                    ?>
                                    <thead>
                                        <tr>
                                            <th >No</th>
                                            <th >Nama</th>
                                            <?php foreach ($th as $x): ?>
                                                <th><a class="text-dark" href="<?= base_url()."/journal/".$x['journal_id']; ?>" style="text-decoration: none;"><?= $x['teach_date'] ?></a></th>
                                            <?php endforeach ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($students as $student): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $student['fullname'] ?></td>
                                            <?php foreach ($th as $w): ?>
                                                    <?php  
                                                        $query2 = $db->query("SELECT `tbl_attendance`.`id` as `attendance_id`, `tbl_attendance`.`journal_id`, `tbl_attendance`.`present`, `tbl_attendance`.`description`, `users`.`fullname` FROM `tbl_attendance` LEFT JOIN `tbl_journal` ON `tbl_journal`.`id` = `tbl_attendance`.`journal_id` LEFT JOIN `users` ON `users`.`id` = `tbl_attendance`.`user_id` WHERE `tbl_attendance`.`journal_id` = '$w[journal_id]' AND `tbl_attendance`.`user_id` = '$student[id]'");
                                                        $result2 = $query2->getResultArray();
                                                    ?>
                                                    <?php foreach ($result2  as $y): ?>
                                                        <td class="<?= ($y['present'] == 'H' ? 'text-primary' : ($y['present'] == 'I' ? 'text-success' : ($y['present'] == 'S' ? 'text-warning' : ($y['present'] == 'A' ? 'text-danger' :'')))) ?>"><?= ($y['present'] == 'H' ? 'Hadir' : ($y['present'] == 'I' ? 'Izin' : ($y['present'] == 'S' ? 'Sakit' : ($y['present'] == 'A' ? 'Alpha' :'')))) ?></td>
                                                    <?php endforeach ?>
                                            <?php endforeach ?>
                                                </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <?php else :?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th >No</th>
                                            <th >Nama</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="3">No data</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endif ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?= $this->endSection(); ?>