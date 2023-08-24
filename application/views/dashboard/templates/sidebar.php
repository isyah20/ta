        <!-- Sidebar -->
        <ul class="navbar-nav sidebar accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("home") ?>">
                <!-- <div class="sidebar-brand-text mx-3">tender<span class="supertext">+</span></div> -->
                <img src="<?= base_url('assets/img/logo-tender.png') ?>" width="130px" alt="">
            </a>
            <div class="jutify-content-center">
                <hr style="width:auto; color:#F8A5A5; height:2px; " />
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item mt-3 ">
                <a class="nav-link collapsed" href="<?= base_url("pengguna") ?>">
                    <img src="<?= base_url("assets/img/box-dash.svg") ?>" alt="">
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsePengguna" aria-expanded="false" aria-controls="flush-collapseOne">
                    <img src="<?= base_url("assets/img/akun_profile.svg") ?>" alt="">
                    <span>Perngguna</span>
                    <p class="d-flex justify-content-end" style="margin-top: -30px; padding-left:10px;">
                        <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" style="color: white;  margin-top:5%"></iconify-icon>
                    </p>
                </a>
                <ul class=" submenu pengguna py-2 accordion-collapse tender collapse" id="flush-collapsePengguna" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <li>
                        <p class="description_top">Perngguna</p>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'pengguna' ?>" class="dropdown-item">
                            <p class="description">Pengguna</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'peserta' ?>" class="dropdown-item">
                            <p class="description">Peserta</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseLPSE" aria-expanded="false" aria-controls="flush-collapseOne">
                    <img src="<?= base_url("assets/img/lpse_icon_admin.svg") ?>" alt="">
                    <span>LPSE</span>
                    <p class="d-flex justify-content-end" style="margin-top: -30px; padding-left:10px;">
                        <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" style="color: white;  margin-top:5%"></iconify-icon>
                    </p>
                </a>
                <ul class="submenu pengguna py-2 accordion-collapse tender collapse" id="flush-collapseLPSE" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <li>
                        <p class="description_top">LPSE</p>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'lpse' ?>" class="dropdown-item">
                            <p class="description">LPSE</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'kategori-lpse' ?>" class="dropdown-item">
                            <p class="description">Kategori LPSE</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'preferensi' ?>" class="dropdown-item">
                            <p class="description">Preferensi</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'wilayah' ?>" class="dropdown-item">
                            <p class="description">Wilayah</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseJadwal" aria-expanded="false" aria-controls="flush-collapseOne">
                    <img src="<?= base_url("assets/img/jadwal_icon_admin.svg") ?>" alt="">
                    <span>Jadwal</span>
                    <p class="d-flex justify-content-end" style="margin-top: -30px; padding-left:10px;">
                        <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" style="color: white;  margin-top:5%"></iconify-icon>
                    </p>
                </a>
                <ul class=" submenu pengguna py-2 accordion-collapse tender collapse" id="flush-collapseJadwal" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <li>
                        <p class="description_top">Jadwal</p>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'jadwal' ?>" class="dropdown-item">
                            <p class="description">Jadwal</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'tahapan' ?>" class="dropdown-item">
                            <p class="description">Tahapan</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTender" aria-expanded="false" aria-controls="flush-collapseOne">
                    <img src="<?= base_url("assets/img/tender_icon_admin.svg") ?>" alt="">
                    <span>Tender</span>
                    <p class="d-flex justify-content-end" style="margin-top: -30px; padding-left:10px;">
                        <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" style="color: white;  margin-top:5%"></iconify-icon>
                    </p>
                </a>
                <ul class=" submenu pengguna py-2 accordion-collapse tender collapse" id="flush-collapseTender" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <li>
                        <p class="description_top">Tender</p>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'tender' ?>" class="dropdown-item">
                            <p class="description">Tender</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item">
                            <p class="description">Detail Tender</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'jenis-tender' ?>" class="dropdown-item">
                            <p class="description">Jenis Tender</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'hasil_evaluasi' ?>" class="dropdown-item">
                            <p class="description">Hasil Evaluasi</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'pemenang' ?>" class="dropdown-item">
                            <p class="description">Pemenang</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'peserta-tender' ?>" class="dropdown-item">
                            <p class="description">Peserta Tender</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'rup' ?>" class="dropdown-item">
                            <p class="description">RUP</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() . 'syarat_kualifikasi' ?>" class="dropdown-item">
                            <p class="description">Syarat Kualifikasi</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url() . 'artikel' ?>">
                    <img src="<?= base_url("assets/img/tenderlist_profile.svg") ?>" alt="">
                    <span>Artikel</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">