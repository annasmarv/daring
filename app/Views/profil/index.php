            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
	            <div class="page-breadcrumb">
	                <div class="row">
	                    <div class="col-7 align-self-center">
	                        <div class="d-flex align-items-center">
	                            <nav aria-label="breadcrumb">
	                                <ol class="breadcrumb m-0 p-0">
	                                    <li class="breadcrumb-item text-muted active" aria-current="page">&nbsp;</li>
	                                </ol>
	                            </nav>
	                        </div>
	                    </div>
	                </div>
	              </div>

                <div class="row">
                    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                      <div class="card card-profile">
                        <div class="row">
                          <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                              <a href="#">
                                <img src="<?= base_url(); ?>/img/profile/<?= user()->user_img; ?>" class="rounded-circle" width="175" height="175">
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body center text-center">
                          <button type="button" class="btn waves-effect waves-light btn-outline-primary" data-toggle="modal" data-target="#picProfile">Ganti Foto</button>
                          <a href="<?= base_url(); ?>/profile/password" class="btn waves-effect waves-light btn-outline-danger" >Ganti Password</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-8 order-xl-1">
                      <form action="<?= base_url(); ?>/profile/save" method="post">
                        <input type="hidden" name="userid" value="<?= $user['user_id']; ?>">
                        <input type="hidden" name="profileid" value="<?= $user['profileid']; ?>">
                        <div class="card">
                          <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                              <div class="col-8">
                                <h3 class="mb-0">Profil</h3>
                              </div>
                              <div class="col-4 text-right">
                                <input type="submit" name="save" value="SIMPAN" class="btn btn-primary">
                              </div>
                            </div>
                          </div>
                          <div class="card-body">
                            <?= $validation->getError('user_img'); ?>
                            <h6 class="heading-small text-muted mb-4">Data Akun</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-username">Username</label>
                                    <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="" value="<?= $user['username'] ?>" name="username">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-email">E- Mail</label>
                                    <input type="text" id="input-email" class="form-control form-control-alternative" placeholder="" value="<?= $user['email'] ?>" name="email">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- identity -->
                            <h6 class="heading-small text-muted mb-4">Data Identitas Diri</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-username">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-alternative" placeholder="" value="<?= $user['fullname'] ?>" name="fullname">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-email">Nomer Induk Pengawai</label>
                                    <input type="text" class="form-control form-control-alternative" placeholder="" name="nip" value="<?= $user['nip'] ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-first-name">NIK</label>
                                    <input type="text" class="form-control form-control-alternative" placeholder="" value="<?= $user['nik'] ?>" name="nik">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group focused">
                                    <h4 class="form-control-label">Jenis Kelamin</h4>
                                    <div class="form-check form-check-inline pt-2">
                                      <input class="form-check-input" type="radio" name="gender" id="M" value="M" <?= ($user['gender'] == 'M') ? 'checked' : '' ?>>
                                      <label class="form-check-label" for="M">Laki - Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="gender" id="F" value="F" <?= ($user['gender'] == 'F') ? 'checked' : '' ?>>
                                      <label class="form-check-label" for="F">Perempuan</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-last-name">Tempat Lahir</label>
                                    <input type="text" class="form-control form-control-alternative" placeholder="" value="<?= $user['birth_place'] ?>" name="birth_place">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-last-name">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-alternative" placeholder="" value="<?= $user['birth_date'] ?>" name="birth_date">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-last-name">Agama</label>
                                    <select class="form-control" name="religion">
                                      <option value="islam" <?= ($user['religion'] == 'islam') ? 'selected' : '' ?> >Islam</option>
                                      <option value="kristen" <?= ($user['religion'] == 'kristen') ? 'selected' : '' ?> >Kristen/Protestan</option>
                                      <option value="katholik" <?= ($user['religion'] == 'katholik') ? 'selected' : '' ?> >Katholik</option>
                                      <option value="hindu" <?= ($user['religion'] == 'hindu') ? 'selected' : '' ?> >Hindu</option>
                                      <option value="budha" <?= ($user['religion'] == 'budha') ? 'selected' : '' ?> >Budha</option>
                                      <option value="konghucu" <?= ($user['religion'] == 'konghucu') ? 'selected' : '' ?> >Konghucu</option>
                                      <option value="lainnya" <?= ($user['religion'] == 'lainnya') ? 'selected' : '' ?> >Lainnya</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- Dapodik -->
                            <h6 class="heading-small text-muted mb-4">Akun Dapodik</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group focused">
                                    <label class="form-control-label">Email</label>
                                    <div class="input-group">
                                      <input id="dapouser" readonly class="form-control form-control-alternative" value="<?= $user['dapouser']; ?>" type="text">
                                      <div class="input-group-append">
                                        <button onclick="dapoUser()" class="btn btn-outline-secondary" type="button">Copy</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group focused">
                                    <label class="form-control-label" >Password</label>
                                    <div class="input-group">
                                      <input id="dapopass" readonly class="form-control form-control-alternative" value="<?= $user['dapopass']; ?>" type="password">
                                      <div class="input-group-append">
                                        <button onclick="showPassword()" class="btn btn-outline-secondary" type="button"><i class="fa fa-eye"></i></button>
                                        <button onclick="dapoPass()" class="btn btn-outline-secondary" type="button">Copy</button>
                                      </div>
                                    </div>
                                  </div>
                                <a target="_blank" href="https://ptk.datadik.kemdikbud.go.id/" class="btn btn-success">Buka PTK Datadik</a>
                                <a target="_blank" href="<?= $user['infogtkurl']; ?>" class="btn btn-cyan">Buka InfoGTK</a>
                                </div>

                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Informasi Kontak</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-address">Alamat</label>
                                    <input id="input-address" class="form-control form-control-alternative" placeholder="" value="" type="text">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Desa / Kelurahan</label>
                                    <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="" value="">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-country">Kecamatan</label>
                                    <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="" value="">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-country">Kabupaten / Kota</label>
                                    <input type="text" id="input-postal-code" class="form-control form-control-alternative" placeholder="">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Kode Pos</label>
                                    <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="" value="">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group focused">
                                    <label class="form-control-label" for="input-country">No. Telp</label>
                                    <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="" value="">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-country">No. HP</label>
                                    <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
            <!-- modal content -->
            <div id="picProfile" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-top">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="topModalLabel">Ubah Foto Profil</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <form method="post" action="<?= base_url(); ?>/profile/img" enctype="multipart/form-data">
                          <div class="modal-body">
                            <?= csrf_field() ?>
                              <img class="img-thumbnail img-preview" src="">
                              <div class="form-group">
                                <div class="custom-file mt-4">
                                  <input type="file" name="user_img"  class="custom-file-input" id="sampul" onchange="previewImg();">
                                  <div class="invalid-feedback">
                                  </div>
                                  <label class="custom-file-label" for="logo"></label>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-light"
                                  data-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script>
              function dapoUser() {
                var copyText = document.getElementById("dapouser");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(copyText.value)
                var tooltip = document.getElementById("myTooltip");
                tooltip.innerHTML = "Copied: " + copyText.value;
              }

              function dapoPass() {
                var copyText = document.getElementById("dapopass");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(copyText.value)
                var tooltip = document.getElementById("myTooltip");
                tooltip.innerHTML = "Copied: " + copyText.value;
              }

              function showPassword() {
                var x = document.getElementById("dapopass");
                if (x.type === "password") {
                  x.type = "text";
                } else {
                  x.type = "password";
                }
              }

            </script>
            <?= $this->endSection(); ?>