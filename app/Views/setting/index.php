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
                        
                        <form action="<?= base_url('/setting/website/update') ?>" method="post" enctype="multipart/form-data">
                        	<?= csrf_field(); ?>
	                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Setting Aplikasi</h4>
                            <div class="ml-auto">
                              <div class="dropdown sub-dropdown">
                                <button type="submit" class="btn btn-md btn-cyan btn-round">Simpan</button>
                              </div>
                            </div>
                          </div>
	                        <div class="row">
				                    <div class="col-sm-12">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-heading fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='name' placeholder="Nama Website" value="<?= $setting['name']; ?>"> 
				                        </div>
				                        <div class="ml-5 p-0 my-0" id="error"></div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-globe fa-fw"></i></span>
				                          </div>
				                          <input type='url' class='form-control' name='url' placeholder="URL" value="<?= $setting['url']; ?>">
				                        </div>
				                        <div class="ml-5 p-0 my-0" id="error"></div>
				                      </div>
				                    </div>
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-envelope fa-fw"></i></span>
				                          </div>
				                          <input type='email' class='form-control' name='email' placeholder="Email" value="<?= $setting['email']; ?>">
				                        </div>
				                        <div class="ml-5 p-0 my-0" id="error"></div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-phone fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='phone' placeholder="No. Telepon" value="<?= $setting['phone']; ?>">
				                        </div>
				                        <div class="ml-5 p-0 my-0" id="error"></div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-12">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-map-marked-alt fa-fw"></i></span>
				                          </div>
				                          <input type="text" class='form-control' name='address' placeholder="Alamat" value="<?= $setting['address']; ?>">
				                        </div>
				                        <div class="ml-5 p-0 my-0" id="error"></div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-12">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-paragraph fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='meta_description' placeholder="Meta Deskripsi" value="<?= $setting['meta_description']; ?>"> 
				                        </div>
				                        <div class="ml-5 p-0 my-0" id="error"></div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-12">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-key fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='meta_keyword' placeholder="Meta Keyword" value="<?= $setting['meta_keyword']; ?>">
				                        </div>
				                        <div class="ml-5 p-0 my-0" id="error"></div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fab fa-facebook-square fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='facebook' placeholder="Facebook" value="<?= $setting['facebook']; ?>">
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fab fa-twitter fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='twitter' placeholder="Twitter" value="<?= $setting['twitter']; ?>">
				                        </div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fab fa-instagram fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='instagram' placeholder="Instagram" value="<?= $setting['instagram']; ?>">
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fab fa-youtube fa-fw"></i></span>
				                          </div>
				                          <input type='text' class='form-control' name='youtube' placeholder="Youtube" value="<?= $setting['youtube']; ?>">
				                        </div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-12">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-map fa-fw"></i></span>
				                          </div>
				                          <input type="text" class='form-control' name="maps" placeholder="Google Maps" value="<?= $setting['maps']; ?>">
				                        </div>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-icons fa-fw"></i></span>
				                          </div>
				                          <div class="custom-file">
				                            <input type="file" class="custom-file-input" id="file" name="favicon">
				                            <label class="custom-file-label" for="file" data-browse="Pilih">Favicon</label>
				                          </div>
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-sm-6" id="preview">
				                      <div class="d-flex align-items-center">
				                        <strong class="mr-3 ml-2">Favicon Sekarang</strong>
				                        <img id="img-url" src="<?= base_url(); ?>/assets/images/<?= $setting['favicon']; ?>" style="height: 30px">
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-icons fa-fw"></i></span>
				                          </div>
				                          <div class="custom-file">
				                            <input type="file" class="custom-file-input" id="logo" name="logo">
				                            <label class="custom-file-label" for="file" data-browse="Pilih">Logo</label>
				                          </div>
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-sm-6" id="preview">
				                      <div class="d-flex align-items-center">
				                        <strong class="mr-3 ml-2">Logo Sekarang</strong>
				                        <img id="imgurl" src="<?= base_url(); ?>/assets/images/<?= $setting['logo']; ?>" style="height: 30px">
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-icons fa-fw"></i></span>
				                          </div>
				                          <div class="custom-file">
				                            <input type="file" class="custom-file-input" id="logo" name="logo-text">
				                            <label class="custom-file-label" for="file" data-browse="Pilih">Logo Text</label>
				                          </div>
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-sm-6" id="preview">
				                      <div class="d-flex align-items-center">
				                        <strong class="mr-3 ml-2">Logo Text Sekarang</strong>
				                        <img id="imgurl" src="<?= base_url(); ?>/assets/images/<?= $setting['logo_text']; ?>" style="height: 30px">
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <div class="input-group">
				                          <div class="input-group-prepend">
				                            <span class="input-group-text"><i class="fas fa-icons fa-fw"></i></span>
				                          </div>
				                          <div class="custom-file">
				                            <input type="file" class="custom-file-input" id="logo" name="login-image">
				                            <label class="custom-file-label" for="file" data-browse="Pilih">Login Image</label>
				                          </div>
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-sm-6" id="preview">
				                      <div class="d-flex align-items-center">
				                        <strong class="mr-3 ml-2">Login Image Sekarang</strong>
				                        <img id="imgurl" src="<?= base_url(); ?>/assets/images/big/<?= $setting['login_image']; ?>" style="height: 30px">
				                      </div>
				                    </div>
				                  </div>
				                  <div class="row">
				                  	<div class="col-sm-12">
				                  		<div class="form-group">
				                  			<label class="form-label">Footer</label>
				                  			<textarea name="footer" class="editorz"><?= $setting['footer'] ?></textarea>
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