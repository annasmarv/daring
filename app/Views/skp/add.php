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
                            <form action="<?= base_url('skp/save/'.$uri->getSegment('3')) ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title"></h4>
                                        <div class="ml-auto">
                                            <button type="button" class="btn btn-md btn-primary btn-round" data-toggle="modal" data-target="#addKelas">Isi Target Kegiatan</button>
                                            <button type="button" class="btn btn-md btn-round btn-cyan" data-toggle="modal" data-target="#addKeg">Tambah</button>
                                            <a href="<?= base_url('skp/reload/'.$uri->getSegment(3)); ?>">
                                                <button type="button" class="btn btn-md btn-warning btn-round">Reload Data</button>
                                            </a>
                                            <input class="btn btn-round btn-success" type="submit" name="save" value="Simpan">
                                            <input class="btn btn-round btn-danger" type="submit" name="delete" value="Hapus">
                                            <a href="<?= base_url(); ?>/skp/print/<?= $uri->getSegment(3) ?>"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">print</i><span>Cetak</span></button></a>
                                            <a href="<?= base_url(); ?>/skp"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr class="text-center">
                                                    <td colspan="2" rowspan="2">NO</td>
                                                    <td rowspan="2">I. KEGIATAN TUGAS JABATAN</td>
                                                    <td colspan="2">TARGET</td>
                                                    <td colspan="3">REALISASI</td>
                                                    <td rowspan="2">NILAI CAPAIAN SKP</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="2">Kuant/Output</td>
                                                    <td colspan="2">Kuant/Output</td>
                                                    <td>Kual/Mutu</td>
                                                </tr>
                                              
                                                <?php $no=1; foreach ($skps as $skp): ?>    
                                                <tr>
                                                    <td><input type="checkbox" name="skpid[]" class="chkboxes" value="<?= $skp['id'] ?>"></td>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td><?php if ($skp['type'] == 0): ?>
                                                        <?= $skp['kegiatan']; ?>
                                                    <?php else: ?>
                                                        <a href="#" data-toggle="modal" data-target="#laporan<?= $skp['id']; ?>"><?= $skp['kegiatan']; ?></a>
                                                    <?php endif ?></td>
                                                    <td class="text-center"><?= $skp['target']; ?></td>
                                                    <td><?= $skp['output']; ?></td>
                                                    <td class="text-center"><?= $skp['realisasi']; ?></td>
                                                    <td><?= $skp['output']; ?></td>
                                                    <?php
                                                    if ($skp['target'] == 0 || $skp['realisasi'] == 0) {
                                                        $value = "min='0' max='0'";
                                                    }elseif ($skp['realisasi'] / $skp['target'] < 1) {
                                                        $value = "min='1' max='59'";
                                                    }elseif ($skp['realisasi'] / $skp['target'] >= 1){
                                                        $value = "min='60' max='100'";
                                                    }
                                                    ?>
                                                    <td data-toggle="tooltip" title="<?= $value ?>" class="px-0 text-center"><input class="text-center bb1" style="width:90px" <?= $value; ?> value="<?= $skp['mutu']; ?>" type="number" name="mutu[]"></td>
                                                    <td class="text-center"><?= number_format((float)$skp['nilai'], 2, '.', ''); ?></td>
                                                </tr>
                                                <input type="hidden" name="id[]" value="<?= $skp['id'] ?>">

                                                <div id="laporan<?= $skp['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Laporan Kegiatan</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true"><span class="material-symbols-rounded">close</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php if ($skp['type'] == 1): ?>
                                                                    <h4 class="card-title">Pelaksanaan Kegiatan</h4>
                                                                    <p class="card-text"><?= $skp['pelaksanaan'] ?></p>
                                                                    <h4 class="card-title mt-2">Ketercapaian</h4>
                                                                    <p class="card-text"><?= $skp['ketercapaian'] ?></p>
                                                                <?php else: ?>
                                                                    <?php $ext = substr(strrchr($skp['laporan'],'.'),1);?>
                                                                    <?php if ($ext == 'pdf'): ?>
                                                                        <embed type="application/pdf" src="<?= base_url().'/upload/skp/laporan/'.$skp['laporan']; ?>" width="100%" height="400"></embed>
                                                                    <?php else: ?>
                                                                        <a href="<?= base_url().'/upload/skp/laporan/'.$skp['laporan']; ?>">Lihat</a>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-round btn-light" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                                <?php endforeach ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================================================================================ -->
                                <div id="addKelas" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Buat Target</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"><span class="material-symbols-rounded">close</span></button>
                                            </div>
                                            <form action="<?= base_url(); ?>/skp/target" method="post">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <?php $no=1; foreach ($skps as $skp): ?>
                                                    <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                    <input type="hidden" name="id[]" value="<?= $skp['id'];?>">
                                                    <div class="col-md-8">
                                                        <label><?= $no++; ?>. <?= $skp['kegiatan']; ?></label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control" name="target[]" placeholder="Target" value="<?= $skp['target']; ?>" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text btn-round"><?= $skp['output']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-round btn-light"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-round btn-primary" name="addKelas">Simpan</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div id="addKeg" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Tambah Kegiatan</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"><span class="material-symbols-rounded">close</span></button>
                                            </div>
                                            <form action="<?= base_url(); ?>/skp/add/<?= $skp['skp_id']; ?>" method="get">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Kategori</label>
                                                    <select class="form-control" name="type" required id="sel_kat">
                                                        <option selected="" disabled=""></option>
                                                        <?php foreach ($skpparent as $row): ?>
                                                            <option value="<?= $row['id']; ?>"><?= $row['type']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kegiatan</label>
                                                    <select class="form-control" name="kegiatan" required id="sel_keg">
                                                        <option selected="" disabled=""></option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-round btn-light"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-round btn-primary" name="addKeg" value="yes">Tambah</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

            <script type='text/javascript'>
                var baseURL= "<?php echo base_url();?>";                
                $(document).ready(function(){
                    
                    $('#sel_kat').change(function(){
                        var type_id = $(this).val();
                
                        $.ajax({
                            url:'<?=base_url()?>/skp/get_skp_kegiatan',
                            method: 'post',
                            data: {type_id: type_id},
                            dataType: 'json',
                            success: function(response){
                                // Remove options 
                                $('#sel_keg').find('option').not(':first').remove();
                                // Add options
                                $.each(response,function(index,data){
                                    $('#sel_keg').append('<option value="'+data['id']+'">'+data['kegiatan']+'</option>');
                                });
                            },
                        });
                    });
                }) ;
            </script>
            <?= $this->endSection(); ?>
