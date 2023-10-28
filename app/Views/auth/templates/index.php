<!DOCTYPE html>
<html dir="ltr">
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
    <title>Login - <?= web()->name; ?></title>
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/dist/css/style.min.css" rel="stylesheet">
    <style type="text/css">
        @media (max-width: 730px){
            #dis{
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <!-- Login box.scss -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(<?= base_url(); ?>/assets/images/background/active-bg.png) repeat center center;">
            <div class="auth-box row">
                <div id="dis" class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(<?= base_url(); ?>/assets/images/big/<?= web()->login_image; ?>);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <?= $this->renderSection('main'); ?>
                </div>
            </div>
        </div>
        <!-- Login box.scss -->
    </div>
    <!-- All Required js -->
    <script src="<?= base_url(); ?>/assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url(); ?>/assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="<?= base_url(); ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- This page plugin js -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>