<?php $uri = service('uri'); ?>
<!DOCTYPE html>
<html translate="no">
<head>
    <meta name="google" content="notranslate">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= web()->meta_description; ?>">
    <meta name="keyword" content="<?= web()->meta_keyword; ?>">
    <meta name="author" content="Alkanet.ID">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/images/<?= web()->favicon; ?>">
    <title><?= $title; ?> - <?= web()->name; ?></title>
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- This page plugin CSS -->
    <link href="<?= base_url(); ?>/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/extra-libs/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/dist/css/style.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/dist/css/anz.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/dist/css/bootstrap-multiselect.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/css/countdowntimer.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <style type="text/css">
        a.disabsled {
            pointer-events: none;
            cursor: default;
        }
        .btn{
            font-weight: 500!important;
        }
        .btn-round {
            border-radius: .375rem;
        }

        .form-control {
            border-radius: .375rem;
        }
        .example::-webkit-scrollbar {
          display: none;
        }

        .font-24{
            font-size: 24px!important;
        }

        .font-18{
            font-size: 18px!important;
        }

        .font-16{
            font-size: 16px!important;
        }

        .font-14{
            font-size: 14px!important;
        }

        .font-12{
            font-size: 12px!important;
        }

        .msr-p{
            padding-top: 5px!important;
        }

        .input-ijo .custom-control-input:checked~.input-ijo .custom-control-label::before{
            background-color: green!important;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .example {
          -ms-overflow-style: none;  /* IE and Edge */
          scrollbar-width: none;  /* Firefox */
        }
        .video-container-yt {
            position: relative;
            padding-bottom: 56.25%;
            padding-top: 30px; height: 0; overflow: hidden;
        }

        .video-container-yt iframe,
        .video-container-yt object,
        .video-container-yt embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .card-profile-image {
            padding: 10px 70px;
            text-align: center;

        }

        .card-profile-image img {
            max-width: 180px;
            border-radius: 0.375rem;
            transform: translate(0%, -30%);
            transition: all 0.15s ease;
        }

        .card-profile-image img:hover {
            transform: translate(0%, -33%);
        }

        .sticky {
          position: fixed;
          top: 0;
          right: 0;
          width: 100%;
          background: white;
          border-radius: 0;
          border-bottom: 3px solid rgba(0,0,0,.03)!important;
        }

        .sticky + .content {
          padding-top: 102px;
        }

        .card-body img{
            overflow: scroll;
        }
        
        .card-body img{
            max-width: 100%;
        }
        
        @media (min-width: 780px){
            #dis{
                display: none;
            }
            .disfoot{
                margin-bottom: 0px!important;
            }
        }
        .row .modul img{
            max-width: 100%;
            height: auto;
        }
        .card-s{
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s 
            -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
        }
        .card-s:hover{
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }

        .bgx-success{
            background-color: #e6f4ea;
        }
        .bgx-danger{
            background-color: #fce8e6;
        }
    </style>
    <script src="<?= base_url(); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- TinyMCE 5.x -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/extra-libs/tinymce5/tinymce.min.js"></script>
    <script>
        tinymce.init({
        selector: 'textarea.editorz ',
        menubar: false,
        plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons code',
        menubar: 'file edit view insert format tools table tc help',
        toolbar: 'undo redo image | fontsizeselect formatselect | bold italic underline superscript subscript | alignleft aligncenter alignright alignjustify | numlist bullist | fullscreen | outdent indent | forecolor backcolor casechange permanentpen formatpainter removeformat | charmap emoticons | link anchor codesample | ltr rtl code|',
        images_upload_url: '<?= base_url(); ?>/img/upload.php',
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        forced_root_block: "",
        image_advtab: true,
        relative_urls : false,
        remove_script_host : false,
        document_base_url : '<?= base_url(); ?>',
        importcss_append: true,
        images_upload_handler: function(blobInfo, success, failure) {
          var xhr, formData;

          xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open('POST', '<?= base_url(); ?>/img/upload.php');

          xhr.onload = function() {
              var json;
              if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
              }

              json = JSON.parse(xhr.responseText);
              if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
              }
              success(json.location);
          };

          xhr.onerror = function () {
              failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
          };

          formData = new FormData();
          formData.append('file', blobInfo.blob(), blobInfo.filename());
          xhr.send(formData);
        } });
    </script>
