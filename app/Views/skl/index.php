<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                        	<div class="card-header">
	                            <div class="row align-items-center">
	                            	<div class="col-8">
	                                	<h4 class="mb-0 card-title">Nilai SKL</h4>
	                            	</div>
	                            	<div class="col-4 text-right">
                                		<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#nilaiSikap"><i class="fa fa-upload"> Upload</i></button>

                                        <!-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusall"><i class="fa fa-trash"></i>&nbsp; Hapus Semua</button>-->

	                            	</div>
	                            </div>
                            </div>
                            <div class="card-body">
                                <div class="from-group">
                                    <form method="post" action="action/crud.php">
                                        <div class="row">
                                            <div class="col-3">
                                                <select class="form-control" name="kelas">
                                                    <option disabled="">-- Pilih Kelas --</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="submit" name="rekapNilai" class="btn btn-md btn-cyan" value="SET">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form action="action/crud.php" method="post">
                                        <table class="table wrap v-middle mb-0 table-striped">
                                            <thead><!-- 
                                                <tr>
                                                    <th colspan="">aa</th>
                                                    <th colspan="" style="text-align: right;"><input type="submit" class="btn btn-cyan" name="editpnkall" value="Simpan"></th>
                                                </tr> -->
                                                <tr >
                                                    <th style="vertical-align: middle;">#</th>
                                                    <th style="vertical-align: middle;">NIS</th>
                                                    <th style="vertical-align: middle;">Nama Siswa</th>
                                                    <th style="vertical-align: middle;">Nama Siswa</th>
                                                </tr>
                                                <?php $no = 1; foreach ($data as $skl): ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $skl['fullname']; ?></td>
                                                        <td><?= $skl['pabp']; ?></td>
                                                    </tr>

                                                <?php endforeach ?>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr >
                                                    <th style="vertical-align: middle;">#</th>
                                                    <th style="vertical-align: middle;">NIS</th>
                                                    <th style="vertical-align: middle;">Nama Siswa</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    <!-- sample SiswaNonAKtif content -->
            <div id="nilaiSikap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Upload Nilai</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/import/skl">
                            <div class="modal-body">
                                <div class="container">
                                <input name="upload" type="file"><br /><br>
                                <p>Format Upload download <a href="temp/temp_nilai.xls"><strong>Disini </strong></a></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="nilaipnk" class="btn btn-primary" value="Upload">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- Danger Alert Modal -->
            <div id="hapusall" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Hapus Data</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan <b>Menghapus</b> data ini?</p>
                                <form action="action/crud.php" method="post">
                                    <input type="hidden" name="kelas" value="">
                                    <input type="hidden" name="kelas" value="">
                                    <button type="submit" name="hapuspnkall" class="btn btn-light my-2">Iya</button>
                                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Tidak</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
<?= $this->endSection(); ?>