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

class ApiTesting extends RestController
{
    private $domdoc;
    private $base_url;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('simple_html_dom');
        $this->load->helper('scrapping_lpse');
        $this->load->helper('tanggal');
        $this->domdoc = new DOMDocument();
        $this->base_url = "https://lpse.lkpp.go.id/eproc4/lelang/";
        $this->load->model('api/Tender_model', 'tender');
        $this->load->model('api/DetailTender_model', 'detail_tender');
        $this->load->model('api/JenisTender_model', 'jenis_tender');
    }

    public function index_get()
    {
        $lt = new LpseTable();
        $params = [
            // 'kategoriId' => 2
            // 'rekanan'
            //'tahun' =>
            // 'instansiId'
            // 'search[value]'
            // 'start'  => 0,
            //'length' => 20
        ];

        foreach ($this->input->get() as $key => $value) {
            if ($this->input->get($key) != "" && $key != "_" && !is_array($this->input->get($key))) {
                $params[$key] = $value;
            }
        }

        // var_dump($params);
        // die();
        //$tender = [];
        //$jenis = "";
        $data = $lt->getTable($params);
        $tender = [];
        foreach ($data->data as $key => $datas) {
            $explode = explode("-", $datas[8]);
            $jenis = $this->jenis_tender->getIdJenisTenderByName($explode[0]);
            $tahun_anggaran = $explode[1];
            $tender[$key] = [
                'id_tender' => $datas[0],
                'id_lpse' => 1,
                'nama_tender' => $datas[1],
                'id_jenis' => $jenis->id_jenis,
                'tahun_anggaran' => substr($tahun_anggaran, 3),
                'metode_pemilihan' => $datas[5],
                'metode_pengadaan' => $datas[6],
                'metode_evaluasi' => $datas[7],
                'tender_status' => $datas[3],
                'alasan' => null,
                'versi_lpse' => null,
                'nilai_kontrak' => $datas[10],
                'kualifikasi' => null,
                'nilai_hps' => $datas[4],
                'tgl_pembuatan' => null,
            ];
            // $result_tender = $this->tender->tambahTender($tender);

            $pengumuman = $this->pengumuman($datas[0]);
            //$result_detail_tender = $this->detail_tender->tambahDetailDataTender($pengumuman[0]["detail_tender"]);
            $rup = array_merge($pengumuman[1]["rup"], ["id_tender" => $datas[0]]);
            //$result_detail_tender = $this->detail_tender->tambahDetailDataTender($rup);
            // print_r($rup);
            // die();
            // foreach ($pengumuman[0] as $key => $detail) {
            // 	print_r($detail);
            // }
            // foreach ($pengumuman[1] as $key => $rup) {
            // 	print_r($rup);
            // }

            // print_r($detail_tender["detail_tender"]);
            //die();
            $tender[$key] = array_merge($tender[$key], ['detail' => $pengumuman[0]["detail_tender"], 'rup' => $rup]);
            // $tender[$key] = [
            // 	'detail' => $pengumuman[0]["detail_tender"],
            // 	'rup' => $rup,
            // ];
            // $result_tender
            // echo "jenis id[" . $key . "] = " . substr($tahun_anggaran, 3);
            // echo "<br />";
            // if ($key >= 300) {
            // 	die();
            // }

            // if (!$result) {
            // 	$this->response([
            // 		'status' => false,
            // 		'message' => 'Error saat menginputkan data'
            // 	], RestController::HTTP_NOT_FOUND);
            // }
        }
        //die();
        // print_r($tender);
        // die();
        //$result_tender = json_encode($tender);

        $this->response([
            'status' => true,
            'total' => count($tender),
            'data' => $tender,
        ], RestController::HTTP_OK);
        //echo $json;
    }

    private function pengumuman($id)
    {
        $html = file_get_contents($this->base_url . $id . '/pengumumanlelang');
        $data = [];
        $cleaned_html = tidy_html($html);
        // echo $cleaned_html;
        // die();
        libxml_use_internal_errors(true);

        $this->domdoc->loadHTML($cleaned_html);
        $xpath = new DOMXpath($this->domdoc);

        // Detail Tender

        $detail_tender = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']
										|//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']/../td[1]");

        $node_counts_data = $detail_tender->length;
        // echo $cleaned_html;
        // die();
        $result_detail_tender = [];
        //pembentukan detail tender
        if ($node_counts_data) {
            foreach ($detail_tender as $key => $elements) {
                if ($key % 2 == 1) {
                    if ($detail_tender[$key - 1]->nodeValue == "Lokasi Pekerjaan") {
                        $lokasi = explode("-", trim($elements->nodeValue));
                        /* highlight_string("<?php\n\$lokasi =\n" . var_export($lokasi, true) . ";\n?>");
                        die(); */
                        if (count($lokasi) == 3) {
                            $result_detail_tender["Lokasi Pekerjaan"] = trim($lokasi[0]);
                            $result_detail_tender["Kabupaten"] = trim($lokasi[1]);
                            $result_detail_tender["Provinsi"] = trim($lokasi[2]);
                        } elseif (count($lokasi) == 2) {
                            $result_detail_tender["Lokasi Pekerjaan"] = trim($lokasi[0]);
                            $result_detail_tender["Kabupaten"] = trim($lokasi[1]);
                            $result_detail_tender["Provinsi"] = null;
                        } else {
                            $result_detail_tender["Lokasi Pekerjaan"] = trim($lokasi[0]);
                            $result_detail_tender["Kabupaten"] = null;
                            $result_detail_tender["Provinsi"] = null;
                        }
                    } else {
                        $result_detail_tender[$detail_tender[$key - 1]->nodeValue] = trim($elements->nodeValue);
                    }
                }
            }
        }

        // RUP

        $rup = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Rencana Umum Pengadaan']/../td//tr/td");
        ;
        $node_counts_data = $rup->length;
        // echo $node_counts_data;
        // die();
        $result_rup = [];
        if ($node_counts_data) {
            foreach ($rup as $key => $elements) {
                if ($key == 0) {
                    $result_rup["Kode RUP"] = (int) $elements->nodeValue;
                } elseif ($key == 1) {
                    $result_rup["Nama Paket"] = $elements->nodeValue;
                } else {
                    $result_rup["Sumber Dana"] = $elements->nodeValue;
                }
            }
        }
        //die();

        // //Pembentukan Tender
        // $tender = [
        // 	"id_tender" => (int)$data["Kode Tender"],
        // 	"id_lpse" => "",
        // 	"nama_tender" => $data["Nama Tender"],
        // 	"id_jenis" => "",
        // 	"jenis_pengadaan" => $data["Jenis Pengadaan"],
        // 	"tahun_anggaran" => $data["Tahun Anggaran"],
        // 	"metode_pemilihan" => "",
        // 	"metode_pengadaan" => $data["Metode Pengadaan"],
        // 	"metode_evaluasi" => "",
        // 	//"alasan" => $data["Alasan Pembatalan"],
        // 	"tender_status" => $data["Tahap Tender Saat Ini"],
        // 	"versi_lpse" => "",
        // 	"nilai_kontrak" => "",
        // 	"kualifikasi" => $data["Kualifikasi Usaha"],
        // 	"nilai_hps" => (float)trim(preg_replace("/Rp.|\./i", "", $data["Nilai HPS Paket"])),
        // 	"tgl_pembuatan_tender" => $data["Tanggal Pembuatan"]
        // ];

        // // Pembentukan Detail Tender
        // $detail_tender = [
        // 	"id_tender" => (int)$data["Kode Tender"],
        // 	"satker" => $data["Satuan Kerja"],
        // 	"nilai_pagu" => (float)trim(preg_replace("/Rp.|\./i", "", $data["Nilai Pagu Paket"])),
        // 	"lokasi_kerja"  => trim($lokasi[0]),
        // 	//"kabupaten_kerja" => trim($lokasi[1]),
        // 	"provinsi_kerja" => "",
        // 	"cara_bayar" => $data["Jenis Kontrak"],
        // 	"jumlah_peserta" => (int)$data["Peserta Tender"]
        // ];

        // //scrapping for RUP dan pembentukan RUP
        // $rup = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Rencana Umum Pengadaan']/../td//tr/td");
        // $rup = scrapping_rup($rup, $result_td[0]);

        //scrapping for persyaratan kualifikasi dan Pembentukan Syarat Kualifikasi
        // $persyaratan = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/strong|//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/table");
        // //$persyaratan = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td");
        // $resultPersyaratan = $this->scrapping_persyaratan_kualifikasi($persyaratan, $rup["Kode Tender"]);

        return [['detail_tender' => $result_detail_tender], ['rup' => $result_rup]];

        // if ($data) {
        // 	$this->response([
        // 		'status' => true,
        // 		'data' => $data
        // 	], RestController::HTTP_OK);
        // } else {
        // 	$this->response([
        // 		'status' => false,
        // 		'message' => 'Peserta Tender not found'
        // 	], RestController::HTTP_NOT_FOUND);
        // }
    }

    // public function perubahaJadwal_get()
    // {
    // 	$html = file_get_contents('https://lpse.lkpp.go.id/' . $link);
    // 	$cleaned_html = tidy_html($html);

    // 	libxml_use_internal_errors(true);

    // 	$this->domdoc->loadHTML($cleaned_html);
    // 	$xpath = new DOMXpath($this->domdoc);

    // 	$heading = ['tgl_diedit', 'tgl_mulai', 'tgl_akhir', 'keterangan'];
    // 	$perubahan = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]/tr/td[position() > 1]");

    // 	$node_counts_data = $perubahan->length;
    // 	//echo $perubahan->length;
    // 	$result_perubahan = [];
    // 	if ($node_counts_data) {
    // 		$i = 0;
    // 		foreach ($perubahan as $key => $elements) {
    // 			if ($key % 4 == 0) {
    // 				$result_perubahan[$i]["id_jadwal"] = $id_jadwal;
    // 				$result_perubahan[$i][$heading[$key % 4]] = date('Y-m-d', strtotime(tgl_umum(trim($elements->nodeValue)))) . " " . substr($elements->nodeValue, 16);
    // 			} else if ($key % 4 == 3) {
    // 				$result_perubahan[$i][$heading[$key % 4]] = $elements->nodeValue;
    // 				$this->perubahan_jadwal->tambahJadwal($result_perubahan[$i]);
    // 				$i++;
    // 			} else if ($key % 4 == 1 || $key % 4 == 2) {
    // 				$result_perubahan[$i][$heading[$key % 4]] = date('Y-m-d', strtotime(tgl_umum(trim($elements->nodeValue)))) . " " . substr($elements->nodeValue, 16);
    // 			}
    // 		}
    // 	}
    // 	// print_r($result_perubahan);
    // }
    public function pengumuman_get()
    {
        $html = file_get_contents('https://lpse.kalteng.go.id/eproc4/lelang/13350012/pengumumanlelang');
        $data = [];
        $cleaned_html = tidy_html($html);
        // echo $cleaned_html;
        // die();
        libxml_use_internal_errors(true);

        $this->domdoc->loadHTML($cleaned_html);

        $xpath = new DOMXpath($this->domdoc);

        //tambahan tender
        $tender = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Nilai HPS Paket' or text()='Tanggal Pembuatan' or
										text()='Kualifikasi Usaha' or text()='Alasan Pembatalan'  or text()='Alasan di ulang']
										|//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Tanggal Pembuatan' or
										text()='Kualifikasi Usaha' or text()='Alasan Pembatalan'  or text()='Alasan di ulang']/../td
										|//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]
										/tr/th[text()='Nilai HPS Paket']/../td[2]");
        if ($tender->length == 0) {
            // /html/body/div[2]/div/table/tbody/tr[12]
            $tender = $xpath->query("/html/body/div[2]/div/table/tr/th[text()='Nilai HPS Paket' or text()='Tanggal Pembuatan' or
										text()='Kualifikasi Usaha' or text()='Keterangan']
										|/html/body/div[2]/div/table/tr/th[text()='Tanggal Pembuatan' or
										text()='Kualifikasi Usaha' or text()='Keterangan']/../td
										|/html/body/div[2]/div/table/tr/th[text()='Nilai HPS Paket']/../td[2]");
            // foreach ($tender as $key => $elements) {
            // 	echo $elements->nodeValue . "\n";
            // }
            // die();
        }
        $node_counts_data = $tender->length;
        // echo $node_counts_data;
        // die();
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

        //Specific data get
        $data = $xpath->query("//*[@id=\"main\"]/div/table/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']
										|//*[@id=\"main\"]/div/table/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']/../td[1]");
        if ($data->length == 0) {
            // /html/body/div[2]/div/table/tbody/tr[1]/th
            $data = $xpath->query("/html/body/div[2]/div/table/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']
										|/html/body/div[2]/div/table/tr/th[text()='Kode Tender' or text()='Nama Tender' or 
										text()='Satuan Kerja' or text()='Lokasi Pekerjaan' or
										text()='Jenis Kontrak' or text()='Peserta Tender' or text()='Nilai Pagu Paket']/../td[1]");
        }
        // var_export($data->length);
        // die();
        //$result_th = scrapping($th);
        // foreach ($data as $key => $elements) {
        // 	echo $elements->nodeValue . "<br/>";
        // }
        // die();
        $node_counts_data = $data->length;
        $result = [];
        if ($node_counts_data) {
            foreach ($data as $key => $elements) {
                if ($key % 2 == 1) {
                    if ($data[$key - 1]->nodeValue == "Lokasi Pekerjaan") {
                        $explode = explode("\n", trim($elements->nodeValue));
                        $lokasi = preg_split("/ - /", $explode[0]);
                        // print_r($lokasi);
                        // die();
                        /* highlight_string("<?php\n\$lokasi =\n" . var_export($lokasi, true) . ";\n?>");
                        die(); */
                        if (count($lokasi) > 2) {
                            $result["Lokasi Pekerjaan"] = $lokasi[0];
                            $result["Kabupaten"] = $lokasi[1];
                            $result["Provinsi"] = $lokasi[2];
                        } elseif (count($lokasi) > 1) {
                            $result["Lokasi Pekerjaan"] = $lokasi[0];
                            $result["Kabupaten"] = $lokasi[1];
                        } else {
                            $result["Lokasi Pekerjaan"] = $lokasi[0];
                        }
                    } else {
                        $result[$data[$key - 1]->nodeValue] = trim($elements->nodeValue);
                    }
                }
            }
        }
        // $this->response([
        // 	'status' => true,
        // 	'data' => $result
        // ], RestController::HTTP_OK);
        // die();
        // //scrapping for table heading
        // $th = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm table-bordered\"]/tr/th[text()!='Rencana Umum Pengadaan' and text()!='Kode RUP' and text()!='Nama Paket' and text()!='Sumber Dana' and text()!='Syarat Kualifikasi']");
        // $result_th = scrapping($th);

        // //scrapping for table data
        $td = $xpath->query("//th[text()='Kode Tender' or text()='Nama Tender']/../td/strong|//table[@class=\"table table-sm table-bordered\"]/tr[position()>2]/td[text()!='Rencana Umum Pengadaan']|//td/a[@target='_blank']");
        $result_td = scrapping($td);

        // //Making result Scrapping Tender
        // for ($i = 0; $i < sizeof($result_th); $i++) {
        // 	$data[$result_th[$i]] = trim($result_td[$i]);
        // }

        // // Pemisahan Kabupaten dengan Provinsi
        // $lokasi = explode("-", $data["Lokasi Pekerjaan"]);
        // unset($data["Lokasi Pekerjaan"]);

        //Pembentukan Tender
        $tender = [
            "id_tender" => $data["Kode Tender"],
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
            // "nilai_hps" => (float)trim(preg_replace("/Rp.|\./i", "", $data["Nilai HPS Paket"])),
            "tgl_pembuatan_tender" => $data["Tanggal Pembuatan"],
        ];

        // // Pembentukan Detail Tender
        // $detail_tender = [
        // 	"id_tender" => (int)$data["Kode Tender"],
        // 	"satker" => $data["Satuan Kerja"],
        // 	"nilai_pagu" => (float)trim(preg_replace("/Rp.|\./i", "", $data["Nilai Pagu Paket"])),
        // 	"lokasi_kerja"  => trim($lokasi[0]),
        // 	"kabupaten_kerja" => trim($lokasi[1]),
        // 	"provinsi_kerja" => "",
        // 	"cara_bayar" => $data["Jenis Kontrak"],
        // 	"jumlah_peserta" => (int)$data["Peserta Tender"]
        // ];

        // scrapping for RUP dan pembentukan RUP
        $result_rup = [];
        $rup = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Rencana Umum Pengadaan']/../td//tr/td");
        if ($rup->length > 0) {
            foreach ($rup as $key => $elements) {
                if ($key == 0) {
                    $result_rup["Kode RUP"] = (int) $elements->nodeValue;
                } elseif ($key == 1) {
                    $result_rup["Nama Paket"] = $elements->nodeValue;
                } elseif ($key == 2) {
                    $result_rup["Sumber Dana"] = $elements->nodeValue;
                }
                // echo $key . " => " . $elements->nodeValue . "<br/>";
            }
            // die();
        }
        // print_r($result_rup);
        // die();
        $rup = scrapping_rup($rup, $result_td[0]);

        // scrapping for persyaratan kualifikasi dan Pembentukan Syarat Kualifikasi
        $persyaratan = $xpath->query("//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/strong|
												//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/table|
												//table[@class=\"table table-sm table-bordered\"]/tr/th[text()='Syarat Kualifikasi']/../td/a");
        if ($persyaratan->length == 0) {
            // /html/body/div[2]/div/table/tbody/tr[1]/th
            // /html/body/div[2]/div/table/tbody/tr[16]/th
            // /html/body/div[2]/div/table/tbody/tr[16]/td/h5[1]
            // /html/body/div[2]/div/table/tbody/tr[16]/td/table/tbody/tr[1]/td[2]
            $persyaratan = $xpath->query("/html/body/div[2]/div/table/tr/th[text()='Syarat Kualifikasi']/../td/h5|
			/html/body/div[2]/div/table/tr/th[text()='Syarat Kualifikasi']/../td/table|
			/html/body/div[2]/div/table/tr/th[text()='Syarat Kualifikasi']/../td/a");
            // foreach ($persyaratan as $key => $elements) {
            // 	echo $elements->nodeValue . "<br/>";
            // }
            // echo $persyaratan->length;
            // die();
            $resultJudul = [];
            $resultIsiPersyaratan = [];
            $resultPersyaratan = [];
            if ($persyaratan->length == 1) {
                // echo "masuk sini";
                // die();
                foreach ($persyaratan as $key => $elements) {
                    if ($elements->getAttribute("href")) {
                        $resultJudul[0] = 0;
                        $resultIsiPersyaratan[0] = $elements->getAttribute("href");
                    } else {
                        $resultJudul[0] = "Persyaratan Kualifikasi";
                        $resultIsiPersyaratan[0] = $this->domdoc->saveHtml($elements);
                    }
                }
            } elseif ($persyaratan->length > 0) {
                echo "masuk sini";
                die();
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
                // $resultPersyaratan = "";
                $resultPersyaratan[$i] = ["kode_tender" => (int) $rup["Kode Tender"], "kategori" => $resultJudul[$i], "syarat" => $resultIsiPersyaratan[$i]];
            }

            if ($data) {
                $this->response([
                    'status' => true,
                    'data' => [
                        'tender' => $tender,
                        'detail' => $result,
                        'tambahan' => $result_tender,
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

        $resultPersyaratan = $this->scrapping_persyaratan_kualifikasi($persyaratan, $rup["Kode Tender"]);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => [
                    'tender' => $tender,
                    'detail' => $result,
                    'tambahan_data' => $result_tender,
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

    public function scrapping_persyaratan_kualifikasi($persyaratan, $kode_tender)
    {
        $resultJudul = [];
        $resultIsiPersyaratan = [];
        $resultPersyaratan = [];
        if ($persyaratan->length == 1) {
            foreach ($persyaratan as $key => $elements) {
                $resultJudul[0] = 0;
                $resultIsiPersyaratan[0] = $elements->getAttribute("href");
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
            // $resultPersyaratan = "";
            $resultPersyaratan[$i] = ["kode_tender" => (int) $kode_tender, "kategori" => $resultJudul[$i], "syarat" => $resultIsiPersyaratan[$i]];
        }
        return $resultPersyaratan;
    }

    private function peserta($npwp)
    {
        $peserta_url = 'https://script.google.com/macros/s/AKfycbyOJ9QVzmOoBbAMYt94OoL1yMCkW-utQ7MxlU19e__iulNKQ8Y/exec?npwp=' . $npwp;
        print_r($peserta_url);
        die();
        $client = new Client(
            [
                'headers' => [
                    'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
                ],
            ]
        );
        $response = $client->request('GET', $peserta_url, $this->client->getConfig('headers'));
        $response = json_decode($response->getBody()->getContents(), true);
        $data = [
            "npwp" => $response['data']['NPWP'],
            "nama_peserta" => $response['data']['NAMA'],
            "alamat" => $response['data']['ALAMAT'],
            "kelurahan" => $response['data']['KELURAHAN'],
            "kecamatan" => $response['data']['KECAMATAN'],
            "kabupaten" => $response['data']['KABKOT'],
            "provinsi" => $response['data']['PROVINSI'],
            "kode_klu" => $response['data']['KODE_KLU'],
            "klu" => $response['data']['KLU'],
            "no_telp" => $response['data']['TELP'],
            "email" => $response['data']['EMAIL'],
        ];

        print_r($data);
    }

    public function pesertaTender_get()
    {
        // Using xpath
        $html = file_get_contents('http://lpse.lamongankab.go.id/eproc4/lelang/7499057/peserta');
        $cleaned_html = tidy_html($html);
        $domdoc = new DOMDocument();
        // echo $cleaned_html;
        // die();
        libxml_use_internal_errors(true);

        $domdoc->loadHTML($cleaned_html);
        $xpath = new DOMXpath($domdoc);

        $heading = ['nama', 'npwp', 'harga_penawaran', 'harga_terkoreksi'];
        $peserta = $xpath->query("//*[@id=\"main\"]/div/table/tbody/tr/td[position() > 1 and position() < 6]");
        $node_counts_th = $peserta->length;
        $result = [];

        $i = 0;
        if ($node_counts_th) {
            foreach ($peserta as $key => $elements) {
                $result[$i]["id_tender"] = 7883119;
                // $result[$i][$heading[$key % 4]] = trim($elements->nodeValue);
                if ($key % 4 == 0) {
                    $nama = trim($elements->nodeValue);
                //die();
                } elseif ($heading[$key % 4] == "npwp") {
                    $explode = explode(' - ', $elements->nodeValue, 1);
                    // $result[$i][$heading[$key % 4]] = $explode[0];
                    $result[$i][$heading[$key % 4]] = preg_replace("/[^0-9]/", "", $explode[0]);
                } else {
                    $result[$i][$heading[$key % 4]] = preg_replace("/[^0-9,]/", "", trim($elements->nodeValue));
                }

                if ($key % 4 == 3) {
                    // $this->peserta_tender->tambahPesertaTender($result[$i]);
                    $i++;
                }
                // else if ($key % 4 == 1) {
                // 	$check = $this->peserta->getPesertaByNPWP($result[$i]["npwp"]);
                // 	if (!$check) {
                // 		$data = [
                // 			'npwp' => $result[$i]["npwp"],
                // 			'nama_peserta' => $nama
                // 		];
                // 		$this->peserta->tambahPeserta($data);
                // 	}
                // 	// $this->peserta($result[$i]["npwp"], $nama);
                // }
            }
        }
        // print_r($result);
        /* highlight_string("<?php\n\$result =\n" . var_export($result, true) . ";\n?>");*/
        // die();

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

    public function peserta_get($npwp = null)
    {
        $peserta_url = 'https://script.google.com/macros/s/AKfycbyOJ9QVzmOoBbAMYt94OoL1yMCkW-utQ7MxlU19e__iulNKQ8Y/exec?npwp=032051393721000';
        $client = new Client(
            [
                'headers' => [
                    'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
                ],
            ]
        );
        $response = $client->request('GET', $peserta_url, $this->client->getConfig('headers'));
        $response = json_decode($response->getBody()->getContents(), true);
        $data = [
            "npwp" => $response['data']['NPWP'],
            "nama_peserta" => $response['data']['NAMA'],
            "alamat" => $response['data']['ALAMAT'],
            "kelurahan" => $response['data']['KELURAHAN'],
            "kecamatan" => $response['data']['KECAMATAN'],
            "kabupaten" => $response['data']['KABKOT'],
            "provinsi" => $response['data']['PROVINSI'],
            "kode_klu" => $response['data']['KODE_KLU'],
            "klu" => $response['data']['KLU'],
            "no_telp" => $response['data']['TELP'],
            "email" => $response['data']['EMAIL'],
        ];

        //print_r($data);
        //echo $response['data']['NPWP'] . "<br />";
        // foreach ($response['data'] as $key => $data) {
        // 	echo $data['NPWP'] . "<br />";
        // }
        //echo $response->getBody()->getContents();
    }

    // public function pemenang_get($id_tender = 7573119)
    // {
    // 	$html = file_get_html('https://lpse.jogjaprov.go.id/eproc4/evaluasi/' . $id_tender . '/pemenang');
    // 	$table = $html->find('table', 0);
    // 	//echo $table;
    // 	//die();
    // 	$result = [];
    // 	//$resultSubTable = [];
    // 	$resultHeading = [];
    // 	$resultData = [];
    // 	foreach ($table->find('tr') as $key => $elements) {
    // 		if (!$elements->find("table")) {
    // 			if ($elements->find("th")) {
    // 				if ($elements->find("td", 0) != null) {
    // 					$result[$elements->find("th", 0)->plaintext] = $elements->find("td", 0)->plaintext;
    // 				}
    // 			}
    // 		} else if ($elements->find("table")) {
    // 			// echo $elements;
    // 			foreach ($table->find('table tr th') as $keyHeading => $heading) {
    // 				//echo $keyHeading . ' = ' . $heading->plaintext;

    // 				$resultHeading[$keyHeading] = $heading->plaintext;
    // 				// echo "<br />";
    // 				// if ($table->find('th')) {
    // 				// 	foreach ($table->find('th') as $keyHeading => $heading) {
    // 				// 		echo $keyHeading . ' = ' . $heading->plaintext . ' ';
    // 				// 		//$resultSubTable[$subTable->find("th", 0)->plaintext] = "";
    // 				// 	}
    // 				// }

    // 				// if ($subTable->find('tr td')) {
    // 				// 	$resultSubTable[$subTable->find("tr th", 0)->plaintext] = $elements->find("tr td", 0)->plaintext;
    // 				// }
    // 			}

    // 			foreach ($table->find('table tr td') as $keyData => $data) {
    // 				//echo $keyData . ' = ' . $data;
    // 				$resultData[$keyData] = $data->plaintext;
    // 			}
    // 			// if ($elements->find("td", 0) != null) {
    // 			// 	$result[$elements->find("th", 0)->plaintext] = $elements->find("td", 0)->plaintext;
    // 			// }
    // 		}
    // 	}

    // 	// print_r($resultData);
    // 	// die();

    // 	//combine result for get data Pemenang
    // 	for ($i = 0; $i < sizeof($resultHeading); $i++) {
    // 		$result[$resultHeading[$i]] = $resultData[$i];
    // 	}

    // 	if ($result) {
    // 		$this->response([
    // 			'status' => true,
    // 			'data' => $result
    // 		], RestController::HTTP_OK);
    // 	} else {
    // 		$this->response([
    // 			'status' => false,
    // 			'message' => 'Peserta Tender not found'
    // 		], RestController::HTTP_NOT_FOUND);
    // 	}
    // }

    public function tahap_get()
    {
        $html = file_get_contents($this->base_url . '7828119' . '/jadwal');
        $cleaned_html = tidy_html($html);

        libxml_use_internal_errors(true);

        $this->domdoc->loadHTML($cleaned_html);
        $xpath = new DOMXpath($this->domdoc);

        // tahapan Tender

        $heading = ['id_tahapan', 'tgl_mulai', 'tgl_akhir', 'perubahan', 'link'];
        $tahapan = $xpath->query("//table[@class=\"table table-sm\"]/tr/td[position() > 3]/a|//table[@class=\"table table-sm\"]/tr/td[position() > 1]");
        $link = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td[position() > 1]/a");
        // echo $cleaned_html;
        // die();
        $node_counts_data = $tahapan->length;
        //echo $tahapan->length;
        $result_tahapan = [];
        if ($node_counts_data) {
            $i = 0;
            $j = 0;
            $id_jadwal = 0;
            foreach ($tahapan as $key => $elements) {
                $result_tahapan[$j]["id_tender"] = 7828119;
                if ($i == 4) {
                    print_r(trim(preg_replace('/[^0-9]/', "", $result_tahapan[$j]["perubahan"])));
                    die();
                    //$result_tahapan[$j][$heading[$i % 5]] = $elements->getAttribute("href");
                    // $this->perubahan_jadwal($elements->getAttribute("href"), $id_jadwal);
                    $j++;
                    $i = 0;
                } else {
                    if ($i == 0) {
                        // $id = $this->tahapan->getIdTahapanByName(trim($elements->nodeValue));
                        // if (!$id) {
                        // 	$this->tahapan->tambahTahapanTender(['nama_tahapan' => trim($elements->nodeValue)]);
                        // 	$id = $this->tahapan->getIdTahapanByName(trim($elements->nodeValue));
                        // }
                        $result_tahapan[$j][$heading[$i % 5]] = 1;
                    } elseif ($i >= 3) {
                        $result_tahapan[$j][$heading[$i % 5]] = trim($elements->nodeValue);
                    // $id_jadwal = $this->jadwal->tambahJadwal($result_tahapan[$j]);
                    } else {
                        $jadwal = '7 Mei 2021 13:00';
                        // $tanggal = tgl_umum(trim($jadwal));
                        $waktu = preg_split("/(\w+\s){3}/", trim($jadwal));
                        // print_r(trim($jadwal));

                        $result_tahapan[$j][$heading[$i % 5]] = date('Y-m-d', strtotime(tgl_umum(trim($jadwal)))) . " " . $waktu[1];
                        // print_r(tgl_umum(trim($jadwal)));
                        // print_r($result_tahapan[$j][$heading[$i % 5]]);
                        // die();
                    }
                    $i++;
                }
                if (trim($elements->nodeValue) == "Tidak Ada") {
                    $j++;
                    $i = 0;
                }
            }
        }
        print_r($result_tahapan);
    }

    public function lpse_get()
    {
        $html = file_get_contents($this->base_url . '7828119' . '/jadwal');
        $cleaned_html = tidy_html($html);

        libxml_use_internal_errors(true);

        $this->domdoc->loadHTML($cleaned_html);
        $xpath = new DOMXpath($this->domdoc);

        // tahapan Tender

        $heading = ['id_tahapan', 'tgl_mulai', 'tgl_akhir', 'perubahan', 'link'];
        $tahapan = $xpath->query("//table[@class=\"table table-sm\"]/tr/td[position() > 3]/a|//table[@class=\"table table-sm\"]/tr/td[position() > 1]");
        $link = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td[position() > 1]/a");
        // echo $cleaned_html;
        // die();
        $node_counts_data = $tahapan->length;
        //echo $tahapan->length;
        $result_tahapan = [];
        if ($node_counts_data) {
            $i = 0;
            $j = 0;
            $id_jadwal = 0;
            foreach ($tahapan as $key => $elements) {
                $result_tahapan[$j]["id_tender"] = 7828119;
                if ($i == 4) {
                    //$result_tahapan[$j][$heading[$i % 5]] = $elements->getAttribute("href");
                    // $this->perubahan_jadwal($elements->getAttribute("href"), $id_jadwal);
                    $j++;
                    $i = 0;
                } else {
                    if ($i == 0) {
                        // $id = $this->tahapan->getIdTahapanByName(trim($elements->nodeValue));
                        // if (!$id) {
                        // 	$this->tahapan->tambahTahapanTender(['nama_tahapan' => trim($elements->nodeValue)]);
                        // 	$id = $this->tahapan->getIdTahapanByName(trim($elements->nodeValue));
                        // }
                        $result_tahapan[$j][$heading[$i % 5]] = 1;
                    } elseif ($i >= 3) {
                        $result_tahapan[$j][$heading[$i % 5]] = trim($elements->nodeValue);
                        $id_jadwal = $this->jadwal->tambahJadwal($result_tahapan[$j]);
                    } else {
                        $jadwal = '7 Mei 2021 13:00';
                        // $tanggal = tgl_umum(trim($jadwal));
                        $waktu = preg_split("/(\w+\s){3}/", trim($jadwal));
                        // print_r(trim($jadwal));

                        $result_tahapan[$j][$heading[$i % 5]] = date('Y-m-d', strtotime(tgl_umum(trim($jadwal)))) . " " . $waktu[1];
                        // print_r(tgl_umum(trim($jadwal)));
                        print_r($result_tahapan[$j][$heading[$i % 5]]);
                        die();
                    }
                    $i++;
                }
                if (trim($elements->nodeValue) == "Tidak Ada") {
                    $j++;
                    $i = 0;
                }
            }
        }
    }

    public function evaluasi_get($id_tender = 7573119)
    {
        $html = file_get_contents('https://lpse.lkpp.go.id/eproc4/evaluasi/' . $id_tender . '/hasil');
        $cleaned_html = tidy_html($html);

        libxml_use_internal_errors(true);

        // echo $cleaned_html;
        // die();

        $this->domdoc->loadHTML($cleaned_html);
        $xpath = new DOMXpath($this->domdoc);

        // tahapan Tender

        // $heading = ['id_tahapan', 'tgl_mulai', 'tgl_akhir', 'perubahan', 'link'];
        $heading = $xpath->query("//table[@class=\"table table-sm\"]/thead/tr/th[position() > 1]");
        $results_heading = [];
        foreach ($heading as $key => $val) {
            switch (trim($val->nodeValue)) {
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
                default:
                    $results_heading[$key % $heading->length] = strtolower(trim($val->nodeValue));
                    break;
            }
        }
        // print_r($results_heading);
        // die();

        $data = $xpath->query("//table[@class=\"table table-sm\"]/tbody/tr/td[position() > 1]|//table[@class=\"table table-sm\"]/tbody/tr/th");
        // $icon = $xpath->query("//table[@class=\"table table-sm\"]/tbody/tr/td/i");
        $link = $xpath->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td/a");
        // echo $cleaned_html;
        // die();
        $node_counts_data = $data->length;
        // echo $heading->length;
        // die();
        //echo $tahapan->length;
        $result_tahapan = [];
        if ($node_counts_data) {
            $i = 0;
            foreach ($data as $key => $elements) {
                $result_tahapan[$i]["id_tender"] = $id_tender;
                $icon = $elements->getElementsByTagName('i');
                $image = $elements->getElementsByTagName('img');
                if ($key % $heading->length == 0) {
                    $nama = explode('-', $elements->nodeValue);
                    $nama = trim($nama[0]);
                }

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
                        // $result_tahapan[$i][$results_heading[$key % $heading->length]] = trim($a->getAttribute('class'));
                        // echo '[ ' . $results_heading[$key % $heading->length]  . ' ] => ' . $a->getAttribute('class') . "\n";
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
                    $result_tahapan[$i][$results_heading[$key % $heading->length]] = preg_replace("/[^0-9]/", "", $explode[1]);
                } elseif ($elements->nodeValue != '') {
                    $result_tahapan[$i][$results_heading[$key % $heading->length]] = preg_replace("/[^0-9,]/", "", $elements->nodeValue);
                // echo '[ ' . $results_heading[$key % $heading->length]  . ' ] => ' . $elements->nodeValue . "\n";
                } else {
                    $result_tahapan[$i][$results_heading[$key % $heading->length]] = null;
                    // echo '[ ' . $results_heading[$key % $heading->length]  . ' ] => ' . 'null' . "\n";
                }

                if ($key % $heading->length == $heading->length - 1) {
                    $i++;
                }

                // echo '[ ' . $key . ' ] => ' . getAttachableNodeByAttributeName($elements, 'class') . "\n";
            }

            print_r($result_tahapan);
        }
    }

    public function pemenang_get($id_tender = 7573119)
    {
        $html = file_get_contents('https://lpse.lkpp.go.id/eproc4/evaluasi/' . $id_tender . '/pemenang');
        $pemenang = tidy_html($html);
        $html = file_get_contents('https://lpse.lkpp.go.id/eproc4/evaluasi/' . $id_tender . '/pemenangberkontrak');
        $pemenang_berkontrak = tidy_html($html);

        libxml_use_internal_errors(true);

        // echo $pemenang_berkontrak;
        // die();

        $this->domdoc->loadHTML($pemenang);
        $xpath_pemenang = new DOMXpath($this->domdoc);

        // echo $pemenang->length;
        // die();

        $this->domdoc->loadHTML($pemenang_berkontrak);
        $xpath_pemenang_berkontrak = new DOMXpath($this->domdoc);
        // tahapan Tender

        // $heading = ['id_tahapan', 'tgl_mulai', 'tgl_akhir', 'perubahan', 'link'];
        //*[@id="main"]/div/table/tbody/tr[7]/td/table/tbody/tr[2]

        $pemenang = $xpath_pemenang->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td/table/tr/td[position() = 3 or position() = 5]");
        $pemenang_berkontrak = $xpath_pemenang_berkontrak->query("//*[@id=\"main\"]/div/table[@class=\"table table-sm\"]/tr/td/table/tr/td[position() > 3]");

        $heading = ['npwp', 'harga_negosiasi', 'harga_kontrak', 'nilai_pdn', 'nilai_umk'];

        $results_pemenang = [];
        // foreach ($pemenang as $key => $val) {
        // 	echo $val->nodeValue . "<br/>";
        // }
        // die();
        $data = [
            'npwp' => preg_replace("/[^0-9]/", "", $pemenang[0]->nodeValue),
            'harga_negosiasi' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang[1]->nodeValue)),
            'harga_kontrak' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang_berkontrak[0]->nodeValue)),
            'nilai_pdn' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang_berkontrak[1]->nodeValue)),
            'nilai_umk' => str_replace(",", ".", preg_replace("/[^0-9,]/", "", $pemenang_berkontrak[2]->nodeValue)),
        ];
        // echo $pemenang[0]->nodeValue . "<br/>";
        // foreach ($pemenang_berkontrak as $key => $data) {
        // 	echo $data->nodeValue . "<br/>";
        // }

        print_r($data);
    }
}
