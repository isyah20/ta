<style>
    .dropdown-profile .nav-link { padding: 10px !important; }
    
    .dropdown-profile .dropdown-menu, .dropdown-menus .dropdown-menu { width: 240px; }
    
    .dropdown-profile li a.active, .dropdown-menus li a.active, .dropdown-profile li a:hover, .dropdown-menus li a:hover, .dropdown-profile a.nav-link:focus, .dropdown-profile a.nav-link:hover, .dropdown-item:focus {
        background: #c50000;
        border-radius: 0;
        padding: 10px !important;
    }
    
    .dropdown-profile .text-dropdown, .dropdown-menus .text-dropdown, .profile-dropdown h3 { font-size: 15px; }
    
    .profile-dropdown h4 { font-size: 14px; }
    
    #nav_paket {
        background: #ffa600;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 0 10px 0 10px;
    }
    
    .dropdown-item iconify-icon { color: #fff; }
</style>

<nav class="navbar bg-white shadow navbar-expand-md fixed-top">
	<div class="container-xl">
		<a class="navbar-brand" href="<?= base_url() ?>">
			<img src="<?= base_url("assets/img/logo-tender.png") ?>" alt="Logo TenderPlus" width="auto" height="40px">
		</a>
		<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
			<?php if ($this->uri->segment(1) != "verify") { ?>
				<ul class="navbar-nav mb-3 mb-md-0  mt-2 mt-lg-0 pe-lg-4 gap-3">
					<li class="nav-item">
						<a class="nav-link text-dark text-center <?= $this->uri->segment(1) == '' ? 'fw-bold active' : '' ?>" href="<?= base_url() ?>#beranda_home" aria-current="page">Beranda<span class="visually-hidden">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark text-center" href="<?= base_url() ?>#tender_home">Tender</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark text-center" href="<?= base_url() ?>#fitur_home">Fitur</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark text-center" href="<?= base_url() ?>#testimoni_home">Testimoni</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark text-center" href="<?= base_url() ?>#artikel">Artikel</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark text-center" href="<?= base_url('/pricing_plan') ?>">Paket</a>
					</li>
				</ul>
			<?php } ?>
			
			<div class="dropdown dropdown-profile nav-profile" style="display: none;">
                <a class="nav-link dropdown-toggle link-danger text-center p-2 rounded-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <iconify-icon inline icon="bi:person" width="20" height="20"></iconify-icon>
                </a>
                <ul class="dropdown-menu dropdown-menu-end my-2 p-0 rounded-3">
                    <li>
                        <div class="profile-dropdown d-flex align-self-center p-3 border-bottom">
                            <img class="img-profile-dropdown" src="" alt="Avatar">
                            <div class="text-white mx-2">
                                <h3 class="mb-1" id="nav_nama_pengguna"></h3>
                                <h4 class="mb-0 text-break mb-2" id="nav_jenis_perusahaan"></h4>
                                <span class="mb-0 text-break" id="nav_paket"></span>
                            </div>
                        </div>
                    </li>
                    <div>
                        <li>
                            <a class="py-2 dropdown-item d-flex" id="nav_dashboard" href="">
                                <div class="shape-rounded">
                                    <iconify-icon inline icon="bxs:dashboard" class="mt-1"></iconify-icon>
                                </div>
                                <p class="py-1 px-1 text-dropdown">Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a class="py-2 dropdown-item d-flex" href="<?= base_url('profile') ?>">
                                <div class="shape-rounded">
                                    <iconify-icon inline icon="bi:person-fill" class="mt-1"></iconify-icon>
                                </div>
                                <p class="py-1 px-1 text-dropdown">Profil</p>
                            </a>
                        </li>
                        <li>
                            <a class="py-2 dropdown-item d-flex" href="<?= base_url('preferensi') ?>">
                                <div class="shape-rounded">
                                    <iconify-icon inline icon="material-symbols:settings-suggest" class="mt-1"></iconify-icon>
                                </div>
                                <p class="py-1 px-1 text-dropdown">Preferensi</p>
                            </a>
                        </li>
                        <li>
                            <a class="py-2 dropdown-item d-flex" href="<?= base_url('logout') ?>" style="border-radius: 0 0 7px 7px !important;">
                                <div class="shape-rounded">
                                    <iconify-icon inline icon="ic:baseline-logout" class="mt-1"></iconify-icon>
                                </div>
                                <p class="py-1 px-1 text-dropdown">Keluar</p>
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
            
            <div class="gap-3 text-nowrap nav-auth" style="display: none;">
                <a href="<?= base_url('register') ?>" type="button" class="btn btn-custom-daftar mx-1 px-4">DAFTAR</a>
                <a href="<?= base_url('login') ?>" type="button" class="btn btn-custom-login ml-1 px-4">MASUK</a>
            </div>
		</div>
	</div>
</nav>

<script>
    $(document).ready(function () {
        var id_pengguna = Cookies.get('id_pengguna', { domain: 'tenderplus.id' });
        var nama_pengguna, foto, jenis, kategori, status, token;
        
        if (id_pengguna) {
            $('.nav-profile').show();
            $('.nav-auth').hide();
            
            $.ajax({
                type : 'GET',
                url : "<?= base_url('api/getProfilPengguna/') ?>"+id_pengguna,
                dataType: "JSON",
                success : function(data){
                    if (data != null) {
                        var jenis_perusahaan, paket;
                        
                        foto = data.foto;
                        if (foto != null && foto != '') $('.img-profile-dropdown, .img-profile').prop('src',"<?= base_url('uploads/') ?>" + foto);
                        else $('.img-profile-dropdown, .img-profile').prop('src',"<?= base_url('assets/img/img-profile-default.png') ?>");
            
                        nama_pengguna = data.nama;
                        jenis = data.jenis_perusahaan;
                        kategori = data.kategori;
                        status = data.status;
                        token = data.token;
                        
                        if (jenis == '1') jenis_perusahaan = 'Konsultan Badan Usaha';
                        else if (jenis == '2') jenis_perusahaan = 'Konsultan Perorangan';
                        else if (jenis == '3') jenis_perusahaan = 'Kontraktor';
                        else {
                            if (kategori == '3') jenis_perusahaan = 'Asosiasi';
                            else if (kategori == '4') jenis_perusahaan = 'Suplier';
                            else if (kategori == '5') jenis_perusahaan = 'Marketing';
                        }
                        
                        if (status == '0') paket = 'Standard';
                        else if (status == '1') paket = 'Premium';
                        else if (status == '2') paket = 'Trial';
                        
                        if (kategori == '2') $('#nav_dashboard').prop('href',"<?= base_url('user-dashboard') ?>");
                	    else if (kategori == '3') $('#nav_dashboard').prop('href',"<?= base_url('asosiasi') ?>");
                	    else if (kategori == '4') $('#nav_dashboard').prop('href',"<?= base_url('suplier') ?>");
                        else if (kategori == '5') $('#nav_dashboard').prop('href',"<?= base_url('marketing') ?>");
                        
                        $('#nav_nama_pengguna').html(nama_pengguna);
                        $('#nav_jenis_perusahaan').html(jenis_perusahaan);
                        $('#nav_paket').html(paket);
                    }
                }
            });
        } else {
            $('.dropdown-profile').hide();
            $('.nav-auth').show();
        }
        
    	$('.nav-item .nav-link').on('click', function() {
    		$('.nav-item .nav-link').removeClass('active').removeClass('fw-bold');
    		$(this).addClass('fw-bold active');
    	});
    })
</script>
