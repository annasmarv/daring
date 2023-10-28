<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
     <style>
      #map-canvas {
        width: 100;
        height: 500px;
      }
    </style>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAqhJ6sg9DMHKhLvWrzU s96NDMemaDXriw"></script>
    <script>
    var marker;
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }     
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var infoWindow = new google.maps.InfoWindow;      
        var bounds = new google.maps.LatLngBounds();
 
 
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
          function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                map: map,
                position: pt
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
 
          <?php
          foreach ($absens as $absen) {
	            $lat = $absen['XLatitude'];
	            $lon = $absen['XLongitude'];
	            $nama = addslashes($absen['fullname']);
	            echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                        
	          }
	      ?>
          }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
            <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body" style="padding: 5px!important">
                        <div class="d-flex align-items-center px-4 py-2">
                                        <h4 class="card-title">Detail Lokasi</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <a href="<?= base_url(); ?>/data/absensi?date=<?= $_GET['date']; ?>&class_id=<?= $_GET['class_id']; ?>"><button type="button" class="btn btn-md btn-light btn-round"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                                            </div>
                                        </div>
                                    </div>
                        <div class="content">
						    <div id="map-canvas"></div>
						</div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
<?= $this->endSection(); ?>