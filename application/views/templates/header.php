<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?> | TenderPlus</title>
	<link rel="icon" href="<?= base_url('assets/img/logo-tab.jpg') ?>" type="image/jpeg">
	<link href=<?= base_url("assets/css/bootstrap/bootstrap.min.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/general/general.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/general/animate.min.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/home/style.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/tender/style.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/statistik/style.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/statistik/market.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/tender/timeline.css") ?> rel="stylesheet" type="text/css">
	<link href=<?= base_url("assets/css/users/preferensi.css") ?> rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js" rel="icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="<?= base_url("assets/js/home/echarts.js") ?>" type="text/javascript"></script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
	
	<script>
		const base_url = "<?= base_url() ?>";
		
		var opsi_toastr = {
            closeButton: false,
            progressBar: true,
            positionClass: "toast-top-center",
            preventDuplicates: true,
            timeOut: 5000
        }
	</script>
</head>
