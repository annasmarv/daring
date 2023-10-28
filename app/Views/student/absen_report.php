<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title">Laporan Absensi</h4>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="customize-input float-right">
                                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                                <option selected="">Aug 19</option>
                                                <option value="1">July 19</option>
                                                <option value="2">Jun 19</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="5">#</th>
                                                <th>Tanggal</th>
                                                <th>Waktu Absen</th>
                                                <th>Nama</th>
                                                <th>Posisi</th>
                                                <th><span style="height: 10px;width: 10px;border-radius: 50%;display: inline-block;" class="bg-primary"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($report as $x) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $x['XDate'];?></td>
                                                <td><?= $x['XTime']; ?></td>
                                                <td><?= $x['fullname'];?></td>
                                                <td><?= $x['XLatitude'].','.$x['XLongitude'];?></td>
                                                <td><span style="height: 10px;width: 10px;border-radius: 50%;display: inline-block;" class="bg-success"></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endSection(); ?>