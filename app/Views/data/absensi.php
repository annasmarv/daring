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
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped v-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0 font-weight-medium text-muted" width="1">#</th>
                                                <th class="border-0 font-weight-medium text-muted">Nama</th>
                                                <th class="border-0 font-weight-medium text-muted" width="75">Kelas</th>
                                                <th class="border-0 font-weight-medium text-muted" width="95">Waktu</th>
                                                <th class="border-0 font-weight-medium text-muted" width="10">Koordinat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($absens as $absen): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $absen['fullname']; ?></td>
                                                <td><?= $absen['class_group_name']; ?></td>
                                                <td><?= $absen['XTime'].'<br>'.$absen['XDate']; ?></td>
                                                <td><?= $absen['XLatitude'].','.$absen['XLongitude']; ?></td>
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