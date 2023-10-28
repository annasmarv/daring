<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        navigator.geolocation.getCurrentPosition(function (position) {
             tampilLokasi(position);
        }, function (e) {
            alert('dimohon untuk mengaktifkan GPS, dan mengizinkan situs ini mengakses lokasi lewat browser');
        }, {
            enableHighAccuracy: true
        });
    });
    function myFunction() {
      navigator.geolocation.getCurrentPosition(function (position) {
             tampilLokasi(position);
        }, function (e) {
            alert('dimohon untuk mengaktifkan GPS');
        }, {
            enableHighAccuracy: true
        });
    }
</script>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Absensi</h4>
                                <p class="card-text">Sebelum mengisi absen, harap aktifkan sistem GPS pada ponsel Anda dan Izinkan WEB ini mengakses Lokasi Anda.</p>
                                <!--<a href="javascript:void(0)" class="btn btn-info">Izinkan Lokasi</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <h4 class="card-title">Absensi</h3>
                                    </div>
                                    <div class="col-8 text-right">
                                        <h4 class="card-title"><?= tgl_indo(date("Y-m-d")); ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="btn-list">
                                     <?php
                                     date_default_timezone_set('Asia/Jakarta');
                                        $no = 1;
                                        $date1 = date('Y-m-d');
                                        $lim1 = '06:00';
                                        $lim2 = '22:00';
                                        $time1 = date('H:i');?>
                                    <button type="button" <?= ($isA != NULL) ? 'disabled' : '' ?> class="btn btn-rounded btn-cyan" data-toggle="modal" data-target="#modal"><i class="fas fa-paper-plane"></i> M A S U K</button>
                                    <button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#pulang"><i class="fas fa-reply"></i> P U L A N G</button>
                                    <a href="<?= base_url(); ?>/student/absen/report"><button type="button" class="btn btn-rounded btn-warning"><i class="fas fa-receipt"></i> LAPORAN</button></a>
                                    <a href="<?= base_url(); ?>/student/absen/check"><button type="button" class="btn btn-rounded btn-danger"><i class="fa fa-map-marker-alt"></i> CEK LOKASI</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--  ------------------------------------------------------------------------------------------------------------------------- -->
                                <!-- sample modal content -->
                                <div id="modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Konfirmasi Data Absen</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <form action="<?= base_url(); ?>/student/absen/send" method="post">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Siswa</label>
                                                        <h3 class="card-title"><?= user()->fullname ?></h3>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal</label>
                                                        <h3 class="card-title"><?= tgl_indo(date("Y-m-d")); ?></h3>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Waktu</label>
                                                        <h3 class="card-title"><?php echo date("G:i")." WIB"; ?></h3>
                                                    </div>
                                                    <input type="hidden" name="user" value="<?= user()->id; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                 <!-- sample modal content -->
                                <div id="pulang" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Catatan Pembelajaran Hari ini</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <form action="<?= base_url(); ?>/student/absen/note" method="post">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <textarea name="note" class="editorz"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
<?= $this->endSection(); ?>