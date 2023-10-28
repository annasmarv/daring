<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Absensi</h4>
                        <p class="card-text">Terima kasih sudah melaksanakan absensi, silahkan cek menu hasil absensi hari ini</p> 
                        <a href="<?= base_url(); ?>/student/absen/report" class="text-white btn btn-warning">Laporan</a>
                        <a href="<?= base_url(); ?>/student/absen/" class="text-white btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>