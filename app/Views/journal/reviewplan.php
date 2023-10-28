            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h3 class="card-title">Rencana Pembelajaran</h3><br>          
                                <table>
                                    <tr>
                                        <td width="150">Guru</td><td width="30">:</td><td><?= $plan['fullname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mata Pelajaran</td><td>:</td><td><?= $plan['subject_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td><td>:</td><td>
                                            <?php if ($plan['class_group_id']) {
                                                $kelass = explode(',', str_replace('+', '', $plan['class_group_id']));
                                                foreach ($kelass as $x) { 
                                                    foreach ($classes as $y) {  
                                                        if ($y['id'] == $x) { 
                                                            echo "<button class=\"btn waves-effect waves-light btn-rounded btn-outline-info font-12\">".$y['class_group_name']."</button> ";
                                                        }
                                                    }
                                                }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tema</td><td>:</td><td><?= $plan['title']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Buat</td><td>:</td><td><?= $plan['created_at']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Update</td><td>:</td><td><?= $plan['updated_at']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h3 class="card-title"><?= $plan['title'];?></h3>
                                <h6 class="card-subtitle"><?= $plan['subject_name']; ?></h6>
                                <p class="mt-4">
                                    <strong>Tujuan Pembelajaran</strong><br>
                                    <span><?= $plan['goal']; ?></span>
                                </p>
                                <p class="mt-4">
                                    <strong>Kegiatan Pembelajaran</strong><br>
                                    <span><?= $plan['activity']; ?></span>
                                </p>
                                <p class="mt-4">
                                    <strong>Asesmen Pembelajaran</strong><br>
                                    <span><?= $plan['asesmen']; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h3 class="card-title">Tanggapan</h3><br>
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
            <?= $this->endSection(); ?>
