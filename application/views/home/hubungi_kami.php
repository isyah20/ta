<style>
    .form-style {
        font-weight: 400;
        font-size: var(--bs-body-font-size);
        letter-spacing: 0;
    }
    
    .input-icon { top: 0; }
</style>

<section class="mt-5">
    <div class="container-lg py-5">
        <div class="wow fadeInUp mb-4 text-center" data-bs-ride="about" data-wow-delay="0.1s">
            <img src="<?= base_url("assets/img/hubungi-kami.png") ?>" width="700" alt="hubungi-kami.png">
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-5 wow fadeInUp" data-wow-delay="0.3s">
                <img src="<?= base_url("assets/img/hubungi-kami-illustration.svg") ?>" class="d-block" alt="hubungi-kami-illustration.svg">
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <h5 class="text-center">Ada pertanyaan terkait TenderPlus? Kirimkan pesan kepada kami</h5>
                <p class="text-center">Kami sangat senang bisa berkomunikasi dengan Anda</p>
                <form class="" action="">
                    <div class="text-center">
                        <div class="form-group">
                            <i class="input-icon bi bi-person"></i>
                            <input type="text" class="form-style" placeholder="Nama Lengkap" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <i class="input-icon bi bi-envelope"></i>
                        <input type="email" class="form-style" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group mt-3">
                        <i class="input-icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_2884_1252" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                    <rect width="30" height="30" fill="#D9D9D9" />
                                </mask>
                                <g mask="url(#mask0_2884_1252)">
                                    <path d="M8.68725 21.2812H17.3438V19.1873H8.68725V21.2812ZM8.68725 16.0312H21.3127V13.9688H8.68725V16.0312ZM8.68725 10.8127H21.3127V8.71875H8.68725V10.8127ZM5.844 26.25C5.2815 26.25 4.79175 26.0417 4.37475 25.6252C3.95825 25.2082 3.75 24.7185 3.75 24.156V5.844C3.75 5.2815 3.95825 4.79175 4.37475 4.37475C4.79175 3.95825 5.2815 3.75 5.844 3.75H24.156C24.7185 3.75 25.2082 3.95825 25.6252 4.37475C26.0417 4.79175 26.25 5.2815 26.25 5.844V24.156C26.25 24.7185 26.0417 25.2082 25.6252 25.6252C25.2082 26.0417 24.7185 26.25 24.156 26.25H5.844ZM5.844 24.156H24.156V5.844H5.844V24.156Z" fill="#D9D9D9" />
                                </g>
                            </svg>
                        </i>
                        <input type="text" class="form-style" placeholder="Judul" autocomplete="off">
                    </div>
                    <div class="form-group mt-3">
                        <i class="input-icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_2884_5104" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                    <rect width="30" height="30" fill="#D9D9D9" />
                                </mask>
                                <g mask="url(#mask0_2884_5104)">
                                    <path d="M12.5 17.5H17.5V15H12.5V17.5ZM12.5 13.75H22.5V11.25H12.5V13.75ZM12.5 10H22.5V7.5H12.5V10ZM10 22.5C9.3125 22.5 8.72417 22.2554 8.235 21.7663C7.745 21.2763 7.5 20.6875 7.5 20V5C7.5 4.3125 7.745 3.72375 8.235 3.23375C8.72417 2.74458 9.3125 2.5 10 2.5H25C25.6875 2.5 26.2763 2.74458 26.7663 3.23375C27.2554 3.72375 27.5 4.3125 27.5 5V20C27.5 20.6875 27.2554 21.2763 26.7663 21.7663C26.2763 22.2554 25.6875 22.5 25 22.5H10ZM10 20H25V5H10V20ZM5 27.5C4.3125 27.5 3.72417 27.2554 3.235 26.7663C2.745 26.2763 2.5 25.6875 2.5 25V7.5H5V25H22.5V27.5H5Z" fill="#D9D9D9" />
                                </g>
                            </svg>
                        </i>
                        <textarea class="form-style" placeholder="Pesan" style="height: 100px;" autocomplete="off"></textarea>
                    </div>
                    <div class="text-center mt-3">
                        <button class="button-hub">KIRIM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>