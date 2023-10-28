<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?= $pager->links('quest', 'custom_page'); ?>
                                <?php $page = (isset($_GET['page_quest'])) ? $_GET['page_quest'] : 1 ?>
                        	    <?php foreach ($quests as $quest): ?>
                                <form id="form-users" action="<?= base_url(); ?>/quest/update" class="mt-3" method="post">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Soal No. <input type="number" value="<?= $quest['number']; ?>" name="number"></h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button type="submit" class="btn btn-md btn-cyan btn-round">Simpan</button>
                                                <a href="<?= base_url(); ?>/questbank/<?= $quest['quest_bank_id']; ?>"><button type="button" class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" value="<?= $quest['qid']; ?>" name="id" >
                                    <input type="hidden" value="<?= $quest['quest_bank_id']; ?>" name="code" >
                                    <input type="hidden" value="<?= $page ?>" name="page">
                                    <div class="form-body">
                                    	<textarea class="editorz" rows="15" name="question"><?= $quest['question']; ?></textarea><br><br><br>
                                        <?php if ($quest['type'] == 1): ?>
                                            Jawaban 1. <br>
                                            <textarea class="editorz" name="answer1" type="text" id="textfield9" size="50" /> <?= $quest['answer1']; ?> </textarea> <br><br>
                                            Jawaban 2. <br>
                                            <textarea class="editorz" name="answer2" type="text"  size="50" /><?= $quest['answer2']; ?></textarea> <br><br>
                                            Jawaban 3. <br>
                                            <textarea class="editorz" name="answer3" type="text"  size="50" /><?= $quest['answer3']; ?></textarea> <br><br>
                                            Jawaban 4. <br>
                                            <textarea class="editorz" name="answer4" type="text" size="50" /><?= $quest['answer4']; ?></textarea> <br><br>                                        
                                            <?php if ($quest['quest_option'] == 5): ?>
                                                Jawaban 5. <br>
                                                <textarea class="editorz" name="answer5" type="text" size="50" /><?= $quest['answer5']; ?></textarea> <br><br>
                                                </textarea>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <div class="row"> 
                                        <label class="col-sm-1 col-form-label" style="color: black!important;font-size: 14px!important">Poin</label>
                                        <div class="col-sm-2">
                                          <input type="number" value="<?= $quest['point']; ?>" name="point" class="form-control" placeholder="Poin Maks." step=".01">
                                        </div>
                                        <?php if ($quest['type'] == '1') { ?>
                                        <label class="col-sm-1 col-form-label" style="color: black!important;font-size: 14px!important">Kunci</label>
                                        <div class="col-sm-2">
                                          <div class="row">
                                            <select class="form-control" name="kunci" id="select">
                                              <option <?= ($quest['quest_keys'] == 1) ? 'selected' : '' ?> value="1">A</option>
                                              <option <?= ($quest['quest_keys'] == 2) ? 'selected' : '' ?> value="2">B</option>
                                              <option <?= ($quest['quest_keys'] == 3) ? 'selected' : '' ?> value="3">C</option>
                                              <option <?= ($quest['quest_keys'] == 4) ? 'selected' : '' ?> value="4">D</option>                
                                              <?php
                                              if ($quest['quest_option']==5) { ?>
                                                 <option <?= ($quest['quest_keys'] == 5) ? 'selected' : '' ?> value="5">E</option>  
                                               <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <?php } ?>
                                    </div><br>
                                    <button class="btn btn-cyan btn-round" type="submit">Simpan</button>
                                </form>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?= $this->endSection(); ?>