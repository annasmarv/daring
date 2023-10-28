<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h4 class="text-dark mb-1 font-weight-medium">Kehadiran Siswa</h4>
                                    </div>
                                    <br>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <i class="fa fa-users"></i>
                                </div>
                                <br>
                            </div>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium"><?php foreach ($abc as $x) { echo $x['user_id']; } ?></h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Siswa</h6>

                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaAktif($now); ?></h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#SiswaAktif">Siswa Aktif Belajar</a></h6>

                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaNonAktif($now); ?></h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#SiswaNonAktif">Siswa Tidak Aktif</a></h6>
                                    <!--
                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium">0</h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Siswa Login</h6>-->

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h4 class="text-dark mb-1 font-weight-medium">Kehadiran Guru</h4>
                                    </div>
                                    <br>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <i class="fa fa-users"></i>
                                </div>
                                <br>
                            </div>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium"><?php foreach ($abc as $x) { echo $x['user_id']; } ?></h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Guru</h6>

                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium">14</h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Guru Aktif Mengajar</h6>

                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium">6</h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Guru Tidak Aktif Mengajar</h6>
                                    <!--
                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium">0</h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Guru Login</h6>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h4 class="text-dark mb-1 font-weight-medium">Absen GPS</h4>
                                    </div>
                                    <br>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <i class="fa fa-map-marker-alt"></i>
                                </div>
                                <br>
                            </div>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaGPSDate($now); ?></h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#AbsenGPS">Siswa Absen GPS</a></h6>

                                    <div class="d-inline-flex align-items-center">
                                        <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaNotGPSDate($now); ?></h5>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#NoAbsenGPS">Siswa Tidak Absen GPS</a></h6>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-group">
                <?php //foreach ($db->pilihKelas() as $d) { $idk = $d['Urut'];$kelas = $d['XKodeKelas']?>
                    <div class="rows">
                        <div class="card border-right">
                            <div class="card-body">
                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h4 class="text-dark mb-1 font-weight-medium">Kelas <?php //echo $d['XKodeKelas']; ?></h4>
                                        </div>
                                        <br>
                                    </div>
                                    <br>
                                </div>
                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaAktif2($now,$d['XKodeKelas']); ?></h5>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#SiswaAktif<?php //echo $idk ?>">Siswa Aktif Belajar</a></h6>

                                        <div class="d-inline-flex align-items-center">
                                            <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaNonAktif2($now,$d['XKodeKelas']); ?></h5>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#SiswaNonAktif<?php //echo $idk ?>">Siswa Tidak Aktif</a></h6>

                                        <div class="d-inline-flex align-items-center">
                                            <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaGPSDate2($now,$d['XKodeKelas']); ?></h5>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#AbsenGPS<?php //echo $idk ?>">Siswa Absen GPS</a></h6>

                                        <div class="d-inline-flex align-items-center">
                                            <h5 class="text-dark mb-1 font-weight-medium"><?php //echo $db->totalSiswaNotGPSDate2($now,$d['XKodeKelas']); ?></h5>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="" data-toggle="modal" data-target="#NoAbsenGPS<?php //echo $idk ?>">Siswa Tidak Absen GPS</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Siswa Aktif modal content -->
                    <div id="SiswaAktif<?php //echo $idk;?>" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Total Siswa Aktif [<?php //echo $db->totalSiswaAktif2($now,$kelas); ?>]</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <?php //
                                            $no =1;
                                            // foreach ($db->SiswaAktif2($now,$kelas) as $data) { ?>
                                            <tr>
                                                <td><?php //echo $no++ ?></td>
                                                <td><?php //echo $data[0]."<br>";
                                                    // $db->namaSiswa($data[0]);?></td>
                                                <td><?php //if (isset($data[2])) {
                                                    // echo "KI |";
                                                    // } if (isset($data[3])) {
                                                    //     echo "MT |";
                                                    // } if (isset($data[4])) {
                                                    //     echo "BM |";
                                                    // }?></td>
                                                <td><?php //echo $data[1]; ?></td>
                                            </tr>
                                            <?php //} ?>
                                        </table>
                                    </div>
                                    <div>
                                        * Keterangan <br>
                                        1. KI = Kelas Interaktif <br>
                                        2. MT = Mengerjakan Tugas <br>
                                        3. BM = Baca Modul <br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!-- sample SiswaNonAKtif content -->
                    <div id="SiswaNonAktif<?php //echo $idk;?>" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Total Tidak Siswa Aktif [<?php //echo $db->totalSiswaNonAktif2($now,$kelas); ?>]</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <?php //
                                            // $no =1;
                                            // foreach ($db->SiswaNonAktif2($now,$kelas) as $data) { ?>
                                            <tr>
                                                <td><?php //echo $no++ ?></td>
                                                <td><?php //echo $data[0]."<br>";
                                                    // $db->namaSiswa($data[0]);?></td>
                                                <td><?php //echo $data[1]; ?></td>
                                            </tr>
                                            <?php //} ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!-- sample AbsenGPS content -->
                    <div id="AbsenGPS<?php //echo $idk;?>" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Total Siswa Absen [<?php //echo $db->totalSiswaGPSDate2($now,$kelas); ?>]</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <?php //
                                            // $no =1;
                                            // foreach ($db->SiswaGPSDate2($now,$kelas) as $data) { ?>
                                            <tr>
                                                <td><?php //echo $no++ ?></td>
                                                <td><?php //echo $data[0]."<br>";
                                                    // $db->namaSiswa($data[0]);?></td>
                                                <td><?php //echo $data[3].",".$data[4]; ?></td>
                                                <td><?php //echo $data[5]." ".$data[6]; ?></td>
                                                <td><?php //echo $data[1]; ?></td>
                                            </tr>
                                            <?php //} ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!-- sample NoAbsenGPS content -->
                    <div id="NoAbsenGPS<?php //echo $idk;?>" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Total Siswa Tidak Absen [<?php //echo $db->totalSiswaNotGPSDate2($now,$kelas); ?>]</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <?php //
                                            // $no =1;
                                            // foreach ($db->SiswaNotGPSDate2($now,$kelas) as $data) { ?>
                                            <tr>
                                                <td><?php //echo $no++ ?></td>
                                                <td><?php //echo $data[0]."<br>";
                                                    // $db->namaSiswa($data[0]);?></td>
                                                <td><?php //echo $data[1]; ?></td>
                                            </tr>
                                            <?php //} ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                <?php //} ?>
                </div>

            <!-- Siswa Aktif modal content -->
            <div id="SiswaAktif" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Total Siswa Aktif [<?php //echo $db->totalSiswaAktif($now); ?>]</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php //
                                    // $no =1;
                                    // foreach ($db->SiswaAktif($now) as $data) { ?>
                                    <tr>
                                        <td><?php //echo $no++ ?></td>
                                        <td><?php //echo $data[0]."<br>";
                                            // $db->namaSiswa($data[0]);?></td>
                                        <td><?php //if (isset($data[2])) {
                                            // echo "KI |";
                                            // } if (isset($data[3])) {
                                            //     echo "MT |";
                                            // } if (isset($data[4])) {
                                            //     echo "BM |";
                                            // }?></td>
                                        <td><?php //echo $data[1]; ?></td>
                                    </tr>
                                    <?php //} ?>
                                </table>
                            </div>
                            <div>
                                * Keterangan <br>
                                1. KI = Kelas Interaktif <br>
                                2. MT = Mengerjakan Tugas <br>
                                3. BM = Baca Modul <br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- sample SiswaNonAKtif content -->
            <div id="SiswaNonAktif" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Total Tidak Siswa Aktif [<?php //echo $db->totalSiswaNonAktif($now); ?>]</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php //
                                    // $no =1;
                                    // foreach ($db->SiswaNonAktif($now) as $data) { ?>
                                    <tr>
                                        <td><?php //echo $no++ ?></td>
                                        <td><?php //echo $data[0]."<br>";
                                            // $db->namaSiswa($data[0]);?></td>
                                        <td><?php //echo $data[1]; ?></td>
                                    </tr>
                                    <?php //} ?>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- sample AbsenGPS content -->
            <div id="AbsenGPS" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Total Siswa Absen [<?php //echo $db->totalSiswaGPSDate($now); ?>]</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php //
                                    // $no =1;
                                    // foreach ($db->SiswaGPSDate($now) as $data) { ?>
                                    <tr>
                                        <td><?php //echo $no++ ?></td>
                                        <td><?php //echo $data[0]."<br>";
                                            // $db->namaSiswa($data[0]);?></td>
                                        <td><?php //echo $data[3].",".$data[4]; ?></td>
                                        <td><?php //echo $data[5]." ".$data[6]; ?></td>
                                        <td><?php //echo $data[1]; ?></td>
                                    </tr>
                                    <?php //} ?>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- sample NoAbsenGPS content -->
            <div id="NoAbsenGPS" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Total Siswa Tidak Absen [<?php //echo $db->totalSiswaNotGPSDate($now); ?>]</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php //
                                    //$no =1;
                                    //foreach ($db->SiswaNotGPSDate($now) as $data) { ?>
                                    <tr>
                                        <td><?php //echo $no++ ?></td>
                                        <td><?php //echo $data[0]."<br>";
                                            //$db->namaSiswa($data[0]);?></td>
                                        <td><?php //echo $data[1]; ?></td>
                                    </tr>
                                    <?php //} ?>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?= $this->endSection(); ?>