<?= $this->extend('rapor/templates/index'); ?>
<?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                        	<div class="card-header">
	                            <div class="row align-items-center">
	                            	<div class="col-8">
	                                	<h4 class="mb-0 card-title">Catatan Akademik</h4>
	                            	</div>
	                            	<div class="col-4 text-right">
                                        <?php if ($_GET['rekapNilai']): ?>
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#catatanakademik"><i class="fa fa-upload"> Upload</i></button>
                                        <?php endif ?>
                                    </div>
	                            </div>
                            </div>
                            <div class="card-body">
                                <div class="from-group">
                                    <form method="get" action="#">
                                        <div class="row">
                                            <div class="col-3">
                                                <select class="form-control" name="kelas">
                                                    <option selected="" disabled=""></option>
                                                    <?php foreach ($classes as $class): ?>
                                                        <option <?= ($_GET['kelas'] == $class['class_group_id']) ? 'selected' : '' ?> value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                                    <?php endforeach ?>
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
                                    <form action="#" method="post">
                                        <table class="table wrap v-middle mb-0 table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="6" style="text-align: right;"><input type="submit" class="btn btn-cyan" name="editall" value="Simpan"></th>
                                                </tr>
                                                <tr>
                                                    <th style="vertical-align: middle;">#</th>
                                                    <th style="vertical-align: middle;">NIS</th>
                                                    <th style="vertical-align: middle;">Nama Siswa</th>
                                                    <th >Catatan Akademik</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php $no=1; foreach ($datas as $data): ?>
                                                  <tr>
                                                      <td><?= $no++ ?></td>
                                                      <td><?= $data['nis']; ?></td>
                                                      <td><?= $data['fullname']; ?></td>
                                                      <td><?= $data['deskripsi']; ?></td>
                                                  </tr>
                                              <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- sample SiswaNonAKtif content -->
            <div id="catatanakademik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Upload Nilai</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/rapor/importcatatan">
                            <div class="modal-body">
                                <div class="container">
                                    <input name="upload" type="file"><br /><br>
                                    <p>Format Upload download <a href="<?= base_url(); ?>/temp/rapor/catatan - <?= $_GET['kelas']; ?>.xlsx"><strong>Disini </strong></a></p>
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
<?= $this->endSection() ?>