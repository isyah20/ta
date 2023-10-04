<style>
    .profile-nav {
        background: #DF3131;
        padding: 8px;
    }

    .profile-nav .nav-item .nav-link.active {
        background: #c50000;
        padding: 10px 15px;
        border-radius: 7px;
    }

    ul.navbar-nav {
        padding-right: 15px !important;
    }

    .dropdown-profile .nav-link {
        padding: 10px !important;
    }

    .dropdown-profile .dropdown-menu,
    .dropdown-menus .dropdown-menu {
        width: 240px;
    }

    .dropdown-profile li a.active,
    .dropdown-menus li a.active,
    .dropdown-profile li a:hover,
    .dropdown-menus li a:hover,
    .dropdown-profile a.nav-link:focus,
    .dropdown-profile a.nav-link:hover,
    .dropdown-item:focus {
        background: #c50000;
        border-radius: 0;
        padding: 10px !important;
    }

    .dropdown-profile .text-dropdown,
    .dropdown-menus .text-dropdown,
    .profile-dropdown h3 {
        font-size: 15px;
    }

    .profile-dropdown h4 {
        font-size: 14px;
    }

    #nav_paket {
        background: #ffa600;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 0 10px 0 10px;
    }

    .dropdown-item iconify-icon {
        color: #fff;
    }
</style>

<nav class="navbar profile-nav navbar-expand-md fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img class="py-1" src="<?= base_url("assets/img/logo_footer.png") ?>" alt="Logo TenderPlus" style="width: 20%;">
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
            <ul class="navbar-nav mb-3 mb-md-0  mt-2 mt-lg-0 pe-lg-4 gap-3">
                <li class="nav-item">
                    <a class="nav-link text-white link-danger text-center fw-bold" href="" id="nav_dashboard">Dashboard</a>
                </li>

                <?php 
                use App\components\UserCategory;
                use App\components\UserType;
                use App\components\CompanyType;

                // $this->load->library('input');
                $userCat = $_COOKIE['kategori'];
                $userStatus = $_COOKIE['status'];
                $isProfileComplete = $_COOKIE['lengkap']; 
                $companyType = $_COOKIE['jenis_perusahaan'];

                if ($userCat == UserCategory::SRV_PROVIDER && $isProfileComplete && in_array($userStatus, [UserType::TRIAL, UserType::PAID])) : ?>
                    <li class="nav-item dropdown dropdown-profile">
                        <a class="nav-link dropdown-toggle text-white link-danger text-center" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>Analytics</b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end my-2 p-0 rounded-3">
                            <li>
                                <a class="py-2 dropdown-item d-flex position-relative" href="<?= base_url('user-dashboard/market') ?>">
                                    <div class="shape-rounded">
                                        <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                    </div>
                                    <p class="px-2 text-dropdown">Analisis Pasar</p>
                                </a>
                            </li>
                            <?php if ($companyType == CompanyType::PERSONAL_CONSULTANT || $companyType == CompanyType::ENT_BUSINESS_CONSULTANT): ?>
                                <li>
                                    <a class="py-2 dropdown-item d-flex position-relative rounded-bottom" href="<?= base_url('competitor') ?>">
                                        <div class="shape-rounded">
                                            <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                        </div>
                                        <p class="px-2 text-dropdown">Analisis Kompetitor</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if($userCat == UserCategory::SUPPLIER && in_array($userStatus, [UserType::TRIAL, UserType::PAID])) : ?>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-white link-danger text-center fw-bold" href="<?= base_url('suplier/marketing') ?>" id="nav_dashboard">Marketing</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-white link-danger text-center fw-bold" href="<?= base_url('suplier/leads') ?>" id="nav_dashboard">Leads</a>
                    </li>
                    <li class="nav-item dropdown dropdown-profile">
                        <a class="nav-link dropdown-toggle text-white link-danger text-center" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>Marketing</b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end my-2 p-0 rounded-3">
                            <li>
                                <a class="py-2 dropdown-item d-flex position-relative rounded-bottom" href="<?= base_url('suplier/marketing') ?>">
                                    <div class="shape-rounded">
                                        <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                    </div>
                                    <p class="px-2 text-dropdown">Manage Marketing</p>
                                </a>
                            </li>
                            <li>
                                <a class="py-2 dropdown-item d-flex position-relative rounded-bottom" href="<?= base_url('suplier/crm') ?>">
                                    <div class="shape-rounded">
                                        <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                    </div>
                                    <p class="px-2 text-dropdown">Plotting Tim</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    
                    <!-- <li class="nav-item dropdown dropdown-profile">
                        <a class="nav-link dropdown-toggle text-white link-danger text-center" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>Analytics</b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end my-2 p-0 rounded-3">
                            <li>
                                <a class="py-2 dropdown-item d-flex position-relative" href="<?= base_url('market') ?>">
                                    <div class="shape-rounded">
                                        <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                    </div>
                                    <p class="px-2 text-dropdown">Analisis Pasar</p>
                                </a>
                            </li>
                            <li>
                                <a class="py-2 dropdown-item d-flex position-relative rounded-bottom" href="<?= base_url('competitor') ?>">
                                    <div class="shape-rounded">
                                        <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                    </div>
                                    <p class="px-2 text-dropdown">Analisis Kompetitor</p>
                                </a>
                            </li>
                            <li>
                                <a class="py-2 dropdown-item d-flex position-relative rounded-bottom" href="">
                                    <div class="shape-rounded">
                                        <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                    </div>
                                    <p class="px-2 text-dropdown">Data Leads</p>
                                </a>
                            </li>
                            <li>
                                <a class="py-2 dropdown-item d-flex position-relative rounded-bottom" href="">
                                    <div class="shape-rounded">
                                        <iconify-icon icon="ic:outline-analytics" style="color: white;" width="18px" height="25px"></iconify-icon>
                                    </div>
                                    <p class="px-2 text-dropdown">Plotting Tim</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                <?php endif; ?>
            </ul>

            <div class="dropdown dropdown-profile d-md-block">
                <a class="nav-link dropdown-toggle text-white link-danger text-center p-2 rounded-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <iconify-icon inline icon="bi:person" width="20" height="20"></iconify-icon>
                </a>
                <ul class="dropdown-menu dropdown-menu-end my-2 p-0 rounded-3">
                    <li>
                        <div class="profile-dropdown d-flex align-self-center p-3 border-bottom">
                            <img class="img-profile-dropdown" src="" alt="Avatar">
                            <div class="text-white mx-2">
                                <h3 class="mb-1 nama-pengguna"></h3>
                                <h4 class="mb-0 text-break mb-2" id="nav_jenis_perusahaan"></h4>
                                <span class="mb-0 text-break" id="nav_paket"></span>
                                <input type="hidden" id="jenis_user">
                                <input type="hidden" id="kategori_user">
                                <input type="hidden" id="status_user">
                            </div>
                        </div>
                    </li>
                    <div>
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
        </div>
    </div>
