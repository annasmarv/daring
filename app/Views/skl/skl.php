<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?= base_url(); ?>/lulus/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/lulus/css/main.css">
	<style type="text/css">
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
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('imsages/img-01.jpg');">
			<div class="wrap-login100 p-b-30">
				<form class="login100-form validate-form">
					<div class="login100-form-avatar">
						<img src="/img/favicon.png" alt="">
					</div>

					<span class="login100-form-title p-t-5 p-b-15">
						PENGUMUMAN KELULUSAN SMK NEGERI 7 KENDAL <br>TAHUN PELAJARAN 2022/2023
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<div class="video-container-yt">
							<iframe src="https://www.youtube.com/embed/4CMBl1EktVs?autoplay=1&mute=1"></iframe>
						</div>
					</div>

					<?php $isdatetime = date('Y-m-d H:i:s'); if ($isdatetime >= '2021-06-03 17:00:00'): ?>
					<div class="container-login100-form-btn p-t-10">
						<span class="login100-form-title p-t-20 p-b-15">
							<div style="padding-bottom: 10px;">Selamat! Kamu dinyatakan</div>
							<b><i>LULUS</i></b>
						</span>
						<a href="<?= base_url(); ?>/skl/skl" style="color: white" class="login100-form-btn">
							Unduh SKL
						</a>
					</div>
					<!-- <div class="container-login100-form-btn p-t-10">
						<a href="<?= base_url(); ?>/skl/rapor" style="color: white" class="login100-form-btn">
							Unduh Rapor
						</a>
					</div> -->
					
					<?php endif ?>
				</form>
			</div>
		</div>
	</div>
	
	<script src="<?= base_url(); ?>/lulus/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url(); ?>/lulus/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url(); ?>/lulus/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>/lulus/vendor/select2/select2.min.js"></script>
	<script src="<?= base_url(); ?>/lulus/js/main.js"></script>
</body>
</html>