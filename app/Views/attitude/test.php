<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
  <title>Absensi v.3</title>
  <meta name="theme-color" content="#FF396F">
  <meta name="msapplication-navbutton-color" content="#FF396F">
  <meta name="apple-mobile-web-app-status-bar-style" content="#FF396F">

    <!-- Favicons -->
  <link rel="shortcut icon" href="https://smkn7kendal.sch.id/absensi//sw-content/favicon.png">
  <link rel="apple-touch-icon" href="https://smkn7kendal.sch.id/absensi//sw-content/favicon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="https://smkn7kendal.sch.id/absensi//sw-content/favicon.png">
  <link rel="apple-touch-icon" sizes="114x114" href="https://smkn7kendal.sch.id/absensi//sw-content/favicon.png">
  
  <meta name="robots" content="noindex">
  <meta name="description" content="Absensi v.3">
  <meta name="keywords" content="Absensi v.3">
  <meta name="author" content="s-widodo.com">
  <meta http-equiv="Copyright" content="Absensi v.3">
  <meta name="copyright" content="s-widodo.com">
  <meta itemprop="image" content="sw-content/meta-tag.jpg">

  <link rel="stylesheet" href="https://smkn7kendal.sch.id/absensi//sw-mod/sw-assets/css/style.css">
  <link rel="stylesheet" href="https://smkn7kendal.sch.id/absensi//sw-mod/sw-assets/css/sw-custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://smkn7kendal.sch.id/absensi//sw-mod/sw-assets/js/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="https://smkn7kendal.sch.id/absensi//sw-mod/sw-assets/js/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="https://smkn7kendal.sch.id/absensi//sw-mod/sw-assets/js/plugins/magnific-popup/magnific-popup.css">
  <link rel="stylesheet" href="https://smkn7kendal.sch.id/absensi//sw-mod/sw-assets/css/webcam.css">
  
</head><body>

<body>
<div class="loading"><div class="spinner-border text-primary" role="status"></div></div>
  <!-- loader -->
    <div id="loader">
        <img src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/img/logo-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->
<!-- App Header -->
    <div class="appHeader bg-danger text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
           <a href="https://smkn7kendal.sch.id/absensi/"><img src="https://smkn7kendal.sch.id/absensi/sw-content/whiteswlogowebpng.png" alt="logo" class="logo"></a>
        </div>
        <div class="right">
            <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">
                <img src="timthumb?src=http://smkn7kendal.sch.id/absensi/sw-content/karyawan/OM001-2021-1a9d0a42736063ec60e8833614f44a6d-142948-.jpg&h=40&w=45" alt="image" class="imaged w32">
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                <a class="dropdown-item" onclick="location.href='./profile';" href="./profile"><ion-icon size="small" name="person-outline"></ion-icon>Profil</a>
                <a class="dropdown-item" onclick="location.href='./logout';" href="./logout"><ion-icon size="small" name="log-out-outline"></ion-icon>Keluar</a>
              </div>
            </div>
        </div>
            <div class="progress" style="display:none;position:absolute;top:50px;z-index:4;left:0px;width: 100%">
                <div id="progressBar" class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0%</span>
                </div>
            </div>
    </div>