</nav>

<script>
    var id_pengguna, nama_pengguna, foto;

    $(document).ready(function() {
        id_pengguna = Cookies.get('id_pengguna', {
            // domain: 'tenderplus.id'
            domain: 'tenderplus.test'
            // domain = 'localhost/tenderplus'
        });

        if (id_pengguna) {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('api/getProfilPengguna/') ?>" + id_pengguna,
                dataType: "JSON",
                success: function(data) {
                    if (data != null) {
                        let jenis, kategori, status, token, jenis_perusahaan, paket, url_dashboard;

                        foto = data.foto;
                        if (foto != null && foto != '') $('.img-profile-dropdown, .img-profile').prop('src', "<?= base_url('uploads/') ?>" + foto);
                        else $('.img-profile-dropdown, .img-profile').prop('src', "<?= base_url('assets/img/img-profile-default.png') ?>");

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
                        }

                        if (status == '0') paket = 'Standard';
                        else if (status == '1') paket = 'Premium';
                        else if (status == '2') paket = 'Trial';

                        if (kategori == '2') url_dashboard = "<?= base_url('user-dashboard') ?>";
                        else if (kategori == '3') url_dashboard = "<?= base_url('asosiasi') ?>";
                        else if (kategori == '4') url_dashboard = "<?= base_url('suplier') ?>";

                        $('#nav_dashboard').prop('href', url_dashboard);
                        $('.nama-pengguna').html(nama_pengguna);
                        $('#nav_jenis_perusahaan').html(jenis_perusahaan);
                        $('#nav_paket').html(paket);
                        $('#jenis_user').val(jenis);
                        $('#kategori_user').val(kategori);
                        $('#status_user').val(status);
                    }
                }
            });
        } else window.location.href = "<?= base_url('login') ?>";

        $('.nav-item .nav-link').on('click', function() {
            $('.nav-item .nav-link').removeClass('active').removeClass('fw-bold');
            $(this).addClass('fw-bold active');
        });
    })
</script>