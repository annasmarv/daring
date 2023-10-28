            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            
            <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')): ?>
                          <div class="alert alert-success alert-dismissible border-0 fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                              <strong>Success - </strong> <?= session()->getFlashdata('pesan') ?>
                          </div>
                        <?php endif ?>
                        <form action="/data/school/update/<?= $sekolah['id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-8">
                            <h4 class="card-title">Edit Biodata Sekolah</h4>
                          </div>
                          <div class="col-4 text-right">
                            <input type="submit" class="btn btn-cyan btn-round" name="uBioSek" value="SIMPAN">
                          </div>
                        </div>
                        <hr class="my-3">

                          <div class="row">
                            <div class="col-lg-6 col-sm-12">
                              <div class="form-group">
                                <label class="form-control-label">Nama Sekolah</label>
                                <input type="text" name="nsekolah" class="form-control" value="<?= $sekolah['nama_sekolah']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">NPSN</label>
                                <input type="text" name="npsn" class="form-control" value="<?= $sekolah['npsn']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Alamat</label>
                                <textarea name="alamats" class="form-control" required=""><?= $sekolah['alamat']; ?></textarea>
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Kecamatan</label>
                                <input type="text" name="kecs" class="form-control" value="<?= $sekolah['kecamatan']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Kabupaten</label>
                                <input type="text" name="kabs" class="form-control" value="<?= $sekolah['kabupaten']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Provinsi</label>
                                <input type="text" name="provs" class="form-control" value="<?= $sekolah['provinsi']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Kode Pos</label>
                                <input type="text" name="kpos" class="form-control" value="<?= $sekolah['kodepos']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Kepala Sekolah</label>
                                <input type="text" name="kepsek" class="form-control" value="<?= $sekolah['nama_kepsek']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">NIP</label>
                                <input type="text" name="nipksek" class="form-control" value="<?= $sekolah['nip_kepsek']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Pengawas Sekolah</label>
                                <input type="text" name="pengawassek" class="form-control" value="<?= $sekolah['nama_pengawas']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">NIP</label>
                                <input type="text" name="nippsek" class="form-control" value="<?= $sekolah['nip_pengawas']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Telp. Sekolah</label>
                                <input type="text" name="telp" class="form-control" value="<?= $sekolah['telp']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Fax Sekolah</label>
                                <input type="text" name="fax" class="form-control" value="<?= $sekolah['fax']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Website</label>
                                <input type="text" name="web" class="form-control" value="<?= $sekolah['web']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">E-Mail</label>
                                <input type="text" name="email" class="form-control" value="<?= $sekolah['email']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">No HP Kepala Sekolah</label>
                                <input type="text" name="nohp" class="form-control" value="<?= $sekolah['kontak_kepsek']; ?>" required="">
                              </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <div class="form-group">
                                <img class="img-thumbnail img-preview" src="/img/<?= $sekolah['logo']; ?>">
                                <div class="custom-file mt-4">
                                  <input type="file" name="logo"  class="custom-file-input" id="sampul" onchange="previewImg();">
                                  <div class="invalid-feedback">
                                  </div>
                                  <label class="custom-file-label" for="logo"><?= $sekolah['logo']; ?></label>
                                  <input type="hidden" name="logo_lama" value="<?= $sekolah['logo']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>                                                        
                          <hr class="my-4">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <?= $this->endSection(); ?>