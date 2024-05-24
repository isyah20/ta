<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Notifikasi Pemenang Tender Baru</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

	<style>
		body {
			font-family: 'Ubuntu', sans-serif;
			font-size: 14px;
		}

		a {
			text-decoration: none;
		}

		a.btn {
			background: #B02D19;
			color: #fff;
			padding: 7px 10px;
			display: inline-block;
		}

		a.btn:hover {
			background: #992513;
		}
	</style>
</head>

<body style="margin: 0; background: #f2f2f2; padding: 20px 0;">
	<table align="center" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse; border-radius: 15px; background: #fff;">
		<tr>
			<td colspan="3">
				<div style="border-top: 8px solid #B02D19; border-radius: 15px; padding: 20px;"></div>
			</td>
		</tr>
		<tr>
			<td width="100"></td>
			<td width="600">
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="400">
							<h1 style="margin: 0;">PEMENANG TENDER BARU</h1>
							<h4 style="margin: 5px 0 10px 0; font-weight: 400;">Daftar pemenang tender baru sesuai dengan preferensi Anda</h4>
							<a href="<?= $baseurl ?>/suplier" class="btn">Lihat Semua Pemenang Tender Baru<a>
						</td>
						<td width="200">
							<img src="<?= $baseurl ?>/assets/img/notif_2.png" alt="notif_2.png" width="200" />
						</td>
					</tr>
					<tr>
						<td height="20" colspan="2"></td>
					</tr>

					<?php if ($isUserFree) : ?>
						<tr>
							<td colspan="2">Total pemenang tender baru: <span style="background: #FFF2F2;border: 1px solid #B02D19;padding: 5px;font-size: 16px;"><strong><?= $count_tender ?></strong></span> paket
							</td>
						</tr>
						<tr>
							<td height="20" colspan="2"></td>
						</tr>
					<?php endif; ?>

					<?php if ($isUserTrial || $isUserPremium) : ?>
						<?php foreach ($tenders as $tender) : ?>
							<tr>
								<td colspan="2" style="border-radius: 5px; box-shadow: 0 0 5px #eee; border: 1px solid #ddd; overflow: hidden;">
									<table cellpadding="0" cellspacing="0" width="100%" style="padding: 10px 15px; border-top: 5px solid #eb650d; background: #f5f5f5;">
										<tr>
											<td colspan="4">
												<h2 style="margin: 0;font-weight: 500;"><?= $tender[0]['lpse_name'] ?></h2>
											</td>
										</tr>
									</table>
									<?php foreach ($tender as $key => $item) : ?>
										<table cellpadding="0" cellspacing="0" width="100%" style="padding: 0 15px 15px 15px;">
											<tr>
												<td width="30" style="padding: 5px; border-top: 1px solid #ddd;"><span style="padding: 5px 10px; display: block; text-align: center;"><strong><?= $key + 1 ?>.</strong></span></td>
												<td style="border-top: 1px solid #ddd;" colspan="3">
													<h3 style="margin: 0;"><?= $item['tender_name'] ?></h3>
												</td>
											</tr>
											<tr>
												<td style="padding: 5px">&nbsp;</td>
												<td width="150">Harga Penawaran</td>
												<td width="15" style="text-align:center;">:</td>
												<td style="color: green;"><strong><?= $item['penawaran'] ?></strong></td>
											</tr>
											<tr>
												<td style="padding: 5px">&nbsp;</td>
												<td width="150">Nama Pemenang</td>
												<td width="15" style="text-align:center;">:</td>
												<td><strong><?= $item['nama_pemenang'] ?></strong></td>
											</tr>
											<tr>
												<td style="padding: 5px">&nbsp;</td>
												<td width="150">Link Paket</td>
												<td width="15" style="text-align:center;">:</td>
												<td><a href="<?= $item['link'] ?>" class="btn">Klik Disini<a></td>
											</tr>
										</table>
									<?php endforeach; ?>
								</td>
							</tr>
							<tr>
								<td height="20"></td>
							</tr>
						<?php endforeach; ?>

						<?php if ($isUserTrial) : ?>
							<tr>
								<td colspan="2"><?= $footnoteTrial ?></td>
							</tr>
							<tr>
								<td height="20" colspan="2"></td>
							</tr>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ($isUserFree) : ?>
						<tr>
							<td colspan="2">
								Halo <strong><?= $name ?></strong>,<br />
								Terdapat <strong><?= $count_tender ?> pemenang tender baru</strong> yang dapat Anda follow up bersama TenderPlus. Silakan upgrade ke akun premium untuk dapat melihat daftar pemenang tender!
							</td>
						</tr>
						<tr>
							<td height="20" colspan="2"></td>
						</tr>
					<?php endif; ?>

					<tr>
						<td colspan="2" align="center">
							<img src="<?= $baseurl ?>/assets/img/logo-tender.png" alt="logo-tender.png" width="150" />
						</td>
					</tr>
					<tr>
						<td colspan="2" height="10"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<a href="https://www.instagram.com/tenderplus_id/" target="_blank"><img src="<?= $baseurl ?>/assets/img/instagram-beecons.png" alt="instagram-beecons.png" width="30" /></a>
							<a href="https://www.linkedin.com/company/tenderplus-id/" target="_blank"><img src="<?= $baseurl ?>/assets/img/linkedin-beecons.png" alt="linkedin-beecons.png" width="30" /></a>
							<a href="https://www.facebook.com/tenderplus.id/" target="_blank"><img src="<?= $baseurl ?>/assets/img/facebook-beecons.png" alt="facebook-beecons.png" width="30" /></a>
						</td>
					</tr>
					<tr>
						<td colspan="2" height="10"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<a href="<?= $baseurl ?>/tentang_kami" target="_blank" style="color: #000;padding: 0 5px;font-size: 13px;">Tentang Kami</a>
							<a href="<?= $baseurl ?>/hubungi_kami" target="_blank" style="color: #000;padding: 0 5px;font-size: 13px;">Kontak Kami</a>
							<a href="<?= $baseurl ?>/kebijakan_privasi" target="_blank" style="color: #000;padding: 0 5px;font-size: 13px;">Kebijakan Privasi</a>
							<a href="<?= $baseurl ?>/faq" target="_blank" style="color: #000;padding: 0 5px;font-size: 13px;">FAQ</a>
						</td>
					</tr>
					<tr>
						<td colspan="2" height="10"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><span style="font-size: 11px;">&copy;<?= date("Y") ?>. TenderPlus. All Rights Reserved</span></td>
					</tr>
				</table>
			</td>
			<td width="100"></td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="border-bottom: 8px solid #B02D19; border-radius: 15px; padding: 20px;"></div>
			</td>
		</tr>
	</table>
</body>

</html>