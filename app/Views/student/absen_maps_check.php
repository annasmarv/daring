<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-md btn-primary" onclick="getLocation()">Cek Lokasi</button>
                            <a href="<?= base_url(); ?>/student/absen" class="btn btn-md btn-primary">Kembali</a>
                            <div id="mapholder"></div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAqhJ6sg9DMHKhLvWrzU s96NDMemaDXriw"></script>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }

function showPosition(position)
  {
  var lat=position.coords.latitude;
  var lon=position.coords.longitude;
  var latlon=new google.maps.LatLng(lat, lon)
  var mapholder=document.getElementById('mapholder')
  mapholder.style.height='250px';
  mapholder.style.width='100%';

  var myOptions={
  center:latlon,zoom:14,
  mapTypeId:google.maps.MapTypeId.ROADMAP,
  mapTypeControl:false,
  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
  var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
  }

function showError(error)
  {
  switch(error.code) 
    {
    case error.PERMISSION_DENIED:
      x.innerHTML="User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML="Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML="The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML="An unknown error occurred."
      break;
    }
  }
</script>

<?= $this->endSection(); ?>