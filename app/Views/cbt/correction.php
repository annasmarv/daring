<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<?php $uri = service('uri'); ?>

<style type="text/css">
  .jawaban img, .card-text{
    max-width: 100%!important;
  }
  .card-text img{
    max-width: 100%!important;
  }
  .asdas p {
    margin: 0;
    display: inline-block;
  }
  td p{
    display: inline-block;
  }
  .table tr td{
    border-top: none!important;
  }
  .td-radius{
    border-radius: 10px;
  }
  .bgx-success{
    background-color: #e6f4ea;
  }
  .bgx-danger{
    background-color: #fce8e6;
  }
</style>

     <div class="container-fluid ">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                <h4 class="card-title">Lembar Jawaban Siswa</h4>
                <div class="ml-auto">
                  <div class="dropdown sub-dropdown">
                    <a href="<?= base_url(); ?>/ujian/<?= $uri->getSegment(3); ?>"><button class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                    <button class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v fa-fw"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                      <a class="dropdown-item" href="#" onclick="window.print()">Print</a>
                      <a class="dropdown-item" href="#">Export</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-lg-4 col-md-6 col-6">
                  <select class="form-control">
                    <option>Nama Siswa</option>
                  </select>
                </div>
                <div class="col-lg-8 col-md-6 col-6 text-right">
                  <p class="p-2 mb-0">0 dari 0 poin</p>
                </div>
              </div> -->
              <form action="<?= base_url(); ?>/correction/save" method="post">
              <?= csrf_field(); ?>
              <?php foreach ($qna as $data): ?>
              <?php 
                if ($data['XJawaban'] == $data['answer_key']) {
                  $check = 'text-success fa fa-check';
                  $bg    = 'bgx-success';
                }else{
                  $check = 'text-danger fa fa-times';
                  $bg    = 'bgx-danger';
                }
              ?>
              <table class="table">
                <tr class="<?= $data['XJawaban'] == $data['answer_key'] ? 'text-success' : 'text-danger' ?>">
                  <td style="width:5px!important" align="center" valign="top"><strong><?= $data['number']; ?>.</strong></td>
                  <td colspan="2"><?= $data['question']; ?></td>
                </tr>
                <?php if ($data['quest_type'] == 1): ?>
                <tr class="<?= $data['XJawaban'] == 1 ? $bg : ''; ?>">
                  <td align="center"><i class="<?= $data['XJawaban'] == 1 ? $check : ''; ?>"></i></td>
                  <td width="5">A. </td>
                  <td><?= $data['answer1']; ?></td>
                  <td><i class="<?= $data['answer_key'] == 1 ? 'fa fa-lock' : '' ?>"></i></td>
                </tr>
                <tr class="<?= $data['XJawaban'] == 2 ? $bg : ''; ?>">
                  <td align="center"><i class="<?= $data['XJawaban'] == 2 ? $check : ''; ?>"></i></td>
                  <td>B. </td>
                  <td><?= $data['answer2']; ?></td>
                  <td><i class="<?= $data['answer_key'] == 2 ? 'fa fa-lock' : '' ?>"></i></td>
                </tr>
                <tr class="<?= $data['XJawaban'] == 3 ? $bg : ''; ?>">
                  <td align="center"><i class="<?= $data['XJawaban'] == 3 ? $check : ''; ?>"></i></td>
                  <td>C. </td>
                  <td><?= $data['answer3']; ?></td>
                  <td><i class="<?= $data['answer_key'] == 3 ? 'fa fa-lock' : '' ?>"></i></td>
                </tr>
                <tr class="<?= $data['XJawaban'] == 4 ? $bg : ''; ?>">
                  <td align="center"><i class="<?= $data['XJawaban'] == 4 ? $check : ''; ?>"></i></td>
                  <td>D. </td>
                  <td><?= $data['answer4']; ?></td>
                  <td><i class="<?= $data['answer_key'] == 4 ? 'fa fa-lock' : '' ?>"></i></td>
                </tr>                      
                <?php if ($data['quest_option'] == 5): ?>
                <tr class="<?= $data['XJawaban'] == 5 ? $bg : ''; ?>">
                  <td align="center"><i class="<?= $data['XJawaban'] == 5 ? $check : ''; ?>"></i></td>
                  <td>E. </td>
                  <td><?= $data['answer5']; ?></td>
                  <td><i class="<?= $data['answer_key'] == 5 ? 'fa fa-lock' : '' ?>"></i></td>
                </tr>
                <?php endif; ?>
                <tr>
                  <td colspan="3">
                  <?php
                    echo "Kunci Jawaban : ".alp($data['answer_key'])." | Jawaban Siswa : ".alp($data['XJawaban']);
                  ?> | Point : <?= $data['XNilai']; ?>
                  </td>
                  <td></td>
                </tr>
                <?php endif ?>

                <?php if ($data['quest_type'] == 2): ?>
                  <tr>
                    <td rowspan="2"></td>
                    <td>
                      <input type="hidden" id="id" name="id[]" value="<?= $data['id']; ?>">
                      <input type="hidden" id="1" name="1" value="<?= $data['user_id']; ?>">
                      <input type="hidden" id="2" name="2" value="<?= $data['task_id']; ?>">
                      <p><b>Jawaban Siswa :</b></p><br>
                      <p><?= $data['XJawabanEssai']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Poin Jawaban :</b><br>
                      <input class="col-sm-4 form-control" type="number" value="<?= $data['XNilai']; ?>" id ="nilai" name="nilai[]" ><br>
                      <b>Poin Maks. <?= $data['maxpoint']; ?></b>
                    </td>
                  </tr>
                <?php endif ?>
              </table>
              <hr>
              <?php endforeach ?>
                      <center><input type="submit" id="rTask" name="" class="btn btn-cyan" value="SIMPAN"></center>
                    <a href="<?= base_url() ?>/ujian/<?= $page ?>"><button class="btn btn-sm btn-cyan"><i class="fa fa-arrow-left"></i> Kembali</button></a>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection(); ?>