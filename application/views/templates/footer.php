<style>
    .footer-top a { font-size: var(--bs-body-font-size); }
            
    .footer-img { width: 33%; }
            
    .footer-top h6, .footer-top a {
        font-size: var(--bs-body-font-size);
        font-weight: 400;
        line-height: 1.4;
    }
    
    .copyright { font-weight: 400; }
    
    .wa-button {
        width: 264px;
        height: 42px;
        border-radius: 30px;
        position: fixed;
        bottom: 20px;
        right: 80px;
        color: #fff;
        background: linear-gradient(to right,#09a915,#0bcc1a);
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0px 0px 7px rgba(0,0,0,.3;
        transition: opacity .5s, background-color .5s;
        -moz-transition: opacity .5s, background-color .5s;
        -webkit-transition: opacity .5s, background-color .5s;
    }
    
    /*.float-img { height: 29px; }*/
</style>

<footer class="wow fadeIn" data-wow-delay="0.1s">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 text-center text-lg-start">
					<img src="<?= base_url("assets/img/logo_footer.png") ?>" class="footer-img" alt="">
					<h6>TenderPlus adalah platform aplikasi yang dikembangkan untuk memudahkan pengguna dalam memantau paket tender terbaru di LPSE (Layanan Pengadaan Secara Elektronik) pemerintah Indonesia. Kami berkomitmen untuk memberikan pengalaman yang lebih baik dan memberikan keunggulan kompetitif kepada pengguna kami.
					</h6>

					<div class="row social-links my-4 justify-content-center justify-content-lg-start">
						<div class="col-2 d-inline justify-content-center align-center">
							<a href="https://instagram.com/tenderplus_id?igshid=NTc4MTIwNjQ2YQ==">
								<iconify-icon class="iconify" icon="akar-icons:instagram-fill" width="20" height="20"></iconify-icon>
							</a>
						</div>
						<div class="col-2">
							<a href="https://www.linkedin.com">
								<iconify-icon class="iconify" icon="akar-icons:linkedin-box-fill" width="20" height="20"></iconify-icon>
							</a>
						</div>
						<div class="col-2">
							<a href="https://www.facebook.com/tenderplus.id">
								<iconify-icon class="iconify" icon="akar-icons:facebook-fill" width="20" height="20"></iconify-icon>
							</a>
						</div>
						<div class="col-2">
							<a href="https://twitter.com">
								<iconify-icon class="iconify" icon="akar-icons:twitter-fill" width="20" height="20"></iconify-icon>
							</a>
						</div>
					</div>
				</div>

				<div class="col-lg-2"></div>

				<!-- <div class="col-lg-4" style="margin-top:30px">
					<h6 style="font-size: 16px; font-weight:200px;"> Hubungi Kami </h6>
					<div class="row mb-0 ">
						<div class="col-1">
							<img src="<?= base_url("assets/img/location_on.png") ?>" alt="">
						</div>
						<div class="col-10" style="text-align:left ">
							<p style="font-size: 12px; font-weight:100">
								Jl. Mijil Nomor 98, Karangjati,
								Sinduadi, Kec. Mlati, Kabupaten Sleman,
								Daerah Istimewa Yogyakarta 55284
							</p>
						</div>
					</div>
					<div class="row mb-0 ">
						<div class="col-1">
							<img src="<?= base_url("assets/img/schedule.png") ?>" alt="">
						</div>
						<div class="col-10" style="text-align:left ">
							<p style="font-size: 12px; font-weight:100">
								Senin - Jumat<br>
								08:00 - 16:00 WIB
							</p>
						</div>
					</div>
					<div class="row mb-0 ">
						<div class="col-1">
							<img src="<?= base_url("assets/img/alternate_email.png") ?>" alt="">
						</div>
						<div class="col-10" style="text-align:left ">
							<p style="font-size: 12px; font-weight:100">
								mail@beecons.co.id
							</p>
						</div>
					</div>
					<div class="row mb-0 ">
						<div class="col-1">
							<img src="<?= base_url("assets/img/call.png") ?>" alt="">
						</div>
						<div class="col-10" style="text-align:left ">
							<p style="font-size: 12px; font-weight:100">
								(0274) 511067
							</p>
						</div>
					</div>

					<h6 style="font-size: 16px; font-weight:200px; margin-top:10px"> Kunjungi Situs Kami </h6>
					<div class="row">
						<div class="col-1">
							<img src="<?= base_url("assets/img/language.png") ?>" alt="">
						</div>
						<div class="col-10" style="text-align:left ">
							<p style="font-size: 12px; font-weight:100">
								beecons.co.id<br>
								estimator.id
							</p>
						</div>
					</div>
				</div> -->

				<div class="col-lg-5 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
					<div class="text-nowrap mx-2"><a href="<?= base_url("tentang_kami") ?>"> Tentang Kami</a></div>
					<div class="text-nowrap mx-2"> <a href="<?= base_url("kebijakan_privasi") ?>"> Kebijakan Privasi</a></div>
					<div class="text-nowrap mx-2"><a href="<?= base_url("hubungi_kami") ?>"> Kontak Kami</a></div>
					<div class="text-nowrap mx-2"><a href="<?= base_url("faq") ?>"> FAQ</a></div>
				</div>

				<!-- <div class="col-lg-4" style="margin-top:30px">
					<h6 style="font-size: 16px; font-weight:200px;">Detail Lokasi Kami</h6>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.2329772099824!2d110.36466631446271!3d-7.76510007916832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a584fffcb7c8b%3A0xa4e1a3a99628573!2sPT.%20Baracipta%20Esa%20Engineering%20(studio)!5e0!3m2!1sid!2sid!4v1662624240708!5m2!1sid!2sid" frameborder="0" style="border-radius:8px; width: 100%; height:200px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div> -->
			</div>
		</div>

		<div class="container">
			<div class="mt-2 text-center text-lg-start">
				<div class="copyright">
					&copy; 2023. <strong><span>TenderPlus.</span></strong> All Right Reserved.
				</div>
			</div>
		</div>
	</div>
</footer>

<div class="btn-contact">
	<a href="javascript:void(0);" class="btn-whatsapp">
		<!--<span>Hubungi kami</span>-->
		<img src="<?= base_url("assets/img/icon-wa.png") ?>" width="40">
	</a>
</div>

<!--<div class="dropdown wa-button">-->
<!--    <a href="javascript:void(0);" class="btn-whatsapp text-white">-->
<!--        <div style="margin-left: 27px;margin-top: 7px;"><i class="fa fa-whatsapp fa-2x"></i></div>-->
<!--        <div style="margin-top: -24px;margin-left: 57px;"> Hubungi kami via WhatsApp</div>-->
<!--    </a>-->
<!--</div>-->
            
<div class="row" id="float-call">
    
<?php /*<div class="col-10">
        <a href="https://wa.me/+628112632799" class="float-call">
            <span><img src="<?= base_url("assets/img/whatsapp.svg") ?>"></span>
            <span>Hubungi kami via WhatsApp</span>
        </a>
    </div>*/ ?>
	
	<div class="col-2">
		<a href="#" class="back-to-top">
			<img src="<?= base_url("assets/img/back-to-top.svg") ?>" class="float-img mt-1">
		</a>
	</div>
</div>

<script src="<?= base_url("assets/js/home/select2.js") ?>"></script>
<script src="<?= base_url("assets/js/wow/wow.min.js") ?>"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.0.7/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>
<script src="<?= base_url("assets/js/bootstrap/bootstrap.min.js") ?>"></script>
<?php /* <script src="<?= base_url("assets/js/home/navbar.js") ?>" type="text/javascript"></script> */ ?>
<script src="<?= base_url("assets/js/home/index.js") ?>" type="text/javascript"></script>


<script>
    function isMobile() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    };
        
    $(".btn-whatsapp").on("click", function(){
        let text = `Halo Tim TenderPlus,\nSaya ingin menanyakan terkait aplikasi monitoring tender yang saya ikuti\nApakah saya bisa mendapatkan informasi lebih lanjut?\nTerima kasih`;
        let phone = '628112585566';
        let message = encodeURIComponent(text);

        let api_wa;
        if (isMobile() == true) api_wa = "whatsapp://send"; else api_wa = "https://api.whatsapp.com/send";
        let url = api_wa+'?phone=' + phone + '&text=' + message; 
        window.open(url, '_blank');
    });

    $('.nav-item .nav-link').on('click', function() {
		$('.nav-item').find('.active').removeClass('active');
        $(this).addClass('active');
    });
    
	let floatcall = document.getElementById("float-call");
	floatcall.style.visibility = "hidden";
	
	window.onscroll = function() {
		scrollFunctionFooter();
	};
	
	function scrollFunctionFooter() {
		if (window.scrollY > 100) {
			floatcall.style.visibility = "visible";
		} else {
			floatcall.style.visibility = "hidden";
		}
	}
	
	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		    split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix != undefined ? prefix + ' ' + rupiah : rupiah;
	}
	
	/*var Tawk_API = Tawk_API || {},
		Tawk_LoadStart = new Date();
	(function() {
		var s1 = document.createElement("script"),
			s0 = document.getElementsByTagName("script")[0];
		s1.async = true;
		s1.src = 'https://embed.tawk.to/638d9d92daff0e1306daefa6/1gjgiv1vf';
		s1.charset = 'UTF-8';
		s1.setAttribute('crossorigin', '*');
		s0.parentNode.insertBefore(s1, s0);
	})();
	
	timeline(document.querySelectorAll('.timeline'), {
		forceVerticalMode: 800,
		mode: 'horizontal',
		visibleItems: 6,
		moveItems: 3
	});*/
</script>
<script src="<?= base_url("assets/js/main.js") ?>"></script>