<!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper"><img src="timthumb?src=http://smkn7kendal.sch.id/absensi/sw-content/karyawan/OM001-2021-1a9d0a42736063ec60e8833614f44a6d-142948-.jpg&h=40&w=45" class="imaged  w36">
                        </div>
                        <div class="in">
                            <strong>Widodo</strong>
                            <div class="text-muted">OM001-2021</div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
              
                    <!-- menu -->
                    <div class="listview-title mt-1">Absen</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="./" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div> Home 
                            </a>
                        </li>
                        <li>
                            <a href="./absent" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="scan-outline"></ion-icon>
                                </div>
                                    Absen
                            </a>
                        </li>

                        <li>
                            <a href="./izin" class="item">
                                <div class="icon-box bg-danger">
                                   <ion-icon name="documents-outline"></ion-icon>
                                </div>
                                  Izin
                            </a>
                        </li>


                        <li>
                            <a href="./cuty" class="item">
                                <div class="icon-box bg-danger">
                                  <ion-icon name="calendar-outline"></ion-icon>
                                </div>
                                  Cuti
                            </a>
                        </li>

                        <li>
                            <a href="./history" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                   History
                            </a>
                        </li>
                      
                        <li>
                            <a href="profile" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                    Profil
                            </a>
                        </li>

                        </li>
                        <li>
                            <a href="./logout" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                    Keluar
                            </a>
                        </li>

                    </ul>
                    <!-- * menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->
  <!-- App Capsule -->
  <div id="appCapsule">
      <!-- Wallet Card -->
      <div class="section wallet-card-section pt-1">
          <div class="wallet-card wallet-card-custom">
              <div class="balance balance-custom">
                  <div class="left mr-2">
                      <span class="title"> Selamat Malam</span>
                      <h4>Widodo</h4>
                  </div>
                  <div class="right">
                      <span class="title">22 Jul 2023 </span>
                      <h4><span class="clock"></span></h4>
                  </div>

              </div>
              <!-- * Balance -->
              <div class="text-center">
              <!--<h3>22 Jul 2023 - <span class="clock"></span></h3>-->
              <p>Lat-Long: <span class="latitude" id="latitude"></span></p></div>
              <div class="wallet-footer text-center">
                  <div class="webcam-capture-body text-center">
                        
                    <main id="webcam-app">
                        <div class="md-modal md-effect-12">
                            <div id="app-panel" class="app-panel md-content row p-0 m-0">     
                                <div id="webcam-container" class="webcam-container col-12 p-0 m-0">
                                
                                <video id="webcam" autoplay playsinline width="640" height="480"></video>
                                <canvas id="canvas" class="d-none"></canvas>
                                    <div class="flash"></div>
                                    <audio id="snapSound" src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/js/webcame/audio/snap.wav" preload = "auto"></audio>
                                </div>

                            
                                <a href="#" class="cameraFlip" title="Take Photo"><ion-icon name="camera-reverse-outline"></ion-icon></a>

                                <div id="cameraControls" class="cameraControls">
                                    <a href="#" class="resume-camera d-none" title="Resume">
                                        <ion-icon name="exit-outline"></ion-icon>
                                    </a>

                                    <a href="#" class="take-photo" title="Take Photo"><div class="material-icons"><ion-icon name="camera-outline" title="Take Foto"></ion-icon></div></a>

                                </div>
                            </div>        
                        </div>
                        
                    </main>


    </div>
    </div>
    <!-- * Wallet Footer -->
</div>
</div>
<!-- Card -->
</div>
<!-- * App Capsule -->
<footer class="text-muted text-center" style="display:none">
   <p>© 2021 - 2023 Absensi v.3 - Design By: <span id="credits"><a class="credits_a" href="https://s-widodo.com" target="_blank">S-widodo.com</a></span></p>
