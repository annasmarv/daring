            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>
            <style type="text/css">
                .bb1{
                    border: 0;
                    border-bottom: 1px solid #01caf1;
                }
            </style>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <form action="<?= base_url('skp/saves/'.$uri->getSegment('3')); ?>" method="post" enctype="multipart/form-data">
                                
                                <?= csrf_field(); ?>
                                <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                <input type="hidden" name="type" value="<?= $_GET['type']; ?>">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title"></h4>
                                        <div class="ml-auto">
                                            <input class="btn btn-round btn-cyan" type="submit" name="a" value="Simpan">
                                            <a href="<?= base_url(); ?>/data/modul"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <?php if ($_GET['type'] == 1): ?>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3 col-sm-4">
                                                    <label class="form-label pt-1">Nama Kegiatan</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <select class="form-control form-select" name="skp_list_id" readonly>
                                                        <?php foreach ($lists as $list): ?>
                                                            <option <?= $list['id']==$_GET['kegiatan'] ? 'selected' : '' ?> value="<?= $list['id']; ?>"><?= $list['kegiatan']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pelaksanaan Kegiatan</label>
                                                <textarea class="editorz" rows="15" name="pelaksanaan"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Ketercapaian</label>
                                                <textarea class="editorz" rows="15" name="ketercapaian"></textarea>
                                            </div>
                                        <button type="submit" class="btn btn-round btn-cyan">Simpan</button>
                                        </div>
                                        <?php else: ?>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3 col-sm-4">
                                                    <label class="form-label pt-1">Nama Kegiatan</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <select class="form-control form-select" name="skp_list_id" readonly>
                                                        <option></option>
                                                        <?php foreach ($lists as $list): ?>
                                                            <option <?= $list['id']==$_GET['kegiatan'] ? 'selected' : '' ?> value="<?= $list['id']; ?>"><?= $list['kegiatan']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-lg-2 col-md-3 col-sm-4">
                                                    <label class="form-label pt-2">Laporan</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input required class="form-control-file" type="file" name="file_upload">
                                                    <a target="_blank" href="https://drive.google.com/drive/folders/1iPP7Ul8-trDBtRWtlubTcABrjciUksPf?usp=sharing"><small class="badge badge-default badge-success text-white">Format Laporan</small></a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>
