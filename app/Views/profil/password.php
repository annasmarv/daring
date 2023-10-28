            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-white">
                                <div class="row align-items-center">
                                <div class="col-8">
                                  <h3 class="mb-0">Ubah Password</h3>
                                </div>
                              </div>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('pesan')): ?>
                                  <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible border-0 fade show" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                      <?= session()->getFlashdata('pesan') ?>
                                  </div>
                                <?php endif ?>
                                <form method="post" action="<?= base_url(); ?>/profile/changepassword">
                                    <?= csrf_field() ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password Lama</label>
                                            <input class="form-control" required type="password" name="oldPass">
                                            <input type="hidden" name="user" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input class="form-control" required type="password" minlength="8" id="minval"
                                            aria-describedby="minval" name="newPass">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Konfirmasi Password Baru</label>
                                            <input class="form-control" required type="password" minlength="8" id="minval"
                                            aria-describedby="minval" name="confPass">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" value="Ubah" name="cPass" class="btn btn-cyan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>