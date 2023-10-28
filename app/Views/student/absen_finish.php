<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<?php if ($isA == NULL): ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        navigator.geolocation.getCurrentPosition(function (position) {
             tampilLokasi(position);
        }, function (e) {
            alert('Geolocation Tidak Mendukung Pada Browser Anda');
            window.location.href = "<?= base_url(); ?>/absen";
        }, {
            enableHighAccuracy: true
        });
    });

    function tampilLokasi(posisi) {
        //console.log(posisi);
        var seti        = '1';
        var latitude    = posisi.coords.latitude;
        var longitude   = posisi.coords.longitude;
        $.ajax({
            type    : 'POST',
            url     : '<?= base_url('student/absen/cek');?>',
            data : {
                latitude : latitude,
                longitude : longitude
            },
            
            success: function(msg){
        alert( "Absensi Berhasil: " + msg );
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
     alert("Absensi Gagal !");
  }
        })
    }
</script>
<?php endif ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Absensi</h4>
                        <p class="card-text">Terima kasih sudah melaksanakan absensi, silahkan cek menu hasil absensi hari ini</p> 
                        <a href="<?= base_url(); ?>/student/absen/report" class="text-white btn btn-warning">Laporan</a>
                        <a href="<?= base_url(); ?>/student/absen" class="text-white btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>