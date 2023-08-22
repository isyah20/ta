<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>
	<link rel="icon" href="<?= base_url('assets/img/logo-tab.jpg') ?>" type="image/jpeg">
	<link href=<?= base_url("assets/css/bootstrap/bootstrap.min.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/home/style.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/statistik/style.css") ?> rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= base_url("assets/auth/css/main.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("assets/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css") ?>">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">

	<!-- jquery -->
	<script src="<?= base_url("assets/js/jquery-3.6.1.min.js") ?>"> </script>
	<style>
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}

		.field-icon-l {
			color: #db2828;
			margin-left: -40px;
		}
	</style>
	<!--END MAP-->
	<style>
		body {
			background-color: #F7F7F7;
		}
	</style>
    <script type="text/javascript">
    const base_url = '<?= base_url() ?>';
    </script>
</head>

<body>
<?php
// untuk mendapatkan url sekarang. contoh: verify/ezRDp5wgAxUjYdQV6Nmvq2hC0
// uri_string()?>
