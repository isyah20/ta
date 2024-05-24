<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;*/

class Home extends CI_Controller
{
    public $perPage = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tender_model');
        $this->load->model('PaketPembelian_model');
        
        /*$this->load->model('Lpse_model');
        $this->load->model('JenisTender_model');
        $this->load->model('Tahapan_model');
        $this->load->model('WilayahModel');
        $this->load->model('Jadwal_model');
        
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('user');
        
        $this->_client = new Client([
            'base_uri' => base_url('api/'),
            'timeout' => 4,
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);*/
    }

    public function index()
    {
        /*$sessionData = $this->session->user_data;
        $photo = null;
        $userId = 0;
        if($sessionData) {
            $photo = $this->user->getPhotoProfile((int) $sessionData['id_pengguna'], $this->db);
            $userId = (int) $sessionData['id_pengguna'];
        }*/
        
        $statistikhome = $this->Tender_model->getStatistik();

        $data = [
            'title' => 'Beranda',
            'statistik' => $statistikhome,
            'halaman' => 'home/index',
            /*'tender' => $tender['data'],
            'totalPage' => ceil($totalTender['data'] / $this->perPage),
            // 'tender' => $tender['data'],
            'wilayah' => $wilayah['data'],
            'lpse' => $lpse['data'],
            'tahapan' => $tahapan['data'],
            'photo' => $photo,
            'userId' => $userId,*/
        ];

        $this->load->view('templates/layout', $data);
    }
    
    public function faq()
    {
        $data = [
            'title' => 'FAQ',
            'halaman' => 'home/faq'
        ];

        $this->load->view('templates/layout', $data);
    }

    public function kebijakan_privasi()
    {
        $data = [
            'title' => 'Kebijakan Privasi',
            'halaman' => 'home/kebijakan_privasi'
        ];

        $this->load->view('templates/layout', $data);
    }

    public function detail_artikel()
    {
        $data = [
            'title' => 'Artikel',
            'halaman' => 'home/detail_artikel'
        ];

        $this->load->view('templates/layout', $data);
    }

    public function baca_artikel()
    {
        $data = [
            'title' => 'Artikel',
            'halaman' => 'home/baca_artikel'
        ];

        $this->load->view('templates/layout', $data);
    }

    public function hubungi_kami()
    {
        $data = [
            'title' => 'Hubungi Kami',
            'halaman' => 'home/hubungi_kami'
        ];

        $this->load->view('templates/layout', $data);
    }

    public function tentang_kami()
    {
        $data = [
            'title' => 'Tentang Kami',
            'halaman' => 'home/tentang_kami'
        ];

        $this->load->view('templates/layout', $data);
    }

    public function pricing_plan()
    {
        $data = [
            'title' => 'Paket',
            'halaman' => 'home/pricing_plan'
        ];

        $this->load->view('templates/layout', $data);
    }
    
    public function pembayaran()
    {
        $data = [
            'title' => 'Pembayaran',
            'halaman' => 'payment/pembayaran'
        ];

        $this->load->view('templates/layout', $data);
    }
    
    public function invoice()
    {
        $data = [
            'title' => 'Invoice Pembayaran',
            'halaman' => 'payment/invoice'
        ];

        $this->load->view('templates/layout', $data);
    }

    public function getFitur($data)
    {
        $response = $this->PaketPembelian_model->getData($data)->result();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function detail_tender($id)
    {
        $tender = $this->Tender_model->getTenderById($id)->row();

        $data = [
            'title' => 'Detail Tender',
            'halaman' => 'home/detail_tender',
            'tender' => $tender
        ];

        $this->load->view('templates/layout', $data);
    }

    public function detail_pemenang($id)
    {
        $tender = $this->Tender_model->getWinnerById($id)->row();
        
        $data = [
            'title' => 'Detail Pemenang Tender',
            'halaman' => 'home/detail_pemenang',
            'tender' => $tender
        ];
        
        $this->load->view('templates/layout', $data);
    }

    /*
    public function dashboard_user()
    {
        $userId = get_cookie('id_pengguna');
        
        if ($userId) {
            $user = $this->getKategoriUser($userId)->row();
            $kategori = $user->kategori;
        
            if ($kategori == '1') redirect('tender');
            elseif ($kategori == '2') redirect('user-dashboard');
            elseif ($kategori == '3') redirect('asosiasi');
            elseif ($kategori == '4') redirect('suplier');
        } else redirect('login');
    }
    
    private function getKategoriUser($id)
    {
        return $this->db->query("SELECT kategori FROM pengguna WHERE id_pengguna={$id}");
    }
    
    public function statistic()
    {
        $statistic = $this->_client->request('GET', 'statistikhome', $this->_client->getConfig('headers'));
        $data = ['statistic' => $statistic['data']];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function indexOri()
    {
        $totalTender = $this->Tender_model->getTenderDefaultC($this->input->get('cariOrderBy'));
        // get wilayah
        $wilayah = $this->WilayahModel->getAllWilayah();
        // get kategori lpse
        $lpse = $this->Lpse_model->getAllLpse();
        // get jenis_pengadaan
        $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();
        // get tahapan
        $tahapan = $this->Tahapan_model->getAllTahapan();
        if (!empty($this->input->get("page"))) {
            $start = $this->perPage * $this->input->get('page');
            $tender = $this->Tender_model->getTenderDefaultLim($this->input->get('cariOrderBy'), $this->perPage, $start);
            $data['tender'] = $tender['data'];
            $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);
            $this->load->view('home/post_tender', $data);
        } else {
            $start = 0;
            $tender = $this->Tender_model->getTenderDefaultLim($this->input->get('cariOrderBy'), $this->perPage, $start);

            $data = [
                'title' => 'Home',
                'tender' => $tender['data'],
                'totalPage' => ceil($totalTender['data'] / $this->perPage),
                'wilayah' => $wilayah['data'],
                'lpse' => $lpse['data'],
                'jenisPengadaan' => $jenisPengadaan['data'],
                'tahapan' => $tahapan['data'],
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('home/index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function getTenderDefault()
    {
        $totalTender = $this->Tender_model->getTenderDefaultC($this->input->get('cariOrderBy'));

        if (!empty($this->input->get("page"))) {
            $start = $this->perPage * $this->input->get('page');
            $tender = $this->Tender_model->getTenderDefaultLim($this->input->get('cariOrderBy'), $this->perPage, $start);
            $json = [
                'pagination_results' => $tender,
                'total_page' => ceil($totalTender / $this->perPage),
            ];
        } else {
            $start = 0;
            $tender = $this->Tender_model->getTenderDefaultLim($this->input->get('cariOrderBy'), $this->perPage, $start);
            $json = [
                'pagination_results' => $tender,
                'total_page' => ceil($totalTender / $this->perPage),
            ];
        }
    }

    public function tender()
    {
        $data = $this->input->post();
        $json = [];
        $getTender = null;
        $getTotalPage = 0;

        if ($data['cari'] === '' && $data['cariWilayah'] === "null" && $data['cariKLPD'] === "null" && $data['cariJenisPengadaan'] === "null" && $data['cariHPS'] === "null" && $data['cariKualifikasi'] === "null" && $data['cariTahun'] === "null" && $data['cariTahapan'] === "null") {
            $totalTender = $this->Tender_model->getTenderDefaultC($data['cariOrderBy']);
            if ($totalTender['status'] !== false) {
                if (!empty($this->input->get("page"))) {
                    $getTotalPage = ceil($totalTender['data'] / $this->perPage);
                    $start = $this->perPage * $this->input->get('page');
                    $tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);
                    if ($tender['status'] !== false) {
                        $getTender = $tender['data'];
                    }
                } else {
                    $getTotalPage = ceil($totalTender['data'] / $this->perPage);
                    $start = 0;
                    $tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);
                    if ($tender['status'] !== false) {
                        $getTender = $tender['data'];
                    }
                }
            }
        } elseif ($data['cari'] !== '' || $data['cariWilayah'] !== "null" || $data['cariKLPD'] !== "null" || $data['cariJenisPengadaan'] !== "null" || $data['cariHPS'] !== "null" || $data['cariKualifikasi'] !== "null" || $data['cariTahun'] !== "null" || $data['cariTahapan'] !== "null" || $data['cariOrderBy'] !== "null") {
            $totalTender = $this->Tender_model->getSearchTenderC($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy']);

            if ($totalTender['status'] !== false) {
                if (!empty($this->input->post("halaman"))) {
                    $getTotalPage = ceil($totalTender['data'] / $this->perPage);

                    $start = $this->perPage * $this->input->post('halaman');

                    $tender = $this->Tender_model->getSearchTenderLim($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy'], $this->perPage, $start);

                    if ($tender['status'] !== false) {
                        $getTender = $tender['data'];
                    }
                } else {
                    $getTotalPage = ceil($totalTender['data'] / $this->perPage);

                    $start = 0;

                    $tender = $this->Tender_model->getSearchTenderLim($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy'], $this->perPage, $start);

                    if ($tender['status'] !== false) {
                        $getTender = $tender['data'];
                    }
                }
            }
        }

        $json = [

            'tender' => $getTender,

            'totalPage' => $getTotalPage,

        ];

        // var_dump($json);

        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($json));
    }

    public function tender()

    {

    	$data = $this->input->post();

    	// var_dump($data);

    	$json = array();

    	$getTender = null;

    	$getTotalPage = 0;

    	if ($data['cari'] === '' && $data['cariWilayah'] === "null" && $data['cariKLPD'] === "null" && $data['cariJenisPengadaan'] === "null" && $data['cariHPS'] === "null" && $data['cariKualifikasi'] === "null" && $data['cariTahun'] === "null" && $data['cariTahapan'] === "null") {

    		$tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

    		if($tender['status']!==false){

    			if (!empty($this->input->get("page"))) {

    				$getTotalPage = ceil($tender['recordsTotal'] / $this->perPage);

    				$start = $this->perPage * $this->input->get('page');

    				$tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

    				if($tender['status']!==false){

    					$getTender = $tender['data'];

    				}

    				// $getTender = $tender['data'];

    				// $this->load->view('home/post_tender', $data);

    			} else {

    				$getTotalPage = ceil($totalTender['data'] / $this->perPage);

    				$start = 0;

    				$tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

    				if($tender['status']!==false){

    					$getTender = $tender['data'];

    				}

    				// $getTender = $tender['data'];

    			}

    		}

    	// } else if ($data['cari'] === '' && $data['cariWilayah'] === "null" && $data['cariKLPD'] === "null" && $data['cariJenisPengadaan'] === "null" && $data['cariHPS'] === "null" && $data['cariKualifikasi'] === "null" && $data['cariTahun'] === "null" && $data['cariTahapan'] === "null" && $data['cariOrderBy'] !== "null"){

    	// 	$totalTender = $this->Tender_model->getTenderDefaultC($data['cariOrderBy']);

    	// 	// var_dump($totalTender);

    	// 	if($totalTender['status']!==false){

    	// 		if (!empty($this->input->get("page"))) {

    	// 			$getTotalPage = ceil($totalTender['data'] / $this->perPage);

    	// 			$start = $this->perPage * $this->input->get('page');

    	// 			$tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

    	// 			if($tender['status']!==false){

    	// 				$getTender = $tender['data'];

    	// 			}

    	// 			// $getTender = $tender['data'];

    	// 		} else {

    	// 			$getTotalPage = ceil($totalTender['data'] / $this->perPage);

    	// 			$start = 0;

    	// 			$tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

    	// 			if($tender['status']!==false){

    	// 				$getTender = $tender['data'];

    	// 			}

    	// 			// $getTender = $tender['data'];

    	// 		}

    	// 	}

    	} else if ($data['cari'] !== '' || $data['cariWilayah'] !== "null" || $data['cariKLPD'] !== "null" || $data['cariJenisPengadaan'] !== "null" || $data['cariHPS'] !== "null" || $data['cariKualifikasi'] !== "null" || $data['cariTahun'] !== "null" || $data['cariTahapan'] !== "null" || $data['cariOrderBy'] !== "null") {

    		$totalTender = $this->Tender_model->getSearchTenderC($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy']);

    		if ($totalTender['status'] !== false) {

    			if (!empty($this->input->post("halaman"))) {

    				$getTotalPage = ceil($totalTender['data'] / $this->perPage);

    				$start = $this->perPage * $this->input->post('halaman');

    				$tender = $this->Tender_model->getSearchTenderLim($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy'], $this->perPage, $start);

    				if($tender['status']!==false){

    					$getTender = $tender['data'];

    				}

    			} else {

    				$getTotalPage = ceil($totalTender['data'] / $this->perPage);

    				$start = 0;

    				$tender = $this->Tender_model->getSearchTenderLim($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy'], $this->perPage, $start);

    				// $data['tender'] = $tender['data'];

    				// $this->load->view('home/post_tender', $data);

    				if($tender['status']!==false){

    					$getTender = $tender['data'];

    				}

    			}

    		}

    	}

    	$json = array(

    		'tender' => $getTender,

    		'totalPage' => $getTotalPage,

    	);

    	$this->output

    	->set_content_type('application/json')

    	->set_output(json_encode($json));

    }

    public function tender2()
    {
        $data = $this->input->post();

        if ($data['cari'] === '' && $data['cariWilayah'] === "null" && $data['cariKLPD'] === "null" && $data['cariJenisPengadaan'] === "null" && $data['cariHPS'] === "null" && $data['cariKualifikasi'] === "null" && $data['cariTahun'] === "null" && $data['cariTahapan'] === "null" && $data['cariOrderBy'] === "null") {
            $totalTender = $this->Tender_model->getTenderDefaultC($data['cariOrderBy']);

            if (!empty($this->input->get("page"))) {
                $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);

                $start = $this->perPage * $this->input->get('page');

                $tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

                $data['tender'] = $tender['data'];

                $this->load->view('home/post_tender', $data);
            } else {
                $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);

                $start = 0;

                $tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

                $data['tender'] = $tender['data'];

                $this->load->view('home/post_tender', $data);
            }
        } elseif ($data['cari'] === '' && $data['cariWilayah'] === "null" && $data['cariKLPD'] === "null" && $data['cariJenisPengadaan'] === "null" && $data['cariHPS'] === "null" && $data['cariKualifikasi'] === "null" && $data['cariTahun'] === "null" && $data['cariTahapan'] === "null" && $data['cariOrderBy'] !== "null") {
            $totalTender = $this->Tender_model->getTenderDefaultC($data['cariOrderBy']);

            if (!empty($this->input->get("page"))) {
                $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);

                $start = $this->perPage * $this->input->get('page');

                $tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

                $data['tender'] = $tender['data'];

                $this->load->view('home/post_tender', $data);
            } else {
                $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);

                $start = 0;

                $tender = $this->Tender_model->getTenderDefaultLim($data['cariOrderBy'], $this->perPage, $start);

                $data['tender'] = $tender['data'];

                $this->load->view('home/post_tender', $data);
            }
        } elseif ($data['cari'] !== '' || $data['cariWilayah'] !== "null" || $data['cariKLPD'] !== "null" || $data['cariJenisPengadaan'] !== "null" || $data['cariHPS'] !== "null" || $data['cariKualifikasi'] !== "null" || $data['cariTahun'] !== "null" || $data['cariTahapan'] !== "null" || $data['cariOrderBy'] !== "null") {
            $totalTender = $this->Tender_model->getSearchTenderC($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy']);

            if ($totalTender['status'] !== false) {
                if (!empty($this->input->post("halaman"))) {
                    $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);

                    $start = $this->perPage * $this->input->post('halaman');

                    $tender = $this->Tender_model->getSearchTenderLim($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy'], $this->perPage, $start);

                    if ($tender['status'] !== false) {
                        $data['tender'] = $tender['data'];

                        $this->load->view('home/post_tender', $data);
                    } else {
                        ?>

						<a class="row-table d-flex mt-1 text-body" disable="disabled">

							<div class="col text-center mx-1">Tidak ada data</div>

						</a>

					<?php

                    }
                } else {
                    $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);

                    $start = 0;

                    $tender = $this->Tender_model->getSearchTenderLim($data['cari'], "null", $data['cariWilayah'], $data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariKualifikasi'], $data['cariTahun'], $data['cariTahapan'], $data['cariOrderBy'], $this->perPage, $start);

                    // $data['tender'] = $tender['data'];

                    // $this->load->view('home/post_tender', $data);

                    if ($tender['status'] !== false) {
                        $data['tender'] = $tender['data'];

                        $this->load->view('home/post_tender', $data);
                    } else {
                        ?>

						<a class="row-table d-flex mt-1 text-body" disable="disabled">

							<div class="col text-center mx-1">Tidak ada data</div>

						</a>

				<?php

                    }
                }
            } else {
                ?>

				<a class="row-table d-flex mt-1 text-body" disable="disabled">

					<div class="col text-center mx-1">Tidak ada data</div>

				</a>

			<?php

            }
        }
    }

    public function modalJadwal2()
    {
        $id = $this->input->post("sendId");

        $jadwal = $this->Jadwal_model->getJadwalByIdTender($id);

        // Merubah Format Tanggal dan Waktu

        if (isset($jadwal["data"])) {
            foreach ($jadwal["data"] as $key => $jadwals) {
                $jadwal["data"][$key]["tgl_mulai"] = date("d F Y H:i", strtotime($jadwals["tgl_mulai"]));

                $jadwal["data"][$key]["tgl_akhir"] = $jadwals["tgl_akhir"] != null ? date("d F Y H:i", strtotime($jadwals["tgl_akhir"])) : null;
            }
        }

        if ($jadwal['status'] !== false) :

            //Merubah Format Tanggal dan Waktu

            // if (isset($jadwal["data"])) {

            // 	foreach ($jadwal["data"] as $key => $jadwals) {

            // 		$jadwal["data"][$key]["tgl_mulai"] = date("d F Y H:i", strtotime($jadwals["tgl_mulai"]));

            // 		$jadwal["data"][$key]["tgl_akhir"] = $jadwals["tgl_akhir"] != null ? date("d F Y H:i", strtotime($jadwals["tgl_akhir"])) : null;

            // 	}

            // }

            ?>

			<div class="modal-header m-2">

				<div class="col-lg-1 col-md-2 col-2">

					<img src="<?= base_url("assets/img/logo-detail.png") ?>" style="width:48px; height:80px" alt="logoDetail">

				</div>

				<div class="col text-start">

					<h4>Tahapan / Jadwal</h4>

					<p class="text-judul-jadwal"><?= $this->input->post("sendNama"); ?></p>

				</div>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>

			<div class="modal-body body-jadwal">

				<div class="timeline pb-5 timeline--loaded timeline--mobile">

					<!-- <div class="timeline pb-5"> -->

					<div class="timeline__wrap">

						<div class="timeline__items">



							<?php // var_dump($jadwal)

                            ?>

							<?php foreach ($jadwal['data'] as $key => $jadwals) : ?>

								<?php // var_dump($key)

                                ?>

								<?php if ((int) $key % 2 == 0) : ?>

									<?php // var_dump($jadwal)

                                    ?>

									<div class="timeline__item top <?= (strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?> timeline__item--top" style="width: 139.333px; height: 268px;">

										<div class="timeline__item__inner">

											<div class="timeline__content__wrap">

												<div class="timeline__content ">

													<div class="row">

														<div class="col-1 align-self-center">

															<span>

																<iconify-icon icon="<?= $jadwals["icon"] ?>" style="color: #ae0707;"></iconify-icon>

															</span>

														</div>

														<div class="col align-self-center">

															<h6 class="text-jadwal" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>

															<p class="tanggal-jadwal" style="font-size: 12px" width="12" height="15">

																<?php

                                                                // Mengecek jika tanggal akhir ada

                                                                if ($jadwals["tgl_akhir"] != "") {
                                                                    // Mengecek jika kedua tanggal memiliki bulan yang sama maka diambil bulan pada tanggal akhir

                                                                    if (date("F", strtotime($jadwals["tgl_mulai"])) === date("F", strtotime($jadwals["tgl_akhir"]))) {
                                                                        echo substr($jadwals["tgl_mulai"], 0, 2) . " - " . $jadwals["tgl_akhir"];
                                                                    } else {
                                                                        echo $jadwals["tgl_mulai"] . " - " . $jadwals["tgl_akhir"];
                                                                    }
                                                                } else {
                                                                    echo $jadwals["tgl_mulai"];
                                                                }

							    ?> </p>

														</div>

													</div>

												</div>

											</div>

										</div>

										<span class="timeline__arrow">

											<img src="<?= base_url(strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"]) ? 'assets/img/arrowup.png' : 'assets/img/arrowup-dashed.png') ?>" style="width:13px; height:70px" alt="">

										</span>

									</div>

								<?php else : ?>

									<div class="timeline__item bottom <?= (strtotime(date("d M Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?> timeline__item--bottom" style="width: 139.333px; height: 255px; transform: translateY(268px);">

										<span class="timeline__arrow">

											<img src="<?= base_url((strtotime(date("d M Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'assets/img/arrowdown.png' : 'assets/img/arrowdown-dashed.png') ?>" style=" width:13px; height:70px" alt="">

										</span>

										<hr class="right-line-bottom">

										<div class="timeline__item__inner">

											<div class="timeline__content__wrap">

												<div class="timeline__content mt-2">

													<div class="row">

														<div class="col-1 align-self-center">

															<span>

																<iconify-icon icon="<?= $jadwals["icon"] ?>" style="color: #ae0707;" width="20" height="20"></iconify-icon>

															</span>

														</div>

														<div class="col align-self-center">

															<h6 class="text-jadwal" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>

															<p class="tanggal-jadwal" style="font-size: 12px">

																<?php

							    if ($jadwals["tgl_akhir"] != "") {
							        if (date("F", strtotime($jadwals["tgl_mulai"])) === date("F", strtotime($jadwals["tgl_akhir"]))) {
							            echo substr($jadwals["tgl_mulai"], 0, 2) . " - " . $jadwals["tgl_akhir"];
							        } else {
							            echo $jadwals["tgl_mulai"] . " - " . $jadwals["tgl_akhir"];
							        }
							    } else {
							        echo $jadwals["tgl_mulai"];
							    }

								    ?> </p>

														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

								<?php endif; ?>

							<?php endforeach; ?>



						</div>

					</div>

				</div>

			</div>

			<!-- <script src="<?= base_url("assets/js/tender/timeline.js") ?>"></script> -->

		<?php else : ?>

			<div class="modal-header m-2">

				<div class="col-lg-1 col-md-2 col-2">

					<img src="<?= base_url("assets/img/logo-detail.png") ?>" style="width:48px; height:80px" alt="logoDetail">

				</div>

				<div class="col text-start">

					<h4>Tahapan / Jadwal</h4>

					<p class="text-judul-jadwal"><?= $this->input->post("sendNama"); ?></p>

				</div>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>

			<div class="modal-body body-jadwal">

				<div class="row py-4">

					<div class="col align-self-center text-center">

						<h6 class="text-jadwal font-weight-bold">Belum ada jadwal</h6>

					</div>

				</div>

			</div>

		<?php

		endif;
    }

    public function modalJadwal()
    {
        $id = $this->input->post("sendId");

        $jadwal = $this->Jadwal_model->getJadwalByIdTender($id);

        // Merubah Format Tanggal dan Waktu

        if (isset($jadwal["data"])) {
            foreach ($jadwal["data"] as $key => $jadwals) {
                $jadwal["data"][$key]["tgl_mulai"] = date("d F Y H:i", strtotime($jadwals["tgl_mulai"]));

                $jadwal["data"][$key]["tgl_akhir"] = $jadwals["tgl_akhir"] != null ? date("d F Y H:i", strtotime($jadwals["tgl_akhir"])) : null;
            }
        }

        if ($jadwal['status'] !== false) :

            //Merubah Format Tanggal dan Waktu

            // if (isset($jadwal["data"])) {

            // 	foreach ($jadwal["data"] as $key => $jadwals) {

            // 		$jadwal["data"][$key]["tgl_mulai"] = date("d F Y H:i", strtotime($jadwals["tgl_mulai"]));

            // 		$jadwal["data"][$key]["tgl_akhir"] = $jadwals["tgl_akhir"] != null ? date("d F Y H:i", strtotime($jadwals["tgl_akhir"])) : null;

            // 	}

            // }

            ?>

			<div class="modal-header m-2">

				<div class="col-md-2 col-xs-4">

					<img src="<?= base_url("assets/img/logo-detail.png") ?>" style="width:48px; height:80px" alt="logoDetail">

				</div>

				<div class="col-md-9 col-xs-7 text-start">

					<h4>Tahapan / Jadwal</h4>

					<p class="text-judul-jadwal"><?= $this->input->post("sendNama"); ?></p>

				</div>

				<button type="button" class="col-1 col-xs-1 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>

			<div class="modal-body body-jadwal">

				<div class="timeline timeline--loaded timeline--mobile">

					<!-- <div class="timeline pb-5"> -->

					<div class="timeline__wrap">

						<div class="timeline__items">



							<?php // var_dump($jadwal)

                                ?>

							<?php foreach ($jadwal['data'] as $key => $jadwals) : ?>

								<?php // var_dump($key)

                                    ?>

								<?php if ((int) $key % 2 == 0) : ?>

									<?php // var_dump($jadwal)

                                        ?>

									<div class="timeline__item top <?= (strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?> timeline__item--top timeline__item--left py-1">

										<!-- <div class="timeline__item top <?= (strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?>"> -->

										<div class="timeline__content justify-content-start">

											<!-- <div class="timeline__content"> -->

											<div class="row">

												<div class="col-1 align-self-center">

													<span>

														<iconify-icon icon="<?= $jadwals["icon"] ?>" style="color: #ae0707;"></iconify-icon>

													</span>

												</div>

												<div class="col align-self-center">

													<h6 class="text-jadwal text-start" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>

													<p class="tanggal-jadwal text-start" style="font-size: 12px" width="12" height="15">

														<?php

                                                            // Mengecek jika tanggal akhir ada

                                                            if ($jadwals["tgl_akhir"] != "") {
                                                                // Mengecek jika kedua tanggal memiliki bulan yang sama maka diambil bulan pada tanggal akhir

                                                                if (date("F", strtotime($jadwals["tgl_mulai"])) === date("F", strtotime($jadwals["tgl_akhir"]))) {
                                                                    echo substr($jadwals["tgl_mulai"], 0, 2) . " - " . $jadwals["tgl_akhir"];
                                                                } else {
                                                                    echo $jadwals["tgl_mulai"] . " - " . $jadwals["tgl_akhir"];
                                                                }
                                                            } else {
                                                                echo $jadwals["tgl_mulai"];
                                                            }

							    ?>

													</p>

												</div>

											</div>

										</div>

										<!-- <span class="timeline__arrow">

											<img src="<?= base_url(strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"]) ? 'assets/img/arrowup.png' : 'assets/img/arrowup-dashed.png') ?>" style="width:13px; height:70px" alt="">

										</span> -->

										<?php if ($key !== 0) {
										    // echo '<hr class="right-line" />';
										} ?>

									</div>

								<?php else : ?>

									<div class="timeline__item bottom <?= (strtotime(date("d M Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?> timeline__item--bottom  timeline__item--left py-1">

										<!-- <div class="timeline__item bottom <?= (strtotime(date("d M Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?>"> -->

										<!-- <span class="timeline__arrow">

											<img src="<?= base_url((strtotime(date("d M Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'assets/img/arrowdown.png' : 'assets/img/arrowdown-dashed.png') ?>" style=" width:13px; height:70px" alt="">

										</span> -->

										<!-- <hr class="right-line-bottom" /> -->

										<div class="timeline__content justify-content-start mt-2">

											<!-- <div class="timeline__contentmt-2"> -->

											<div class="row">

												<div class="col-1 align-self-center">

													<span>

														<iconify-icon icon="<?= $jadwals["icon"] ?>" style="color: #ae0707;" width="20" height="20"></iconify-icon>

													</span>

												</div>

												<div class="col align-self-center">

													<h6 class="text-jadwal text-start" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>

													<p class="tanggal-jadwal text-start" style="font-size: 12px">

														<?php

										                if ($jadwals["tgl_akhir"] != "") {
										                    if (date("F", strtotime($jadwals["tgl_mulai"])) === date("F", strtotime($jadwals["tgl_akhir"]))) {
										                        echo substr($jadwals["tgl_mulai"], 0, 2) . " - " . $jadwals["tgl_akhir"];
										                    } else {
										                        echo $jadwals["tgl_mulai"] . " - " . $jadwals["tgl_akhir"];
										                    }
										                } else {
										                    echo $jadwals["tgl_mulai"];
										                }

								    ?>

													</p>

												</div>

											</div>

										</div>

									</div>

								<?php endif; ?>

							<?php endforeach; ?>



						</div>

					</div>

				</div>

			</div>

			<!-- <script src="<?= base_url("assets/js/tender/timeline.js") ?>"></script> -->

		<?php else : ?>

			<div class="modal-header m-2">

				<div class="col-md-2 col-xs-4">

					<img src="<?= base_url("assets/img/logo-detail.png") ?>" style="width:48px; height:80px" alt="logoDetail">

				</div>

				<div class="col-md-9 col-xs-7 text-start">

					<h4>Tahapan / Jadwal</h4>

					<p class="text-judul-jadwal"><?= $this->input->post("sendNama"); ?></p>

				</div>

				<button type="button" class="col-md-1 col-xs-1 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>

			<div class="modal-body body-jadwal">

				<div class="row py-4">

					<div class="col align-self-center text-center">

						<h6 class="text-jadwal font-weight-bold">Belum ada jadwal</h6>

					</div>

				</div>

			</div>

<?php

		endif;
    }

    public function getTenderList()
    {
        $results = $this->Tender_model->getTenderList();

        $data = [];

        $no = $_POST['start'];

        foreach ($results as $result) {
            $row = [];

            $row[] = $result->id_tender;

            $row[] = $result->id_lpse;

            $row[] = $result->id_jenis;

            $row[] = $result->nama_tender;

            $row[] = $result->nilai_hps;

            $row[] = $result->nilai_kontrak;

            $data[] = $row;
        }

        $output = [

            "draw" => $_POST['draw'],

            "recordsTotal" => $this->Tender_model->count_all_data(),

            "recordsFiltered" => $this->Tender_model->count_filtered_data(),

            "data" => $data,

        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }
    
    public function get_tender_data()
    {
        $lpse_id = '26';
        $data['tender'] = $this->Tender_model->get_tender_by_lpse_id($lpse_id);
        echo json_encode($data);
    }

    public function getTabelTender()
    {
        if (

            isset($_SERVER['HTTP_X_REQUESTED_WITH'])

            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])

            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'

        ) {
            $datatable = $_POST;

            $datatable['col-display'] = [

                'id_tender',

                'id_duplikat',

                'nama_tender',

                'lokasi_pekerjaan',

                'jenis_tender',

                'metode_pemilihan',

                'status',

                'nilai_hps',

            ];

            return $this->Tender_model->getTabelTender($datatable);
        }
    }

    public function getLpse()
    {
        $lpse = $this->Lpse_model->getAllLpse();

        // cek isi json must not null

        if (isset($lpse['data'])) {
            // Do something with the value at $array[$index]

            $json = [

                'lpse' => $lpse['data'],

            ];
        } else {
            // get data from model again

            $json = $this->Lpse_model->getAllLpse();
            ;
        }

        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($json));
    }

    public function getJenisPengadaan()
    {
        $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();

        if (isset($jenisPengadaan['data'])) {
            // Do something with the value at $array[$index]

            $json = [

                'jenisPengadaan' => $jenisPengadaan['data'],

            ];
        } else {
            // get data from model again

            $json = $this->JenisTender_model->getAllJenisTender();
        }

        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($json));
    }

    public function getWilayah()
    {
        $wilayah = $this->WilayahModel->getAllWilayah();

        if (isset($wilayah['data'])) {
            // Do something with the value at $array[$index]

            $json = [

                'wilayah' => $wilayah['data'],

            ];
        } else {
            // get data from model again

            $json = $this->WilayahModel->getAllWilayah();
        }

        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($json));
    }

    public function getTahapan()
    {
        $tahapan = $this->Tahapan_model->getAllTahapan();

        if (isset($tahapan['data'])) {
            // Do something with the value at $array[$index]

            $json = [

                'tahapan' => $tahapan['data'],

            ];
        } else {
            // get data from model again

            $json = $this->Tahapan_model->getAllTahapan();
        }

        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($json));
    }*/
}
