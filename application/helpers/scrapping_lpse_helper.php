<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('tidy_html')) {
    function tidy_html($input_html)
    {
        $config = ['output-html' => true,   'wrap' => 800];
        // 'index' => true,

        //Detect if tidy is in configured
        if (function_exists('tidy_get_release')) {
            $tidy = new tidy();
            $tidy->parseString($input_html, $config, 'raw');
            $tidy->cleanRepair();
            $cleaned_html = tidy_get_output($tidy);
        } else {
            //Tidy not configured for this server
            $cleaned_html = $input_html;
        }

        return $cleaned_html;
    }
}

function scrapping_rup($rup, $kode)
{
    $result_rup = [
        "Kode Tender" => (int) $kode,
    ];

    if ($rup->length > 0) {
        foreach ($rup as $key => $elements) {
            if ($key == 0) {
                $result_rup["Kode RUP"] = (int) $elements->nodeValue;
            } elseif ($key == 1) {
                $result_rup["Nama Paket"] = $elements->nodeValue;
            } elseif ($key == 2) {
                $result_rup["Sumber Dana"] = $elements->nodeValue;
            }
        }
    }
    return $result_rup;
}

function scrapping_peserta($xpath, $result_th, $kode = null)
{
    if ($xpath->length > 0) {
        $my_idx = 0;
        foreach ($xpath as $key => $elements) {
            if ($key % 5 == 0 && $key > 1) {
                $my_idx++;
            }
            // echo "result_td" . "[" . $my_idx . "][" . $result_th[$key % 5] . "]" . '=' . $elements->nodeValue;
            // echo "<br />";
            // Tidak Menampung data pada array Result
            if ($result_th[$key % 5] !== "No") {
                $result[$my_idx]["id_tender"] = $kode;
                $result[$my_idx][$result_th[$key % 5]] = trim($elements->nodeValue);
            }
        }
    } else {
        $result = "xpath Query Salah";
    }
    return $result;
}

function scrapping($xpath)
{
    $node_counts_th = $xpath->length;
    $result = [];
    if ($node_counts_th) {
        foreach ($xpath as $key => $elements) {
            $result[$key] = $elements->nodeValue;
        }
    }
    return $result;
}

// function notifTenderBaru($data)
// {
// 	// Ambil tender baru
// 	// $response = $this->client->request('GET', 'tender/cek-tender-baru',);
// 	// $tender = json_decode($response->getBody()->getContents(), true);
// 	// print_r($tender);
// 	// var_dump($tender);
// 	// die();

// 	// Session
// 	$response = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna']);
// 	$pengguna = json_decode($response->getBody()->getContents(), true);
// 	// var_dump($this->session->user_data['id_pengguna']);
// 	// die();

// 	// if (count($tender['data']) > 0) {
// 	$config = [
// 		'charset' => 'UTF-8',
// 		'useragent' => 'Codeigniter',
// 		'protocol' => 'smtp',
// 		'mailtype' => 'html',
// 		'smtp_host' => 'smtp.gmail.com',
// 		'smtp_port' => '465',
// 		'smtp_timeout' => '60',
// 		'smtp_user' => 'arrio.saputra@students.utdi.ac.id',
// 		'smtp_pass' => 'saputraario',
// 		'crlf' => "\r\n",
// 		'newline' => "\r\n",
// 		'wordwrap' => TRUE,
// 		'smtp_crypto' => 'ssl',
// 	];

// 	// $data = $tender["data"];
// 	// die();
// 	// $id = $data[0]["id_tender"];
// 	// $nama = $data[0]["nama_tender"];

// 	//memanggil library email dan set konfigurasi untuk pengiriman email
// 	$text = '';
// 	foreach ($data as $row) {
// 		$text .= "<tr>";
// 		$text .= "<td style=\"border:1px solid #cccccc;\"><p style=\"text-align:justify;margin:10px;font-size:16px;font-family:Ubuntu,sans-serif;\">" . $row["id_tender"] . "</p></td>";
// 		$text .= "<td style=\"border:1px solid #cccccc;\"><p style=\"text-align:justify;margin:10px;font-size:16px;font-family:Ubuntu,sans-serif;\">" . $row["nama_tender"] . "</p></td>";
// 		$text .= "</tr>";
// 	}

