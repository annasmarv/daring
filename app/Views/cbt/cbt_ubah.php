            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Ubah Jadwal Ujian</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <a href="<?= base_url('ujian/cbt'); ?>" class="btn btn-md btn-light btn-round"><i class="material-icons fs-20">arrow_back_ios</i> Kembali</a>
                                            <button class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons fs-24">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Print</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="<?= base_url(); ?>/ujian/update" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= $detail->ujianid; ?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label>Nama Tugas</label>
                                            <input type="text" name="task_name" class="form-control" value="<?= $detail->task_name; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select class="form-control" name="class" id="sel_class" required>
                                                <option selected="" disabled=""></option>
                                                <?php foreach ($classes as $class): ?>
                                                    <option <?= $class['class_group_id'] == $detail->class_group_id ? 'selected' : ''; ?> value="<?= $class['class_group_id']; ?>"><?= $class['class_group_name']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>Mata Pelajaran</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="sel_mapel" name="subject" required>
                                                <option selected="" value=""></option>
                                                <?php foreach ($subjects as $subject): ?>
                                                    <option <?= $subject['subject_id'] == $detail->subject_id ? 'selected' : ''; ?> value="<?= $subject['subject_id']; ?>"><?= $subject['subject_name']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Soal</label>
                                            <select class="form-control" id="questbank" name="quest_bank_id" required>
                                                <option selected="" value=""></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Soal</label>
                                            <input type="text" class="form-control" name="quest_total" value="<?= $detail->quest_total; ?>" required>
                                            <small id="" class="form-text text-white badge badge-danger">*Maks. <small id="jumsoal1"></small></small>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Ujian</label>
                                            <input type="date" class="form-control" name="datestart" value="<?= $detail->task_date_start; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Mulai</label>
                                            <input type="time" class="form-control" name="timestart" value="<?= $detail->time_start; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Berakhir</label>
                                            <input type="time" class="form-control" name="timefinish" value="<?= $detail->time_finish; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Acak Soal</label>
                                            <select id="acak" class="form-control" name="random" required>
                                                <option <?= ($detail->random == 0) ? 'selected' : '' ?> value="0">Tidak</option>
                                                <option <?= ($detail->random == 1) ? 'selected' : '' ?> value="1">Ya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label>Status</label>
                                            <select id="acak" class="form-control" name="status" required>
                                                <option <?= ($detail->status == 0) ? 'selected' : '' ?> value="0">NONAKTIF</option>
                                                <option <?= ($detail->status == 1) ? 'selected' : '' ?> value="1">AKTIF</option>
                                            </select>
                                            <input type="hidden" name="teacher_id" value="<?= user()->id;?>">
                                        </div>
                                        <div class="form-group">
                                        <input type="submit" name="submit" value="Ubah" class="btn btn-cyan btn-round">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $("#questbank").change(function(){
                    var soal = $("#questbank").val();
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: '<?= base_url(); ?>/quest/count_soal',
                        data: "soal="+soal,
                        success: function(msg){     
                            
                            if(msg == ''){
                                alert('Tidak ada data Kota');
                            }   
                            
                            else{
                                $("#quest_total").val(msg);
                                $("#jumsoal1").html(msg);                                     
                            }
                        }
                    });            
                });
                </script>
                <script type='text/javascript'>
                    var baseURL= "<?php echo base_url();?>";
                    $(document).ready(function(){
                        $('#sel_class').change(function(){
                            var class_id = $(this).val();
                            // AJAX request
                            $.ajax({
                                url:'<?=base_url()?>/ujian/get_subject_by_classgroup',
                                method: 'post',
                                data: {class_id: class_id},
                                dataType: 'json',
                                success: function(response){
                                    $('#sel_mapel').find('option').not(':first').remove();
                                    // Add options
                                    $.each(response,function(index,data){
                                    $('#sel_mapel').append('<option value="'+data['id']+'">'+data['subject_name']+'</option>');
                                    });
                                }
                            });
                        });

                        $('#sel_mapel').change(function(){
                            var subject = $(this).val();
                            $.ajax({
                                url:'<?=base_url()?>/questbank/getQuestbank',
                                method: 'post',
                                data: {subject_id: subject},
                                dataType: 'json',
                                success: function(response){
                                    $('#questbank').find('option').not(':first').remove();
                                    $.each(response,function(index,data){
                                        $('#questbank').append('<option value="'+data['id']+'">'+data['quest_code']+'</option>');
                                    });
                                }
                            });
                        });
                    });
                </script>
            <?= $this->endSection(); ?>