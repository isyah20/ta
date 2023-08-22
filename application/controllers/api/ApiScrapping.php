<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";
require APPPATH . "libraries/scrapping/LpseTable.php";
require FCPATH . 'vendor/autoload.php';
// use namespace
use chriskacerguis\RestServer\RestController;
// use App\Lpsegg\LpseTable;
use GuzzleHttp\Client;
use Library\Scrapping\LpseTable;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ApiScrapping extends RestController
{
    private $domdoc;
    private $base_url;
    private $id_lpse;
    private $id_wilayah;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('simple_html_dom');
        $this->load->helper('tanggal');
        $this->load->helper('scrapping_lpse');
        // $this->load->library('scrapping/LpseTable');
        $this->domdoc = new DOMDocument();
        $this->base_url = "";
        $this->id_lpse = 0;
        $this->load->model('scrapping/Lpse_model', 'lpse');
        $this->load->model('scrapping/Scrapping_model', 'scrap');
        $this->load->model('scrapping/Tender_model', 'tender');
        $this->load->model('scrapping/JenisTender_model', 'jenis_tender');
        $this->load->model('scrapping/DetailTender_model', 'detail_tender');
        $this->load->model('scrapping/Rup_model', 'rup');
        $this->load->model('scrapping/Peserta_model', 'peserta');
        $this->load->model('scrapping/PesertaTenderModel', 'peserta_tender');
        $this->load->model('scrapping/Jadwal_model', 'jadwal');
        $this->load->model('scrapping/PerubahanJadwal_model', 'perubahan_jadwal');
        $this->load->model('scrapping/Tahapan_model', 'tahapan');
        $this->load->model('scrapping/Evaluasi_model', 'evaluasi');
        $this->load->model('scrapping/Pemenang_model', 'pemenang');
        $this->load->model('scrapping/SyaratKualifikasi_model', 'syarat_kualifikasi');
        $this->load->model('scrapping/Wilayah_model', 'wilayah');
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => base_url(),
            // You can set any number of default request options.
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    private function notifikasiTenderBaru()
    {
        $tender = $this->client->request('GET', 'api/tender/notifikasi-tender-baru', $this->client->getConfig('headers'));
        $result = json_decode($tender->getBody()->getContents(), true);

        $count = count($result['data']);

        $config = [
            'charset' => 'UTF-8',
            'useragent' => 'Codeigniter',
            'protocol' => 'smtp',
            'mailtype' => 'html',
            'smtp_host' => 'sv2.ecc.co.id',
            'smtp_port' => '465',
            'smtp_timeout' => '60',
            'smtp_user' => 'support@tenderplus.id',
            'smtp_pass' => 'eA9DUlPzsE4X',
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'wordwrap' => true,
            'smtp_crypto' => 'ssl',
        ];

        $data = $result["data"];

        foreach ($result['data'] as $email) {
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from('no-reply@tenderplus.id', 'Tender Plus');
            $this->email->subject("Ada Tender Baru!");
            $email_check = $email['email'];

            $result_filter = array_filter($result['data'], function ($result) use ($email_check) {
                return $result['email'] == $email_check;
            });
        }

        $html = '';
        foreach (array_slice($result_filter, 0, 5) as $row) {
            if ($row["kualifikasi"] == 1) {
                $row["kualifikasi"] = "Kecil";
            } elseif ($row["kualifikasi"] == 2) {
                $row["kualifikasi"] = "Non-Kecil";
            } elseif ($row["kualifikasi"] == 3) {
                $row["kualifikasi"] = "Besar";
            } elseif ($row["kualifikasi"] == 4) {
                $row["kualifikasi"] = "Menengah";
            } elseif ($row["kualifikasi"] == 5) {
                $row["kualifikasi"] = "Kecil dan/atau Non-kecil";
            }

            $html .= "
				<table role=\"presentation\" style=\"margin:0 0 20px 0;width:100%;border-collapse:collapse;border:1px solid #D9D9D9;border-spacing:0;\">
					<tr>
						<td style=\"padding:3px 10px;\">
							<p style=\"font-size: 18px;line-height:0;font-family:Ubuntu,sans-serif;font-style: normal;font-weight: 700;\">" . $row["id_tender"] . "&nbsp;<span style=\"width: auto;background: #FCD9D9;border: 1px solid #D21B1B;border-radius: 5px; padding:3px 5px;color:#000000;font-size: 12px;\">" . date("d-m-Y", strtotime($row["tgl_pembuatan"])) . "</span></p>
							<p style=\"margin:0;font-size: 15px;line-height:1.3;font-family:Ubuntu,sans-serif;font-style: normal;font-weight: 600;\">" . $row["nama_tender"] . "</p>
							<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
								<tr>
									<td align=\"center\" style=\"width:30px;vertical-align:top;color:#153643;padding:0;\">
										<p><img src=\"https://tenderplus.id/assets/img/EOS_LOCATION_ON_FILLED.png\" alt=\"\" width=\"25\" style=\"height:auto;display:block;\" /></p>
									</td>
									<td style=\"width:500px;padding:0 0 10px 10px;vertical-align:top;\">
										<p style=\"font-size: 15px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;margin-bottom:5px;\">Lokasi Pengerjaan</p>
										<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;margin:0;\">" . $row["lokasi_pekerjaan"] . "</p>
									</td>
									<td align=\"center\" style=\"width:30px;vertical-align:top;color:#153643;padding:0;\">
										<p><img src=\"https://tenderplus.id/assets/img/EOS_PUSH_PIN_FILLED.png\" alt=\"\" width=\"25\" style=\"height:auto;display:block;\" /></p>
									</td>
									<td style=\"width:500px;padding:0 0 10px 10px;vertical-align:top;\">
										<p style=\"font-size: 15px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;margin-bottom:5px;\">LPSE dan Kualifikasi Usaha</p>
										<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;margin:0;\">LPSE " . $row["nama_lpse"] . " - " . $row["kualifikasi"] . "</p>
									</td>
								</tr>
								<tr>
									<td align=\"center\" style=\"width:30px;vertical-align:top;color:#153643;padding:0;\">
										<p><img src=\"https://tenderplus.id/assets/img/rp.png\" alt=\"\" width=\"25\" style=\"height:auto;display:block;\" /></p>
									</td>
									<td style=\"width:500px;padding:0 0 10px 10px;vertical-align:top;\">
										<p style=\"font-size: 15px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;margin-bottom:5px;\">Nilai HPS</p>
										<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;color: #139728;margin:0;\">Rp " . number_format(($row["nilai_hps"]), 0, ',', '.') . "</p>
									</td>
									<td align=\"center\" style=\"width:30px;vertical-align:top;color:#153643;padding:0;\">
										<p><img src=\"https://tenderplus.id/assets/img/EOS_ASSIGNMENT_FILLED.png\" alt=\"\" width=\"25\" style=\"height:auto;display:block;\" /></p>
									</td>
									<td style=\"width:500px;padding:0 0 10px 10px;vertical-align:top;\">
										<p style=\"font-size: 15px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;margin-bottom:5px;\">Tahun Anggaran dan Kategori</p>
										<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;margin:0;\">" . $row["tahun_anggaran"] . " - " . $row["jenis_tender"] . "</p>
									</td>
								</tr>
								<tr>
									<td align=\"center\" style=\"width:30px;vertical-align:top;color:#153643;padding:0;\">
										<p><img src=\"https://tenderplus.id/assets/img/rp.png\" alt=\"\" width=\"25\" style=\"height:auto;display:block;\" /></p>
									</td>
									<td style=\"width:500px;padding:0 0 10px 10px;vertical-align:top;\">
										<p style=\"font-size: 15px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;margin-bottom:5px;\">Nilai Pagu</p>
										<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;color: #139728;margin:0;\">Rp " . number_format(($row["nilai_pagu"]), 0, ',', '.') . "</p>
									</td>
									<td align=\"center\" style=\"width:30px;vertical-align:top;color:#153643;padding:0;\">
										<p><img src=\"https://tenderplus.id/assets/img/ic_round-library-books.png\" alt=\"\" width=\"25\" style=\"height:auto;display:block;\" /></p>
									</td>
									<td style=\"width:500px;padding:0 0 10px 10px;vertical-align:top;\">
										<p style=\"font-size: 15px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;margin-bottom:5px;\">Metode Evaluasi</p>
										<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;margin:0;\">" . $row["metode_evaluasi"] . "</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			";
        }

        $message = "
			<!DOCTYPE html>
			<html lang=\"en\" xmlns=\"https://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">

			<head>
				<meta charset=\"UTF-8\">
				<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
				<meta name=\"x-apple-disable-message-reformatting\">
				<title></title>
				<!--[if mso]>
				<noscript>
					<xml>
						<o:OfficeDocumentSettings>
							<o:PixelsPerInch>96</o:PixelsPerInch>
						</o:OfficeDocumentSettings>
					</xml>
				</noscript>
				<![endif]-->
				<style>
					table,
					td,
					div,
					h1,
					p {
						font-family: Ubuntu, sans-serif;
					}
				</style>
			</head>

			<body style=\"margin:0;padding:0;\">
				<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
					<tr>
						<td align=\"center\" style=\"padding:0;\">
							<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border-spacing:0;\">
								<tr>
									<td style=\"padding:20px\">
										<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
											<tr>
												<td style=\"padding:0;\">
													<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
														<tr>
															<td style=\"width:100%;padding:0 0 20px 0;vertical-align:top;color:#153643;\">
																<p style=\"margin:0;font-size: 30px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 700;\">TENDER TERBARU</p>
																<p style=\"margin:3px 0 0 0;font-size: 20px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Tender terbaru sesuai dengan konfigurasi filter Anda</p>
															</td>
															<td style=\"width:auto;padding:0 0 20px 0;vertical-align:center;color:#153643;\">
																<p style=\"margin:0 0 0 20px;float:right;\"><img src=\"https://tenderplus.id/assets/img/notif-2.png\" alt=\"\" style=\"height:180px;display:block;\" /></p>
															</td>
														</tr>
													</table>
													<table role=\"presentation\" style=\"margin:20px 0;width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
														<tr>
															<td align=\"center\" style=\"padding:0;\">
																<table role=\"presentation\" style=\"width:auto;border-collapse:collapse;border:0;border-spacing:0;\">
																	<tr>
																		<td align=\"center\" style=\"background:#BF0C0C;border-radius:3px;padding:0;\">
																			<a href=\"\" style=\"text-decoration: none;\">
																				<p style=\"font-size: 14px;margin:18px 12px;line-height:0;font-family:Ubuntu,sans-serif;color: #ffffff;font-style: normal;font-weight: 500;\">Lihat Semua Tender Terbaru</p>
																			</a>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<tr>
														<td style=\"padding:0;color:#153643;\">
															<p style=\"font-size: 15px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">Total tender terbaru : <span style=\"width: auto;background: #FFF2F2;border: 1px solid #EB650D;border-radius: 5px; padding:3px 5px;color:#000000\">$count</span> Tender</p>
														</td>
													</tr>
													$html
												</td>
											</tr>
											<tr>
												<td align=\"center\" style=\"padding:100px 0 5px 15px;\">
													<p style=\"margin:0;font-size: 35px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 700;\"><span style=\"color: #BF0C0C;\">tender</span><sup>+</sup></p>
												</td>
											</tr>
											<tr>
												<td style=\"padding: 0;\">
													<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
														<tr>
															<td style=\"padding:0;\">
																<table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;\">
																	<tr>
																		<td style=\"padding:0 0 0 10px;width:45px;\">
																			<a href=\"\">
																				<img src=\"https://tenderplus.id/assets/img/instagram.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
																			</a>
																		</td>
																		<td style=\"padding:0 0 0 10px;width:45px;\">
																			<a href=\"\">
																				<img src=\"https://tenderplus.id/assets/img/linkedin.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
																			</a>
																		</td>
																		<td style=\"padding:0 0 0 10px;width:45px;\">
																			<a href=\"\">
																				<img src=\"https://tenderplus.id/assets/img/facebook.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
																			</a>
																		</td>
																		<td style=\"padding:0 0 0 10px;width:45px;\">
																			<a href=\"\">
																				<img src=\"https://tenderplus.id/assets/img/twitter.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
																			</a>
																		</td>
																	</tr>
																</table>
																<table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;margin-top:20px;\">
																	<tr>
																		<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
																			<a style=\"text-decoration: none;\" href='" . site_url("tentang_kami") . "'>
																				<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">Tentang Kami</p>
																			</a>
																		</td>
																		<td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
																			<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">.</p>
																		</td>
																		<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
																			<a style=\"text-decoration: none;\" href='" . site_url("hubungi_kami") . "'>
																				<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">Kontak Kami</p>
																			</a>
																		</td>
																		<td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
																			<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">.</p>
																		</td>
																		<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
																			<a style=\"text-decoration: none;\" href='" . site_url("kebijakan_privasi") . "'>
																				<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">Kebijakan Privasi</p>
																			</a>
																		</td>
																		<td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
																			<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">.</p>
																		</td>
																		<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
																			<a style=\"text-decoration: none;\" href='" . site_url("faq") . "'>
																				<p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">FAQ</p>
																			</a>
																		</td>
																	</tr>
																</table>
																<table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;\">
																	<tr>
																		<td align=\"center\" style=\"padding:0;width:auto;\">
																			<p style=\"font-size: 12px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">&copy;2022. tender<sup>+</sup></p>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</body>

			</html>
			";

        $this->email->message($message);
        $this->email->to($email['email']);
        $this->email->send();
    }

    private function save_detail($datas, $pengumuman, $id_duplikat)
    {
        if ($pengumuman != null) {
            $detail = [
                'id_tender' => $id_duplikat,
                'satker' => $pengumuman[0]["detail_tender"]["Satuan Kerja"],
                'nilai_pagu' => (float) $pengumuman[0]["detail_tender"]['Nilai Pagu Paket'],
                'lokasi_pekerjaan' => $pengumuman[0]["detail_tender"]['Lokasi Pekerjaan'],
                'kab_pekerjaan' => $pengumuman[0]["detail_tender"]['Kabupaten'],
                'prov_pekerjaan' => $pengumuman[0]["detail_tender"]['Provinsi'],
                'cara_bayar' => $pengumuman[0]["detail_tender"]['Jenis Kontrak'],
                'jumlah_peserta' => trim(substr($pengumuman[0]["detail_tender"]['Peserta Tender'], 0, 4)),
            ];
        } else {
            $id_prov = substr($this->id_wilayah, 0, 2);
            $prov = $this->wilayah->getWilayahById($id_prov);
            $kab = $this->wilayah->getWilayahById($this->id_wilayah);

            $detail = [
                'id_tender' => $id_duplikat,
                'satker' => null,
                'nilai_pagu' => null,
                'lokasi_pekerjaan' => null,
                'kab_pekerjaan' => $kab,
                'prov_pekerjaan' => $prov,
                'cara_bayar' => null,
                'jumlah_peserta' => null,
            ];
        }

        //Menyimpan data detail tender ke database
        $this->detail_tender->tambahDetailDataTender($detail);

        return $detail;
    }

    private function save_tender($datas, $pengumuman, $id_duplikat)
    {
        // Mengolah data tersebut
        // Memisahkan jenis pengadaan dengan Tahun Anggaran
        $explode = explode("-", $datas[8]);
        // Mencocokkan jenis tender
        $jenis = $this->jenis_tender->getIdJenisTenderByName(trim($explode[0]));
        // Memecahkan tahun anggaran
        $tahun_anggaran = $explode[1];

        //Konversi kualifikasi menjadi angka
        $kualifikasi = null;

        if (isset($pengumuman[2]["tambahan_tender"]["Kualifikasi Usaha"])) {
            $dump = trim($pengumuman[2]["tambahan_tender"]["Kualifikasi Usaha"], "\n");
            if ($dump == "Kecil" || $dump == "Usaha Kecil" || $dump == "Perusahaan Kecil") {
                $kualifikasi = 1;
            } elseif ($dump == "Non Kecil" || $dump == "Usaha Non Kecil" || $dump == "Perusahaan Non Kecil") {
                $kualifikasi = 2;
            } elseif ($dump == "Besar") {
                $kualifikasi = 3;
            } elseif ($dump == "Menengah") {
                $kualifikasi = 4;
            } else {
                $kualifikasi = 5;
            }
        } else {
            $kualifikasi = null;
        }

        //Konversi versi lpse
        $versi = null;
        if ($datas[9] == '5') {
            $versi = 'spse 4.5';
        } elseif ($datas[9] == '4') {
            $versi = 'spse 4.4';
        } elseif ($datas[9] == '3') {
            $versi = 'spse 4.3';
        } elseif ($datas[9] == '2') {
            $versi = 'spse 4';
        } else {
            $versi = 'spse 3';
        }
        //alasan
        $alasan = null;
        if (isset($pengumuman[2]["tambahan_tender"]["Alasan Pembatalan"])) {
            $alasan = $pengumuman[2]["tambahan_tender"]["Alasan Pembatalan"];
        } elseif (isset($pengumuman[2]["tambahan_tender"]["Alasan di ulang"])) {
            $alasan = $pengumuman[2]["tambahan_tender"]["Alasan di ulang"];
        } else {
            $alasan = null;
        }

        //status_tender
        // preg_match('/<span class=\'.*badge-warning\'>(.*?)<\/span>.|<span?.*>(.*)<\/span>/', $datas[1], $status);
        // if (isset($status[1])) {
        // 	if ($status[1] != null) {
        // 		if ($status[1] == 'Tender Batal' || $status[1] == 'Seleksi Gagal' || $status[1] == 'Tender Gagal' || $status[1] == 'Seleksi Batal') {
        // 			$status = "Gagal";
        // 		} else if ($status[1] == 'Tender Ulang' || $status[1] == 'Evaluasi Ulang' || $status[1] == 'Seleksi Ulang') {
        // 			$status = "Ulang";
        // 		} else {
        // 			$status = "Selesai";
        // 		}
        // 	} else {
        // 		if ($status[2] == 'Tender Batal' || $status[2] == 'Seleksi Gagal' || $status[2] == 'Tender Gagal' || $status[2] == 'Seleksi Batal') {
        // 			$status = "Gagal";
        // 		} else if ($status[2] == 'Tender Ulang' || $status[2] == 'Evaluasi Ulang' || $status[2] == 'Seleksi Ulang') {
        // 			$status = "Ulang";
        // 		} else {
        // 			$status = "Selesai";
        // 		}
        // 	}
        // } else {
        // 	$status = "Selesai";
        // }

        // $check_kode = $this->tender->getTenderByKodeTender($datas[0]);
        // // print_r($check_kode);
        // // die();
        // $check_kode;
        // if ($check_kode != null && substr($check_kode, -1) > 'A') {
        // 	$id_duplikat = $check_kode++;
        // } elseif ($check_kode != null) {
        // 	$id_duplikat = $check_kode . 'A';
        // } else {
        // 	$id_duplikat = $datas[0];
        // }

        // Membuat data tender
        $tender = [
            'id_tender' => $datas[0],
            'id_duplikat' => $id_duplikat,
            'id_lpse' => $this->id_lpse,
            'nama_tender' => preg_replace('/<[^>].*>/', '', $datas[1]),
            'id_jenis' => $jenis->id_jenis ? (int) $jenis->id_jenis : 7,
            'tahun_anggaran' => substr($tahun_anggaran, 4, 9),
            'metode_pemilihan' => $datas[5],
            'metode_pengadaan' => $datas[6],
            'metode_evaluasi' => $datas[7],
            // 'status' => $status,
            'status' => preg_replace('/\[[^\]].*\]/', '', $datas[3]),
            'alasan' => $alasan,
            'versi_lpse' => $versi,
            'nilai_kontrak' => (float) preg_replace("/[^0-9,]/", "", $datas[10]),
            'kualifikasi' => $kualifikasi,
            'nilai_hps' => (float) isset($pengumuman[2]["tambahan_tender"]["Nilai HPS Paket"]) ? $pengumuman[2]["tambahan_tender"]["Nilai HPS Paket"] : null,
            'tgl_pembuatan' => isset($pengumuman[2]["tambahan_tender"]["Tanggal Pembuatan"]) ? date('Y-m-d', strtotime(tgl_umum($pengumuman[2]["tambahan_tender"]["Tanggal Pembuatan"]))) : null,
        ];
        $check_kode = $this->tender->getTenderByKodeTender($datas[0]);
        if (!$check_kode || $check_kode == null) {
            //Melakukan penyimpanan tender ke database
            $this->tender->tambahTender($tender);
        } else {
            $this->tender->ubahTender($datas[0], $tender);
        }
        return $tender;
    }

    private function scrapping_update($data, $max_id, $tahap = true, $peserta = true, $evaluasi = true, $pemenang = true)
    {
        //print_r($data);

        $tender = [];
        //Melakukan penelusuran untuk menemukan data hasil scrapping
        foreach ($data->data as $key => $datas) {
            //Jika kode_tender hasil scrapping >= dari kode tender db maka disimpan ke db
            if ($datas[0] > $max_id) {
                //Memasuki halaman pengumuman dan mengambil data yang diperlukan
                $pengumuman = $this->pengumuman($datas[0]);

                //Melakukan scrapping ke tender
                $tender[$key] = $this->save_tender($datas, $pengumuman, null);

                //Melakukan scrapping detail tender dari halaman pengumuman
                $detail = $this->save_detail($datas, $pengumuman, $tender[$key]["id_urut_tender"]);

                //Memasuki halaman tahap dan menanmbahkan jadwal
                if ($tahap) {
                    $this->tahap($datas[0]);
                }

                //Memasuki halaman peserta, evaluasi, dan pemenang dan mengambil serta menyimpan  data yang diperlukan
                if ($peserta) {
                    $this->peserta_tender($datas[0]);
                }
                if ($evaluasi) {
                    $this->evaluasi($datas[0]);
                }
                if ($pemenang) {
                    $this->pemenang($datas[0]);
                }
                //die();

                //Menyimpan data rup tender ke database
                if ($pengumuman[1]['rup']) {
                    $data_rup = [
                        'id_rup' => $pengumuman[1]['rup']["Kode RUP"],
                        'id_tender' => $datas[0],
                        'nama_paket' => $pengumuman[1]["rup"]["Nama Paket"],
                        'sumber_dana' => $pengumuman[1]["rup"]["Sumber Dana"],
                    ];

                    // if (!$this->rup->getRupById($data_rup["id_rup"]))
                    $this->rup->tambahRupTender($data_rup);
                }

                //Meynimpan syarat_kualifikasi tender ke database
                if ($pengumuman[3]['syarat']) {
                    $data_syarat = [
                        'id_tender' => (int) $datas[0],
                        'kategori' => (int) $pengumuman[3]['syarat']["kategori"],
                        'syarat' => $pengumuman[3]["syarat"]["syarat"],
                    ];

                    // if (!$this->rup->getRupById($data_rup["id_rup"]))
                    $this->syarat_kualifikasi->tambahSyarat($data_syarat);
                }

                $rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);

                // Menambahakn detail tender dan rup ke data tender
                $tender[$key] = array_merge($tender[$key], ['detail' => $pengumuman[0]["detail_tender"], 'rup' => $pengumuman[1]["rup"]]);
            }
        }

        //Mengirim response ke user
        // $this->response([
        // 	'status' => true,
        // 	'total' => count($tender),
        // 	'data' => $tender
        // ], RestController::HTTP_OK);
    }

    // private function scrapping($tahap = true, $peserta = true, $evaluasi = true, $pemenang = true)
    // {
    // 	$data = $this->dataTabel();
    // 	$total_tender = $this->tender->getCountTenderOfLPSE($this->id_lpse);
    // 	$tender = [];
    // 	$error = '';

    // 	// Mengolah data tersebut jika data tidak kosong di website lpse
    // 	if ($data != null) {
    // 		if ($data->recordsTotal > $total_tender) {
    // 			foreach ($data->data as $key => $datas) {
    // 				//Mengecek status dan detail pada tender tersebut apakah sudah ada di database atau tidak
    // 				$check_detail = $this->detail_tender->getDetailTenderOnlyById($datas[0]);
    // 				$recent_tender = $this->tender->getRecentKodeTenderByLPSE($this->id_lpse);
    // 				//Mengecek apakah status tender sudah ada di database atau belum dan apakah status tender tidak sama dengan status tender hasil scrapping
    // 				if ($datas[0] > $recent_tender) {
    // 					//Memasuki halaman pengumuman dan mengambil data yang diperlukan
    // 					$pengumuman = $this->pengumuman($datas[0]);
    // 					if ($pengumuman != null) {
    // 						$tender[$key] = $this->save_tender($datas, $pengumuman);

    // 						//Jika nilai status belum ada maka detail, rup, dan syarat kualifikasi tidak ada sehingga disimpan
    // 						$detail = $this->save_detail($datas, $pengumuman);
    // 						//Memasuki halaman tahap dan menanmbahkan jadwal
    // 						if ($tahap)
    // 							$this->tahap($datas[0]);

    // 						//Memasuki halaman peserta, evaluasi, dan pemenang dan mengambil serta menyimpan  data yang diperlukan
    // 						if ($peserta)
    // 							$this->peserta_tender($datas[0]);
    // 						if ($evaluasi)
    // 							$this->evaluasi($datas[0]);
    // 						if ($pemenang)
    // 							$this->pemenang($datas[0]);

    // 						//Menyimpan data rup tender ke database
    // 						if ($pengumuman[1]['rup']) {
    // 							$data_rup = [
    // 								'id_rup' => $pengumuman[1]['rup']["Kode RUP"],
    // 								'id_tender' => $datas[0],
    // 								'nama_paket' => $pengumuman[1]["rup"]["Nama Paket"],
    // 								'sumber_dana' => isset($pengumuman[1]["rup"]["Sumber Dana"]) ? $pengumuman[1]["rup"]["Sumber Dana"] : null,
    // 							];

    // 							// if (!$this->rup->getRupById($data_rup["id_rup"]))
    // 							$this->rup->tambahRupTender($data_rup);
    // 						}

    // 						$rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);

    // 						//Meynimpan syarat_kualifikasi tender ke database
    // 						if ($pengumuman[3]['syarat']) {
    // 							$data_syarat = [
    // 								'id_tender' => (int) $datas[0],
    // 								'kategori' => $pengumuman[3]['syarat']["kategori"],
    // 								'syarat' => $pengumuman[3]["syarat"]["syarat"],
    // 							];

    // 							// if (!$this->rup->getRupById($data_rup["id_rup"]))
    // 							$this->syarat_kualifikasi->tambahSyarat($data_syarat);
    // 						}
    // 					} else {
    // 						$error = 'Error pada tender ' . $datas[0];
    // 					}
    // 				}
    // 				//Jika status pada tender telah ada namun detail tender belum ada maka disimpan data baru detail tender
    // 				else if ($check_detail == null) {
    // 					$pengumuman = $this->pengumuman($datas[0]);
    // 					if ($pengumuman != null) {
    // 						$this->save_detail($datas, $pengumuman);
    // 					} else {
    // 						$error = 'Error pada tender ' . $datas[0];
    // 					}
    // 				}
    // 			}
    // 		}
    // 	} else {
    // 		$error = 'error pada ' . preg_replace('/http:\/\/|https:\/\/|\/eproc4/', "", $this->base_url);
    // 	}
    // 	if ($tender != [])
    // 		return [1, null];
    // 	else
    // 		return [0, $error];
    // }

    // before edit
    // private function scrapping($tahap = true, $peserta = true, $evaluasi = true, $pemenang = true)
    // {
    // 	$awal = microtime(true);
    // 	$data = $this->dataTabel();

    // 	$total_tender = $this->tender->getCountTenderOfLPSE($this->id_lpse);
    // 	$recent_tender = $this->tender->getRecentTenderOfLPSE($this->id_lpse);
    // 	$tender = [];
    // 	$email = [];
    // 	$error = '';

    // 	$berhasil = 0;
    // 	$gagal = 0;
    // 	$failed = [];
    // 	$ket = null;

    // 	// print_r($total_tender . " - " . $data->recordsTotal);
    // 	// die();
    // 	// Mengolah data tersebut jika data tidak kosong di website lpse
    // 	if ($data != null) {
    // 		if ($data->recordsTotal > $total_tender) {
    // 			$new_arr = array_unique($data->data, SORT_REGULAR);
    // 			// print_r($data->recordsTotal . " - " . $total_tender . "<br />");
    // 			// die();
    // 			if (count($new_arr) > $total_tender) {
    // 				$result_filter = array_filter($new_arr, function ($data) use ($recent_tender) {
    // 					return $data[0] > $recent_tender;
    // 				});
    // 				// print_r($result_filter);
    // 				// die();
    // 				if ($result_filter != null) {
    // 					foreach ($result_filter as $key => $datas) {
    // 						$check_kode = $this->tender->getTenderByKodeTender($datas[0]);
    // 						//Memasuki halaman pengumuman dan mengambil data yang diperlukan
    // 						// print_r($datas[0] . ' = ' . $check_kode . ' total ' . $key . '  ' . ($datas[0] == $check_kode ? ' ' : 'false') . '<br />');
    // 						// continue;
    // 						if ($check_kode == null || $check_kode != $datas[0]) {
    // 							$pengumuman = $this->pengumuman($datas[0]);
    // 							if ($pengumuman != null) {
    // 								$tender[$key] = $this->save_tender($datas, $pengumuman);
    // 								if (count($tender[$key]) > 1) {
    // 									$email[$key] = [
    // 										'id_tender' => $datas[0],
    // 										'nama_tender' => preg_replace('/<[^>].*>/', '', $datas[1]),
    // 									];
    // 								}
    // 								//Jika nilai status belum ada maka detail, rup, dan syarat kualifikasi tidak ada sehingga disimpan
    // 								$detail = $this->save_detail($datas, $pengumuman, $tender[$key]["id_urut_tender"]);
    // 								//Memasuki halaman tahap dan menanmbahkan jadwal
    // 								if ($tahap)
    // 									$this->tahap($datas[0]);

    // 								//Memasuki halaman peserta, evaluasi, dan pemenang dan mengambil serta menyimpan  data yang diperlukan
    // 								if ($peserta)
    // 									$this->peserta_tender($datas[0]);
    // 								if ($evaluasi)
    // 									$this->evaluasi($datas[0]);
    // 								if ($pemenang)
    // 									$this->pemenang($datas[0]);

    // 								//Menyimpan data rup tender ke database
    // 								if ($pengumuman[1]['rup']) {
    // 									$data_rup = [
    // 										'id_rup' => $pengumuman[1]['rup']["Kode RUP"],
    // 										'id_tender' => $datas[0],
    // 										'nama_paket' => $pengumuman[1]["rup"]["Nama Paket"],
    // 										'sumber_dana' => isset($pengumuman[1]["rup"]["Sumber Dana"]) ? $pengumuman[1]["rup"]["Sumber Dana"] : null,
    // 									];

    // 									// if (!$this->rup->getRupById($data_rup["id_rup"]))
    // 									$this->rup->tambahRupTender($data_rup);
    // 								}

    // 								$rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);

    // 								//Meynimpan syarat_kualifikasi tender ke database
    // 								if ($pengumuman[3]['syarat']) {
    // 									$data_syarat = [
    // 										'id_tender' => (int) $datas[0],
    // 										'kategori' => $pengumuman[3]['syarat']["kategori"],
    // 										'syarat' => $pengumuman[3]["syarat"]["syarat"],
    // 									];

    // 									// if (!$this->rup->getRupById($data_rup["id_rup"]))
    // 									$this->syarat_kualifikasi->tambahSyarat($data_syarat);
    // 								}
    // 								$berhasil++;
    // 							} else {
    // 								$gagal++;
    // 								$ket .= $datas[0] . " , ";
    // 								array_push($failed, $datas[0]);
    // 							}
    // 						}
    // 					}
    // 					// $this->helper->notifikasiTenderBaru($email);
    // 				} else {
    // 					foreach ($data->data as $key => $datas) {
    // 						$check_detail = $this->detail_tender->getDetailTenderOnlyById($datas[0]);
    // 						$check_kode = $this->tender->getTenderByKodeTender($datas[0]);
    // 						// print_r($check_detail . ' = ' . $check_kode . ' total ' . $key . '  ' . ($check_detail == $check_kode ? ' ' : 'false') . '<br />');
    // 						// print_r(`$check_detail = $check_kode total $key \n`);
    // 						// continue;
    // 						// if ($check_kode != $datas[0]) {
    // 						// 	print_r($check_kode . "<br />");
    // 						// 	print_r("data ini tidak ada " . $datas[0] . "<br>");
    // 						// 	die();
    // 						// }
    // 						//Mengecek apakah status tender sudah ada di database atau belum dan apakah status tender tidak sama dengan status tender hasil scrapping
    // 						if ($check_kode == null || $check_kode != $datas[0]) {
    // 							// print_r($datas[0] . " Belum ada di tender");
    // 							// die();
    // 							//Memasuki halaman pengumuman dan mengambil data yang diperlukan
    // 							$pengumuman = $this->pengumuman($datas[0]);
    // 							if ($pengumuman != null) {
    // 								$tender[$key] = $this->save_tender($datas, $pengumuman);

    // 								//Jika nilai status belum ada maka detail, rup, dan syarat kualifikasi tidak ada sehingga disimpan
    // 								$detail = $this->save_detail($datas, $pengumuman, $tender[$key]["id_urut_tender"]);
    // 								//Memasuki halaman tahap dan menanmbahkan jadwal
    // 								if ($tahap)
    // 									$this->tahap($datas[0]);

    // 								//Memasuki halaman peserta, evaluasi, dan pemenang dan mengambil serta menyimpan  data yang diperlukan
    // 								if ($peserta)
    // 									$this->peserta_tender($datas[0]);
    // 								if ($evaluasi)
    // 									$this->evaluasi($datas[0]);
    // 								if ($pemenang)
    // 									$this->pemenang($datas[0]);

    // 								//Menyimpan data rup tender ke database
    // 								if ($pengumuman[1]['rup']) {
    // 									$data_rup = [
    // 										'id_rup' => $pengumuman[1]['rup']["Kode RUP"],
    // 										'id_tender' => $datas[0],
    // 										'nama_paket' => $pengumuman[1]["rup"]["Nama Paket"],
    // 										'sumber_dana' => isset($pengumuman[1]["rup"]["Sumber Dana"]) ? $pengumuman[1]["rup"]["Sumber Dana"] : null,
    // 									];

    // 									// if (!$this->rup->getRupById($data_rup["id_rup"]))
    // 									$this->rup->tambahRupTender($data_rup);
    // 								}

    // 								$rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);

    // 								//Meynimpan syarat_kualifikasi tender ke database
    // 								if ($pengumuman[3]['syarat']) {
    // 									$data_syarat = [
    // 										'id_tender' => (int) $datas[0],
    // 										'kategori' => $pengumuman[3]['syarat']["kategori"],
    // 										'syarat' => $pengumuman[3]["syarat"]["syarat"],
    // 									];

    // 									// if (!$this->rup->getRupById($data_rup["id_rup"]))
    // 									$this->syarat_kualifikasi->tambahSyarat($data_syarat);
    // 								}
    // 								$berhasil++;
    // 							} else {
    // 								$gagal++;
    // 								$ket .= $datas[0] . " , ";
    // 								array_push($failed, $datas[0]);
    // 							}
    // 						}
    // 						//Jika status pada tender telah ada namun detail tender belum ada maka disimpan data baru detail tender
    // 						else if ($check_detail == null) {
    // 							// print_r($datas[0] . " Belum ada di detail");
    // 							// die();
    // 							$pengumuman = $this->pengumuman($datas[0]);
    // 							if ($pengumuman != null) {
    // 								$this->save_detail($datas, $pengumuman, $tender[$key]["id_urut_tender"]);
    // 								$berhasil++;
    // 							} else {
    // 								$gagal++;
    // 								$ket .= $datas[0] . " , ";
    // 								array_push($failed, $datas[0]);
    // 							}
    // 						}
    // 					}
    // 				}
    // 			}
    // 		}
    // 	} else {
    // 		$ket = "Data kosong pada lpse " . $this->base_url;
    // 	}

    // 	$check_history = $this->scrap->getHistoryByIdLpse($this->id_lpse, 1);
    // 	$akhir = microtime(true);
    // 	$duration = $akhir - $awal;
    // 	$hours = (int)($duration / 60 / 60);
    // 	$minutes = (int)($duration / 60) - $hours * 60;
    // 	$seconds = (int)$duration - $hours * 60 * 60 - $minutes * 60;

    // 	if ($check_history == null) {
    // 		$data = [
    // 			'id_lpse' => $this->id_lpse,
    // 			'id_jenis_monitoring' => 1,
    // 			'url' => $this->base_url,
    // 			'berhasil' => $berhasil,
    // 			'error' => $gagal,
    // 			'keterangan' => $ket,
    // 			'date' => date('Y-m-d'),
    // 			'waktu_eksekusi' => $seconds
    // 			// 'waktu_eksekusi' => number_format($lama, 3, '.', '')
    // 		];
    // 		$result = $this->scrap->tambahScrap($data);
    // 		if ($result != true) {
    // 			print_r($result . "<br />");
    // 			print_r("error pada tambah lpse " . $this->base_url . "<br />");
    // 			print_r($data);
    // 			die();
    // 		}
    // 	} else {
    // 		$old_data = $this->scrap->getDataHistory($this->id_lpse, 1, $data);
    // 		if (count($old_data) > 0) {
    // 			$gagal = $old_data[0]['error'] + $gagal;
    // 			$gagal -= $berhasil;
    // 			$berhasil = $old_data[0]['berhasil'] + $berhasil;
    // 		}
    // 		$data = [
    // 			'id_lpse' => $this->id_lpse,
    // 			'id_jenis_monitoring' => 1,
    // 			'url' => $this->base_url,
    // 			'berhasil' => $berhasil,
    // 			'error' => $gagal,
    // 			'keterangan' => $ket,
    // 			'date' => date('Y-m-d'),
    // 			'waktu_eksekusi' => $seconds
    // 			// 'waktu_eksekusi' => number_format($lama, 3, '.', '')
    // 		];
    // 		$result = $this->scrap->ubahScrap($this->id_lpse, 1, $data);
    // 		if ($result != true) {
    // 			print_r($result . "<br />");
    // 			print_r("error pada update lpse " . $this->base_url . "<br />");
    // 			print_r($data);
    // 			die();
    // 		}
    // 	}

    // 	return [
    // 		'berhasil' => $berhasil,
    // 		'gagal' => $gagal,
    // 		'failed' => $failed,
    // 		'waktu' => $seconds
    // 	];

    // 	// if ($tender != [])
    // 	// 	return [1, null];
    // 	// else
    // 	// 	return [0, $error];
    // }

    private function scrapping($tahap = true, $peserta = true, $evaluasi = true, $pemenang = true)
    {
        $awal = microtime(true);
        $data = $this->dataTabel();
        //var_dump($data);
        //die();
        $total_tender = $this->tender->getCountTenderOfLPSE($this->id_lpse);
        // print_r($total_tender . " - " . $data->recordsTotal);
        // die();
        $recent_tender = $this->tender->getRecentTenderOfLPSE($this->id_lpse);
        $tender = [];
        $email = [];
        $error = '';

        $berhasil = 0;
        $gagal = 0;
        $failed = [];
        $ket = null;

        // print_r($total_tender . " - " . $data->recordsTotal);
        // die();
        // Mengolah data tersebut jika data tidak kosong di website lpse
        if ($data != null) {
            if ($data->recordsTotal > $total_tender) {
                // $check_kode = $this->tender->getTenderByKodeTender($datas[0]);
                // $result_filter = array_filter($new_arr, function ($data) use ($recent_tender) {
                // 	return $data[0] > $recent_tender;
                // });
                $new_arr = array_unique($data->data, SORT_REGULAR);
                // print_r(count($new_arr));
                // die();
                $i = 1;
                foreach ($new_arr as $key => $datas) {
                    $check_kode = $this->tender->getTenderByKodeTender($datas[0]);
                    // print_r($datas[0] . " " . $key . "<br />");
                    // continue;
                    // print_r($check_kode["id_tender"]);
                    // die();||
                    if ($check_kode == null || $check_kode["id_tender"] != $datas[0] || ($check_kode["id_tender"] == $datas[0] && $check_kode["id_lpse"] != $this->id_lpse)) {
                        $pengumuman = $this->pengumuman($datas[0]);
                        if ($pengumuman != null) {
                            $id_duplikat = $datas[0];
                            if (isset($check_kode["id_tender"]) && $check_kode["id_tender"] == $datas[0]) {
                                $str_arr = explode('.', $check_kode["id_duplikat"]);
                                // print_r($str_arr);
                                // die();
                                if ($str_arr[1] == null) {
                                    $id_duplikat = $check_kode["id_duplikat"] + 0.1;
                                } else {
                                    $id_duplikat = $check_kode["id_duplikat"]++;
                                }
                            }
                            $tender[$key] = $this->save_tender($datas, $pengumuman, $id_duplikat);
                            // if (count($tender[$key]) > 1) {
                            // 	$email[$key] = [
                            // 		'id_tender' => $datas[0],
                            // 		'nama_tender' => preg_replace('/<[^>].*>/', '', $datas[1]),
                            // 	];
                            // }
                            //Jika nilai status belum ada maka detail, rup, dan syarat kualifikasi tidak ada sehingga disimpan
                            $detail = $this->save_detail($datas, $pengumuman, $tender[$key]["id_duplikat"]);
                            //Memasuki halaman tahap dan menanmbahkan jadwal
                            if ($tahap) {
                                $this->tahap($datas[0]);
                            }

                            //Memasuki halaman peserta, evaluasi, dan pemenang dan mengambil serta menyimpan  data yang diperlukan
                            if ($peserta) {
                                $this->peserta_tender($datas[0]);
                            }
                            if ($evaluasi) {
                                $this->evaluasi($datas[0]);
                            }
                            if ($pemenang) {
                                $this->pemenang($datas[0]);
                            }

                            //Menyimpan data rup tender ke database
                            if ($pengumuman[1]['rup']) {
                                $data_rup = [
                                    'id_rup' => $pengumuman[1]['rup']["Kode RUP"],
                                    // 'id_duplikat' => $tender[$key]["id_duplikat"],
                                    'id_tender' => $tender[$key]["id_duplikat"],
                                    'nama_paket' => $pengumuman[1]["rup"]["Nama Paket"],
                                    'sumber_dana' => $pengumuman[1]["rup"]["Sumber Dana"] ?? null,
                                ];

                                // if (!$this->rup->getRupById($data_rup["id_rup"]))
                                $this->rup->tambahRupTender($data_rup);
                            }

                            $rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);

                            //Meynimpan syarat_kualifikasi tender ke database
                            if ($pengumuman[3]['syarat']) {
                                $data_syarat = [
                                    'id_tender' => (int) $tender[$key]["id_duplikat"],
                                    // 'id_duplikat' => $tender[$key]["id_duplikat"],
                                    'kategori' => $pengumuman[3]['syarat']["kategori"],
                                    'syarat' => $pengumuman[3]["syarat"]["syarat"],
                                ];

                                // if (!$this->rup->getRupById($data_rup["id_rup"]))
                                $this->syarat_kualifikasi->tambahSyarat($data_syarat);
                            }
                            $berhasil++;
                        } else {
                            $id_duplikat = $datas[0];
                            if (isset($check_kode["id_tender"]) && $check_kode["id_tender"] == $datas[0]) {
                                $str_arr = explode('.', $check_kode["id_duplikat"]);
                                //
                                if ($str_arr[1] == null) {
                                    $id_duplikat = $check_kode["id_duplikat"] + 0.1;
                                } else {
                                    $id_duplikat = $check_kode["id_duplikat"]++;
                                }
                            }
                            $tender[$key] = $this->save_tender($datas, $pengumuman, $id_duplikat);
                            // if (count($tender[$key]) > 1) {
                            // 	$email[$key] = [
                            // 		'id_tender' => $datas[0],
                            // 		'nama_tender' => preg_replace('/<[^>].*>/', '', $datas[1]),
                            // 	];
                            // }
                            //Jika nilai status belum ada maka detail, rup, dan syarat kualifikasi tidak ada sehingga disimpan
                            $detail = $this->save_detail($datas, null, $tender[$key]["id_duplikat"]);
                            //Memasuki halaman tahap dan menanmbahkan jadwal
                            if ($tahap) {
                                $this->tahap($datas[0]);
                            }

                            //Memasuki halaman peserta, evaluasi, dan pemenang dan mengambil serta menyimpan  data yang diperlukan
                            if ($peserta) {
                                $this->peserta_tender($datas[0]);
                            }
                            if ($evaluasi) {
                                $this->evaluasi($datas[0]);
                            }
                            if ($pemenang) {
                                $this->pemenang($datas[0]);
                            }

                            //Menyimpan data rup tender ke database

                            // if ($pengumuman[1]['rup']) {
                            // 	$data_rup = [
                            // 		'id_rup' => $pengumuman[1]['rup']["Kode RUP"],
                            // 		'id_duplikat' => $tender[$key]["id_duplikat"],
                            // 		'id_tender' => $datas[0],
                            // 		'nama_paket' => null,
                            // 		'sumber_dana' => null,
                            // 	];

                            // 	// if (!$this->rup->getRupById($data_rup["id_rup"]))
                            // 	$this->rup->tambahRupTender($data_rup);
                            // }

                            // $rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);

                            //Meynimpan syarat_kualifikasi tender ke database
                            // if ($pengumuman[3]['syarat']) {
                            // 	$data_syarat = [
                            // 		'id_tender' => (int) $datas[0],
                            // 		'id_duplikat' => $tender[$key]["id_duplikat"],
                            // 		'kategori' => $pengumuman[3]['syarat']["kategori"],
                            // 		'syarat' => $pengumuman[3]["syarat"]["syarat"],
                            // 	];

                            // 	// if (!$this->rup->getRupById($data_rup["id_rup"]))
                            // 	$this->syarat_kualifikasi->tambahSyarat($data_syarat);
                            // }
                            $berhasil++;
                            // $gagal++;
                            // $ket .= $datas[0] . " , ";
                            // array_push($failed, $datas[0]);
                        }
                    } elseif ($check_kode["id_tender"] == $datas[0] && $check_kode["id_lpse"] == $this->id_lpse) {
                        // print_r($datas[0] . " = " . $check_kode["id_tender"] . " $$ " . $check_kode["id_lpse"] . " = " . $this->id_lpse . " key " . $i . "<br />");
                        // $i++;
                    }
                }
                // if (count($new_arr) > $total_tender) {
                // 	$result_filter = array_filter($new_arr, function ($data) use ($recent_tender) {
                // 		return $data[0] > $recent_tender;
                // 	});
                // 	// print_r($result_filter);
                // 	// die();
                // 	if ($result_filter != null) {

                // 		// $this->helper->notifikasiTenderBaru($email);
                // 	} else {
                // 		foreach ($data->data as $key => $datas) {
                // 			$check_detail = $this->detail_tender->getDetailTenderOnlyById($datas[0]);
                // 			$check_kode = $this->tender->getTenderByKodeTender($datas[0]);
                // 			// print_r($check_detail . ' = ' . $check_kode . ' total ' . $key . '  ' . ($check_detail == $check_kode ? ' ' : 'false') . '<br />');
                // 			// print_r(`$check_detail = $check_kode total $key \n`);
                // 			// continue;
                // 			// if ($check_kode != $datas[0]) {
                // 			// 	print_r($check_kode . "<br />");
                // 			// 	print_r("data ini tidak ada " . $datas[0] . "<br>");
                // 			// 	die();
                // 			// }
                // 			//Mengecek apakah status tender sudah ada di database atau belum dan apakah status tender tidak sama dengan status tender hasil scrapping
                // 			if ($check_kode == null || $check_kode != $datas[0]) {
                // 				// print_r($datas[0] . " Belum ada di tender");
                // 				// die();
                // 				//Memasuki halaman pengumuman dan mengambil data yang diperlukan
                // 				$pengumuman = $this->pengumuman($datas[0]);
                // 				if ($pengumuman != null) {
                // 					$tender[$key] = $this->save_tender($datas, $pengumuman);

                // 					//Jika nilai status belum ada maka detail, rup, dan syarat kualifikasi tidak ada sehingga disimpan
                // 					$detail = $this->save_detail($datas, $pengumuman, $tender[$key]["id_urut_tender"]);
                // 					//Memasuki halaman tahap dan menanmbahkan jadwal
                // 					if ($tahap)
                // 						$this->tahap($datas[0]);

                // 					//Memasuki halaman peserta, evaluasi, dan pemenang dan mengambil serta menyimpan  data yang diperlukan
                // 					if ($peserta)
                // 						$this->peserta_tender($datas[0]);
                // 					if ($evaluasi)
                // 						$this->evaluasi($datas[0]);
                // 					if ($pemenang)
                // 						$this->pemenang($datas[0]);

                // 					//Menyimpan data rup tender ke database
                // 					if ($pengumuman[1]['rup']) {
                // 						$data_rup = [
                // 							'id_rup' => $pengumuman[1]['rup']["Kode RUP"],
                // 							'id_tender' => $datas[0],
                // 							'nama_paket' => $pengumuman[1]["rup"]["Nama Paket"],
                // 							'sumber_dana' => isset($pengumuman[1]["rup"]["Sumber Dana"]) ? $pengumuman[1]["rup"]["Sumber Dana"] : null,
                // 						];

                // 						// if (!$this->rup->getRupById($data_rup["id_rup"]))
                // 						$this->rup->tambahRupTender($data_rup);
                // 					}

                // 					$rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);

                // 					//Meynimpan syarat_kualifikasi tender ke database
                // 					if ($pengumuman[3]['syarat']) {
                // 						$data_syarat = [
                // 							'id_tender' => (int) $datas[0],
                // 							'kategori' => $pengumuman[3]['syarat']["kategori"],
                // 							'syarat' => $pengumuman[3]["syarat"]["syarat"],
                // 						];

                // 						// if (!$this->rup->getRupById($data_rup["id_rup"]))
                // 						$this->syarat_kualifikasi->tambahSyarat($data_syarat);
                // 					}
                // 					$berhasil++;
                // 				} else {
                // 					$gagal++;
                // 					$ket .= $datas[0] . " , ";
                // 					array_push($failed, $datas[0]);
                // 				}
                // 			}
                // 			//Jika status pada tender telah ada namun detail tender belum ada maka disimpan data baru detail tender
                // 			else if ($check_detail == null) {
                // 				// print_r($datas[0] . " Belum ada di detail");
                // 				// die();
                // 				$pengumuman = $this->pengumuman($datas[0]);
                // 				if ($pengumuman != null) {
                // 					$this->save_detail($datas, $pengumuman, $tender[$key]["id_urut_tender"]);
                // 					$berhasil++;
                // 				} else {
                // 					$gagal++;
                // 					$ket .= $datas[0] . " , ";
                // 					array_push($failed, $datas[0]);
                // 				}
                // 			}
                // 		}
                // 	}
                // }
            }
            $this->notifikasiTenderBaru($tender);
        } else {
            $ket = "Data kosong pada lpse " . $this->base_url;
        }

        $check_history = $this->scrap->getHistoryByIdLpse($this->id_lpse, 1);
        $akhir = microtime(true);
        $duration = $akhir - $awal;
        $hours = (int) ($duration / 60 / 60);
        $minutes = (int) ($duration / 60) - $hours * 60;
        $seconds = (int) $duration - $hours * 60 * 60 - $minutes * 60;

        if ($check_history == null) {
            $data = [
                'id_lpse' => $this->id_lpse,
                'id_jenis_monitoring' => 1,
                'url' => $this->base_url,
                'berhasil' => $berhasil,
                'error' => $gagal,
                'keterangan' => $ket,
                'date' => date('Y-m-d'),
                'waktu_eksekusi' => $seconds,
                // 'waktu_eksekusi' => number_format($lama, 3, '.', '')
            ];
            $result = $this->scrap->tambahScrap($data);
            if ($result != true) {
                print_r($result . "<br />");
                print_r("error pada tambah lpse " . $this->base_url . "<br />");
                print_r($data);
                die();
            }
        } else {
            $old_data = $this->scrap->getDataHistory($this->id_lpse, 1, $data);
            if (count($old_data) > 0) {
                $gagal = $old_data[0]['error'] + $gagal;
                $gagal -= $berhasil;
                $berhasil = $old_data[0]['berhasil'] + $berhasil;
            }
            $data = [
                'id_lpse' => $this->id_lpse,
                'id_jenis_monitoring' => 1,
                'url' => $this->base_url,
                'berhasil' => $berhasil,
                'error' => $gagal,
                'keterangan' => $ket,
                'date' => date('Y-m-d'),
                'waktu_eksekusi' => $seconds,
                // 'waktu_eksekusi' => number_format($lama, 3, '.', '')
            ];
            $result = $this->scrap->ubahScrap($this->id_lpse, 1, $data);
            if ($result != true) {
                print_r($result . "<br />");
                print_r("error pada update lpse " . $this->base_url . "<br />");
                print_r($data);
                die();
            }
        }

        return [
            'berhasil' => $berhasil,
            'gagal' => $gagal,
            'failed' => $failed,
            'waktu' => $seconds,
        ];

        // if ($tender != [])
        // 	return [1, null];
        // else
        // 	return [0, $error];
    }

    private function dataTabel()
    {
        $lt = new LpseTable();
        $params = [
            'tahun' => date("Y"),
        ];
        $paramsFuture = [
            'tahun' => date("Y") + 1,
        ];
        // Memecahkan parameter url untuk ditampung di array $params
        foreach ($this->input->get() as $key => $value) {
            if ($this->input->get($key) != "" && $key != "_" && !is_array($this->input->get($key))) {
                $params[$key] = $value;
            }
        }

        foreach ($this->input->get() as $key => $value) {
            if ($this->input->get($key) != "" && $key != "_" && !is_array($this->input->get($key))) {
                $paramsFuture[$key] = $value;
            }
        }

        //Mendapatkan data tender untuk tahun sekarang
        $data = $lt->getTable($this->base_url, $params);
        //Mendapatkan data tender untuk 1 tahun mendatang
        $dataFuture = $lt->getTable($this->base_url, $paramsFuture);
        // if ($dataFuture == null) {
        // 	print_r($this->base_url);
        // 	die();
        // }
        //Menggabungkan data tahun sekarang dan tahun mendatang
        if ($dataFuture != null && $dataFuture->data != null) {
            foreach ($dataFuture->data as $key => $value) {
                array_push($data->data, $value);
            }
            $data->recordsTotal += $dataFuture->recordsTotal;
            $data->recordsFiltered += $dataFuture->recordsFiltered;
        }

        return $data;
    }

    private function scrapping_status()
    {
        $awal = microtime(true);
        $data = $this->dataTabel();

        $result_filter = null;
        $berhasil = 0;
        $gagal = 0;
        $failed = [];
        $ket = "";

        // Mengolah data tersebut jika data tidak kosong di website lpse
        if ($data != null) {
            //Menghilangkan tender dengan status sudah selesai
            if ($this->id_lpse != 11) {
                $result_filter = array_filter($data->data, function ($data) {
                    return $data[3] != "Tender Sudah Selesai" && $data[3] != "Seleksi Gagal" && $data[3] != "Tender Gagal" && $data[3] != "Tender Batal";
                });
            }
            foreach ($result_filter != null ? $result_filter : $data->data as $key => $datas) {
                //Mengecek status dan detail pada tender tersebut apakah sudah ada di database atau tidak
                $status_tender = $this->tender->getStatusTender($datas[0]);
                //Mengecek apakah status tender sudah ada di database atau belum dan apakah status tender tidak sama dengan status tender hasil scrapping
                if ($status_tender != preg_replace('/\[[^\]].*\]/', '', $datas[3])) {
                    //Memasuki halaman pengumuman dan mengambil data yang diperlukan
                    $result = $this->tender->updateStatus($datas[0], (string) preg_replace('/\[[^\]].*\]/', '', $datas[3]), $this->id_lpse);
                    if ($result != null) {
                        $berhasil++;
                    } else {
                        $gagal++;
                        $ket .= $datas[0] . ", ";
                        array_push($failed, $datas[0]);
                    }
                }
            }
        } else {
            // $error = 'error pada ' . preg_replace('/http:\/\/|https:\/\/|\/eproc4/', "", $this->base_url);
            $ket = "Data kosong pada lpse " . $this->base_url;
        }
        $check_history = $this->scrap->getHistoryByIdLpse($this->id_lpse, 2);
        $akhir = microtime(true);
        $duration = $akhir - $awal;
        $hours = (int) ($duration / 60 / 60);
        $minutes = (int) ($duration / 60) - $hours * 60;
        $seconds = (int) $duration - $hours * 60 * 60 - $minutes * 60;
        $data = [
            'id_lpse' => $this->id_lpse,
            'id_jenis_monitoring' => 2,
            'url' => $this->base_url,
            'berhasil' => $berhasil,
            'error' => $gagal,
            'keterangan' => $ket ? $ket : null,
            'date' => date('Y-m-d'),
            'waktu_eksekusi' => $seconds,
            // 'waktu_eksekusi' => number_format($lama, 3, '.', '')
        ];
        if ($check_history == null) {
            $this->scrap->tambahScrap($data);
        } else {
            $this->scrap->ubahScrap($this->id_lpse, 2, $data);
        }
        return [
            'berhasil' => $berhasil,
            'gagal' => $gagal,
            'failed' => $failed,
            'waktu' => $seconds,
        ];
    }

    private function scrapping_status_new($id)
    {
        $tender = [];
        $error = '';
        $html = @file_get_contents($this->base_url . '/lelang/' . $id . '/pengumumanlelang');
        if ($html !== false) {
            $cleaned_html = tidy_html($html);

            libxml_use_internal_errors(true);

            $this->domdoc->loadHTML($cleaned_html);
            $xpath = new DOMXpath($this->domdoc);

            // Tambahan Tender
            $pengumuman = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Tahap Tender Saat Ini']");

            $node_counts_data = $pengumuman->length;
            // if ($node_counts_data) {
            // 	foreach ($tender as $key => $elements) {
            // 		echo $key - 1 . " " . $tender[$key]->nodeValue . "<br />";
            // 	}
            // }

            $status_scrap = null;
            if ($node_counts_data) {
                foreach ($pengumuman as $key => $elements) {
                    $status_scrap = preg_replace('/\[[^\]].*\]/', '', $elements->nodeValue);
                }
            }
            print_r($status_scrap);
            $status_tender = $this->tender->getStatusTender($id);

            //Mengecek apakah status tender sudah ada di database atau belum dan apakah status tender tidak sama dengan status tender hasil scrapping
            if ($status_tender != $status_scrap || $status_tender == null) {
                //Memasuki halaman pengumuman dan mengambil data yang diperlukan
                $this->tender->updateStatus($id, $status_scrap);
            }
        }
    }

    public function index_get()
    {
        set_time_limit(0);
        $lpse = $this->lpse->getAllLpseLink();
        // print_r($lpse);
        foreach ($lpse as $val) {
            $this->base_url = $val["url"];
            $this->id_lpse = $val["id_lpse"];
            // echo preg_replace('/\/eproc4/', "", $this->base_url) . "<br />";
            // echo $this->base_url . "<br />";
            $this->scrapping();
        }
    }

    public function status_get()
    {
        // Mengambil data lpse dari id terbesar hingga ke kecil
        $lpse = $this->lpse->getAllLpseHaveTender();
        // Pagination
        $config['base_url'] = base_url('api/tender/page');
        $config['total_rows'] = count($lpse) - 1;
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $data['start'] = ($this->uri->segment(4) * 10) - 10;
        $resultLpse = array_slice($lpse, $data['start'] ?? 0, $config['per_page']);
        //var_dump($resultLpse);
        //die();
        $berhasil = [];
        $error = [];
        $waktu = 0;
        foreach ($resultLpse as $val) {
            $this->base_url = $val["url"];
            $this->id_lpse = $val["id_lpse"];
            $this->id_wilayah = $val["id_wilayah"];
            $result = $this->scrapping_status();
            array_push($berhasil, "lpse " . $this->id_lpse . " = total " . $result["berhasil"]);
            array_push($error, [$this->id_lpse, $result["gagal"], $result["failed"]]);
            $waktu = $result["waktu"];
        }

        $this->response([
            'status' => true,
            'berhasil' => $berhasil,
            'error' => $error,
            'waktu' => $waktu . " microsecond",
        ], RestController::HTTP_OK);
    }

    public function tender_get()
    {
        // Mengambil data lpse dari id terbesar hingga ke kecil
        $lpse = $this->lpse->getAllLpseLink();

        // Pagination
        $config['base_url'] = base_url('api/tender/page');
        $config['total_rows'] = count($lpse) - 1;
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $data['start'] = ($this->uri->segment(4) * 10) - 10;
        $resultLpse = array_slice($lpse, $data['start'] ?? 0, $config['per_page']);
        //var_dump($resultLpse);
        //die();
        // $links = $this->pagination->create_links();

        // print_r($lpse);
        // die();
        $berhasil = [];
        $error = [];
        $waktu = 0;
        foreach ($resultLpse as $val) {
            if ($val["url"] != '') {
                $this->base_url = $val["url"];
                $this->id_lpse = $val["id_lpse"];
                $this->id_wilayah = $val["id_wilayah"];
                $result = $this->scrapping(false, false, false, false);
                array_push($berhasil, "lpse " . $this->id_lpse . " = total " . $result["berhasil"]);
                array_push($error, [$result["gagal"], $result["failed"]]);
                $waktu = $result["waktu"];
            }
            //  else {
            // 	print_r($this->id_lpse = $val["id_lpse"] . "Gak da url");
            // 	die();
            // }
        }

        $this->response([
            'status' => true,
            'berhasil' => $berhasil,
            'error' => $error,
            'waktu' => $waktu . " microsecond",
        ], RestController::HTTP_OK);
    }

    private function pengumuman($id)
    {
        // Mengambil content dari halaman pengumuman
        // $i = 0;
        // do {
        // 	$html = @file_get_contents($this->base_url . '/lelang/' . $id . '/pengumumanlelang');
        // 	// if ($html === false) {
        // 	// 	echo "Error melakukan requested";
        // 	// 	die();
        // 	// }
        // 	$i++;
        // } while (!$html && $i <= 4);

        $html = @file_get_contents($this->base_url . '/lelang/' . $id . '/pengumumanlelang');
        if ($html !== false) {
            $cleaned_html = tidy_html($html);

            libxml_use_internal_errors(true);

            $this->domdoc->loadHTML($cleaned_html);
            $xpath = new DOMXpath($this->domdoc);

            // Tambahan Tender
            $tender = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Nilai HPS Paket' or text()='Tanggal Pembuatan' or
										text()='Kualifikasi Usaha' or text()='Alasan Pembatalan' or text()='Alasan di ulang']
										|//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Tanggal Pembuatan' or
										text()='Kualifikasi Usaha' or text()='Alasan Pembatalan' or text()='Alasan di ulang']/../td
										|//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Nilai HPS Paket']/../td[2]");
            if ($tender->length == 0) {
                // /html/body/div[2]/div/table/tbody/tr[12]
                $tender = $xpath->query("/html/body/div[2]/div/table/tr/th[text()='Nilai HPS Paket' or text()='Tanggal Pembuatan' or
												text()='Kualifikasi Usaha' or text()='Keterangan']
												|/html/body/div[2]/div/table/tr/th[text()='Tanggal Pembuatan' or
												text()='Kualifikasi Usaha' or text()='Keterangan']/../td
												|/html/body/div[2]/div/table/tr/th[text()='Nilai HPS Paket']/../td[2]");
            }

            $node_counts_data = $tender->length;
            // if ($node_counts_data) {
            // 	foreach ($tender as $key => $elements) {
            // 		echo $key - 1 . " " . $tender[$key]->nodeValue . "<br />";
            // 	}
            // }

            $result_tender = [];
            if ($node_counts_data) {
                foreach ($tender as $key => $elements) {
                    if ($key % 2 == 1) {
                        if ($tender[$key - 1]->nodeValue == "Keterangan") {
                            $result_tender["Alasan"] = $elements->nodeValue;
                        } else {
                            $result_tender[$tender[$key - 1]->nodeValue] = $elements->nodeValue;
                        }
                    }
                }
                $result_tender["Nilai HPS Paket"] = preg_replace("/[^0-9.]/", "", str_replace(',', '.', str_replace('.', '', $result_tender["Nilai HPS Paket"])));
            }

            // Detail Tender
            $detail_tender = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']
										|//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']/../td[1]");
            if ($detail_tender->length == 0) {
                // /html/body/div[2]/div/table/tbody/tr[1]/th
                $detail_tender = $xpath->query("/html/body/div[2]/div/table/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
												text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
												text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']
												|/html/body/div[2]/div/table/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
												text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
												text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']/../td[1]");
            }
            $node_counts_data = $detail_tender->length;
            $result_detail_tender = [];
            //pembentukan detail tender
            if ($node_counts_data) {
                foreach ($detail_tender as $key => $elements) {
                    if ($key % 2 == 1) {
                        if ($detail_tender[$key - 1]->nodeValue == "Lokasi Pekerjaan") {
                            $id_prov = substr($this->id_wilayah, 0, 2);
                            $prov = $this->wilayah->getWilayahById($id_prov);
                            $kab = $this->wilayah->getWilayahById($this->id_wilayah);

                            $result_detail_tender["Lokasi Pekerjaan"] = trim($elements->nodeValue);
                            $result_detail_tender["Kabupaten"] = $kab;
                            $result_detail_tender["Provinsi"] = $prov;
                        } else {
                            $result_detail_tender[$detail_tender[$key - 1]->nodeValue] = trim($elements->nodeValue);
                        }
                    }
                }
                $result_detail_tender["Nilai Pagu Paket"] = preg_replace("/[^0-9.]/", "", str_replace(',', '.', str_replace('.', '', $result_detail_tender["Nilai Pagu Paket"])));
            }

            // RUP
            $rup = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Rencana Umum Pengadaan']/../td//tr/td");
            ;
            $node_counts_data = $rup->length;
            $result_rup = [];
            if ($node_counts_data) {
                foreach ($rup as $key => $elements) {
                    if ($key == 0) {
                        $result_rup["Kode RUP"] = $elements->nodeValue ? (int) $elements->nodeValue : null;
                    } elseif ($key == 1) {
                        $result_rup["Nama Paket"] = $elements->nodeValue ? $elements->nodeValue : null;
                    } elseif ($key == 2) {
                        $result_rup["Sumber Dana"] = $elements->nodeValue ? $elements->nodeValue : null;
                    }
                }
            }

            //Syarat Kualifikasi
            $persyaratan = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/strong|
													//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/table|
													//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/a");

            if ($persyaratan->length == 0) {
                $persyaratan = $xpath->query("/html/body/div[2]/div/table/tr/th[text()='Syarat Kualifikasi']/../td/h5|
														/html/body/div[2]/div/table/tr/th[text()='Syarat Kualifikasi']/../td/table|
														/html/body/div[2]/div/table/tr/th[text()='Syarat Kualifikasi']/../td/a");
            }

            $result_persyaratan = $this->scrapping_persyaratan_kualifikasi($persyaratan, $id);

            return [['detail_tender' => $result_detail_tender], ['rup' => $result_rup], ['tambahan_tender' => $result_tender], ['syarat' => $result_persyaratan]];
        }
        return null;
    }

    public function scrapping_persyaratan_kualifikasi($persyaratan, $kode_tender)
    {
        $resultJudul = [];
        $resultIsiPersyaratan = [];
        $resultPersyaratan = [];
        if ($persyaratan->length == 1) {
            foreach ($persyaratan as $key => $elements) {
                if ($elements->getAttribute("href")) {
                    $resultJudul[0] = 0;
                    $resultIsiPersyaratan[0] = $elements->getAttribute("href");
                } else {
                    // echo $kode_tender;
                    // die();
                    $resultJudul[0] = "Persyaratan Kualifikasi";
                    $resultIsiPersyaratan[0] = $this->domdoc->saveHtml($elements);
                }
            }
        } elseif ($persyaratan->length > 0) {
            $j = 0;
            $i = 0;
            foreach ($persyaratan as $key => $elements) {
                if ($key % 2 == 0) {
                    $resultJudul[$j] = $elements->nodeValue;
                    $j++;
                } else {
                    $resultIsiPersyaratan[$i] = $this->domdoc->saveHtml($elements);
                    $i++;
                }
            }
        }
        for ($i = 0; $i < sizeof($resultJudul); $i++) {
            $resultPersyaratan = ["id_tender" => $kode_tender, "kategori" => $resultJudul[$i], "syarat" => $resultIsiPersyaratan[$i]];
            // $this->syarat_kualifikasi->tambahSyarat($resultPersyaratan);
        }
        return $resultPersyaratan;
    }

    public function pengumuman_get()
    {
        $html = file_get_contents($this->base_url . '17531013/pengumumanlelang');
        $data = [];
        $cleaned_html = tidy_html($html);

        libxml_use_internal_errors(true);

        $this->domdoc->loadHTML($cleaned_html);
        $xpath = new DOMXpath($this->domdoc);

        //scrapping for table heading
        $th = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]/tr/th[text()!='Rencana Umum Pengadaan' and text()!='Kode RUP' and text()!='Nama Paket' and text()!='Sumber Dana' and text()!='Syarat Kualifikasi']");
        $result_th = scrapping($th);

        //scrapping for table data
        $td = $xpath->query("//th[text()='Kode Tender' or text()='Nama Tender']/../td/strong|//table[@class=\"table table-sm table-bordered\"]/tr[position()>2]/td[text()!='Rencana Umum Pengadaan']|//td/a[@target='_blank']");
        $result_td = scrapping($td);

        //Making result Scrapping Tender
        for ($i = 0; $i < sizeof($result_th); $i++) {
            $data[$result_th[$i]] = trim($result_td[$i]);
        }

        // Pemisahan Kabupaten dengan Provinsi
        $lokasi = explode("-", $data["Lokasi Pekerjaan"]);
        unset($data["Lokasi Pekerjaan"]);

        if (count($lokasi) == 3) {
            $result_detail_tender["Lokasi Pekerjaan"] = trim($lokasi[0]);
            $result_detail_tender["Kabupaten"] = trim($lokasi[1]);
            $result_detail_tender["Provinsi"] = trim($lokasi[2]);
        } elseif (count($lokasi) == 2) {
            $result_detail_tender["Lokasi Pekerjaan"] = trim($lokasi[0]);
            $result_detail_tender["Kabupaten"] = trim($lokasi[1]);
            $result_detail_tender["Provinsi"] = substr(strrev('17531013'), 1, 2);
        } else {
            $result_detail_tender["Lokasi Pekerjaan"] = trim($lokasi[0]);
            $result_detail_tender["Kabupaten"] = null;
            $result_detail_tender["Provinsi"] = null;
        }
        $id_lpse = substr(strrev('17531013'), 1, 2);
        //Pembentukan Tender
        $tender = [
            "id_tender" => (int) $data["Kode Tender"],
            "id_lpse" => "",
            "nama_tender" => $data["Nama Tender"],
            "id_jenis" => "",
            "jenis_pengadaan" => $data["Jenis Pengadaan"],
            "tahun_anggaran" => $data["Tahun Anggaran"],
            "metode_pemilihan" => "",
            "metode_pengadaan" => $data["Metode Pengadaan"],
            "metode_evaluasi" => "",
            "alasan" => $data["Alasan Pembatalan"],
            "tender_status" => $data["Tahap Tender Saat Ini"],
            "versi_lpse" => "",
            "nilai_kontrak" => "",
            "kualifikasi" => $data["Kualifikasi Usaha"],
            "nilai_hps" => (float) trim(preg_replace("/Rp.|\./i", "", $data["Nilai HPS Paket"])),
            "tgl_pembuatan_tender" => $data["Tanggal Pembuatan"],
        ];

        // Pembentukan Detail Tender
        $detail_tender = [
            "id_tender" => (int) $data["Kode Tender"],
            "satker" => $data["Satuan Kerja"],
            "nilai_pagu" => (float) trim(preg_replace("/Rp.|\./i", "", $data["Nilai Pagu Paket"])),
            "lokasi_kerja" => trim($lokasi[0]),
            "kabupaten_kerja" => trim($lokasi[1]),
            "provinsi_kerja" => "",
            "cara_bayar" => $data["Jenis Kontrak"],
            "jumlah_peserta" => (int) $data["Peserta Tender"],
        ];

        //scrapping for RUP dan pembentukan RUP
        $rup = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Rencana Umum Pengadaan']/../td//tr/td");
        $rup = scrapping_rup($rup, $result_td[0]);

        //scrapping for persyaratan kualifikasi dan Pembentukan Syarat Kualifikasi
        $persyaratan = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/strong|//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/table");
        //$persyaratan = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td");
        $resultPersyaratan = $this->scrapping_persyaratan_kualifikasi($persyaratan, $rup["Kode Tender"]);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => [
                    'tender' => $tender,
                    'detail' => $detail_tender,
                    'persyaratan' => $resultPersyaratan,
                    'rup' => $rup,
                ],
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta Tender not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function pesertaTender_get()
    {
        $id_tender = $this->tender->getKodeTender();
        // print_r($id_tender);
        // die();
        $resultPeserta = [];
        foreach ($id_tender as $key => $val) {
            $this->base_url = $val["url"];
            $resultPeserta[$key] = $this->peserta_tender($val["id_tender"], $val["id_duplikat"]);
            if ($resultPeserta[$key] != null) {
                $result = $this->evaluasi($val["id_tender"]);
                if ($result != null) {
                    $this->pemenang($val["id_tender"]);
                }
            }
        }
        $this->response([
            'status' => true,
            'message' => 'Peserta dan Pemenang berhasil ditambah sebesar' . count($resultPeserta),
        ], RestController::HTTP_OK);
    }

    private function peserta_tender($kode_tender, $id_duplikat = null)
    {
        //set_time_limit(1000);
        $html = file_get_contents($this->base_url . '/lelang/' . $kode_tender . '/peserta');
        $cleaned_html = tidy_html($html);
        $domdoc = new DOMDocument();

        libxml_use_internal_errors(true);

        $domdoc->loadHTML($cleaned_html);
        $xpath = new DOMXpath($domdoc);

        $jumlah = $xpath->query("//*[@id=\"main\"]/div/table/tbody/tr/td[position() = 1]");
        $heading = ['nama', 'npwp', 'harga_penawaran', 'harga_terkoreksi'];
        $peserta = $xpath->query("//*[@id=\"main\"]/div/table/tbody/tr/td[position() > 1 and position() < 6]");
        $node_counts = $peserta->length;
        if ($jumlah->length != $this->peserta_tender->getCountPesertaTenderByIdTender($kode_tender)) {
            $result = [];
            $i = 0;
            if ($node_counts) {
                foreach ($peserta as $key => $elements) {
                    $result[$i]["id_tender"] = $kode_tender;
                    $result[$i]["id_duplikat"] = $id_duplikat;
                    // $result[$i][$heading[$key % 4]] = trim($elements->nodeValue);
                    if ($key % 4 == 0) {
                        $nama = trim($elements->nodeValue);
                    //die();
                    } else {
                        // $result[$i][$heading[$key % 4]] = preg_replace("/[^0-9,]/", "", trim($elements->nodeValue));
                        $result[$i][$heading[$key % 4]] = trim($elements->nodeValue);
                        // print_r($result[$i][$heading[$key % 4]]);
                        // die();
                    }
                    if ($key % 4 == 3) {
                        if (strlen($result[$i]["npwp"]) > 4) {
                            $this->peserta_tender->tambahPesertaTender($result[$i]);
                        }
                        $i++;
                    } elseif ($key % 4 == 1) {
                        if (strlen($result[$i]["npwp"]) > 4) {
                            $check = $this->peserta->getPesertaByNPWP($result[$i]["npwp"]);
                            if (!$check) {
                                $data = [
                                    'npwp' => $result[$i]["npwp"],
                                    'nama_peserta' => $nama,
                                ];
                                $this->peserta->tambahPeserta($data);
                            }
                        }
                        // $this->peserta($result[$i]["npwp"], $nama);
                    }
                }
                return $result;
            // $this->peserta($result[$i]["npwp"], $nama);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    private function peserta($npwp, $nama)
    {
        $check = $this->peserta->getPesertaByNPWP($npwp);
        if (!$check) {
            $peserta_url = 'https://script.google.com/macros/s/AKfycbyOJ9QVzmOoBbAMYt94OoL1yMCkW-utQ7MxlU19e__iulNKQ8Y/exec?npwp=' . $npwp;
            $client = new Client([
                'headers' => [
                    'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
                ],
            ]);
            $response = null;
            //set_time_limit(600);
            // do {
            // 	$response = $client->request('GET', $peserta_url);
            // 	$response = json_decode($response->getBody()->getContents(), true);
            // } while ($response['data'] == null);

            $response = $client->request('GET', $peserta_url, $this->client->getConfig('headers'));
            $response = json_decode($response->getBody()->getContents(), true);

            //$response = json_decode($response->getBody()->getContents(), true);
            $data = [
                "npwp" => $response['data']['NPWP'] ?? $npwp,
                "nama_peserta" => $nama,
                "alamat" => $response['data']['ALAMAT'] ?? "",
                "kelurahan" => $response['data']['KELURAHAN'] ?? "",
                "kecamatan" => $response['data']['KECAMATAN'] ?? "",
                "kabupaten" => $response['data']['KABKOT'] ?? "",
                "provinsi" => $response['data']['PROVINSI'] ?? "",
                "kode_klu" => $response['data']['KODE_KLU'] ?? "",
                "klu" => $response['data']['KLU'] ?? "",
                "no_telp" => $response['data']['TELP'] ?? "",
                "email" => $response['data']['EMAIL'] ?? "",
            ];
            $this->peserta->tambahPeserta($data);
        }
        //print_r($data);
    }

    public function evaluasi($id_tender)
    {
        $i = 0;
        do {
            $html = @file_get_contents($this->base_url . '/evaluasi/' . $id_tender . '/hasil');
            if ($html === false) {
                break;
            }
            $i++;
        } while (!$html && $i <= 4);
        if ($html != false) {
            $cleaned_html = tidy_html($html);
            // print_r($cleaned_html);
            // die();
            libxml_use_internal_errors(true);

            $this->domdoc->loadHTML($cleaned_html);
            $xpath = new DOMXpath($this->domdoc);

            // Hasil Evaluasi Tender
            $jumlah = $xpath->query("//*[@id=\"main\"]/div/table/tbody/tr/td[position() = 1]");
            if ($jumlah->length != $this->evaluasi->getCountPesertaTenderByIdTender($id_tender)) {
                $heading = $xpath->query("//table[@class=\"table table-sm\"]/thead/tr/th[position() > 1]");
                $results_heading = [];
                foreach ($heading as $key => $val) {
                    switch (trim($val->nodeValue)) {
                        case 'SkorKualifkasi':
                            $results_heading[$key % $heading->length] = "skor_kualifikasi";
                            break;
                        case 'SkorPembuktian':
                            $results_heading[$key % $heading->length] = "skor_pembuktian";
                            break;
                        case 'SkorTeknis':
                            $results_heading[$key % $heading->length] = "skor_teknis";
                            break;
                        case 'SkorHarga':
                            $results_heading[$key % $heading->length] = "skor_harga";
                            break;
                        case 'SkorAkhir':
                            $results_heading[$key % $heading->length] = "skor_akhir";
                            break;
                        case 'Nama Peserta':
                            $results_heading[$key % $heading->length] = "npwp";
                            break;
                        case 'K':
                            $results_heading[$key % $heading->length] = "evaluasi_kualifikasi";
                            break;
                        case 'SK':
                            $results_heading[$key % $heading->length] = "skor_kualifikasi";
                            break;
                        case 'SB':
                            $results_heading[$key % $heading->length] = "skor_pembuktian";
                            break;
                        case 'B':
                            $results_heading[$key % $heading->length] = "pembuktian_kualifikasi";
                            break;
                        case 'A':
                            $results_heading[$key % $heading->length] = "evaluasi_administrasi";
                            break;
                        case 'T':
                            $results_heading[$key % $heading->length] = "evaluasi_teknis";
                            break;
                        case 'ST':
                            $results_heading[$key % $heading->length] = "skor_teknis";
                            break;
                        case 'P':
                            if ($key >= $heading->length - 3) {
                                $results_heading[$key % $heading->length] = "pemenang";
                            } else {
                                $results_heading[$key % $heading->length] = "penawaran";
                            }
                            break;
                        case 'PT':
                            $results_heading[$key % $heading->length] = "penawaran_terkoreksi";
                            break;
                        case 'HN':
                            $results_heading[$key % $heading->length] = "hasil_negosiasi";
                            break;
                        case 'SH':
                            $results_heading[$key % $heading->length] = "skor_harga";
                            break;
                        case 'SA':
                            $results_heading[$key % $heading->length] = "skor_akhir";
                            break;
                        case 'H':
                            $results_heading[$key % $heading->length] = "evaluasi_harga";
                            break;
                        case 'PK':
                            $results_heading[$key % $heading->length] = "pemenang_berkontrak";
                            break;
                        case 'V':
                            $results_heading[$key % $heading->length] = "pemenang_terverifikasi";
                            break;
                        case 'RA':
                            $results_heading[$key % $heading->length] = "reverse_auction";
                            break;
                        default:
                            $results_heading[$key % $heading->length] = strtolower(trim(str_replace(' ', '_', preg_replace('/<[^>]*>/', '', $val->nodeValue))));
                            break;
                    }
                }

                $data = $xpath->query("//table[@class=\"table table-sm\"]/tbody/tr/td[position() > 1]|//table[@class=\"table table-sm\"]/tbody/tr/th");
                // $link = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td/a");

                $node_counts_data = $data->length;
                $result_tahapan = [];
                if ($node_counts_data) {
                    $i = 0;
                    foreach ($data as $key => $elements) {
                        $result_tahapan[$i]["id_tender"] = $id_tender;
                        $icon = $elements->getElementsByTagName('i');
                        $image = $elements->getElementsByTagName('img');
                        // if ($key % $heading->length == 0) {
                        // 	$nama = explode('-', $elements->nodeValue);
                        // 	$nama = trim($nama[0]);
                        // }

                        if ($icon->length > 0) {
                            foreach ($icon as $a) {
                                switch ((string) trim($a->getAttribute('class'))) {
                                    case 'fa fa-check':
                                        $result_tahapan[$i][$results_heading[$key % $heading->length]] = 1;
                                        break;
                                    case 'fa fa-close':
                                        $result_tahapan[$i][$results_heading[$key % $heading->length]] = 0;
                                        break;
                                    default:
                                        $result_tahapan[$i][$results_heading[$key % $heading->length]] = null;
                                }
                            }
                        } elseif ($image->length > 0) {
                            foreach ($image as $img) {
                                $result_tahapan[$i][$results_heading[$key % $heading->length]] = 1;
                                // echo '[ ' . $results_heading[$key % $heading->length]  . ' ] => ' . $img->getAttribute('src') . "\n";
                            }
                        } elseif ($results_heading[$key % $heading->length] == "alasan") {
                            $result_tahapan[$i][$results_heading[$key % $heading->length]] = $elements->nodeValue;
                        } elseif ($results_heading[$key % $heading->length] == "npwp") {
                            $explode = explode('-', $elements->nodeValue, 2);
                            $check = $this->peserta->getPesertaByNPWP(preg_replace("/[^0-9]/", "", $explode[1]));
                            if (!$check) {
                                $data = [
                                    'npwp' => preg_replace("/[^0-9]/", "", $explode[1]),
                                    'nama_peserta' => $explode[0],
                                ];
                                $this->peserta->tambahPeserta($data);
                            }
                            $result_tahapan[$i][$results_heading[$key % $heading->length]] = preg_replace("/[^0-9]/", "", $explode[1]);
                        } elseif ($elements->nodeValue != '') {
                            $result_tahapan[$i][$results_heading[$key % $heading->length]] = str_replace(",", ".", preg_replace("/[^0-9,]/", "", $elements->nodeValue));
                        } else {
                            $result_tahapan[$i][$results_heading[$key % $heading->length]] = null;
                        }

                        if ($key % $heading->length == $heading->length - 1) {
                            $this->evaluasi->tambahEvaluasi($result_tahapan[$i]);
                            $i++;
                        }
                    }
                }
                return $result_tahapan;
            } elseif ($jumlah->length > 0) {
                return 1;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function pemenang($id_tender)
    {
        $html = @file_get_contents($this->base_url . '/evaluasi/' . $id_tender . '/pemenang');
        if ($html === false) {
            return null;
        }
        $pemenang = tidy_html($html);
        $html = @file_get_contents($this->base_url . '/evaluasi/' . $id_tender . '/pemenangberkontrak');
        if ($html === false) {
            return null;
        }
        $pemenang_berkontrak = tidy_html($html);

        libxml_use_internal_errors(true);

        // echo $pemenang_berkontrak;
        // die();

        $this->domdoc->loadHTML($pemenang);
        $xpath_pemenang = new DOMXpath($this->domdoc);

        $this->domdoc->loadHTML($pemenang_berkontrak);
        $xpath_pemenang_berkontrak = new DOMXpath($this->domdoc);

        $pemenang = $xpath_pemenang->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td/table/tr/td[position() = 3 or position() = 5]");
        $pemenang_berkontrak = $xpath_pemenang_berkontrak->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td/table/tr/td[position() > 3]");
        if (count($this->pemenang->getPemenangByIdTender($id_tender)) == 0) {
            if ($pemenang->length > 0 && $pemenang_berkontrak->length > 0) {
                $data = [
                    'id_tender' => $id_tender,
                    'npwp' => preg_replace("/[^0-9]/", "", $pemenang[0]->nodeValue),
                    'harga_negosiasi' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang[1]->nodeValue)),
                    'harga_kontrak' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang_berkontrak[0]->nodeValue)),
                    'nilai_pdn' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang_berkontrak[1]->nodeValue)),
                    'nilai_umk' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang_berkontrak[2]->nodeValue)),
                ];

                $this->pemenang->tambahPemenang($data);
            }
        }
    }

    // public function pesertaTenderUpdate_get()
    // {
    // 	$id_tender = $this->tender->getAllTender([
    // 		[
    // 			'target' => 'tender.id_lpse',
    // 			'sort' => 'DESC',
    // 		],
    // 		[
    // 			'target' => 'tender.id_tender',
    // 			'sort' => 'DESC',
    // 		]
    // 	]);
    // 	$id_lpse = 0;
    // 	$dump_id = 0;
    // 	foreach ($id_tender as $val) {
    // 		$check_tender = (int) $this->peserta_tender->getTenderById($val["id_tender"]);
    // 		if (!$check_tender) {
    // 			$this->base_url = $val["url"];
    // 			$this->peserta_tender($val["id_tender"]);
    // 			$this->evaluasi($val["id_tender"]);
    // 			$this->pemenang($val["id_tender"]);
    // 		}
    // 	}

    // 	$this->response([
    // 		'status' => true,
    // 		'message' => 'Jadwal berhasil ditambah sebesar',
    // 	], RestController::HTTP_OK);
    // }

    public function jadwalUpdate_get()
    {
        $id_tender = $this->tender->getAllTender([
            [
                'target' => 'tender.id_lpse',
                'sort' => 'DESC',
            ],
            [
                'target' => 'tender.id_tender',
                'sort' => 'DESC',
            ],
        ]);

        // $lpse = $this->lpse->getAllLpseLink();
        // foreach ($lpse as $data) {
        // 	$count_tender = $this->tender->getCountTenderOfLPSE($data["lpse"]);
        // 	$count_jadwal_tender =  $this->jadwal->getCountTenderByLPSE($data["id_lpse"]);
        // }
        // $count_tender = $this->tender->getCountTenderOfLPSE();
        // $recent_tender = $this->jadwal->getRecentJadwalByCurrentTender($val["id_lpse"]);
        // $id_lpse = $id_tender[0]["id_lpse"];
        $id_lpse = 0;
        $dump_id = 0;
        $count_jadwal_tender = 0;
        $count_tender = 0;
        foreach ($id_tender as $val) {
            if ($id_lpse == $val["id_lpse"]) {
                $count_jadwal_tender = (int) $this->jadwal->getCountTenderByLPSE($val["id_lpse"]);
                $count_tender = $this->tender->getCountTenderOfLPSE($val["id_lpse"]);
                //  else {
                // 	echo "Tidak perlu update pada lpse = " . $id_lpse . " karena tender = " . $count_jadwal_tender . " dan jadwal = " . $count_tender . "\n";
                // 	// die();
                // }
            }
            if ($count_jadwal_tender != $count_tender) {
                $this->base_url = $val["url"];
                $this->tahap($val["id_tender"]);
            }
            $id_lpse = $val["id_lpse"];

            // echo "id_lpse = " . $val["id_lpse"] . " id tender = " . $val["id_tender"] .  "\n";
            // echo "id_tender = " . $recent_tender . "\n";
            // if ($recent_tender == $val["id_tender"]) {
            // }
        }

        $this->response([
            'status' => true,
            'message' => 'Jadwal berhasil ditambah sebesar',
        ], RestController::HTTP_OK);
    }

    public function jadwal_get()
    {
        $awal = microtime(true);

        $result_filter = null;
        $berhasil = 0;
        $gagal = 0;
        $failed = [];
        $ket = "";
        $id_lpse = 0;
        $base_url = "";

        $id_tender = $this->tender->getKodeTender();
        // print_r($id_tender);
        foreach ($id_tender as $val) {
            $this->id_lpse = $val["id_lpse"];
            $this->base_url = $val["url"];
            $result = $this->tahap($val["id_tender"], $val["id_duplikat"]);
            if ($this->id_lpse == $val["id_lpse"]) {
                $gagal += $result["gagal"] ?? 0;
                $berhasil += $result["berhasil"] ?? 0;
                $id_lpse = $this->id_lpse;
                $base_url = $this->base_url;
            } else {
                $check_history = $this->scrap->getHistoryByIdLpse($id_lpse, 3);
                $akhir = microtime(true);
                $duration = $akhir - $awal;
                $hours = (int) ($duration / 60 / 60);
                $minutes = (int) ($duration / 60) - $hours * 60;
                $seconds = (int) $duration - $hours * 60 * 60 - $minutes * 60;
                $data = [
                    'id_lpse' => $id_lpse,
                    'id_jenis_monitoring' => 3,
                    'url' => $base_url,
                    'berhasil' => $berhasil,
                    'error' => $gagal,
                    'keterangan' => $ket ? $ket : null,
                    'date' => date('Y-m-d'),
                    'waktu_eksekusi' => $seconds,
                    // 'waktu_eksekusi' => number_format($lama, 3, '.', '')
                ];
                if ($check_history == null) {
                    $this->scrap->tambahScrap($data);
                } else {
                    $this->scrap->ubahScrap($this->id_lpse, 3, $data);
                }
                $berhasil = 0;
                $gagal = 0;
                $awal = microtime(true);
            }
        }
        $this->response([
            'status' => true,
            'berhasil' => $berhasil,
        ], RestController::HTTP_OK);
    }

    private function tahap($kode_tender, $id_duplikat = 0)
    {
        // Mengambil konten dari halaman tahap
        // $i = 0;
        // do {
        // 	$html =  @file_get_contents($this->base_url . '/lelang/' . $kode_tender . '/jadwal');
        // 	if ($html === false) {
        // 		break;
        // 	}
        // 	$i++;
        // } while (!$html && $i <= 4);

        $html = @file_get_contents($this->base_url . '/lelang/' . $kode_tender . '/jadwal');
        if ($html != false) {
            $count = $this->jadwal->getCountJadwalByTender($kode_tender);
            $cleaned_html = tidy_html($html);

            libxml_use_internal_errors(true);

            $this->domdoc->loadHTML($cleaned_html);
            $xpath = new DOMXpath($this->domdoc);

            // Mengumpulkan data heading
            $heading = ['id_tahapan', 'tgl_mulai', 'tgl_akhir', 'perubahan', 'link'];
            $result_tahapan = [];

            // Mengambil banyak tahapan yang ada pada halaman jadwal
            $banyak_tahapan = $xpath->query("//table[@class=\"table table-sm\"]/tr/td[position() = 1]");
            // Menghitung total tahapan jadwal pada jadwal tender
            $total_jadwal = $this->jadwal->getCountJadwalByTender($kode_tender);

            // Melakukan query xpath untuk menscrapping data tahapan
            // $tahapan = $xpath->query("//table[@class=\"table table-sm\"]/tr/td[position() > 3]/a|//table[@class=\"table table-sm\"]/tr/td[position() > 1]");
            $tahapan = $xpath->query("//table[@class=\"table table-sm\"]/tr/td[position() > 1]");

            $node_counts_data = $tahapan->length;
            if ($node_counts_data) {
                $i = 0; //Untuk nilai kolom
                $j = 0;
                $link = '';
                foreach ($tahapan as $key => $elements) {
                    // $result_tahapan[$j]["id_duplikat"] = $id_duplikat;
                    $result_tahapan[$j]["id_tender"] = $kode_tender;
                    if ($i == 0) {
                        //dilakukan pengecekan apakah tahapan memiliki id
                        $id = $this->tahapan->getIdTahapanByName(trim($elements->nodeValue));
                        if (!$id) {
                            $this->tahapan->tambahTahapanTender(['nama_tahapan' => trim($elements->nodeValue)]);
                            $id = $this->tahapan->getIdTahapanByName(trim($elements->nodeValue)); // menambah id baru untuk tahapan
                        }
                        $result_tahapan[$j][$heading[$i % 5]] = $id; //menyimpan id tahapan ke dalam array
                    } elseif ($i == 3) {
                        // $link = $xpath->query("//table[@class=\"table table-sm\"]/tr[position()=" . ($key - 1) . "]/td[position() > 3]/a");
                        foreach ($elements->childNodes as $child) {
                            if ($child->nodeName == "a") {
                                $result_tahapan[$j][$heading[$i % 5]] = $child->nodeValue;
                                $explode = explode("/", $child->getAttribute("href"));
                                $result_tahapan[$j]["id_perubahan"] = $explode[3];
                                $link = $child->getAttribute("href");
                            } elseif (trim($child->nodeValue) == "Tidak Ada") {
                                $result_tahapan[$j][$heading[$i % 5]] = $child->nodeValue;
                            }
                        }
                        $id_tahapan = $this->jadwal->getIdTahapanInJadwal($result_tahapan[$j]["id_tender"], $result_tahapan[$j]['id_tahapan']);
                        //Jika id tahapan telah terdaftar dan tidak ada perubahan id_tahapan setelah di scrapping
                        if ($id_tahapan) {
                            if (trim($result_tahapan[$j]["perubahan"]) != "Tidak Ada") {
                                $perubahan = $this->jadwal->getPerubahanJadwalByIdTahapan($result_tahapan[$j]["id_tender"], $result_tahapan[$j]['id_tahapan']);
                                // Jika perubahan pada tahap tersebut tidak sama dengan perubahan jadwal pada db maka ada update di perubahan jadwal
                                if ($perubahan != trim(preg_replace('/[^0-9]/', "", $result_tahapan[$j]["perubahan"]))) {
                                    $id_jadwal = $this->jadwal->ubahJadwalByKodeTenderAndIdTahap($kode_tender, $result_tahapan[$j]['id_tahapan'], $result_tahapan[$j]);
                                    $this->perubahan_jadwal($result_tahapan[$j]["id_perubahan"], $link);
                                }
                            }
                        }
                        // id_tahapan hasil scrapping tidak terdaftar di db berarti tahapan baru
                        else {
                            // $exist_jadwal = $this->jadwal->getJadwalByKodeTenderAndIdTahap($kode_tender, $result_tahapan[$j]['id_tahapan']);
                            // if ($exist_jadwal != null) {
                            // 	print_r($kode_tender . "<br/>");
                            // 	print_r($result_tahapan[$j]['id_tahapan'] . "<br/>");
                            // 	print_r($exist_jadwal);
                            // 	die();
                            // }

                            // if()
                            if (isset($result_tahapan[$j]["id_perubahan"])) {
                                // print_r($result_tahapan[$j]);
                                $perubahan = $this->perubahan_jadwal($result_tahapan[$j]["id_perubahan"], $link);
                                if (!$perubahan) {
                                    return ["gagal" => 1, "id" => $kode_tender];
                                }

                                $id_jadwal = $this->jadwal->tambahJadwal($result_tahapan[$j]);
                            } else {
                                $id_jadwal = $this->jadwal->tambahJadwal($result_tahapan[$j]);
                            }

                            if ($id_jadwal > 0) {
                                // print_r($id_jadwal);
                                // die();
                                return ["berhasil" => 1];
                            // $berhasil++;
                            } else {
                                return ["gagal" => 1, "id" => $kode_tender];
                                // $gagal++;
                                // $ket .= $kode_tender . " , ";
                                // array_push($failed, $kode_tender);
                            }
                            // print_r($result_tahapan);
                        }
                    } else {
                        $waktu = preg_split("/(\w+\s){3}/", trim($elements->nodeValue));
                        $result_tahapan[$j][$heading[$i % 5]] = date('Y-m-d', strtotime(tgl_umum(trim($elements->nodeValue)))) . " " . $waktu[1];
                    }
                    $i++;
                    if ($i == 4) {
                        $i = 0;
                        $j++;
                    }
                }
            }
        }

        // return [
        // 	'berhasil' => $berhasil,
        // 	'gagal' => $gagal,
        // 	'failed' => $failed,
        // 	'waktu' => $seconds
        // ];
    }

    private function perubahan_jadwal($id_perubahan, $link)
    {
        // echo preg_replace('/\/eproc4/', "", "https: //lpse.lkpp.go.id/eproc4/") . $link;
        // die();
        $i = 0;
        do {
            $html = file_get_contents(preg_replace('/\/eproc4/', "", $this->base_url) . $link);
            // $html = file_get_contents("https: //lpse.lkpp.go.id/eproc4" . $link);

            if ($html === false) {
                break;
            }
            $i++;
        } while (!$html && $i <= 4);
        if ($html != false) {
            $cleaned_html = tidy_html($html);

            libxml_use_internal_errors(true);

            $this->domdoc->loadHTML($cleaned_html);
            $xpath = new DOMXpath($this->domdoc);

            $heading = ['tgl_diedit', 'tgl_mulai', 'tgl_akhir', 'keterangan'];
            $perubahan = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]/tr/td[position() > 1]");

            $node_counts_data = $perubahan->length;
            // echo $cleaned_html;
            // die();
            //echo $perubahan->length;
            $result_perubahan = [];
            if ($node_counts_data) {
                $this->perubahan_jadwal->hapusJadwalByIdPerubahan($id_perubahan);

                $i = 0;
                foreach ($perubahan as $key => $elements) {
                    $result_perubahan[$i]['id_perubahan'] = $id_perubahan;
                    if ($key % 4 == 0) {
                        // $result_perubahan[$i]["id_jadwal"] = $id_jadwal;
                        $waktu = preg_split("/(\w+\s){3}/", trim($elements->nodeValue));
                        $result_perubahan[$i][$heading[$key % 4]] = date('Y-m-d', strtotime(tgl_umum(trim($elements->nodeValue)))) . " " . $waktu[1];
                    } elseif ($key % 4 == 3) {
                        $result_perubahan[$i][$heading[$key % 4]] = $elements->nodeValue;
                        // $id_perubahan = $this->perubahan_jadwal->hapusJadwal($id_jadwal, );
                        $this->perubahan_jadwal->tambahJadwal($result_perubahan[$i]);
                        $i++;
                    } elseif ($key % 4 == 1 || $key % 4 == 2) {
                        $waktu = preg_split("/(\w+\s){3}/", trim($elements->nodeValue));
                        $result_perubahan[$i][$heading[$key % 4]] = date('Y-m-d', strtotime(tgl_umum(trim($elements->nodeValue)))) . " " . $waktu[1];
                        // $result_perubahan[$i][$heading[$key % 4]] = date('Y-m-d', strtotime(tgl_umum(trim($elements->nodeValue)))) . " " . substr($elements->nodeValue, 16);
                    }
                }
            }
        }

        // print_r($result_perubahan);
    }

    public function peserta_get()
    {
        $peserta = $this->peserta->getAllPeserta();
        foreach ($peserta as $key => $value) {
            if ($value["alamat"] == null) {
                $peserta_url = 'https://script.google.com/macros/s/AKfycbyOJ9QVzmOoBbAMYt94OoL1yMCkW-utQ7MxlU19e__iulNKQ8Y/exec?npwp=' . $value["npwp"];
                $client = new Client(
                    [
                        'auth' => ['beetend', '76oZ8XuILKys5'],
                    ]
                );
                $response = null;
                // echo $value["npwp"];
                // die();
                $response = $client->request('GET', $peserta_url, $this->client->getConfig('headers'));
                $response = json_decode($response->getBody()->getContents(), true);
                print_r($response);
                die();
                //$response = json_decode($response->getBody()->getContents(), true);
                $data = [
                    "npwp" => $response['data']['NPWP'] ?? $value["npwp"],
                    "nama_peserta" => $value["nama_peserta"],
                    "alamat" => $response['data']['ALAMAT'] ?? null,
                    "kelurahan" => $response['data']['KELURAHAN'] ?? "",
                    "kecamatan" => $response['data']['KECAMATAN'] ?? "",
                    "kabupaten" => $response['data']['KABKOT'] ?? "",
                    "provinsi" => $response['data']['PROVINSI'] ?? "",
                    "kode_klu" => $response['data']['KODE_KLU'] ?? "",
                    "klu" => $response['data']['KLU'] ?? "",
                    "no_telp" => $response['data']['TELP'] ?? "",
                    "email" => $response['data']['EMAIL'] ?? "",
                ];
                $this->peserta->ubahPeserta($value["id_peserta"], $data);
            }
        }
    }

    public function pemenang_get()
    {
        $html = file_get_html('https://lpse.jogjaprov.go.id/eproc4/evaluasi/17573013/pemenang');
        $table = $html->find('table', 0);
        //echo $table;
        //die();
        $result = [];
        //$resultSubTable = [];
        $resultHeading = [];
        $resultData = [];
        foreach ($table->find('tr') as $key => $elements) {
            if (!$elements->find("table")) {
                if ($elements->find("th")) {
                    if ($elements->find("td", 0) != null) {
                        $result[$elements->find("th", 0)->plaintext] = $elements->find("td", 0)->plaintext;
                    }
                }
            } elseif ($elements->find("table")) {
                // echo $elements;
                foreach ($table->find('table tr th') as $keyHeading => $heading) {
                    //echo $keyHeading . ' = ' . $heading->plaintext;

                    $resultHeading[$keyHeading] = $heading->plaintext;
                    // echo "<br />";
                    // if ($table->find('th')) {
                    // 	foreach ($table->find('th') as $keyHeading => $heading) {
                    // 		echo $keyHeading . ' = ' . $heading->plaintext . ' ';
                    // 		//$resultSubTable[$subTable->find("th", 0)->plaintext] = "";
                    // 	}
                    // }

                    // if ($subTable->find('tr td')) {
                    // 	$resultSubTable[$subTable->find("tr th", 0)->plaintext] = $elements->find("tr td", 0)->plaintext;
                    // }
                }

                foreach ($table->find('table tr td') as $keyData => $data) {
                    //echo $keyData . ' = ' . $data;
                    $resultData[$keyData] = $data->plaintext;
                }
                // if ($elements->find("td", 0) != null) {
                // 	$result[$elements->find("th", 0)->plaintext] = $elements->find("td", 0)->plaintext;
                // }
            }
        }

        // print_r($resultData);
        // die();

        //combine result for get data Pemenang
        for ($i = 0; $i < sizeof($resultHeading); $i++) {
            $result[$resultHeading[$i]] = $resultData[$i];
        }

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta Tender not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
