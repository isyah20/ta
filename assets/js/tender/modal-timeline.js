let getDataPerubahan = (id) => {
	console.log(id);
	$.ajax({
		// ambil IDnya nunggu tender yang di homepage selesai
		url:
			"http://localhost/beecons/procurement-platform/api/jadwal/perubahan/" +
			id,
		type: "GET",
		contentType: "application/json",
		dataType: "json",
		success: function (result) {
			console.log(result);
			let jadwal = result.data;
			let html = "";
			$.each(jadwal, function (i, data) {
				html +=
					`
					<div class="container mb-4">
						<div class="card-body rounded p-2">
							<div class="row">
								<div class="col body-perubahan-jadwal">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-5">
											<p class="text-tanggal-modal">` +
					data.tgl_mulai +
					`</p>
										</div>
										<div class="col-lg-6 col-md-6 col-7">
											<div class="d-flex gap-2">
												<span class="circle-small"></span>
												<p class="text-tanggal-modal">` +
					data.tgl_mulai +
					`</p>
											</div>
											<div class="d-flex gap-2">
												<span class="circle-small vertical-line"></span>
												<p class="text-tanggal-modal">` +
					data.tgl_akhir +
					`</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-4 align-self-center">
									<p class="text-perubahan-jadwal">` +
					data.keterangan +
					`</p>
								</div>
							</div>
						</div>
					</div>
					`;
			});
			$(".body-perubahan-jadwal").html(html);
		},
		error: (error) => alert(error.message),
	});
};
