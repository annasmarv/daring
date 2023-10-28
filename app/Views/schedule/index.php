            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <?php $uri = service('uri'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('pesan')): ?>
                                  <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible border-0 fade show" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span class="material-symbols-rounded">close</span>
                                      </button>
                                      <?= session()->getFlashdata('pesan') ?>
                                  </div>
                                <?php endif ?>
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Jadwal</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-md btn-cyan btn-round" data-toggle="modal" data-target="#addRelasi">Tambah</button>
                                            <button class="btn btn-md btn-light btn-round text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v fa-fw"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Upload</a>
                                                <a class="dropdown-item" href="#">Print</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Senin</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($monday1 as $mon): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($mon['time_start'], 0, 5)."-".substr($mon['time_finish'], 0, 5); ?></td>
                                                <td><a data-toggle="modal" data-target="#upSchedule<?= $mon['scheduleid']; ?>"><b><?= $mon['subject_name']; ?></b></a></td>
                                            </tr>
                                            <tr>
                                                <td><?= $mon['fullname']; ?></td>
                                            </tr>

                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $mon['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $mon['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option> 
                                                                            <option <?= $mon['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $mon['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $mon['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $mon['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $mon['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $mon['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $mon['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $mon['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $mon['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>JP</label>
                                                                        <input value="<?= $mon['jp'] ?>" class="form-control" type="number" name="jp">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Ruang</label>
                                                                        <input value="<?= $mon['room'] ?>" class="form-control" type="number" name="room">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $mon['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Selasa</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($tuesday1 as $tue): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($tue['time_start'], 0, 5)."-".substr($tue['time_finish'], 0, 5); ?></td>
                                                <td><a data-toggle="modal" data-target="#upSchedule<?= $tue['scheduleid']; ?>"><b><?= $tue['subject_name']; ?></b></a></td>
                                            </tr>
                                            <tr>
                                                <td><?= $tue['fullname']; ?></td>
                                            </tr>
                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $tue['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $tue['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option> 
                                                                            <option <?= $tue['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $tue['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $tue['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $tue['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $tue['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $tue['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $tue['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $tue['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $tue['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>JP</label>
                                                                        <input value="<?= $tue['jp'] ?>" class="form-control" type="number" name="jp">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Ruang</label>
                                                                        <input value="<?= $tue['room'] ?>" class="form-control" type="number" name="room">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $tue['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Rabu</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($wednesday1 as $wed): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($wed['time_start'], 0, 5)."-".substr($wed['time_finish'], 0, 5); ?></td>
                                                <td><a data-toggle="modal" data-target="#upSchedule<?= $wed['scheduleid']; ?>"><b><?= $wed['subject_name']; ?></b></a></td>
                                            </tr>
                                            <tr>
                                                <td><?= $wed['fullname']; ?></td>
                                            </tr>
                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $wed['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $wed['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option> 
                                                                            <option <?= $wed['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $wed['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $wed['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $wed['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $wed['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $wed['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $wed['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $wed['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $wed['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>JP</label>
                                                                        <input value="<?= $wed['jp'] ?>" class="form-control" type="number" name="jp">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Ruang</label>
                                                                        <input value="<?= $wed['room'] ?>" class="form-control" type="number" name="room">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $wed['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Kamis</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($thursday1 as $thu): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($thu['time_start'], 0, 5)."-".substr($thu['time_finish'], 0, 5); ?></td>
                                                <td><b><a data-toggle="modal" data-target="#upSchedule<?= $thu['scheduleid']; ?>"><?= $thu['subject_name']; ?></a></b></td>
                                            </tr>
                                            <tr>
                                                <td><?= $thu['fullname']; ?></td>
                                            </tr>

                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $thu['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $thu['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option>  
                                                                            <option <?= $thu['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $thu['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $thu['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $thu['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $thu['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $thu['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $thu['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $thu['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $thu['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>JP</label>
                                                                        <input value="<?= $thu['jp'] ?>" class="form-control" type="number" name="jp">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Ruang</label>
                                                                        <input value="<?= $thu['room'] ?>" class="form-control" type="number" name="room">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $thu['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Jum'at</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($friday1 as $fri): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($fri['time_start'], 0, 5)."-".substr($fri['time_finish'], 0, 5); ?></td>
                                                <td><b><a data-toggle="modal" data-target="#upSchedule<?= $fri['scheduleid']; ?>"><?= $fri['subject_name']; ?></a></b></td>
                                            </tr>
                                            <tr>
                                                <td><?= $fri['fullname']; ?></td>
                                            </tr>

                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $fri['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $fri['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option>  
                                                                            <option <?= $fri['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $fri['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $fri['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $fri['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>  
                                                                            <option <?= $fri['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $fri['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $fri['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $fri['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $fri['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>JP</label>
                                                                        <input value="<?= $fri['jp'] ?>" class="form-control" type="number" name="jp">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Ruang</label>
                                                                        <input value="<?= $fri['room'] ?>" class="form-control" type="number" name="room">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $fri['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Senin</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($monday2 as $mon): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($mon['time_start'], 0, 5)."-".substr($mon['time_finish'], 0, 5); ?></td>
                                                <td><a data-toggle="modal" data-target="#upSchedule<?= $mon['scheduleid']; ?>"><b><?= $mon['subject_name']; ?></b></a></td>
                                            </tr>
                                            <tr>
                                                <td><?= $mon['fullname']; ?></td>
                                            </tr>

                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $mon['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $mon['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option> 
                                                                            <option <?= $mon['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $mon['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $mon['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $mon['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $mon['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $mon['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $mon['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $mon['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $mon['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>JP>
                                                                        <input value="<?= $mon['jp'] ?>" class="form-control" type="number" name="jp">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $mon['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Selasa</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($tuesday2 as $tue): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($tue['time_start'], 0, 5)."-".substr($tue['time_finish'], 0, 5); ?></td>
                                                <td><a data-toggle="modal" data-target="#upSchedule<?= $tue['scheduleid']; ?>"><b><?= $tue['subject_name']; ?></b></a></td>
                                            </tr>
                                            <tr>
                                                <td><?= $tue['fullname']; ?></td>
                                            </tr>
                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $tue['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $tue['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option> 
                                                                            <option <?= $tue['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $tue['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $tue['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $tue['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $tue['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $tue['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $tue['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $tue['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $tue['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $tue['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Rabu</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($wednesday2 as $wed): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($wed['time_start'], 0, 5)."-".substr($wed['time_finish'], 0, 5); ?></td>
                                                <td><a data-toggle="modal" data-target="#upSchedule<?= $wed['scheduleid']; ?>"><b><?= $wed['subject_name']; ?></b></a></td>
                                            </tr>
                                            <tr>
                                                <td><?= $wed['fullname']; ?></td>
                                            </tr>
                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $wed['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $wed['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option> 
                                                                            <option <?= $wed['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $wed['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $wed['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $wed['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $wed['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $wed['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $wed['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $wed['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $wed['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $wed['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Kamis</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($thursday2 as $thu): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($thu['time_start'], 0, 5)."-".substr($thu['time_finish'], 0, 5); ?></td>
                                                <td><b><a data-toggle="modal" data-target="#upSchedule<?= $thu['scheduleid']; ?>"><?= $thu['subject_name']; ?></a></b></td>
                                            </tr>
                                            <tr>
                                                <td><?= $thu['fullname']; ?></td>
                                            </tr>

                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $thu['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $thu['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option>  
                                                                            <option <?= $thu['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $thu['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $thu['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $thu['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>   
                                                                            <option <?= $thu['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $thu['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $thu['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $thu['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $thu['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $thu['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                           <div class="card">
                               <div class="card-header">
                                   <b>Jum'at</b>
                               </div>
                               <div class="card-body">
                                    <table>
                                        <?php foreach ($friday2 as $fri): ?>
                                            <tr >
                                                <td rowspan="2" width="100" valign="top"><?= substr($fri['time_start'], 0, 5)."-".substr($fri['time_finish'], 0, 5); ?></td>
                                                <td><b><a data-toggle="modal" data-target="#upSchedule<?= $fri['scheduleid']; ?>"><?= $fri['subject_name']; ?></a></b></td>
                                            </tr>
                                            <tr>
                                                <td><?= $fri['fullname']; ?></td>
                                            </tr>

                                            <!--THU Modal -->
                                            <div class="modal fade text-left" id="upSchedule<?= $fri['scheduleid']; ?>" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Ubah</h5>
                                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url(); ?>/data/schedule/update" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?= $fri['scheduleid']; ?>">
                                                            <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label>Hari</label>
                                                                        <select class="form-control form-select select2" name="day" required>
                                                                            <option disabled=""></option>  
                                                                            <option <?= $fri['day']== 'Mon' ? 'selected' : '' ?> value="Mon">Senin</option>   
                                                                            <option <?= $fri['day']== 'Tue' ? 'selected' : '' ?> value="Tue">Selasa</option>   
                                                                            <option <?= $fri['day']== 'Wed' ? 'selected' : '' ?> value="Wed">Rabu</option>   
                                                                            <option <?= $fri['day']== 'Thu' ? 'selected' : '' ?> value="Thu">Kamis</option>  
                                                                            <option <?= $fri['day']== 'Fri' ? 'selected' : '' ?> value="Fri">Jum'at</option>   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mata Pelajaran</label>
                                                                        <select class="form-control form-select select2" name="relation" required>
                                                                            <option selected="" disabled=""></option>
                                                                            <?php foreach ($relations as $relation): ?>
                                                                                <option <?= $fri['relation_id'] == $relation['id'] ? 'selected' : '' ?> value="<?= $relation['id'];?>">
                                                                                    <?= $relation['subject_name'];?> -
                                                                                    <?= $relation['fullname'];?>
                                                                                </option>
                                                                            <?php endforeach ?>     
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Mulai</label>
                                                                        <input value="<?= $fri['time_start'] ?>" class="form-control" type="time" name="time_start">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Waktu Berakhir</label>
                                                                        <input value="<?= $fri['time_finish'] ?>" class="form-control" type="time" name="time_finish">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jam Ke-</label>
                                                                        <input value="<?= $fri['time_of'] ?>" class="form-control" type="number" name="time_of">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Minggu</label>
                                                                        <input value="<?= $fri['week'] ?>" class="form-control" type="number" name="week">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Simpan</span>
                                                                    </button>
                                                                </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </table>
                               </div>
                           </div>
                    </div>
                </div>
            </div>
<!-- ================================================================================ -->
                                <!-- sample modal content -->
                                <div id="addRelasi" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Jadwal</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <form action="<?= base_url(); ?>/data/schedule/create" method="post">
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label>Hari</label>
                                                        <select class="form-control form-select select2" name="day" required>
                                                            <option selected="" disabled=""></option>
                                                            <option value="Mon">Senin</option>   
                                                            <option value="Tue">Selasa</option>   
                                                            <option value="Wed">Rabu</option>   
                                                            <option value="Thu">Kamis</option> 
                                                            <option value="Fri">Jum'at</option> 
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mata Pelajaran</label>
                                                        <select class="form-control form-select select2" name="relation" required>
                                                            <option selected="" disabled=""></option>
                                                            <?php foreach ($relations as $relation): ?>
                                                                <option value="<?= $relation['id'];?>">
                                                                    <?= $relation['subject_name'];?> -
                                                                    <?= $relation['fullname'];?>
                                                                </option>
                                                            <?php endforeach ?>     
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Waktu Mulai</label>
                                                        <input class="form-control" type="time" name="time_start">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Waktu Berakhir</label>
                                                        <input class="form-control" type="time" name="time_finish">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jam Ke-</label>
                                                        <input class="form-control" type="number" name="time_of">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>JP</label>
                                                        <input class="form-control" type="number" name="jp">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ruang</label>
                                                        <input class="form-control" type="number" name="room">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Minggu</label>
                                                        <input class="form-control" type="number" name="week">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="uri" value="<?= $uri->getPath(); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-round btn-light"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-round btn-primary" name="addRelasi">Simpan</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
            <?= $this->endSection(); ?>