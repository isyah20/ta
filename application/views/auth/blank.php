<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="hijWkKiAhFSsm_aEpQSjpe_MoKCMFgzlNGqo5Nz4NeI" />
    <title><?= 'Verfikasi | TenderPlus' ?></title>
    <link rel="icon" href="<?= base_url('assets/img/logo-tab.jpg') ?>" type="image/jpeg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" type="text/css">
    <link href=<?= base_url("assets/css/bootstrap/bootstrap.min.css") ?> rel="stylesheet" type="text/css">
    <link href=<?= base_url("assets/css/general/animate.min.css") ?> rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/auth/css/util.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/auth/css/main.css?v=0.4.1") ?>">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--<script src="<?= base_url("assets/js/jquery-3.6.1.min.js") ?>"> </script>-->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>



    <!--<link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js">-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet" type="text/css">-->
    <!--<link rel="stylesheet" type="text/css" href="<?= base_url("assets/auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css") ?>">-->

    <style>
        .slideshomore-title {
            color: #fff;
            font-size: 18px;
            margin-bottom: 10px;
            padding: 0 50px;
        }

        .text {
            color: #fff;
            font-size: var(--bs-body-font-size);
            line-height: 1.4;
        }

        hr {
            border-top: 4px solid #BF0C0C;
            opacity: 1;
            margin-top: 5px;
        }

        .login100-form-subtitle {
            font-size: var(--bs-body-font-size);
            line-height: 1.4;
        }

        input+div label {
            font-size: 14px;
        }

        .input100,
        .txt3 {
            font-size: var(--bs-body-font-size);
        }

        .label-input100 {
            top: 7px;
        }

        .login100-form-btn {
            height: 45px;
            border-radius: 3px;
            font-size: var(--bs-body-font-size);
            font-weight: 500;
            letter-spacing: 0;
        }

        .txt1 {
            font-size: var(--bs-body-font-size);
            text-decoration: none;
        }

        .txt3 a,
        .link-email {
            font-weight: 500;
            color: #DB2828;
            font-size: var(--bs-body-font-size);
            margin-left: 5px;
            text-decoration: none;
        }

        hr.atau {
            border-top: 1px solid #bbb2b2;
            color: #7d7b7b;
        }

        hr.atau::after {
            font-size: 15px;
            margin-top: 7px;
        }

        .sso {
            letter-spacing: 0;
            border: 0;
            color: #fff;
            background: #4285f4;
            font-size: var(--bs-body-font-size);
        }

        .sso:hover {
            background: #5e98f8;
        }
    </style>
</head>

<body style="background-image: url(<?= base_url("assets/auth/img/back-log.jpg") ?>); background-size: cover;">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <a href="<?= base_url() ?>" class="customButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                </a>

                <span class="login100-form-title">
                    <img src="<?= base_url("assets/auth/img/logo-tender.png") ?>" width="45%" alt="">
                    <hr class="mb-3">
                </span>

                <div class="login100-more">
                    <div class="mx-2 my-2">
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success text-center" rWole="alert">
                                <h5 class="alert-heading mb-3">Verifikasi Sukses!</h5>
                                <p class="text-left"> <?php echo $this->session->flashdata('success'); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('warning')) : ?>
                            <div class="alert alert-warning text-center" rWole="alert">
                                <h5 class="alert-heading mb-3">Peringatan Verifikasi!</h5>
                                <p class="text-left"> <?php echo $this->session->flashdata('warning'); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger text-center" rWole="alert">
                                <h5 class="alert-heading mb-3">Verifikasi Error!</h5>
                                <p class="text-left"> <?= $this->session->flashdata('error') ?></p>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="slideshow-container">
                        <div class="mySlides fade">
                            <img src="<?= base_url('assets/auth/img/login-more.png') ?>" width="60%" style="margin-top: 10px;">
                            <div class="slideshomore-title">Dapatkan Notifikasi Realtime</div>
                            <div class="text">Setiap terdapat tender terbaru Anda akan mendapatkan pemberitahuan secara cepat</div>
                        </div>

                        <div class="mySlides fade">
                            <img src="<?= base_url('assets/auth/img/login-more.png') ?>" width="60%" style="margin-top: 10px;">
                            <div class="slideshomore-title">Pantau Tender Dengan Mudah</div>
                            <div class="text">Tender yang sedang Anda ikuti dapat dipantau dimanapun dan kapanpun dengan mudah</div>
                        </div>

                        <div class="mySlides fade">
                            <img src="<?= base_url('assets/auth/img/login-more.png') ?>" width="60%" style="margin-top: 10px;">
                            <div class="slideshomore-title">Atur Preferensi Tender</div>
                            <div class="text">Kelola pengaturan pemberitahuan Anda untuk mendapatkan pemberitahuan sesuai dengan keinginan</div>
                        </div>
                    </div>
                    <br>

                    <div style="text-align:center">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/auth/vendor/animsition/js/animsition.min.js') ?>"></script>
    <script src="<?= base_url('assets/auth/vendor/bootstrap/js/popper.js') ?>"></script>
    <script src="<?= base_url('assets/auth/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/auth/js/main.js') ?>"></script>

    <!--<script src="<?= base_url('assets/auth/vendor/select2/select2.min.js') ?>"></script>-->
    <!--<script src="<?= base_url('assets/auth/vendor/daterangepicker/moment.min.js') ?>"></script>-->
    <!--<script src="<?= base_url('assets/auth/vendor/daterangepicker/daterangepicker.js') ?>"></script>-->
    <!--<script src="<?= base_url('assets/auth/vendor/countdowntime/countdowntime.js') ?>"></script>-->
    <!--<script src="<?= base_url('assets/auth/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

    <script>
        /*function enableButton() {
		var timer2 = "00:03";

		var interval = setInterval(function() {
			var timer = timer2.split(':');
			//by parsing integer, I avoid all extra string processing
			var minutes = parseInt(timer[0], 10);
			var seconds = parseInt(timer[1], 10);
			--seconds;
			minutes = (seconds < 0) ? --minutes : minutes;
			if (minutes < 0) clearInterval(interval);
			seconds = (seconds < 0) ? 59 : seconds;
			//minutes = (minutes < 10) ?  minutes : minutes;
			$('.countdown').html(minutes + ':' + seconds);
			timer2 = minutes + ':' + seconds;
			if (minutes === 0 && seconds === 0) {
				clearInterval(interval);
				document.getElementById('countdown').style.display = "none";
				document.getElementById('demo').removeAttribute('disabled');
			} else {
				document.getElementById('demo').setAttribute('disabled', true);
			}

		}, 1000);
	}

	$('#demo').click(function() {
		enableButton();
	});

	enableButton();*/

        $('.toggle-password').click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");

            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") input.attr("type", "text");
            else input.attr("type", "password");
        });
    </script>

</body>

</html>