// 	// die();
// 	$this->email->initialize($config);
// 	//konfigurasi pengiriman
// 	$this->email->from($config['smtp_user']);
// 	$this->email->to($pengguna['data']['email']);
// 	$this->email->subject("Ada Tender Baru!");

// 	$message = "
// 			<!DOCTYPE html>
// 			<html lang=\"en\" xmlns=\"https://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">

// 			<head>
// 				<meta charset=\"UTF-8\">
// 				<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
// 				<meta name=\"x-apple-disable-message-reformatting\">
// 				<title></title>
// 				<!--[if mso]>
// 				<noscript>
// 					<xml>
// 						<o:OfficeDocumentSettings>
// 							<o:PixelsPerInch>96</o:PixelsPerInch>
// 						</o:OfficeDocumentSettings>
// 					</xml>
// 				</noscript>
// 				<![endif]-->
// 				<style>
// 					table,
// 					td,
// 					div,
// 					h1,
// 					p {
// 						font-family: Ubuntu, sans-serif;
// 					}
// 				</style>
// 			</head>

// 			<body style=\"margin:0;padding:0;background:#F0F0F0;\">
// 				<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
// 					<tr>
// 						<td align=\"center\" style=\"padding:0;\">
// 							<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border-spacing:0;text-align:left;\">
// 								<tr>
// 									<td style=\"padding:20px 30px;\">
// 										<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
// 											<tr>
// 												<td style=\"padding:0;\">
// 													<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
// 														<tr>
// 															<td style=\"width:260px;padding:0;vertical-align:top;color:#153643;\">
// 																<p style=\"margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Ubuntu,sans-serif;\"><img src=\"https://tenderplus.id/assets/img/homepage_img.png\" alt=\"\" width=\"260\" style=\"height:auto;display:block;\" /></p>
// 															</td>
// 															<td style=\"width:260px;padding:0;vertical-align:top;color:#153643;\">
// 																<p style=\"margin:60px 0 0 0;font-size: 50px;line-height:70px;font-family:Ubuntu,sans-serif;text-align: right;color: #000000;font-style: normal;font-weight: 700;\">TENDER<br>TERBARU</p>
// 															</td>
// 														</tr>
// 													</table>
// 												</td>
// 											</tr>
// 											<tr>
// 												<td style=\"padding:0;\">
// 													<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
// 														<tr>
// 															<td align=\"center\" style=\"width:30px;padding:0;vertical-align:top;color:#153643;\">
// 																<p><img src=\"https://tenderplus.id/assets/img/pinned.png\" alt=\"\" width=\"30\" style=\"height:auto;display:block;margin:20px 0 0 0;\" /></p>
// 															</td>
// 															<td style=\"width:400px;padding:0;vertical-align:top;color:#153643;\">
// 																<p style=\"font-size: 21px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 600;\">BEBERAPA TENDER BERIKUT SESUAI DENGAN PREFERENSI ANDA</p>
// 															</td>
// 														</tr>
// 													</table>
// 												</td>
// 											</tr>
// 											<tr>
// 												<td style=\"padding:0 0 0 0;color:#153643;\">
// 													<p style=\"text-align:justify;margin:0 0 25 0;font-size:16px;line-height:24px;font-family:Ubuntu,sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus repellendus unde earum ea maxime tenetur fuga sequi, quo distinctio inventore nemo animi nesciunt, maiores laboriosam. Placeat minima, non voluptas excepturi, commodi ea sunt corporis, eveniet provident dolore qui. Provident ad nemo vel explicabo libero, corporis ex impedit eveniet? Voluptatum necessitatibus ullam autem provident molestias labore tempore eos architecto, numquam omnis similique molestiae non illum vel, in hic est nostrum facilis aliquam maxime, voluptatibus doloremque adipisci? Illo magni officiis exercitationem sequi voluptatem perspiciatis modi architecto a distinctio, deleniti repudiandae reprehenderit ipsam dolor in suscipit hic ut aliquid ea ratione blanditiis eaque?</p>
// 												</td>
// 											</tr>
// 											<tr>
// 												<td style=\"padding:0;\">
// 													<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;\">
// 														<thead>
// 															<th align=\"center\" style=\"width:100px;padding:0;vertical-align:top;color:#153643;border:1px solid #cccccc;\">
// 																<p style=\"font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">ID</p>
// 															</th>
// 															<th align=\"center\" style=\"width:300px;padding:0;vertical-align:top;color:#153643;\">
// 																<p style=\"font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">NAMA TENDER</p>
// 															</th>
// 														</thead>
// 														<tbody>
// 															$text
// 														</tbody>
// 													</table>
// 												</td>
// 											</tr>
// 										</table>
// 									</td>
// 								</tr>
// 								<tr style=\"margin:20px 30px;\">
// 									<td align=\"center\" style=\"padding:0 0 0 0;background:#BF0C0C;border-radius:10px;\">
// 										<p style=\"font-size: 20px;font-family:Ubuntu,sans-serif;color: #ffffff;font-style: normal;font-weight: 600;\">Jumlah preferensi yang terfilter saat ini: <span style=\"width: 100%;height:100%;background: #ffffff;border-radius: 5px; padding:3px 8px;color:#BF0C0C\">30000</span></p>
// 									</td>
// 								</tr>
// 								<tr>
// 									<td align=\"center\" style=\"padding:100px 0 0 20px;\">
// 										<img src=\"https://tenderplus.id/assets/img/logo-tender.png\" alt=\"\" width=\"150\" style=\"height:auto;display:block;\" />
// 									</td>
// 								</tr>
// 								<tr>
// 									<td>
// 										<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Ubuntu,sans-serif;\">
// 											<tr>
// 												<td style=\"padding:5px 0 5px 0;\">
// 													<table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;\">
// 														<tr>
// 															<td style=\"padding:0 0 50px 10px;width:38px;\">
// 																<a href=\"\">
// 																	<img src=\"\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
// 																</a>
// 															</td>
// 															<td style=\"padding:0 0 50px 10px;width:38px;\">
// 																<a href=\"\">
// 																	<img src=\"\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
// 																</a>
// 															</td>
// 															<td style=\"padding:0 0 50px 10px;width:38px;\">
// 																<a href=\"\">
// 																	<img src=\"\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
// 																</a>
// 															</td>
// 															<td style=\"padding:0 0 50px 10px;width:38px;\">
// 																<a href=\"\">
// 																	<img src=\"\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
// 																</a>
// 															</td>
// 														</tr>
// 													</table>
// 													<table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;\">
// 														<tr>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
// 																<a href=\"\">
// 																	<p style=\"font-style: normal;font-weight: 400;font-size: 15px;color: #000000;\">Tentang Kami</p>
// 																</a>
// 															</td>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
// 																<p style=\"font-style: normal;font-weight: 400;font-size: 15px;color: #000000;\">.</p>
// 															</td>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
// 																<a href=\"\">
// 																	<p style=\"font-style: normal;font-weight: 400;font-size: 15px;color: #000000;\">Kontak Kami</p>
// 																</a>
// 															</td>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
// 																<p style=\"font-style: normal;font-weight: 400;font-size: 15px;color: #000000;\">.</p>
// 															</td>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
// 																<a href=\"\">
// 																	<p style=\"font-style: normal;font-weight: 400;font-size: 15px;color: #000000;\">Kebijakan Privasi</p>
// 																</a>
// 															</td>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
// 																<p style=\"font-style: normal;font-weight: 400;font-size: 15px;color: #000000;\">.</p>
// 															</td>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
// 																<a href=\"\">
// 																	<p style=\"font-style: normal;font-weight: 400;font-size: 15px;color: #000000;\">FAQ</p>
// 																</a>
// 															</td>
// 														</tr>
// 													</table>
// 													<table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;\">
// 														<tr>
// 															<td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
// 																<p style=\"font-style: normal;font-weight: 400;font-size: 12px;color: #000000;\">&copy; 2022. Tender+</p>
// 															</td>
// 														</tr>
// 													</table>
// 												</td>
// 											</tr>
// 										</table>
// 									</td>
// 								</tr>
// 							</table>
// 						</td>
// 					</tr>
// 				</table>
// 			</body>

// 			</html>
// 			";

// 	$this->email->message($message);
// 	$this->email->send();
// 	// }
// }
