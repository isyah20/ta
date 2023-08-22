<div class="login100-more">
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