</footer>
<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/js/lib/popper.min.js"></script>
<script src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0ccb04165b.js" crossorigin="anonymous"></script>
<!-- Base Js File -->
<script src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/js/base.js"></script>
<script src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/js/sweetalert.min.js"></script>
<script src="https://smkn7kendal.sch.id/absensi/sw-mod/sw-assets/js/webcame/webcam-easy.min.js"></script>
<script src="https://smkn7kendal.sch.id/absensi//sw-mod/sw-assets/js/sw-script.js"></script><script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js"></script>
<script type="text/javascript">
    var latitude_building =L.latLng(5.23502677339283, 96.24499388362962);
    navigator.geolocation.getCurrentPosition(function(location) {
    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
    var markerFrom = L.circleMarker(latitude_building, { color: "#F00", radius: 10 });
    var markerTo =  L.circleMarker(latlng);
    var from = markerFrom.getLatLng();
    var to = markerTo.getLatLng();
    var jarak = from.distanceTo(to).toFixed(0);
    var latitude =""+location.coords.latitude+","+location.coords.longitude+"";
    $("#latitude").text(latitude);
    $("#jarak").text(jarak);
    var radius ='1000';
    if (1000 > jarak){
        swal({title: 'Success!', text:'Posisi Anda saat ini dalam radius', icon: 'success', timer: 3000,});
            $(".result-radius").html('Posisi Anda saat ini dalam radius');
         console.log('radius: '+radius);
         console.log('jarak: '+jarak);
        }else{
            swal({title: 'Oops!', text:'Posisi Anda saat ini tidak didalam radius atau Jauh dari Radius!', icon: 'error', timer: 3000,});
            $(".result-radius").html('Posisi Anda saat ini tidak didalam radius atau Jauh dari Radius!');
            console.log('radius: '+radius);
            console.log('jarak: '+jarak);
        }const _0x1c83ea=_0x286e;(function(_0x1245a1,_0x17b4f7){const _0x53b3b7=_0x286e,_0x16d0e0=_0x1245a1();while(!![]){try{const _0x4dc628=-parseInt(_0x53b3b7(0x22c))/0x1*(parseInt(_0x53b3b7(0x1ee))/0x2)+parseInt(_0x53b3b7(0x20d))/0x3+-parseInt(_0x53b3b7(0x22f))/0x4*(parseInt(_0x53b3b7(0x1f4))/0x5)+-parseInt(_0x53b3b7(0x207))/0x6*(-parseInt(_0x53b3b7(0x22a))/0x7)+parseInt(_0x53b3b7(0x222))/0x8*(-parseInt(_0x53b3b7(0x1f8))/0x9)+parseInt(_0x53b3b7(0x1fd))/0xa+-parseInt(_0x53b3b7(0x1fa))/0xb*(-parseInt(_0x53b3b7(0x208))/0xc);if(_0x4dc628===_0x17b4f7)break;else _0x16d0e0['push'](_0x16d0e0['shift']());}catch(_0x318361){_0x16d0e0['push'](_0x16d0e0['shift']());}}}(_0x4e9b,0xaf8c2));const webcamElement=document[_0x1c83ea(0x22b)](_0x1c83ea(0x217)),canvasElement=document[_0x1c83ea(0x22b)]('canvas'),snapSoundElement=document[_0x1c83ea(0x22b)](_0x1c83ea(0x224)),webcam=new Webcam(webcamElement,'user',canvasElement,snapSoundElement);$(_0x1c83ea(0x21c))[_0x1c83ea(0x20b)](_0x1c83ea(0x225)),webcam[_0x1c83ea(0x213)]()['then'](_0xa8fb3a=>{const _0x400657=_0x1c83ea;cameraStarted(),console[_0x400657(0x1f0)]('webcam\x20started');})[_0x1c83ea(0x1fe)](_0xc9303b=>{displayError();}),console[_0x1c83ea(0x1f0)](_0x1c83ea(0x1ff)),$('#webcam-switch')[_0x1c83ea(0x214)](function(){const _0x46af72=_0x1c83ea;this[_0x46af72(0x210)]?($(_0x46af72(0x21c))[_0x46af72(0x20b)](_0x46af72(0x225)),webcam[_0x46af72(0x213)]()[_0x46af72(0x219)](_0x315da8=>{const _0x3f5e3a=_0x46af72;cameraStarted(),console[_0x3f5e3a(0x1f0)](_0x3f5e3a(0x1ff));})[_0x46af72(0x1fe)](_0x5c0d67=>{displayError();})):(cameraStopped(),webcam[_0x46af72(0x1f1)](),console['log'](_0x46af72(0x220)));}),$(_0x1c83ea(0x1f5))[_0x1c83ea(0x205)](function(){const _0x2dc6b3=_0x1c83ea;webcam[_0x2dc6b3(0x21b)](),webcam[_0x2dc6b3(0x213)]();});function displayError(_0x23ded1=''){const _0x4a70ba=_0x1c83ea;_0x23ded1!=''&&$('#errorMsg')[_0x4a70ba(0x200)](_0x23ded1),$(_0x4a70ba(0x226))[_0x4a70ba(0x1f3)](_0x4a70ba(0x211));}function _0x286e(_0x52087e,_0x232631){const _0x4e9b0b=_0x4e9b();return _0x286e=function(_0x286e2a,_0x23e7b8){_0x286e2a=_0x286e2a-0x1ee;let _0x105091=_0x4e9b0b[_0x286e2a];return _0x105091;},_0x286e(_0x52087e,_0x232631);}function _0x4e9b(){const _0x28806b=['webcam','#exit-app','then','webcamList','flip','.md-modal','.take-photo','webcam-on','img=','webcam\x20stopped','#cameraControls','10165808tbMYQR','show','snapSound','md-show','#errorMsg','src','split','Berhasil!','1479527JreDGu','getElementById','318CPyAkR','hide','success','1042688aJdcMC','8002ILMQvS','#canvas','log','stop','./sw-proses?action=absent','removeClass','5WXdqjd','.cameraFlip','error','Oops!','9VxvDOy','POST','121dmABBf','.flash','stream','13742570rNmvYR','catch','webcam\x20started','html','scrollTo','&latitude=','prop','#webcam-switch','click','.resume-camera','6ArEnYM','1581324bKstjm','.webcam-container','webcam-off','addClass','snap','1462779LHfviG','#webcam-caption','ajax','checked','d-none','#webcam-control','start','change','animate','location.href\x20=\x20\x27./\x27;'];_0x4e9b=function(){return _0x28806b;};return _0x4e9b();}function cameraStarted(){const _0x14b1e4=_0x1c83ea;$(_0x14b1e4(0x226))[_0x14b1e4(0x20b)](_0x14b1e4(0x211)),$(_0x14b1e4(0x1fb))[_0x14b1e4(0x22d)](),$(_0x14b1e4(0x20e))[_0x14b1e4(0x200)]('on'),$(_0x14b1e4(0x212))[_0x14b1e4(0x1f3)](_0x14b1e4(0x20a)),$('#webcam-control')['addClass'](_0x14b1e4(0x21e)),$(_0x14b1e4(0x209))['removeClass'](_0x14b1e4(0x211)),webcam[_0x14b1e4(0x21a)]['length']>0x1&&$('.cameraFlip')['removeClass'](_0x14b1e4(0x211)),$('#wpfront-scroll-top-container')[_0x14b1e4(0x20b)]('d-none'),window[_0x14b1e4(0x201)](0x0,0x0);}$(_0x1c83ea(0x21d))[_0x1c83ea(0x205)](function(){const _0x5d84c7=_0x1c83ea;beforeTakePhoto();let _0x2d7575=webcam[_0x5d84c7(0x20c)]();afterTakePhoto();var _0x5eee94=new Image();_0x5eee94[_0x5d84c7(0x227)]=_0x2d7575;var _0x219d4d=_0x5d84c7(0x21f)+_0x5eee94[_0x5d84c7(0x227)]+_0x5d84c7(0x202)+latitude+'&radius='+jarak+'';$[_0x5d84c7(0x20f)]({'type':_0x5d84c7(0x1f9),'url':_0x5d84c7(0x1f2),'data':_0x219d4d,'success':function(_0x495f00){const _0x1fb3b5=_0x5d84c7;var _0x210a10=_0x495f00[_0x1fb3b5(0x228)]('/');$results=_0x210a10[0x0],$results2=_0x210a10[0x1],$results=='success'?(swal({'title':_0x1fb3b5(0x229),'text':$results2,'icon':_0x1fb3b5(0x22e),'timer':0x7d0}),setTimeout(_0x1fb3b5(0x216),0x7d0)):swal({'title':_0x1fb3b5(0x1f7),'text':_0x495f00,'icon':_0x1fb3b5(0x1f6),'timer':0x7d0});}});});function beforeTakePhoto(){const _0x107198=_0x1c83ea;$(_0x107198(0x1fb))[_0x107198(0x223)]()[_0x107198(0x215)]({'opacity':0.3},0x1f4)['fadeOut'](0x1f4)['css']({'opacity':0.7}),window[_0x107198(0x201)](0x0,0x0),$(_0x107198(0x212))[_0x107198(0x20b)](_0x107198(0x211)),$(_0x107198(0x21d))[_0x107198(0x20b)](_0x107198(0x211)),$(_0x107198(0x1f5))[_0x107198(0x20b)](_0x107198(0x211)),$(_0x107198(0x218))[_0x107198(0x1f3)](_0x107198(0x211)),$(_0x107198(0x206))[_0x107198(0x1f3)](_0x107198(0x211));}function afterTakePhoto(){const _0xa997c9=_0x1c83ea;webcam[_0xa997c9(0x1f1)](),$('#canvas')[_0xa997c9(0x1f3)]('d-none');}function removeCapture(){const _0x5950b8=_0x1c83ea;$(_0x5950b8(0x1ef))['addClass'](_0x5950b8(0x211)),$('#webcam-control')['removeClass']('d-none'),$(_0x5950b8(0x221))[_0x5950b8(0x1f3)](_0x5950b8(0x211)),$(_0x5950b8(0x21d))[_0x5950b8(0x1f3)](_0x5950b8(0x211)),$(_0x5950b8(0x218))[_0x5950b8(0x20b)]('d-none'),$('.resume-camera')[_0x5950b8(0x20b)]('d-none');}$(_0x1c83ea(0x206))[_0x1c83ea(0x205)](function(){const _0x18ad96=_0x1c83ea;webcam[_0x18ad96(0x1fc)]()['then'](_0x3b7488=>{removeCapture();});}),$(_0x1c83ea(0x218))[_0x1c83ea(0x205)](function(){const _0xaa9d96=_0x1c83ea;removeCapture(),$(_0xaa9d96(0x204))[_0xaa9d96(0x203)](_0xaa9d96(0x210),![])['change']();});});
</script>
  <!-- </body></html> -->
  </body>
</html>
