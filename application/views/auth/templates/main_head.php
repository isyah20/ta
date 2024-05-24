<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="hijWkKiAhFSsm_aEpQSjpe_MoKCMFgzlNGqo5Nz4NeI" />
	<title><?= $title . ' | TenderPlus' ?></title>
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

        input+div label { font-size: 14px; }

        .input100, .txt3 { font-size: var(--bs-body-font-size); }

        .label-input100 { top: 7px; }

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

        .txt3 a, .link-email {
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
        
        .sso:hover { background: #5e98f8; }
    </style>
</head>

<body style="background-image: url(<?= base_url("assets/auth/img/back-log.jpg") ?>); background-size: cover;">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">