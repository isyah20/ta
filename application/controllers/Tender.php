<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

/*use Twilio\Rest\Client as notifWA;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\components\traits\FileSystem;
use App\components\traits\Whatsapp;
use App\components\UserType;*/

class Tender extends CI_Controller
{
    /*use FileSystem;
    use Whatsapp;*/

    public $limit_paket = 25;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tender_model');

        /*$this->client = new Client([
            'base_uri' => base_url(),
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);*/
    }

    public function getAllTender()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender.py");
        print_r($output);
    }

    public function getAllTender22()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender22.py");
        print_r($output);
    }

    public function getAllTender21()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender21.py");
        print_r($output);
    }

    public function getAllTender20()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender20.py");
        print_r($output);
    }

    public function getAllTender19()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender19.py");
        print_r($output);
    }

    public function getAllTender18()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender18.py");
        print_r($output);
    }

    public function getAllTender17()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender17.py");
        print_r($output);
    }

    public function getAllTender16()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender16.py");
        print_r($output);
    }

    public function getAllTender15()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender15.py");
        print_r($output);
    }

    public function getAllTender14()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender14.py");
        print_r($output);
    }

    public function getAllTender13()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender13.py");
        print_r($output);
    }

    public function getAllTender12()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender12.py");
        print_r($output);
    }

    public function getAllTender11()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender11.py");
        print_r($output);
    }

    public function getAllTender10()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender10.py");
        print_r($output);
    }

    public function getAllTender9()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender9.py");
        print_r($output);
    }

    public function getAllTender8()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender8.py");
        print_r($output);
    }

    public function getAllTender7()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender7.py");
        print_r($output);
    }

    public function getAllTender6()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender6.py");
        print_r($output);
    }

    public function getAllTender5()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender5.py");
        print_r($output);
    }

    public function getAllTender4()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender4.py");
        print_r($output);
    }

    public function getAllTender3()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender3.py");
        print_r($output);
    }

    public function getAllTender2()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender2.py");
        print_r($output);
    }

    public function getAllTender1()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender1.py");
        print_r($output);
    }

    public function getAllTender0()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 all_tender0.py");
        print_r($output);
    }

    public function getTenderTerbaru()
    {
        /*chdir('/www/wwwroot/tenderplus.id/python/Tender/Tender/spiders');
        $output = shell_exec("scrapy crawl tender_terbaru"); # -a start_lpse=10 -a end_lpse=15
        print_r($output);*/

        // chdir('/www/wwwroot/tenderplus.id/python');
        chdir('../tenderplus/python');
        $output = shell_exec("python3 tender_terbaru.py");
        print_r($output);
    }

    public function getLokasiTenderTerbaru()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 lokasi_tender_terbaru.py");
        print_r($output);
    }

    public function getPaketTender()
    {
        /*chdir('/www/wwwroot/tenderplus.id/python/Tender/Tender/spiders');
	    $output = shell_exec("scrapy crawl paket_tender");*/

        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender.py");
        print_r($output);
    }

    public function getPaketTender22()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender22.py");
        print_r($output);
    }

    public function getPaketTender21()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender21.py");
        print_r($output);
    }

    public function getPaketTender20()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender20.py");
        print_r($output);
    }

    public function getPaketTender19()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender19.py");
        print_r($output);
    }

    public function getPaketTender18()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender18.py");
        print_r($output);
    }

    public function getPaketTender17()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender17.py");
        print_r($output);
    }

    public function getPaketTender16()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender16.py");
        print_r($output);
    }

    public function getPaketTender15()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender15.py");
        print_r($output);
    }

    public function getPaketTender14()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender14.py");
        print_r($output);
    }

    public function getPaketTender13()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender13.py");
        print_r($output);
    }

    public function getPaketTender12()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender12.py");
        print_r($output);
    }

    public function getPaketTender11()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender11.py");
        print_r($output);
    }

    public function getPaketTender10()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender10.py");
        print_r($output);
    }

    public function getPaketTender9()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender9.py");
        print_r($output);
    }

    public function getPaketTender8()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender8.py");
        print_r($output);
    }

    public function getPaketTender7()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender7.py");
        print_r($output);
    }

    public function getPaketTender6()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender6.py");
        print_r($output);
    }

    public function getPaketTender5()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender5.py");
        print_r($output);
    }

    public function getPaketTender4()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender4.py");
        print_r($output);
    }

    public function getPaketTender3()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender3.py");
        print_r($output);
    }

    public function getPaketTender2()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender2.py");
        print_r($output);
    }

    public function getPaketTender1()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender1.py");
        print_r($output);
    }

    public function getPaketTender0()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 paket_tender0.py");
        print_r($output);
    }

    public function getPengumumanTender()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 pengumuman_tender.py");
        print_r($output);
    }

    public function getJadwalTender()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 jadwal_tender.py");
        print_r($output);
    }

    public function getPesertaTender()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 peserta_tender.py");
        print_r($output);
    }

    public function getEvaluasiTender()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 evaluasi_tender.py");
        print_r($output);
    }

    public function getPemenangTender()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        // $output = shell_exec("python3 pemenang_tender.py");
        $output = shell_exec("python3 pemenang_baru.py");
        print_r($output);
    }

    public function getTenderPemenang()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 tender_pemenang.py");
        print_r($output);
    }

    public function getProfilPeserta()
    {
        chdir('/www/wwwroot/tenderplus.id/python');
        $output = shell_exec("python3 profil_peserta.py");
        print_r($output);
    }

    public function sendEmail($data)
    {
        $this->load->library('email');
        $config = [];
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'Codeigniter';
        $config['protocol'] = "tls";
        $config['mailtype'] = "html";
        $config['smtp_host'] = "srv162.niagahoster.com"; //pengaturan smtp
        $config['smtp_port'] = "587";
        $config['smtp_user'] = "noreply@tenderplus.id"; // isi dengan email
        $config['smtp_pass'] = "C%87SfcjjaHb*te"; // isi dengan password
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['smtp_crypto'] = "tls"; //pengaturan smtp
        $config['wordwrap'] = true;

        //memanggil library email dan set konfigurasi untuk pengiriman email
        $this->email->initialize($config);
        $this->email->from('no-reply@tenderplus.id', 'Admin TenderPlus');
        $this->email->to($data['email']);
        $this->email->subject($data['kategori'] == '2' ? 'Notifikasi Tender Terbaru' : 'Notifikasi Pemenang Tender Baru');
        $baseUrl = base_url();
        $data['baseurl'] = substr($baseUrl, -1) == '/' ? substr($baseUrl, 0, strlen($baseUrl) - 1) : $baseUrl;

        $message = $this->load->view($data['kategori'] == '2' ? 'tender/email_tender_terbaru' : 'tender/email_pemenang_baru', $data, true);
        if (isDev()) {
            $filename = sprintf('%s-%s.html', $this->sanitizeFileName($data['email'], true, false, ['-', '@', '.']), date('Ymd-His'));
            file_put_contents(sprintf('%s/temp/email/%s', FCPATH, $filename), $message);

            return true;
        }

        $this->email->message($message);
        $this->email->set_mailtype('html');

        if ($this->email->send()) {
            echo "Notifikasi tender terbaru telah dikirimkan";
            return true;
        } else {
            echo "Terjadi kesalahan saat pengiriman notifikasi tender terbaru";
            return false;
        }
    }

    public function kirimTenderTerbaru()
    {
        $notifikasi = $this->Tender_model->getPenggunaNotif()->result();
        foreach ($notifikasi as $penerima) {
            $jum_tender = $this->Tender_model->getJumlahTenderTerbaru($penerima->id_pengguna)->row();
            if ($jum_tender->jumlah > 0) {
                $no_wa = substr($penerima->no_telp, 0, 1) == '0' ? '62' . substr($penerima->no_telp, 1, strlen($penerima->no_telp) - 1) : $penerima->no_telp;
                $baseUrl = base_url();
                $isUserFree = FALSE;
                $isUserTrial = FALSE;
                $isUserPremium = FALSE;

                if ($penerima->user_status != '0') {
                    if ($penerima->whatsapp_status == '0') {
                        $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus.\n\nSilakan lakukan verifikasi nomor WhatsApp Anda melalui halaman profil untuk melihat informasi tender terbaru!\n\n{$baseUrl}profile";
                    } else {
                        if ($penerima->user_status == '1') {
                            $isUserPremium = TRUE;
                        } else {
                            $isUserTrial = TRUE;
                        }
                        $tender = $this->Tender_model->getTenderTerbaru($penerima->id_pengguna, $jum_tender->jumlah)->result();
                        $paket = $id_lpse = "";
                        $sep_lpse = "\n=================================\n";
                        $sep_tender = "\n---------------------------------------------------------------\n";
                        $tenders = [];

                        foreach ($tender as $val) {
                            if ($val->id_lpse != $id_lpse) {
                                $id_lpse = $val->id_lpse;
                                $no = 0;
                                $paket .= "{$sep_lpse}*LPSE {$val->nama_lpse}*\n({$val->url}){$sep_lpse}";
                            }

                            $no++;
                            $hps = "Rp " . number_format($val->hps, 0, ",", ".");
                            //$url = $val->url."/lelang/".$val->kode_tender."/pengumumanlelang";
                            $url = $baseUrl . 'detail-tender/' . $val->kode_tender;
                            $datetime = new DateTime($val->akhir_daftar);
                            $date = $datetime->format('d-m-Y');
                            $time = $datetime->format('H:i');
                            $date = explode('-', $date);
                            $bulan = $date[1];
                            if ($bulan == '01') $bln = 'Januari';
                            else if ($bulan == '02') $bln = 'Februari';
                            else if ($bulan == '03') $bln = 'Maret';
                            else if ($bulan == '04') $bln = 'April';
                            else if ($bulan == '05') $bln = 'Mei';
                            else if ($bulan == '06') $bln = 'Juni';
                            else if ($bulan == '07') $bln = 'Juli';
                            else if ($bulan == '08') $bln = 'Agustus';
                            else if ($bulan == '09') $bln = 'September';
                            else if ($bulan == '10') $bln = 'Oktober';
                            else if ($bulan == '11') $bln = 'November';
                            else if ($bulan == '12') $bln = 'Desember';
                            $akhir_daftar = $date[0] . ' ' . $bln . ' ' . $date[2] . ' ' . $time;

                            $paket .= "*{$no}. {$val->nama_tender}*\n\nNilai HPS: {$hps}\nAkhir Pendaftaran: *{$akhir_daftar}*\nLink Paket: {$url}{$sep_tender}";

                            $tenders[(int) $val->id_lpse][] = [
                                'id_lpse' => $val->id_lpse,
                                'lpse_name' => $val->nama_lpse,
                                'tender_name' => $val->nama_tender,
                                'hps' => $hps,
                                'end_reg' => $akhir_daftar,
                                'link' => $url
                            ];
                        }

                        if ($jum_tender->jumlah > $this->limit_paket) {
                            $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus.\nLihat selengkapnya pada halaman dashboard Anda.\nBerikut ini {$this->limit_paket} paket di antaranya:\n{$paket}";
                        } else {
                            $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus:\n{$paket}";
                        }
                    }
                } else {
                    $isUserFree = TRUE;
                    $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus.\n\nSilakan upgrade akun Anda ke paket premium untuk melihat informasi tender terbaru!\n\n{$baseUrl}pricing_plan";
                }

                $data = [
                    'api_key' => 'OAcYMmjgG1vpneHlpRAHduHOLvpDEn',
                    'sender' => '6282328429138',
                    'number' => $no_wa,
                    'message' => $pesan
                ];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://wa.srv3.wapanels.com/send-message',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                ));

                $response = curl_exec($curl);
                $result = json_decode($response);
                if ($penerima->whatsapp_status == '1' && $penerima->user_status != '0' && $result->status) $this->Tender_model->simpanKirimNotif($penerima->id_pengguna, $jum_tender->jumlah);
                else if (!$result->status && $result->errors == 'Failed to access whatsapp server') $this->kirimTenderTerbaruByPengguna($penerima->id_pengguna);

                curl_close($curl);
                echo $response;

                $data = [
                    'name' => $penerima->nama,
                    'kategori' => '2',
                    'count_tender' => $jum_tender->jumlah,
                    'email' => $penerima->email,
                    'tenders' => $tenders,
                    'isUserPremium' => $isUserPremium,
                    'isUserTrial' => $isUserTrial,
                    'isUserFree' => $isUserFree,
                    'footnoteTrial' => 'Akun Anda dalam masa trial, lakukan pembelian paket premium agar tetap mendapatkan informasi tender terbaru!'
                ];

                $this->sendEmail($data);
            }
        }
    }

    public function kirimTenderTerbaruByPengguna($id_pengguna)
    {
        $penerima = $this->Tender_model->getPenggunaNotifByID($id_pengguna)->row();
        $jum_tender = $this->Tender_model->getJumlahTenderTerbaru($penerima->id_pengguna)->row();
        if ($jum_tender->jumlah > 0) {
            $no_wa = substr($penerima->no_telp, 0, 1) == '0' ? '62' . substr($penerima->no_telp, 1, strlen($penerima->no_telp) - 1) : $penerima->no_telp;
            $baseUrl = base_url();
            $isUserPremium = FALSE;
            $isUserTrial = FALSE;
            $isUserFree = FALSE;

            if ($penerima->user_status != '0') {
                if ($penerima->whatsapp_status == '0') {
                    $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus.\n\nSilakan lakukan verifikasi nomor WhatsApp Anda melalui halaman profil untuk melihat informasi tender terbaru!\n\n{$baseUrl}profile";
                } else {
                    if ($penerima->user_status == '1') {
                        $isUserPremium = TRUE;
                    } else {
                        $isUserTrial = TRUE;
                    }
                    $tender = $this->Tender_model->getTenderTerbaru($penerima->id_pengguna, $jum_tender->jumlah)->result();
                    $paket = $id_lpse = "";
                    $sep_lpse = "\n=================================\n";
                    $sep_tender = "\n---------------------------------------------------------------\n";
                    $tenders = [];

                    foreach ($tender as $val) {
                        if ($val->id_lpse != $id_lpse) {
                            $id_lpse = $val->id_lpse;
                            $no = 0;
                            $paket .= "{$sep_lpse}*LPSE {$val->nama_lpse}*\n({$val->url}){$sep_lpse}";
                        }

                        $no++;
                        $hps = "Rp " . number_format($val->hps, 0, ",", ".");
                        // $url = $val->url."/lelang/".$val->kode_tender."/pengumumanlelang";
                        $url = $baseUrl . 'detail-tender/' . $val->kode_tender;
                        $datetime = new DateTime($val->akhir_daftar);
                        $date = $datetime->format('d-m-Y');
                        $time = $datetime->format('H:i');
                        $date = explode('-', $date);
                        $bulan = $date[1];
                        if ($bulan == '01') $bln = 'Januari';
                        else if ($bulan == '02') $bln = 'Februari';
                        else if ($bulan == '03') $bln = 'Maret';
                        else if ($bulan == '04') $bln = 'April';
                        else if ($bulan == '05') $bln = 'Mei';
                        else if ($bulan == '06') $bln = 'Juni';
                        else if ($bulan == '07') $bln = 'Juli';
                        else if ($bulan == '08') $bln = 'Agustus';
                        else if ($bulan == '09') $bln = 'September';
                        else if ($bulan == '10') $bln = 'Oktober';
                        else if ($bulan == '11') $bln = 'November';
                        else if ($bulan == '12') $bln = 'Desember';
                        $akhir_daftar = $date[0] . ' ' . $bln . ' ' . $date[2] . ' ' . $time;

                        $paket .= "*{$no}. {$val->nama_tender}*\n\nNilai HPS: {$hps}\nAkhir Pendaftaran: *{$akhir_daftar}*\nLink Paket: {$url}{$sep_tender}";

                        $tenders[(int) $val->id_lpse][] = [
                            'id_lpse' => $val->id_lpse,
                            'lpse_name' => $val->nama_lpse,
                            'tender_name' => $val->nama_tender,
                            'hps' => $hps,
                            'end_reg' => $akhir_daftar,
                            'link' => $url
                        ];
                    }

                    if ($jum_tender->jumlah > $this->limit_paket) {
                        $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus.\nLihat selengkapnya pada halaman dashboard Anda.\nBerikut ini {$this->limit_paket} paket di antaranya:\n{$paket}";
                    } else {
                        $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus:\n{$paket}";
                    }
                }
            } else {
                $isUserFree = TRUE;
                $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} paket baru* yang dapat Anda menangkan bersama TenderPlus.\n\nSilakan upgrade akun Anda ke paket premium untuk melihat informasi tender terbaru!\n\n{$baseUrl}pricing_plan";
            }

            $data = [
                'api_key' => 'OAcYMmjgG1vpneHlpRAHduHOLvpDEn',
                'sender' => '6282328429138',
                'number' => $no_wa,
                'message' => $pesan
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://wa.srv3.wapanels.com/send-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);
            if ($penerima->whatsapp_status == '1' && $penerima->user_status != '0' && $result->status) $this->Tender_model->simpanKirimNotif($penerima->id_pengguna, $jum_tender->jumlah);
            else if (!$result->status && $result->errors == 'Failed to access whatsapp server') $this->kirimTenderTerbaruByPengguna($penerima->id_pengguna);

            curl_close($curl);
            echo $response;

            $data = [
                'name' => $penerima->nama,
                'kategori' => '2',
                'count_tender' => $jum_tender->jumlah,
                'email' => $penerima->email,
                'tenders' => $tenders,
                'isUserPremium' => $isUserPremium,
                'isUserTrial' => $isUserTrial,
                'isUserFree' => $isUserFree,
                'footnoteTrial' => 'Akun Anda dalam masa trial, lakukan pembelian paket premium agar tetap mendapatkan informasi tender terbaru!'
            ];

            $this->sendEmail($data);
        }
    }

    public function kirimPemenangTerbaru()
    {
        $notifikasi = $this->Tender_model->getPenggunaSuplierNotif()->result();
        foreach ($notifikasi as $penerima) {
            $jum_tender = $this->Tender_model->getJumlahPemenangTerbaru($penerima->id_pengguna)->row();
            if ($jum_tender->jumlah > 0) {
                $no_wa = substr($penerima->no_telp, 0, 1) == '0' ? '62' . substr($penerima->no_telp, 1, strlen($penerima->no_telp) - 1) : $penerima->no_telp;
                $baseUrl = base_url();
                $isUserFree = FALSE;
                $isUserTrial = FALSE;
                $isUserPremium = FALSE;

                if ($penerima->user_status != '0') {
                    if ($penerima->whatsapp_status == '0') {
                        $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus.\n\nSilakan lakukan verifikasi nomor WhatsApp Anda melalui halaman profil untuk melihat informasi pemenang tender terbaru!\n\n{$baseUrl}profile";
                    } else {
                        if ($penerima->user_status == '1') {
                            $isUserPremium = TRUE;
                        } else {
                            $isUserTrial = TRUE;
                        }
                        $tender = $this->Tender_model->getPemenangTerbaru($penerima->id_pengguna, $jum_tender->jumlah)->result();
                        $paket = $id_lpse = "";
                        $sep_lpse = "\n=================================\n";
                        $sep_tender = "\n---------------------------------------------------------------\n";
                        $tenders = [];

                        foreach ($tender as $val) {
                            if ($val->id_lpse != $id_lpse) {
                                $id_lpse = $val->id_lpse;
                                $no = 0;
                                $paket .= "{$sep_lpse}*LPSE {$val->nama_lpse}*\n({$val->url}){$sep_lpse}";
                            }

                            $no++;
                            $penawaran = "Rp " . number_format($val->harga_penawaran, 0, ",", ".");
                            //$url = $val->url."/lelang/".$val->kode_tender."/pengumumanlelang";
                            $url = $baseUrl . 'detail-pemenang/' . $val->kode_tender;

                            $paket .= "*{$no}. {$val->nama_tender}*\n\nNilai Penawaran: {$penawaran}\nNama Pemenang: *{$val->nama_pemenang}*\nLink Paket: {$url}{$sep_tender}";

                            $tenders[(int) $val->id_lpse][] = [
                                'id_lpse' => $val->id_lpse,
                                'lpse_name' => $val->nama_lpse,
                                'tender_name' => $val->nama_tender,
                                'penawaran' => $penawaran,
                                'nama_pemenang' => $val->nama_pemenang,
                                'link' => $url
                            ];
                        }

                        if ($jum_tender->jumlah > $this->limit_paket) {
                            $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus.\nLihat selengkapnya pada halaman dashboard Anda.\nBerikut ini {$this->limit_paket} pemenang tender di antaranya:\n{$paket}";
                        } else {
                            $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus:\n{$paket}";
                        }
                    }
                } else {
                    $isUserFree = TRUE;
                    $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus.\n\nSilakan upgrade akun Anda ke paket premium untuk melihat informasi pemenang tender terbaru!\n\n{$baseUrl}pricing_plan";
                }

                $data = [
                    'api_key' => 'OAcYMmjgG1vpneHlpRAHduHOLvpDEn',
                    'sender' => '6282328429138',
                    'number' => $no_wa,
                    'message' => $pesan
                ];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://wa.srv3.wapanels.com/send-message',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                ));

                $response = curl_exec($curl);
                $result = json_decode($response);
                if ($penerima->whatsapp_status == '1' && $penerima->user_status != '0' && $result->status) $this->Tender_model->simpanKirimNotifPemenang($penerima->id_pengguna, $jum_tender->jumlah);
                else if (!$result->status && $result->errors == 'Failed to access whatsapp server') $this->kirimPemenangTerbaruByPengguna($penerima->id_pengguna);

                curl_close($curl);
                echo $response;

                $data = [
                    'name' => $penerima->nama,
                    'kategori' => '4',
                    'count_tender' => $jum_tender->jumlah,
                    'email' => $penerima->email,
                    'tenders' => $tenders,
                    'isUserPremium' => $isUserPremium,
                    'isUserTrial' => $isUserTrial,
                    'isUserFree' => $isUserFree,
                    'footnoteTrial' => 'Akun Anda dalam masa trial, lakukan pembelian paket premium agar tetap mendapatkan informasi pemenang tender terbaru!'
                ];

                $this->sendEmail($data);
            }
        }
    }

    public function kirimPemenangTerbaruByPengguna($id_pengguna)
    {
        $penerima = $this->Tender_model->getPenggunaNotifByID($id_pengguna)->row();
        $jum_tender = $this->Tender_model->getJumlahPemenangTerbaru($penerima->id_pengguna)->row();
        if ($jum_tender->jumlah > 0) {
            $no_wa = substr($penerima->no_telp, 0, 1) == '0' ? '62' . substr($penerima->no_telp, 1, strlen($penerima->no_telp) - 1) : $penerima->no_telp;
            $baseUrl = base_url();
            $isUserFree = FALSE;
            $isUserTrial = FALSE;
            $isUserPremium = FALSE;


            if ($penerima->user_status != '0') {
                if ($penerima->whatsapp_status == '0') {
                    $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus.\n\nSilakan lakukan verifikasi nomor WhatsApp Anda melalui halaman profil untuk melihat informasi pemenang tender terbaru!\n\n{$baseUrl}profile";
                } else {
                    if ($penerima->user_status == '1') {
                        $isUserPremium = TRUE;
                    } else {
                        $isUserTrial = TRUE;
                    }
                    $tender = $this->Tender_model->getPemenangTerbaru($penerima->id_pengguna, $jum_tender->jumlah)->result();
                    $paket = $id_lpse = "";
                    $sep_lpse = "\n=================================\n";
                    $sep_tender = "\n---------------------------------------------------------------\n";
                    $tenders = [];

                    foreach ($tender as $val) {
                        if ($val->id_lpse != $id_lpse) {
                            $id_lpse = $val->id_lpse;
                            $no = 0;
                            $paket .= "{$sep_lpse}*LPSE {$val->nama_lpse}*\n({$val->url}){$sep_lpse}";
                        }

                        $no++;
                        $penawaran = "Rp " . number_format($val->harga_penawaran, 0, ",", ".");
                        //$url = $val->url."/lelang/".$val->kode_tender."/pengumumanlelang";
                        $url = $baseUrl . 'detail-pemenang/' . $val->kode_tender;

                        $paket .= "*{$no}. {$val->nama_tender}*\n\nNilai Penawaran: {$penawaran}\nNama Pemenang: *{$val->nama_pemenang}*\nLink Paket: {$url}{$sep_tender}";

                        $tenders[(int) $val->id_lpse][] = [
                            'id_lpse' => $val->id_lpse,
                            'lpse_name' => $val->nama_lpse,
                            'tender_name' => $val->nama_tender,
                            'penawaran' => $penawaran,
                            'nama_pemenang' => $val->nama_pemenang,
                            'link' => $url
                        ];
                    }

                    if ($jum_tender->jumlah > $this->limit_paket) {
                        $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus.\nLihat selengkapnya pada halaman dashboard Anda.\nBerikut ini {$this->limit_paket} pemenang tender di antaranya:\n{$paket}";
                    } else {
                        $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus:\n{$paket}";
                    }
                }
            } else {
                $isUserFree = TRUE;
                $pesan = "Halo *{$penerima->nama}*,\n\nTerdapat *{$jum_tender->jumlah} pemenang tender baru* yang dapat Anda follow up bersama TenderPlus.\n\nSilakan upgrade akun Anda ke paket premium untuk melihat informasi pemenang tender terbaru!\n\n{$baseUrl}pricing_plan";
            }

            $data = [
                'api_key' => 'OAcYMmjgG1vpneHlpRAHduHOLvpDEn',
                'sender' => '6282328429138',
                'number' => $no_wa,
                'message' => $pesan
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://wa.srv3.wapanels.com/send-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);
            if ($penerima->whatsapp_status == '1' && $penerima->user_status != '0' && $result->status) $this->Tender_model->simpanKirimNotifPemenang($penerima->id_pengguna, $jum_tender->jumlah);
            else if (!$result->status && $result->errors == 'Failed to access whatsapp server') $this->kirimPemenangTerbaruByPengguna($penerima->id_pengguna);

            curl_close($curl);
            echo $response;

            $data = [
                'name' => $penerima->nama,
                'kategori' => '4',
                'count_tender' => $jum_tender->jumlah,
                'email' => $penerima->email,
                'tenders' => $tenders,
                'isUserPremium' => $isUserPremium,
                'isUserTrial' => $isUserTrial,
                'isUserFree' => $isUserFree,
                'footnoteTrial' => 'Akun Anda dalam masa trial, lakukan pembelian paket premium agar tetap mendapatkan informasi pemenang tender terbaru!'
            ];

            $this->sendEmail($data);
        }
    }

    public function getKatalogTenderTerbaru()
    {
        // parse_str(file_get_contents('php://input'), $data);
        $page_size = $_GET['pageSize'];
        $page_number = ($_GET['pageNumber'] - 1) * $page_size;
        $response = $this->Tender_model->getKatalogTenderTerbaru($page_number, $page_size)->result();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getKatalogTenderTerbaruByPengguna($id_pengguna, $jum_tender)
    {
        $page_size = $_POST['pageSize'];
        $page_number = ($_POST['pageNumber'] - 1) * $page_size;
        $response = $this->Tender_model->getKatalogTenderTerbaruByPengguna($id_pengguna, $jum_tender, $page_number, $page_size)->result();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getKatalogTenderTerbaruByPengguna1()
    {
        // parse_str(file_get_contents('php://input'), $data);
        $data = [
            'id_pengguna'   => 38,
            'keyword'       => '',
            'jenis_pengadaan' => '',
            'nilai_hps_awal' => 0,
            'nilai_hps_akhir' => 0,
            'prov'          => '',
            'kab'           => '',
            'pageSize'      => 200,
            'pageNumber'    => 10,
            'sort'          => 1,
        ];
        $response = $this->Tender_model->getKatalogTenderTerbaruByPengguna1($data)->result();
        // var_dump($_SESSION[]);
        // var_dump($response);
        // die;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getKatalogPemenangTerbaruByPengguna($id_pengguna, $jum_pemenang)
    {
        $page_size = $_POST['pageSize'];
        $page_number = ($_POST['pageNumber'] - 1) * $page_size;
        $response = $this->Tender_model->getKatalogPemenangTerbaruByPengguna($id_pengguna, $jum_pemenang, $page_number, $page_size)->result();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getKatalogPemenangTerbaruByPengguna1()
    {
        parse_str(file_get_contents('php://input'), $data);
        $response = $this->Tender_model->getKatalogPemenangTerbaruByPengguna1($data)->result();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getJumKatalogTenderTerbaru()
    {
        $response = $this->Tender_model->getJumKatalogTenderTerbaru()->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getJumKatalogTenderTerbaruByPengguna($id_pengguna)
    {
        $response = $this->Tender_model->getJumKatalogTenderTerbaruByPengguna($id_pengguna)->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getJumKatalogTenderTerbaruByPengguna1()
    {
        parse_str(file_get_contents('php://input'), $data);
        // var_dump($data);
        // die;
        $response = $this->Tender_model->getJumKatalogTenderTerbaruByPengguna1($data)->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getJumKatalogPemenangTerbaruByPengguna($id_pengguna)
    {
        $response = $this->Tender_model->getJumKatalogPemenangTerbaruByPengguna($id_pengguna)->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getJumKatalogPemenangTerbaruByPengguna1()
    {
        parse_str(file_get_contents('php://input'), $data);
        $response = $this->Tender_model->getJumKatalogPemenangTerbaruByPengguna1($data)->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getListLokasiPekerjaan()
    {
        $response = array(
            // "total_count" => $this->Tender_model->getJumlahListLokasiPekerjaan($this->input->get("q"), $this->input->get("id_pengguna"), $this->input->get("jenis")),
            // "results" => $this->Tender_model->getListLokasiPekerjaan(
            "results" => [
                '1' => 1,
                '2' => $this->input->get("id_pengguna"),
                '3' => $this->input->get("jenis"),
                '4' => $this->input->get("page") * $this->input->get("page_limit"),
                '5' => $this->input->get("page_limit")
            ]
            // "results" => $this->Tender_model->getListLokasiPekerjaanTenderTerbaru(
            //     $this->input->get("q"),
            //     $this->input->get("id_pengguna"),
            //     $this->input->get("jenis"),
            //     $this->input->get("page") * $this->input->get("page_limit"),
            //     $this->input->get("page_limit")
            // )
        );

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function getListJenisPengadaan()
    {
        $response = array(
            "total_count" => $this->Tender_model->getJumlahListJenisPengadaan($this->input->get("q"), $this->input->get("id_pengguna"), $this->input->get("jenis")),
            "results" => $this->Tender_model->getListJenisPengadaan(
                $this->input->get("q"),
                $this->input->get("id_pengguna"),
                $this->input->get("jenis"),
                $this->input->get("page") * $this->input->get("page_limit"),
                $this->input->get("page_limit")
            )
        );

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    /*public function index($id)
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $explode = explode('/', $url);
        $id = array_pop($explode);

        //get Detail Tender
        try {
            $response_tender = $this->client->request('GET', 'api/detailtender/' . $id, $this->client->getConfig('headers'));
            // print_r($response->getStatusCode());
            $tender = json_decode($response_tender->getBody()->getContents(), true);

            //get Syarat Kualifikasi
            $response = $this->client->request('GET', 'api/syaratkualifikasi/' . $id, $this->client->getConfig('headers'));
            // print_r($response->getStatusCode());
            $syarat = json_decode($response->getBody()->getContents(), true);

            //get Peserta Tender
            $response = $this->client->request('GET', 'api/pesertatenderbytender/' . $id, $this->client->getConfig('headers'));
            // print_r($response->getStatusCode());
            $peserta = json_decode($response->getBody()->getContents(), true);

            //get Hasil Evaluasi
            $response = $this->client->request('GET', 'api/hasilevaluasi/tender/' . $id, $this->client->getConfig('headers'));
            // print_r($response->getStatusCode());
            $evaluasi = json_decode($response->getBody()->getContents(), true);

            //get Pemenang
            $response = $this->client->request('GET', 'api/pemenang/tender/' . $id, $this->client->getConfig('headers'));
            // print_r($response->getStatusCode());
            $pemenang = json_decode($response->getBody()->getContents(), true);

            // Get Data Jadwal From API
            $response = $this->client->get('api/jadwal/tender/' . $id, $this->client->getConfig('headers'));
            // print_r($response->getStatusCode());
            // die();
            $jadwal = json_decode($response->getBody()->getContents(), true);
            // $jadwal = $this->getDataFromAPI(base_url("api/jadwal"));
        } catch (ClientException $e) {
        }

        //Merubah Format Tanggal dan Waktu
        if (isset($jadwal["data"])) {
            foreach ($jadwal["data"] as $key => $jadwals) {
                $jadwal["data"][$key]["tgl_mulai"] = date("d F Y H:i", strtotime($jadwals["tgl_mulai"]));
                $jadwal["data"][$key]["tgl_akhir"] = $jadwals["tgl_akhir"] != null ? date("d F Y H:i", strtotime($jadwals["tgl_akhir"])) : null;
            }
        }

        // echo "<br />";
        // highlight_string("<?php\n\$jadwal =\n\" . var_export($jadwal, true) . ";\n?>");
        // die();

        if ($tender != null) {
            if ($tender['status'] != false) {
                $tender = $tender['data'];
            } else {
                $tender = null;
            }
        } else {
            $tender = null;
        }

        // if ($peserta != null) {
        // 	if ($peserta['status'] == true) {
        // 		$peserta_tender = $peserta['data'];
        // 	} else {
        // 		$peserta_tender = null;
        // 	}
        // } else {
        // 	$peserta_tender = null;
        // }

        // if ($pemenang != null) {
        // 	if ($pemenang['status'] == true) {
        // 		$pemenang_tender = $pemenang['data'];
        // 	} else {
        // 		$pemenang_tender = null;
        // 	}
        // } else {
        // 	$pemenang_tender = null;
        // }

        $data = [
            'title' => 'Detail Tender',
            'link' => [
                ['home', base_url()],
                ['tender', base_url()],
                ['Detail Tender', "#"],
            ],
            'jadwal' => $jadwal["data"] ?? null,
            'tender' => $tender,
            'syarat' => $syarat["data"] ?? null,
            'evaluasi' => $evaluasi["data"] ?? null,
            'peserta' => $peserta["data"] ?? null,
            'pemenang' => $pemenang["data"] ?? null,
            'count' => 1,
        ];

        // foreach ($data["jadwal"] as $key => $jadwals) {
        // 	echo $jadwals["tgl_mulai"] . "<br />";
        // 	// echo strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"]) . "<br />";
        // 	// echo substr($jadwals["tgl_mulai"], 0, 2) . "<br />";
        // }

        // die();
        // echo "<br />";
        // highlight_string("<?php\n\$data =\n\" . var_export($data, true) . ";\n?>");
        // die();

        $this->load->view('templates/header', $data);
        $this->load->view('tender/index', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/footer');
    }

    public function notifikasiTenderBaru()
    {
        $tender = $this->client->request('GET', 'api/tender/notifikasi-tender-baru', $this->client->getConfig('headers'));
        $result = json_decode($tender->getBody()->getContents(), true);

        $count = count($result['data']);
        $config = [
            'charset' => 'UTF-8',
            'useragent' => 'Codeigniter',
            'protocol' => 'smtp',
            'mailtype' => 'html',
            'smtp_host' => 'srv162.niagahoster.com',
            'smtp_port' => '465',
            'smtp_timeout' => '60',
            'smtp_user' => 'noreply@tenderplus.id',
            'smtp_pass' => 'C%87SfcjjaHb*te',
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'wordwrap' => true,
            'smtp_crypto' => 'ssl',
        ];

        $data = $result["data"];

        foreach ($result['data'] as $email) {
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from('no-reply@tenderplus.id');
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
																			<a href='" . site_url("monitoring") . "' style=\"text-decoration: none;\">
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

    public function notifikasiTenderBaruByKeyword()
    {
        $tender = $this->client->request('GET', 'api/tender/notifikasi-tender-baru-by-keyword', $this->client->getConfig('headers'));
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
            $this->email->from('no-reply@tenderplus.id');
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
																			<a href='" . site_url("monitoring") . "' style=\"text-decoration: none;\">
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

    public function notifikasiTenderBaruWA()
    {
        $tender = $this->client->request('GET', 'api/tender/notifikasi-tender-baru', $this->client->getConfig('headers'));
        $result = json_decode($tender->getBody()->getContents(), true);

        $count = count($result['data']);

        foreach ($result['data'] as $no_telp) {
            $no_telp_check = $no_telp['email'];

            $result_filter = array_filter($result['data'], function ($result) use ($no_telp_check) {
                return $result['email'] == $no_telp_check;
            });
        }

        if (substr($no_telp['no_telp'], 0, 1) === "0") {
            $no_telp['no_telp'] = str_replace("0", "62" . substr($no_telp['no_telp'], 1), substr($no_telp['no_telp'], 0, 1));
            $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);
        } elseif (substr($no_telp['no_telp'], 0, 3) === "+62") {
            $no_telp['no_telp'] = str_replace("+62", "62" . substr($no_telp['no_telp'], 3), substr($no_telp['no_telp'], 0, 3));
            $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);
        } elseif (substr($no_telp['no_telp'], 0, 3) === "+62") {
            $no_telp['no_telp'] = str_replace("+62", "62" . substr($no_telp['no_telp'], 3), substr($no_telp['no_telp'], 0, 3));
            $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);
        } elseif (substr($no_telp['no_telp'], 0, 1) === "8") {
            $no_telp['no_telp'] = substr_replace($no_telp['no_telp'], "62", 0, 0);
        }

        $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);

        $data = "";
        $i = 1;
        foreach (array_slice($result_filter, 0, 3) as $row) {
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

            $data .= $i . ". *" . $row["id_tender"] . " | " . date("d-m-Y", strtotime($row["tgl_pembuatan"])) . "*%0A*" . $row["nama_tender"] . "*" . "%0A~ Lokasi Pekerjaan: " . $row["lokasi_pekerjaan"] . "%0A~ LPSE dan Kualifikasi Usaha: " . $row["nama_lpse"] . " - " . $row["kualifikasi"] . "%0A~ Nilai HPS: Rp " . number_format(($row["nilai_hps"]), 0, ',', '.') . "%0A~ Tahun Anggaran dan Kategori: " . $row["tahun_anggaran"] . " - " . $row["jenis_tender"] . "%0A~ Nilai Pagu: Rp " . number_format(($row["nilai_pagu"]), 0, ',', '.') . "%0A~ Metode Evaluasi: " . $row["metode_evaluasi"] . "%0A%0A";

            $i++;
        }

        // $waResult = file_get_contents("http://localhost:3000/api/whatsapp?phone_number=6282330725030@c.us&message=halo");
        $waResult = file_get_contents("http://localhost:3000/api/whatsapp?phone_number=" . $no_telp['no_telp'] . "@c.us&message=" . str_replace(" ", "%20", $no_telp['nama'] . ",%0AAda " . $count . " tender baru sesuai dengan konfigurasi filter kamu nih! Info selengkapnya cek: " . site_url("monitoring") . "" . str_replace(" ", "%20", "%0A%0A" . $data)));
    }

    public function notifikasiTenderBaruWAByKeyword()
    {
        $tender = $this->client->request('GET', 'api/tender/notifikasi-tender-baru-by-keyword', $this->client->getConfig('headers'));
        $result = json_decode($tender->getBody()->getContents(), true);

        $count = count($result['data']);

        foreach ($result['data'] as $no_telp) {
            $no_telp_check = $no_telp['email'];

            $result_filter = array_filter($result['data'], function ($result) use ($no_telp_check) {
                return $result['email'] == $no_telp_check;
            });
        }

        if (substr($no_telp['no_telp'], 0, 1) === "0") {
            $no_telp['no_telp'] = str_replace("0", "62" . substr($no_telp['no_telp'], 1), substr($no_telp['no_telp'], 0, 1));
            $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);
        } elseif (substr($no_telp['no_telp'], 0, 3) === "+62") {
            $no_telp['no_telp'] = str_replace("+62", "62" . substr($no_telp['no_telp'], 3), substr($no_telp['no_telp'], 0, 3));
            $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);
        } elseif (substr($no_telp['no_telp'], 0, 3) === "+62") {
            $no_telp['no_telp'] = str_replace("+62", "62" . substr($no_telp['no_telp'], 3), substr($no_telp['no_telp'], 0, 3));
            $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);
        } elseif (substr($no_telp['no_telp'], 0, 1) === "8") {
            $no_telp['no_telp'] = substr_replace($no_telp['no_telp'], "62", 0, 0);
        }

        $no_telp['no_telp'] = str_replace("-", "", $no_telp['no_telp']);

        $data = "";
        $i = 1;
        foreach (array_slice($result_filter, 0, 3) as $row) {
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

            $data .= $i . ". *" . $row["id_tender"] . " | " . date("d-m-Y", strtotime($row["tgl_pembuatan"])) . "*%0A*" . $row["nama_tender"] . "*" . "%0A~ Lokasi Pekerjaan: " . $row["lokasi_pekerjaan"] . "%0A~ LPSE dan Kualifikasi Usaha: " . $row["nama_lpse"] . " - " . $row["kualifikasi"] . "%0A~ Nilai HPS: Rp " . number_format(($row["nilai_hps"]), 0, ',', '.') . "%0A~ Tahun Anggaran dan Kategori: " . $row["tahun_anggaran"] . " - " . $row["jenis_tender"] . "%0A~ Nilai Pagu: Rp " . number_format(($row["nilai_pagu"]), 0, ',', '.') . "%0A~ Metode Evaluasi: " . $row["metode_evaluasi"] . "%0A%0A";

            $i++;
        }

        // $waResult = file_get_contents("http://localhost:3000/api/whatsapp?phone_number=6282330725030@c.us&message=halo");
        $waResult = file_get_contents("http://localhost:3000/api/whatsapp?phone_number=62" . $no_telp['no_telp'] . "@c.us&message=" . str_replace(" ", "%20", $no_telp['nama'] . ",%0AAda " . $count . " tender baru sesuai dengan konfigurasi filter kamu nih! Info selengkapnya cek: " . site_url("monitoring") . "" . str_replace(" ", "%20", "%0A%0A" . $data)));
    }

    public function search()
    {
        $keyword = $this->input->post('search');
        $output = '';
        if ($keyword) {
            $data = $this->PesertaTender_model->searchMain($keyword);
            if ($data->num_rows() > 0) {
                foreach ($data->result_array() as $hasil) {
                    $output .= '
					<tr style="height: 80px;" id="peserta">
					<td class="text-center tengah" scope="row">
						<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
					</td>
					<td class="tengah">' . $hasil['nama_peserta'] . '
						<img src="<?= base_url("assets/img/crown.png") ?>" style="width:12px;">
						<br>
						<small style="font-weight: 400;">' . $hasil['npwp_peserta'] . '</small>
					</td>
					<td class="tengah">' . 'Rp. ' . number_format($hasil['harga_penawaran']) . '</td>
					<td class="tengah">' . 'Rp. ' . number_format($hasil['harga_terkoreksi']) . '</td>
					<td class="tengah">
			
					</td>
				</tr>';
                }
            } else {
                $output .= 'keyword tidak sesuai';
            }
        } else {
            $output .= 'tidak ada keyword';
        }
        echo $output;
    }

    private function getUserTrialLimitNotif(): int
    {
        $envLimit = $_SERVER['LIMIT_NOTIF_TENDER'] ?? 3;
        return $envLimit;
    }

    public function kirimTenderTerbaru()
    {
        $countEmail = 0;
        $notifikasi = $this->Tender_model->getPenggunaNotif()->result();
        foreach ($notifikasi as $penerima) {
            $jum_tender = $this->Tender_model->getJumlahTenderTerbaru($penerima->id_pengguna)->row();
            if ((int) $jum_tender->jumlah < 1) {
                continue;
            }

            $userStatus = (int) $penerima->user_status;
            $isUserTrial = $userStatus == UserType::TRIAL;
            $isUserFree = $userStatus == UserType::FREE;
            $isUserPremium = $userStatus == UserType::PAID;
            $limit = $isUserTrial ? $this->getUserTrialLimitNotif() : 0;

            $no_wa = substr($penerima->no_telp, 0, 1) == '0' ? '62' . substr($penerima->no_telp, 1, strlen($penerima->no_telp) - 1) : $penerima->no_telp;
            $listTender = $this->Tender_model->getTenderTerbaru($penerima->id_pengguna, $limit)->result();
            $paket = $id_lpse = "";
            $sep_lpse = "\n=================================\n";
            $sep_tender = "\n---------------------------------------------------------------\n";
            $tenders = [];

            foreach ($listTender as $tenderIndex => $tender) {
                if ($tender->id_lpse != $id_lpse) {
                    $id_lpse = $tender->id_lpse;
                    $no = 0;
                    $paket .= "{$sep_lpse}*LPSE {$tender->nama_lpse}*{$sep_lpse}";
                }

                $no++;
                $hps = sprintf('Rp %s', number_format($tender->hps, 0, ",", "."));
                // $url = sprintf('%s/lelang/%s/pengumumanlelang', $tender->url, $tender->kode_tender);
                $url = base_url() . 'detail-tender/' . $tender->kode_tender;
                $akhir_daftar = $this->getFinalRegister($tender->akhir_daftar);
                $paket .= "*{$no}. {$tender->nama_tender}*\n\nNilai HPS: {$hps}\nAkhir Pendaftaran: *{$akhir_daftar}*\nLink Paket: {$url}{$sep_tender}";
                $tenders[(int) $tender->id_lpse][] = [
                    'lpse_name' => $tender->nama_lpse,
                    'tender_name' => $tender->nama_tender,
                    'hps' => $hps,
                    'end_reg' => $akhir_daftar,
                    'link' => $url,
                    'id_lpse' => $tender->id_lpse,
                ];

                if ($isUserTrial && $tenderIndex == ($limit - 1)) {
                    break;
                }
            }

            $footnoteTrial = '';
            $pesan = sprintf("Halo *%s*,\n\nTerdapat *%d paket baru* yang dapat Anda menangkan bersama TenderPlus:\n%s", $penerima->nama, $jum_tender->jumlah, $paket);
            if ($isUserFree) {
                $pesan = sprintf(
                    "Halo *%s*,\n\nTerdapat *%d paket baru* yang dapat Anda menangkan bersama TenderPlus.\nSilakan upgrade ke akun premium untuk dapat melihat tender terbaru.",
                    $penerima->nama,
                    $jum_tender->jumlah
                );
            } elseif ($isUserTrial && (int) $jum_tender->jumlah > 3) {
                $footerNote = sprintf("\n%d tender lainnya dapat Anda lihat dengan berlangganan akun premium TenderPlus", (int) $jum_tender->jumlah - 3);
                $pesan .= $footerNote;
                $footnoteTrial = $footerNote;
            }

            $data = [
                'nomorWa' => $no_wa,
                'msg' => $pesan,
            ];

            if (!isSkipWhatsapp()) $this->sendWhatsappMsg($data);

            $resp = $this->sendEmail([
                'name' => $penerima->nama,
                'count_tender' => $jum_tender->jumlah,
                'email' => $penerima->email,
                'tenders' => $tenders,
                'isUserPremium' => $isUserPremium,
                'isUserTrial' => $isUserTrial,
                'isUserFree' => $isUserFree,
                'footnoteTrial' => $footnoteTrial,
            ]);

            if ($resp) $countEmail++;
            
            $this->Tender_model->simpanKirimNotif($penerima->id_pengguna);
        }
        echo sprintf('%d buah email terkirim ke user.', $countEmail);
    }

    // Kirim email tender terbaru
    public function sendEmail(array $data = [])
    {
        $this->load->library('email');
        $this->email->from('no-reply@tenderplus.id', 'Tender Plus');
        $this->email->to($data['email']);
        $this->email->subject('Notifikasi Tender Terbaru');
        $baseUrl = base_url();
        if (is_cli()) {
            $baseUrl = getBaseUrl();
        }
        $data['baseurl'] = substr($baseUrl, -1) == '/' ? substr($baseUrl, 0, strlen($baseUrl) - 1) : $baseUrl;

        $message = $this->load->view('tender/email-newest-tender', $data, true);
        if (isDev()) {
            $filename = sprintf('%s-%s.html', $this->sanitizeFileName($data['email'], true, false, ['-', '@', '.']), date('Ymd-His'));
            file_put_contents(sprintf('%s/temp/email/%s', FCPATH, $filename), $message);

            return true;
        }

        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }
        return false;
    }

    public function getFinalRegister(string $finalReg)
    {
        $datetime = new DateTime($finalReg);
        $date = $datetime->format('d-m-Y');
        $time = $datetime->format('H:i');
        $date = explode('-', $date);
        $bulan = $date[1];
        $bln = '';
        if ($bulan == '01') {
            $bln = 'Januari';
        } elseif ($bulan == '02') {
            $bln = 'Februari';
        } elseif ($bulan == '03') {
            $bln = 'Maret';
        } elseif ($bulan == '04') {
            $bln = 'April';
        } elseif ($bulan == '05') {
            $bln = 'Mei';
        } elseif ($bulan == '06') {
            $bln = 'Juni';
        } elseif ($bulan == '07') {
            $bln = 'Juli';
        } elseif ($bulan == '08') {
            $bln = 'Agustus';
        } elseif ($bulan == '09') {
            $bln = 'September';
        } elseif ($bulan == '10') {
            $bln = 'Oktober';
        } elseif ($bulan == '11') {
            $bln = 'November';
        } elseif ($bulan == '12') {
            $bln = 'Desember';
        }
        return "{$date[0]} {$bln} {$date[2]} {$time}";
    }

    public function listNewestTender()
    {
        $pageNumber = htmlspecialchars($this->input->get('page', true));
        $pageSize = htmlspecialchars($this->input->get('per_page', true));
        $prefs = [];
        $listAllowedColumn = ['keyword', 'id_lpse', 'jenis_pengadaan', 'nilai_hps_awal', 'nilai_hps_akhir'];
        foreach ($_POST as $key => $value) {
            if (!in_array($key, $listAllowedColumn)) {
                continue;
            }
            $prefs[$key] = $this->input->post($key);
        }

        $totalItems = $this->Tender_model->getListKatalogTenderTerbaru($prefs, $pageNumber, $pageSize, true);
        $result = $this->Tender_model->getListKatalogTenderTerbaru($prefs, $pageNumber, $pageSize);
        $this->output->set_header('Content-Type: application/json');
        echo json_encode(['items' => $result, 'total_items' => $totalItems], JSON_NUMERIC_CHECK);
    }

    public function scrapping_tender()
    {
        $this->client->request('GET', 'api/scrapping/tender', $this->client->getConfig('headers'));
        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', 'https://testweb.dreamit.my.id/api/scrapping/tender', [
        	'auth' => ['beetend', '76oZ8XuILKys5'],
        ]);
    }

    public function openLink()
    {
        $url = $this->input->get('link');
        $this->load->view('tender/open-link', ['url' => $url]);
    }*/
}
