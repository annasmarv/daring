            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            <li class="nav-item">
                                                <a href="#plan" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                                    <span class="d-lg-block">Rencana Pembelajaran</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#feedback" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                    <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                                    <span class="d-lg-block">Feedback</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="ml-auto">
                                            <!-- <button type="submit" value="ubah" name="e_modul" class="btn btn-md btn-cyan btn-round">Simpan</button> -->
                                            <a href="<?= base_url('learn/plan/pdf/'.$plan['id']) ?>">
                                            <button type="button"  class="btn btn-md btn-cyan btn-round">Print</button></a>
                                            <a href="<?= base_url(); ?>/learn/journal/plans/<?= $plan['week_id'] ?>"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="plan">
                                <form action="<?= base_url(); ?>/learn/plan/update/<?= $uri->getSegment(4) ?>" method="post">
                                <?= csrf_field(); ?>
                                            <div class="form-body">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Mata Pelajaran</label>
                                                        <select class="form-control" id="Mata Pelajaran" name="subject_id" required>
                                                            <option selected="" disabled=""></option>
                                                            <?php foreach ($subjects as $subject): ?>
                                                                <option <?= ($subject['subject_id'] == $plan['subject_id'] ? 'selected' : '') ?> value="<?= $subject['subject_id']; ?>">
                                                                    <?= $subject['subject_name']; ?>
                                                                </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-1">
                                                        <label>Kelas</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control" id="kelas" name="class_group_id[]" required multiple="multiple">
                                                            <?php 
                                                            $kelass = explode(',', str_replace('+', '', $plan['class_group_id']));
                                                            foreach ($classes as $y) {  ?>
                                                                <option value="+<?= $y['id']; ?>+" 
                                                                    <?php foreach ($kelass as $x) {
                                                                        if ($y['id'] == $x){echo "selected"; }
                                                                    } ?> >
                                                                    <?= $y['class_group_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Tema</label>
                                                        <input type="text" class="form-control" id="tema" name="title" aria-describedby="tema" value="<?= $plan['title']; ?>" placeholder="Tema" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Alokasi Waktu</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control" id="alokasi_jp" name="alokasi" value="<?= $plan['alokasi_jp']; ?>" placeholder="Alokasi Waktu" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text btn-round">JP</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Tujuan Pembelajaran</label>
                                                        <textarea class="editorz" rows="15" name="goal"><?= $plan['goal']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Kegiatan Pembelajaran</label>
                                                        <textarea class="editorz" rows="15" name="activity"><?= $plan['activity']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Asesmen</label>
                                                        <textarea class="editorz" rows="15" name="asesmen"><?= $plan['asesmen']; ?></textarea>
                                                    </div>
                                                    <br>
                                                    <button type="submit" value="Simpan" name="s_modul" class="btn btn-md btn-round btn-cyan">Simpan</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
                                                        <input type="hidden" name="menu" value="plan">
                                                        <input type="hidden" name="menu_id" value="<?= $plan['id']; ?>">
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
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->endSection(); ?>
