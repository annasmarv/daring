            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                      <h4 class="mb-0 card-title">Pengumuman</h4>
                                    </div>
                                    <?php if (in_groups(['admin','teacher'])): ?>
                                        <div class="col-4 text-right">
                                          <a href = "#" data-toggle="modal" data-target="#addNews" class="btn btn-sm btn-primary btn-round"><i class="text-white fa fa-plus"></i></a>
                                        </div>
                                    <?php endif ?>
                                  </div>
                                </div>

                                <!--Content Scroll Modal -->
            <div class="modal fade" id="addNews" tabindex="-1" role="dialog"
                aria-labelledby="scrollableModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-full-width" role="document">
                    <div class="modal-content">
                        <form method="post" action="<?= base_url(); ?>/home/create">
                            <? csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollableModalTitle">Buat Pengumuman</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" class="form-control" name="title" placeholder="Judul" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pengumuman</label>
                                        <textarea class="editorz" name="news"></textarea>
                                    </div>
                                </div>
                                </div>
                            <div class="modal-footer">
                                <input type="submit" value="Kirim" name="addNews" class="btn btn-cyan btn-round">
                                <button type="button" class="btn btn-secondary btn-round"
                                    data-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

                            <div class="card-body">
                                <?php if (session()->getFlashdata('pesan')): ?>
                                    <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php endif ?>
                                <div class="mt-4 activity">
                                    <?php foreach ($news as $x): ?>
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                    <i data-feather="bell"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2"><?= $x['title']; ?> <?php if (($x['teacher_id'] == user()->id) || (in_groups('admin'))) {
                                                echo "&nbsp;<a href='javascript:void(0)' data-toggle='modal' data-target='#updateNews".$x['newsid']."'><i class='text-primary fa fa-pen'></i></a>
                                                        &nbsp;<a href='javascript:void(0)' data-toggle='modal' data-target='#deleteNews".$x['newsid']."'><i class='text-danger fa fa-trash'></i></a>";
                                            } ?></h5>
                                                <span class="font-weight-light font-14 text-muted"><b><?= $x['fullname']; ?></b></span><br>
                                                <span class="font-weight-light font-14 text-muted"><?= $x['created_at']; ?></span><br>
                                                <br>
                                                <p class="font-14 mb-2 text-muted"><?= $x['news']; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="updateNews<?= $x['newsid']; ?>" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-full-width" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="<?= base_url(); ?>/home/update">
                                                        <? csrf_field(); ?>
                                                        <input type="hidden" value="<?= $x['newsid']; ?>" name="id">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="scrollableModalTitle">Ubah Pengumuman</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Judul</label>
                                                                    <input type="text" class="form-control" name="title" placeholder="Judul" required value="<?= $x['title']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Pengumuman</label>
                                                                    <textarea id="class-news" class="editorz" name="news"><?= $x['news'] ?></textarea>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" value="Kirim" name="addNews" class="btn btn-cyan btn-round">
                                                            <button type="button" class="btn btn-secondary btn-round"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                        <div id="deleteNews<?= $x['newsid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-danger">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-wrong h1"></i>
                                                            <h4 class="mt-2"><b>Perhatian!</b></h4>
                                                            <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                                            <form action="<?= base_url(); ?>/home/delete" method="post">
                                                                <? csrf_field(); ?>
                                                                <input type="hidden" name="id"  value="<?= $x['newsid']; ?>" >
                                                                <button type="submit" name="delNews" value="del" class="btn btn-light btn-round my-2">Iya</button>
                                                                <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>
                                                            </form>
                                                                                    
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>