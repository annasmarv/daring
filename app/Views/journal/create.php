            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>

            <style type="text/css">
                [type=radio] { 
                  position: absolute;
                  opacity: 0;
                  width: 0;
                  height: 0;
                }

                /* IMAGE STYLES */
                [type=radio] + img {
                  cursor: pointer;
                  border-radius: 100%;
                  width: 28px;
                }

                /* CHECKED STYLES */
                [type=radio]:checked + img {
                  background-color: #01caf1;
                }
            </style>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <form action="<?= base_url(); ?>/data/modul/create" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title mb-3">Jurnal Mengajar</h4>
                                        <div class="ml-auto">
                                            <a href="<?= base_url('learn/journal/pdf/'.$jurnal['id']) ?>">
                                            <button type="button" class="btn btn-md btn-cyan btn-round">Print</button></a>
                                            <a href="<?= base_url(); ?>/learn/journal"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs nav-bordered mb-3">
                                        <li class="nav-item">
                                            <a href="#presence" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                                <span class="d-lg-block">Daftar Hadir</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#review" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                                <span class="d-lg-block">Review</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#feedback" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                                <span class="d-lg-block">Feedback</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="presence">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Siswa</th>
                                                            <th style="width:60px"><img src="<?= base_url('/assets/images/H.png') ?>"></th>
                                                            <th style="width:60px"><img src="<?= base_url('/assets/images/T.png') ?>"></th>
                                                            <th style="width:60px"><img src="<?= base_url('/assets/images/I.png') ?>"></th>
                                                            <th style="width:60px"><img src="<?= base_url('/assets/images/S.png') ?>"></th>
                                                            <th style="width:60px"><img src="<?= base_url('/assets/images/A.png') ?>"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <form method="post" action="<?= base_url(); ?>/attendance/save">
                                                            <?php $i=1; foreach ($students as $row): ?> 
                                                                <tr>
                                                                    <input type="hidden" name="id[]" value="">
                                                                    <td><?= $row['fullname']; ?></td>
                                                                    <td class="text-center px-0">
                                                                        <div class="form-check pl-0">
                                                                            <label>
                                                                                <input class="form-check-input" <?= ($row['present'] == 'H' ? 'checked' : ''); ?> type="radio" name="present<?=$i?>[]" data-id="<?= $row['attendance_id'] ?>" value="H">
                                                                                <img src="<?= base_url('/assets/images/H.png') ?>">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center px-0">
                                                                        <div class="form-check pl-0">
                                                                            <label>
                                                                                <input class="form-check-input" <?= ($row['present'] == 'T' ? 'checked' : ''); ?> type="radio" name="present<?=$i?>[]" data-id="<?= $row['attendance_id'] ?>" value="T">
                                                                                <img src="<?= base_url('/assets/images/T.png') ?>">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center px-0">
                                                                        <div class="form-check pl-0">
                                                                            <label>
                                                                                <input class="form-check-input" <?= ($row['present'] == 'I' ? 'checked' : ''); ?> type="radio" name="present<?=$i?>[]" data-id="<?= $row['attendance_id'] ?>" value="I">
                                                                                <img src="<?= base_url('/assets/images/I.png') ?>">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center px-0">
                                                                        <div class="form-check pl-0">
                                                                            <label>
                                                                                <input class="form-check-input" <?= ($row['present'] == 'S' ? 'checked' : ''); ?> type="radio" name="present<?=$i?>[]" data-id="<?= $row['attendance_id'] ?>" value="S">
                                                                                <img src="<?= base_url('/assets/images/S.png') ?>">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center px-0">
                                                                        <div class="form-check pl-0">
                                                                            <label>
                                                                                <input class="form-check-input" <?= ($row['present'] == 'A' ? 'checked' : ''); ?> type="radio" name="present<?=$i?>[]" data-id="<?= $row['attendance_id'] ?>" value="A">
                                                                                <img src="<?= base_url('/assets/images/A.png') ?>">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php  $i++; endforeach ?>
                                                        </form>
                                                    </tbody>                                        
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="review">
                                            <form action="<?= base_url(); ?>/learn/journal/update/<?= $jurnal['id']; ?>" method="post">
                                            <?= csrf_field(); ?>
                                                <div class="form-body">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Catatan Proses Pembelajaran</label>
                                                            <textarea class="editorz" rows="15" name="note"><?= $jurnal['note'] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Refleksi Pembelajaran</label>
                                                            <textarea class="editorz" rows="15" name="reflection"><?= $jurnal['reflection'] ?></textarea>
                                                        </div>
                                                        <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                        <input type="submit" class="btn btn-round btn-cyan" name="jurnal" value="SIMPAN">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="feedback">
                                            <div class="col-lg-12  col-xl-12">
                                                <div class="chat-box scrollable position-relative ps-container ps-theme-default ps-active-y" style="height: calc(80vh - 110px);" data-ps-id="f6c427ad-08a6-2900-8257-465abed1166e">
                                                    <ul class="chat-list list-style-none px-3 pt-3">
                                                        <?php foreach ($feedback as $x): ?>
                                                        <?php if ($x['sender_id'] !== user()->id): ?>
                                                        <li class="chat-item list-style-none mt-3">
                                                            <div class="chat-img d-inline-block"><img src="<?= base_url('img/profile/'.$x['user_img']) ?>" alt="user" class="rounded-circle" width="45">
                                                            </div>
                                                            <div class="chat-content d-inline-block pl-3">
                                                                <h6 class="font-weight-medium"><?= $x['fullname']; ?></h6>
                                                                <div class="msg p-2 d-inline-block mb-1"><?= $x['sender_chat']; ?></div>
                                                            </div>
                                                            <div class="chat-time d-block font-10 mt-1 mr-0 mb-3"><?= $x['created_at']; ?>
                                                            </div>
                                                        </li>
                                                        <?php endif ?>
                                                        <?php if ($x['sender_id'] == user()->id): ?>
                                                        <li class="chat-item odd list-style-none mt-3">
                                                            <div class="chat-content text-right d-inline-block pl-3">
                                                                <div class="box msg p-2 d-inline-block mb-1"><?= $x['sender_chat']; ?></div>
                                                                <br>
                                                            </div>
                                                        </li>
                                                        <?php endif ?>
                                                        <?php endforeach ?>
                                                    </ul>
                                                    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -293px;">
                                                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps-scrollbar-y-rail" style="top: 293px; right: 3px; height: 307px;">
                                                        <div class="ps-scrollbar-y" tabindex="0" style="top: 150px; height: 157px;"></div>
                                                    </div>
                                                </div>
                                                <div class="card-body border-top">
                                                    <form method="post" action="<?= base_url('feedback/send') ?>">
                                                        <input type="hidden" name="menu" value="journal">
                                                        <input type="hidden" name="menu_id" value="<?= $jurnal['id']; ?>">
                                                        <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="input-field mt-0 mb-0">
                                                                    <input id="textarea1" name="chat" placeholder="Type and enter" class="form-control border-0" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <button type="submit" class="btn-circle btn-lg btn-cyan float-right text-white" href="javascript:void(0)"><i class="fas fa-paper-plane"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            $(document).ready(function(){
                $('input[type="radio"]').click(function(){
                    var present = $(this).val();
                    var id = $(this).data('id');
                    $.ajax({
                        url:"<?php base_url(); ?>/attendance/save",
                        method:"POST",
                        data : {
                            id : id,
                            present : present
                        },
                        success: function(msg){
                                console.log(id);
                        },
                    });
                });
            });
            </script>

            <?= $this->endSection(); ?>
