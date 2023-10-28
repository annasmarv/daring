            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Informasi Soal</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <a href="<?= base_url(); ?>/questbank"><button type="button" class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                                            </div>
                                        </div>
                                    </div>
                                <table>
                                    <?php foreach ($banks as $bank): ?>
                                        <tr>
                                            <td width="150">Guru</td><td width="30">:</td><td><?= $bank['fullname']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mata Pelajaran</td><td>:</td><td><?= $bank['subject_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kode Soal</td><td>:</td><td><?= $bank['quest_code']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Poin Total</td><td>:</td><td><?= $point; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Buat</td><td>:</td><td><?= $bank['created_at']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Update</td><td>:</td><td><?= $bank['updated_at']; ?></td>
                                        </tr>

                                        <!-- sample modal content -->
                                <div id="addSoal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Tambah Soal</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <form action="<?= base_url(); ?>/quest/add" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?= $bank['id']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label>Tipe Soal</label>
                                                            <select id="jensoal" class="form-control" name="type">
                                                                <option value="1">Pilihan Ganda</option>
                                                                <option value="2">Isian</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah Soal</label>
                                                            <input type="number" name="total" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Poin Default</label>
                                                            <input type="number" name="point" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary btn-round" name="addSoal">Simpan</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">                            
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Daftar Soal</h4>
                                    <div class="ml-auto">
                                        <div class="btn-group">
                                        <button class="btn btn-md btn-light btn-round" data-toggle="modal" data-target="#addSoal">Tambah</button>
                                        <a href="<?= base_url('questbank/pdf/'.$banks[0]['id']); ?>" target="_blank" class="btn btn-md btn-danger btn-round"><i class="fa fa-file-pdf">Unduh PDF</i></a>
                                        <button class="btn btn-md btn-light btn-round" data-toggle="modal" data-target="#copySoal"><i class="fa fa-clipboard"></i></button>
                                        <button class="btn btn-md btn-light btn-round" ><i class="fa fa-rocket"></i></button>
                                    </div>
                                    </div>
                                </div>
                            
                            <?php foreach ($quests as $quest): ?>
                                <table class="table table-bordered">
                                  <tr>
                                    <td align="center" valign="top"><strong><?= $quest['number']; ?>.</strong></td>
                                    <td colspan="2"><?= $quest['question']; ?></td>
                                    <td class="info"><strong><a href="<?= base_url(); ?>/quest/<?= $quest['quest_bank_id']; ?>?page_quest=<?= $quest['number']; ?>">Edit</a></strong></td>
                                  </tr>
                                  <tr>
                                    <td width="59" align="center" valign="top">&nbsp;</td>
                                    <td colspan="2" width="580" align="left" valign="top">&nbsp;</td>
                                    <td width="73"><strong><a class="text-danger" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#delSoal<?= $quest['qid']; ?>">Hapus</a></strong>

                                        <!-- Danger Alert Modal -->
                                        <div id="delSoal<?= $quest['qid']; ?>" class="modal fade" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-danger">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-wrong h1"></i>
                                                            <h4 class="mt-2"><b>Perhatian!</b></h4>
                                                            <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                                            <form action="<?= base_url(); ?>/quest/delete" method="post">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="id" value="<?= $quest['qid']; ?>">
                                                                <input type="hidden" name="code" value="<?= $quest['quest_bank_id']; ?>">
                                                                <button type="submit" name="delSoal" class="btn btn-light my-2">Iya</button>
                                                                <button type="button" class="btn btn-light my-2" data-dismiss="modal">Tidak</button>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                    </td>
                                  </tr>
                                  <?php 
                                    if ($quest['type'] == 1) { ?>
                                  <tr class="<?= $quest['quest_keys'] == 1 ? 'bgx-success' : ''; ?>">
                                    <td align="center"><i class="<?= $quest['quest_keys'] == 1 ? 'text-success fa fa-check' : ''; ?>"></i>&nbsp;</td>
                                    <td width="5">A. </td>
                                    <td><?= $quest['answer1']; ?></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="<?= $quest['quest_keys'] == 2 ? 'bgx-success' : ''; ?>">
                                    <td align="center"><i class="<?= $quest['quest_keys'] == 2 ? 'text-success fa fa-check' : ''; ?>"></i>&nbsp;</td>
                                    <td>B. </td>
                                    <td><?= $quest['answer2']; ?></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="<?= $quest['quest_keys'] == 3 ? 'bgx-success' : ''; ?>">
                                    <td align="center"><i class="<?= $quest['quest_keys'] == 3 ? 'text-success fa fa-check' : ''; ?>"></i>&nbsp;</td>
                                    <td>C. </td>
                                    <td><?= $quest['answer3']; ?></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="<?= $quest['quest_keys'] == 4 ? 'bgx-success' : ''; ?>">
                                    <td align="center"><i class="<?= $quest['quest_keys'] == 4 ? 'text-success fa fa-check' : ''; ?>"></i>&nbsp;</td>
                                    <td>D. </td>
                                    <td><?= $quest['answer4']; ?></td>
                                    <td>&nbsp;</td>
                                  </tr>

                                  <?php if ($quest['quest_option']==5) { ?>
                                  <tr class="<?= $quest['quest_keys'] == 5 ? 'bgx-success' : ''; ?>">
                                    <td align="center"><i class="<?= $quest['quest_keys'] == 5 ? 'text-success fa fa-check' : ''; ?>"></i>&nbsp;</td>
                                    <td>E. </td>
                                    <td><?= $quest['answer5']; ?></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <?php  } 
                                    }?>
                                  <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="2">
                                        <span class="ss">
                                            <strong>Poin Max. <?= $quest['point']; ?></strong> <br>
                                        </span>
                                    </td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  
                                  <tr>
                                    <td colspan="3" align="center"><hr></td>
                                  </tr>
                                </table>
                            <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="copySoal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Salin Soal Dari</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="<?= base_url(); ?>/questbank/copyQuestBank/<?= $bank['id']; ?>" method="post">
                        <?= csrf_field(); ?>
                            <input type="hidden" name="id" value="<?= $bank['id']; ?>">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Pilih Bank Soal</label>
                                        <select id="jensoal" class="form-control" name="quest_bank_id">
                                        <?php foreach ($lists as $list): ?> 
                                            <option value="<?= $list['bankid']; ?>"><?= $list['quest_code']; ?></option>
                                        <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-round" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-round" name="copySoal">Simpan</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?= $this->endSection(); ?>