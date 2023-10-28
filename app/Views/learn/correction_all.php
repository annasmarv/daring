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
</style>
     <div class="container-fluid ">
      <!--         <div class="row">
          <div class="col-md-12 col-lg-12">
            <div class="card border-primary">
              <div class="card-body">
                <h3 class="card-title">Informasi Siswa</h3><br>
                 
                <table>
                  <tr><td>NIS</td><td>:  </td></tr>
                  <tr><td>Nama Lengkap </td><td>:  </td></tr>
                  <tr><td>Kelas</td><td>:  </td></tr>
                  <tr><td>Poin Maksimal</td><td>:  </td></tr>
                  <tr style="font-weight: bold;"><td>Nilai Akhir</td><td>:  </td></tr>
                </table>
                
             </div>
             <div class="card-footer">
               <a href="index.php?page=resultTask&code=<?php //echo $id; ?>"><button class="btn btn-sm btn-cyan"><i class="fa fa-arrow-left"></i> Kembali</button></a>
             </div>
            </div>
          </div>
        </div> -->
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
              <form action="<?= base_url(); ?>/correction/save" method="post">
              <?= csrf_field(); ?>
              <?php foreach ($qna as $data): ?> 
              <table class="table table-bordered">
                <tr>
                  <td style="width:5px!important" align="center" valign="top"><strong><?= $data['number']; ?>.</strong></td>
                  <td colspan="2"><?= $data['question']; ?></td>
                </tr>
                <?php if ($data['quest_type'] == 1): ?>
                <tr>
                  <td align="center"><i class="<?= $data['XJawaban'] == 1 ? 'fa fa-user-check' : '' ?>"></i></td>
                  <td width="5">A. </td>
                  <td><?= $data['answer1']; ?> <i class="<?= $data['answer_key'] == 1 ? 'text-success fa fa-check' : '' ?>"></i></td>
                </tr>
                <tr>
                  <td align="center"><i class="<?= $data['XJawaban'] == 2 ? 'fa fa-user-check' : '' ?>"></i></td>
                  <td>B. </td>
                  <td><?= $data['answer2']; ?> <i class="<?= $data['answer_key'] == 2 ? 'text-success fa fa-check' : '' ?>"></i></td>
                </tr>
                <tr>
                  <td align="center"><i class="<?= $data['XJawaban'] == 3 ? 'fa fa-user-check' : '' ?>"></i></td>
                  <td>C. </td>
                  <td><?= $data['answer3']; ?> <i class="<?= $data['answer_key'] == 3 ? 'text-success fa fa-check' : '' ?>"></i></td>
                </tr>
                <tr>
                  <td align="center"><i class="<?= $data['XJawaban'] == 4 ? 'fa fa-user-check' : '' ?>"></i></td>
                  <td>D. </td>
                  <td><?= $data['answer4']; ?> <i class="<?= $data['answer_key'] == 4 ? 'text-success fa fa-check' : '' ?>"></i></td>
                </tr>                      
                <?php if ($data['quest_option'] == 5): ?>
                <tr>
                  <td align="center"><i class="<?= $data['XJawaban'] == 5 ? 'fa fa-user-check' : '' ?>"></i></td>
                  <td>E. </td>
                  <td><?= $data['answer5']; ?> <i class="<?= $data['answer_key'] == 5 ? 'text-success fa fa-check' : '' ?>"></i></td>
                </tr>
                <?php endif; if($data['XJawaban'] == $data['answer_key']){
                      $ikon = "fa-check";$warna = "success";}else{$ikon = "fa-ban";$warna = "danger";
                    }; ?>
                <tr>
                  <td colspan="3" class="bg-<?= $warna; ?> text-white">
                  <?php
                    echo "Kunci Jawaban : ".alp($data['answer_key']).", Jawaban Siswa : ".alp($data['XJawaban'])." <i class='fa $ikon'></i>";
                  ?>, Point : <?= $data['XNilai']; ?>
                  </td>
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