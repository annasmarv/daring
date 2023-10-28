            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <style type="text/css">
            	.asdas p {
            		margin: 0;
            		display: inline-block;
            	} 
            </style>
            <div class="container-fluid ">
		    	<!-- Table -->
		    	<div class="row">
		        	<div class="col">
		        		<div class="card">
		            		<div class="card-body">
	                        	<?php foreach ($qna as $data): ?>
		                		
		                		<div class="row">
		                			<div class="col-8">
		                				<h3 class="card-title"><?= ($data['quest_type'] == 1 ? 'PG' : ($data['quest_type'] == 2 ? 'Essai' : 'Lainnya')); ?> - 
				                			Soal Nomor <button class="btn btn-md btn-primary noHover"><strong><?= (isset($_GET['page_qna'])) ? $_GET['page_qna'] : 1; ?></strong></button> 
				                		</h3>
		                			</div>
		                			<div class="col-4 text-right">
		                				<a href="" data-toggle="modal" data-target="#daftar-soal" class="text-dark"><b>Lihat Soal</b></a>
		                			</div>
		                		</div>

		                		<form enctype="multipart/form-data" action="<?php base_url(); ?>/student/exam/save" method="post" method="post">
		                			<?= csrf_field(); ?>
		                			<?php $arr = array('1','2','3','4','5');
		                			$ax = array_rand($arr,1);
		                			?>
					                <input type="hidden" id="kunci" name="kunci" value="<?= $arr[$ax]; ?>">  
					                
					                <p class="card-text my-4" style="margin-bottom: 0!important"><?= $data['question']; ?></p>
					                <!-- <p style="font-weight: bold!important;">Poin Benar : <?= $data['point']; ?></p> -->

				                	<div class="asdas">
						                <?php if ($data['quest_type'] == 1): ?>
						                	<input type="hidden" name="jeso" value="1">
						                	<input type="hidden" id="point" name="point" value="<?= $data['point']; ?>">
					                    	<input <?= ($data['XJawaban'] == 1) ? 'checked' : '' ?> id="optionA" type="radio" data-id="<?= $data['asid']; ?>" name="field" value="1">
					                    	<label for="optionA"><p>A.&nbsp;</p><?= $data['answer1']; ?></label><br><br>
					                    	<input  <?= ($data['XJawaban'] == 2) ? 'checked' : '' ?> id="optionB" type="radio" data-id="<?= $data['asid']; ?>" name="field" value="2">
					                    	<label for="optionB">B.&nbsp;<?= $data['answer2']; ?></label><br><br>
					                    	<input  <?= ($data['XJawaban'] == 3) ? 'checked' : '' ?> id="optionC" type="radio" data-id="<?= $data['asid']; ?>" name="field" value="3">
					                    	<label for="optionC">C.&nbsp;<?= $data['answer3']; ?></label><br><br>
					                    	<input  <?= ($data['XJawaban'] == 4) ? 'checked' : '' ?> id="optionD" type="radio" data-id="<?= $data['asid']; ?>" name="field" value="4">
					                    	<label for="optionD">D.&nbsp;<?= $data['answer4']; ?></label><br><br>

					                		<?php if ($data['quest_option'] == 5): ?>
					                			<input  <?= ($data['XJawaban'] == 5) ? 'checked' : '' ?> id="optionE" type="radio" data-id="<?= $data['asid']; ?>" name="field" value="5">
					                    		<label for="optionE">E.&nbsp;<?= $data['answer5']; ?></label><br><br>
					                		<?php endif ?>
						                <?php endif ?>

				                		<?php if ($data['quest_type'] == 2): ?>
				                			<form enctype="multipart/form-data" action="<?php base_url(); ?>/student/exam/save" method="post">
					                			<input type="hidden" name="id" value="<?= $data['asid']; ?>">
					                			<input type="hidden" name="sort" value="<?= $data['sort']; ?>">
					                			<input type="hidden" name="task_id" value="<?= $data['task_id']; ?>">
					                			<textarea class="editorz mt-4" rows="6" class="form-control" name="jwb2"><?= $data['XJawabanEssai']; ?></textarea>
					                			<input type="submit" class="btn btn-primary mt-4" value="SIMPAN">
					                		</form><br>
					                		<small>* Jangan lupa klik <b>SIMPAN</b> untuk menyimpan jawaban</small>
				                		<?php endif ?>

				                	</div>
		                        <input type="hidden" id="id_user" name="id_user" value="<?= $data['quest_keys'] ?>">
				                </form><br><br>
				                <?php endforeach ?>
				                <?= $pager->links('qna', 'simple_page'); ?>
	                            <?php $page = (isset($_GET['page_qna'])) ? $_GET['page_qna'] : 1 ?>
	                            <div class="text-center">
	                            	<a data-toggle="modal" data-target="#bs-example-modal-sm" class="text-primary"><b>Simpan & Selesai</b></a>
	                            </div>
		            		</div>
		        		</div>
		        	</div>
		      	</div>
		    </div>

		    <div class="modal fade" id="daftar-soal" role="dialog">
			    <div class="modal-dialog">
			    <div class="modal-content">
			            <div class="modal-header">
			              <h5 class="modal-title">Daftar Soal </h5>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			                </button>
			            </div>
			            <div class="modal-body">
			              <?php foreach ($answered as $wk): ?>
			                <a href="?page_qna=<?= $wk['sort']; ?>">
			                  <button class="btn btn-outline-dark btn-sm mb-2 mr-2 <?= ( !empty($wk['XJawaban']) || !empty($wk['XJawabanEssai']) ) ? 'btn-primary' : '' ?>" style="width:40px;height:40px;padding-top:5px;position:relative"><?= $wk['sort']; ?>
			                  </button>
			                </a>
			              <?php endforeach ?>
			            </div>
			        </div>
			  </div>
			</div>

		    <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog"
			    aria-labelledby="mySmallModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-sm">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h4 class="modal-title" id="mySmallModalLabel">Konfirmasi Selesai</h4>
			                <button type="button" class="close" data-dismiss="modal"
			                    aria-hidden="true">×</button>
			            </div>
			            <div class="modal-body">
			                Apakah kamu yakin akan mengakhiri tugas ini?
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
			                <a href="<?= base_url(); ?>/student/tasks/finish/<?php $uri = service('uri'); echo $uri->getSegment(3); ?>"><button type="button" class="btn btn-primary">Simpan & Selesai</button></a>
			            </div>
			        </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<script>
			$(document).ready(function(){
			   	$('input[type="radio"]').click(function(){
			        var jwb = $(this).val();
			        var id = $(this).data('id');
			        var id_user = $("#id_user").val();
			        var point = $("#point").val();
			        $.ajax({
			            url:"<?php base_url(); ?>/student/exam/save",
			            method:"POST",
			            data : {
                			id : id,
                			jwb : jwb,
                			id_user : id_user,
                			point : point
            			},
            			success: function(msg){
						        console.log(id);
						},
			        });
			   	});
			});
			</script>
            <?= $this->endSection();  ?>