</head>
<body>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="" data-boxed-layout="full">
        <!-- Topbar header - style you can find in pages.scss -->
        <?= $this->include('templates/topbar'); ?>
        <!-- End Topbar header -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?= $this->include('templates/sidebar'); ?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- Page wrapper  -->
        <div class="page-wrapper disfoot" style="margin-bottom: 50px">

            <?= $this->renderSection('content'); ?> 

            <footer class="footer text-center text-muted">
                <?= web()->footer; ?>
            </footer>
        </div>
        <style type="text/css">
            .nav-index ul{
                list-style: none;
                margin: 0 auto;
                width: 100%;
                padding: 10px;
                color: #202020;
            }
            .nav-index li{
                float: left;
                width: 20%;
                font-size: 12px;
                text-align: center;
                padding: 7px 10px;
            }
            .nav-index a{
                float: left;
                width: 100%;
                color: #202020;
            }
            .nav-index i{
                font-size: 15px;
                color: #202020;
            }
            .nav-index span{
                font-size: 13px;
            }
            .nav-index .material-symbols-rounded{
                font-size: 24px!important;
            }
            .selectedd a, .selectedd i{
                color: #df0000;
            }
        </style>
        <?php if (in_groups('student')): ?>
        <footer id="dis" class="nav-index bg-white text-center" style="margin: auto; position: fixed; bottom: 0;  width: 100%!important;box-shadow: rgba(0,0,0,.2) 0 1px 4px 0">
            <ul>
                <li>
                    <a href="<?= base_url(); ?>"><span class="material-symbols-rounded">home</span></i><br><span>Beranda</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/student/tasks"><span class="material-symbols-rounded">design_services</span><br><span>Tugas</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/student/absen"><span class="material-symbols-rounded">pin_drop</span><br><span>Absensi</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/student/classes"><span class="material-symbols-rounded">local_library</span><br><span>Kelas Ku</span></a>
                </li>
                <li>
                    <!-- <a href="index.php?page=more"><i class="fa fa-bars"></i><br><span>Menu</span></a> -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><span class="material-symbols-rounded">menu</span><br><span>Menu</span></a>
                </li>
            </ul>
        </footer>
        <?php endif ?>
                <?php if (in_groups(['admin', 'teacher'])): ?>
        <footer id="dis" class="nav-index bg-white text-center" style="margin: auto; position: fixed; bottom: 0;  width: 100%!important;box-shadow: rgba(0,0,0,.2) 0 1px 4px 0">
            <ul>
                <li>
                    <a href="<?= base_url(); ?>"><span class="material-symbols-rounded">home</span><br><span>Beranda</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/learn/task"><span class="material-symbols-rounded">design_services</span><br><span>Tugas</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/learn/journal"><span class="material-symbols-rounded">checklist_rtl</span><br><span>Jurnal</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/learn/classes"><span class="material-symbols-rounded">local_library</span><br><span>Kelasku</span></a>
                </li>
                <li>
                    <!-- <a href="index.php?page=more"><i class="fa fa-bars"></i><br><span>Menu</span></a> -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><span class="material-symbols-rounded">menu</span><br><span>Menu</span></a>
                </li>
            </ul>
        </footer>
        <?php endif ?>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url(); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/js/countdowntimer.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="<?= base_url(); ?>/dist/js/app-style-switcher.js"></script>
    <script src="<?= base_url(); ?>/dist/js/feather.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= base_url(); ?>/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url(); ?>/dist/js/custom.min.js"></script>
    <!--This page plugins -->
    <script src="<?= base_url(); ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--This page JavaScript -->
    <script src="<?= base_url(); ?>/assets/extra-libs/c3/d3.min.js"></script>
    <script src="<?= base_url(); ?>/assets/extra-libs/c3/c3.min.js"></script>
    <script src="<?= base_url(); ?>/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= base_url(); ?>/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= base_url(); ?>/dist/js/bootstrap-multiselect.js"></script>
    <script>
        function previewImg() {
            const sampul = document.querySelector('#sampul');
            const sampulLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');
            
            sampulLabel.textContent = sampul.files[0].name;
            
            const fileSampul = new FileReader();
            
            fileSampul.readAsDataURL(sampul.files[0]);
            
            fileSampul.onload = function (e) {
                imgPreview.src = e.target.result;
            }
        }

        $('#period').on('change', function() {
            var e = document.getElementById("period");
            var value = e.value;
            window.location.replace("<?= base_url(); ?>/home/period/"+value);
        });

        $(document).ready(function() {
            $('.#mutiselect').multiselect();
        });

        jQuery(document).ready(function($){
            $('.select2').select2({
                placeholder: "Pilih Data"
            });
            $('b[role="presentation"]').hide();
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#kelas').multiselect();
    });
</script>
</body>

</html>