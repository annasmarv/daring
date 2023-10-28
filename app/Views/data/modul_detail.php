            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h3 class="card-title">Informasi Materi</h3><br>
                                <?php foreach ($modul as $rows): ?>            
                                <table>
                                    <tr>
                                        <td width="150">Guru</td><td width="30">:</td><td><?= $rows['fullname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mata Pelajaran</td><td>:</td><td><?= $rows['subject_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td><td>:</td><td>
                                            <?php if ($rows['class_group_id']) {
                                                $kelass = explode(',', str_replace('+', '', $rows['class_group_id']));
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
                                        <td>Tema</td><td>:</td><td><?= $rows['title']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Buat</td><td>:</td><td><?= $rows['created_at']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Update</td><td>:</td><td><?= $rows['updated_at']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><a class="text-primary" data-toggle="modal" data-target="#countreadModul"><?php foreach ($count as $x) { echo $x['id'];
                                        } ?>x dibaca</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <div class="card-header d-flex align-items-center">
                                <div class="btn-group">
                                    <a class="btn btn-md btn-cyan btn-round text-white" href="<?= base_url(); ?>/data/modul/update/<?= $rows['id']; ?>">Ubah</a>
                                    <button class="btn btn-md btn-danger btn-round" data-toggle="modal"data-target="#delModul">Hapus</button>
                                </div>
                                <div class="ml-auto">
                                    <a href="<?= base_url(); ?>/data/modul"><button type="button" class="btn btn-md btn-light btn-round"><i class="font-12 pr-1 material-symbols-rounded">arrow_back_ios_new</i><span>Kembali</span></button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?= $rows['title'];?></h3>
                                <h6 class="card-subtitle"><?= $rows['subject_name']; ?></h6>
                                <?php if ($rows['youtube']) : ?>
                                    <div class="video-container-yt"><iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $rows['youtube']; ?>" frameborder="0" allowfullscreen></iframe></div>
                                <?php endif ?>
                                <p class="card-text"><?= $rows['content']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="delModul" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2"><b>Perhatian!</b></h4>
                                <p class="mt-3">Apakah Anda yakin akan menghapus data ini ?</p>
                                <p class="mt-2"><?= $rows['title']; ?></p>
                                <form action="/data/modul/delete" method="post">
                                    <input type="hidden" name="id" value="<?= $rows['id']; ?>">
                                    <button type="submit" name="delModul" class="btn btn-light btn-round my-2">Iya</button>
                                    <button type="button" class="btn btn-light btn-round my-2" data-dismiss="modal">Tidak</button>    
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="countreadModul" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Data Literasi Siswa</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <h3 class="modal-title"><?php //echo $judul ?></h3>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Terakhir Membaca</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no=1; foreach ($lists as $list) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $list['fullname']; ?></td>
                                            <td><?= $list['class_group_name'] ?></td>
                                            <td><?= $list['read_date']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
            <?php endforeach ?>
            <?= $this->endSection(); ?>
