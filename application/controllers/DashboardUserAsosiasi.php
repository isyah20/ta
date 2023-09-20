<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class DashboardUserAsosiasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 3) {
            redirect('login');
        }
        $this->load->model('api/Daftarhitam_model', 'daftarhitam');
        $this->load->model('api/AnggotaAsosiasi_model', 'anggota');
        $this->load->model('Pemenang_model');
        $this->load->model('Blacklist_model', 'blacklist');
        $this->load->model('Asosiasi_model', 'asosiasi');
        $this->load->model('Lpse_model', 'lpse');
        $this->load->model('Tender_model');
        $this->load->model('WilayahModel');
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => base_url() . 'api/',
            // You can set any number of default request options.
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    public function index()
    {
        $notif = null;

        try {
            $tender = $this->client->request('GET', 'api/tender/notifikasi-tender-baru-dashboard-user', $this->client->getConfig('headers'));
            $notif = json_decode($tender->getBody()->getContents(), true);

            $notif = $notif['data'];
        } catch (ClientException $e) {
            $notif = null;
        }
        $id_pengguna = $this->session->user_data['id_pengguna'];
        $search = [
            'lpse' => trim($this->input->post('lpse')),
            'tahun' => trim($this->input->post('tahun')),
        ];

        $response_rata = $this->anggota->getdatadinamisavg($search, $id_pengguna);
        // die;
        $rata1 = [];
        foreach ($response_rata as $b) {
            $rata1[0] = $b['persen_ikut_tender'];
            $rata1[1] = $b['rata_ikut_tender'];
            $rata1[2] = $b['rata_menang_tender'];
            $rata1[3] = $b['rata_kalah_tender'];
            $rata1[4] = $b['rata_penurunan_hps'];
            $rata1[5] = $b['persen_menang_tender'];
            $rata1[6] = $b['persen_kalah_tender'];
            $rata1[7] = $b['persen_penurunan_tender'];
        }

        $response = $this->anggota->getdatadinamis($search, $id_pengguna);
        if (json_encode($response) != "[]") {
            $akumulasi = [];

            foreach ($response as $r) {
                $akumulasi[0] = (int) $r['total_menang'];
                $akumulasi[1] = (int) $r['total_kalah'];
                $akumulasi[2] = (int) $r['total_ikut'];
                $akumulasi[3] = (int) $r['total_ikut_semua'];
                // $akumulasi[4] = (int)$r['persen_menang'];
                // $akumulasi[5] = (int)$r['persen_kalah'];
                // $akumulasi[6] = (int)$r['persen_ikut'];
            }

            if (($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) != 0) {
                $akumulasi[4] = round($response['0']['total_menang'] / ($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) * 100);
                $akumulasi[5] = round($response['0']['total_kalah'] / ($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) * 100);
                $akumulasi[6] = round($response['0']['total_ikut'] / ($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) * 100);
            } else {
                $akumulasi[4] = 0;
                $akumulasi[5] = 0;
                $akumulasi[6] = 0;
            }
        } else {
            $akumulasi = [0, 0, 0, 0];
        }
        $lpse = $this->lpse->getAllLpse();;
        $wilayah = $this->WilayahModel->getAllWilayah();
        $blacklist = $this->blacklist->getAll();
        foreach ($blacklist['data'] as $b);
        $data = [
            'title' => 'Asosiasi Dashboard',
            // 'blacklist' => $this->daftarhitam->getDaftarHItamByNpwp(),
            'wilayah' => $wilayah['data'],
            'blacklist' => $b,
            'lpse' => $lpse['data'],
            'notif' => $notif,
            // 'anggota' => $anggota,
            'akumulasi' => json_encode($akumulasi),
            'rata1' => json_encode($rata1),
            'response' => json_encode($response),
            // 'anggota' => $anggota['data']
        ];
        $this->load->library('user');
        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar', [
            'photo' => $this->user->getPhotoProfile((int) $id_pengguna, $this->db),
        ]);
        $this->load->view('dashboard/asosiasi/index');
        $this->load->view('templates/footer');
    }

    public function create()
    {
        // $id_pengguna = $this->session->user_data['id_pengguna'];
        $this->form_validation->set_rules('id_pengguna', 'id_pengguna', 'required');
        // $this->form_validation->set_rules('npwp', 'npwp', 'required');
        $this->form_validation->set_rules('npwp', 'npwp', 'required|min_length[19]|regex_match[([0-9.-])]');
        $data = [
            'id_pengguna' => htmlspecialchars($this->input->post('id_pengguna', true)),
            'npwp' => htmlspecialchars($this->input->post('npwp', true)),
        ];
        // var_dump($data);
        // die;
        $this->asosiasi->tambahAnggota($data);
    }
    public function destroy($id)
    {
        $this->asosiasi->hapusAnggota($id);
        // redirect('lpse');
    }
    public function table_data()
    {
        $search = [
            'keyword' => trim($this->input->post('search_key')),
            'lpse' => trim($this->input->post('lpse')),
            'tahun' => trim($this->input->post('tahun')),
        ];
        $orderby = $this->input->post('orderby');
        $id_pengguna = $this->session->user_data['id_pengguna'];
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable = $_POST;
            // $datatable ["search"]["value"] =  "";
            // $datatable ["search"]["regex"] = "false";
            // $datatable ["recordsFiltered"] = "0";
            // $datatable ["recordsTotal"] = "0";
            // $datatable ["data"] = "0";
            // $datatable ["draw"] = "1";
            // $datatable ["start"] = "0";
            // $datatable["length"] =  "20";
            // $data = json_decode(str_replace('&quot;', '', $data['lpse']), true);$datatable['lpse'];
            // $search = json_decode(str_replace('&quot;', '', $datatable['lpse']), true);
            // var_dump($search, $datatable);
            // die;

            return $this->asosiasi->getTabelDefault($datatable, $search, $id_pengguna, $orderby);
            // var_dump($this->Tender_model->getTabelDefault($datatable));
        }
    }

    public function chart_dinamis()
    {
        $id_pengguna = $this->session->user_data['id_pengguna'];
        $search = [
            'lpse' => trim($this->input->post('lpse')),
            'tahun' => trim($this->input->post('tahun')),
        ];

        $response_rata = $this->anggota->getdatadinamisavg($search, $id_pengguna);
        $rata1 = [];
        foreach ($response_rata as $b) {
            $rata1[0] = $b['persen_ikut_tender'];
            $rata1[1] = $b['rata_ikut_tender'];
            $rata1[2] = $b['rata_menang_tender'];
            $rata1[3] = $b['rata_kalah_tender'];
            $rata1[4] = $b['rata_penurunan_hps'];
            $rata1[5] = $b['persen_menang_tender'];
            $rata1[6] = $b['persen_kalah_tender'];
            $rata1[7] = $b['persen_penurunan_tender'];
        }
?>
        <p class="d-none" id="chart2"><?php echo json_encode($rata1) ?></p>
        <?php
        $id_pengguna = $this->session->user_data['id_pengguna'];
        $response = $this->anggota->getdatadinamis($search, $id_pengguna);
        if (json_encode($response) != "[]") {
            $akumulasi = [];

            foreach ($response as $r) {
                $akumulasi[0] = (int) $r['total_menang'];
                $akumulasi[1] = (int) $r['total_kalah'];
                $akumulasi[2] = (int) $r['total_ikut'];
                $akumulasi[3] = (int) $r['total_ikut_semua'];
                // $akumulasi[4] = (int)$r['persen_menang'];
                // $akumulasi[5] = (int)$r['persen_kalah'];
                // $akumulasi[6] = (int)$r['persen_ikut'];
            }
            // var_dump($response);
            // die;

            if (($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) != 0) {
                $akumulasi[4] = round($response['0']['total_menang'] / ($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) * 100);
                $akumulasi[5] = round($response['0']['total_kalah'] / ($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) * 100);
                $akumulasi[6] = round($response['0']['total_ikut'] / ($response['0']['total_menang'] + $response['0']['total_kalah'] + $response['0']['total_ikut']) * 100);
            } else {
                $akumulasi[4] = 0;
                $akumulasi[5] = 0;
                $akumulasi[6] = 0;
            }
        } else {
            $akumulasi = [0, 0, 0, 0];
        }
        ?>
        <p class="d-none" id="chart1"><?php echo json_encode($akumulasi) ?></p>
<?php

        // $this->load->view('dashboard/asosiasi/chart_dinamis', $data);
    }

    public function data_anggota()
    {
        $search = [
            'keyword' => trim($this->input->post('search_key')),
            // 'lpse' => trim($this->input->post('lpse')),
            // 'tahun' => trim($this->input->post('tahun')),
        ];
        // $orderby = $this->input->post('orderby');
        $id_pengguna = $this->session->user_data['id_pengguna'];
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $anggota = $_POST;
            // $anggota ["search"]["value"] =  "";
            // $datatable ["search"]["regex"] = "false";
            // $datatable ["recordsFiltered"] = "0";
            // $datatable ["recordsTotal"] = "0";
            // $datatable ["data"] = "0";
            // $datatable ["draw"] = "1";
            // $datatable ["start"] = "0";
            // $datatable["length"] =  "20";

            return $this->asosiasi->data_anggota($anggota, $search, $id_pengguna);
            // var_dump($this->Tender_model->getTabelDefault($datatable));
        }
    }

    // public function table_ajax($start = null)
    // {
    //     $search = array(
    //         'keyword' => trim($this->input->post('search_key')),
    //         'lpse' => trim($this->input->post('lpse')),
    //         'tahun' => trim($this->input->post('tahun')),
    //     );

    //     // $this->load->library('pagination');

    //     $limit = 1000;
    //     $start = 0;
    //     $id_pengguna = $this->session->user_data['id_pengguna'];
    //     // var_dump($id_pengguna);
    //     // die;

    //     $config['base_url'] = base_url('table_ajax/');
    //     $config['total_rows'] = $this->anggota->getDataAsosiasi($limit, $start, $search, $count = true, $id_pengguna);
    //     $config['per_page'] = $limit;
    //     $this->pagination->initialize($config);

    //     $data['anggota'] = $this->anggota->getDataAsosiasi($limit, $start, $search, $count = false, $id_pengguna);

    //     // $data['pagelinks'] = $this->pagination->create_links();
    //     // var_dump($data['anggota']);
    //     $this->load->view('dashboard/asosiasi/table_ajax', $data);
    // }

    public function index_ajax($offset = null)
    {
        $search = [
            'keyword' => trim($this->input->post('search_key')),
            'wilayah' => trim($this->input->post('wilayah')),
        ];

        $this->load->library('pagination');

        $limit = 3;
        $offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $config['base_url'] = base_url('index_ajax/');
        $config['total_rows'] = $this->daftarhitam->get_blacklist($limit, $offset, $search, $count = true);
        $config['per_page'] = $limit;
        // $config['uri_segment'] = 3;
        // $config['num_links'] = 3;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a href="" class="current_page">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = '<iconify-icon inline icon="material-symbols:arrow-forward-rounded"></iconify-icon>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<iconify-icon inline icon="material-symbols:arrow-back-rounded"></iconify-icon>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = '<iconify-icon inline icon="material-symbols:keyboard-double-arrow-left-rounded"></iconify-icon>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<iconify-icon inline icon="material-symbols:keyboard-double-arrow-right-rounded"></iconify-icon>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['daftar_hitam'] = $this->daftarhitam->get_blacklist($limit, $offset, $search, $count = false);

        $data['pagelinks'] = $this->pagination->create_links();
        $data['start'] = ceil(($offset / $config['per_page']) + 1);
        $data['limit'] = ceil($config['total_rows'] / $config['per_page']);
        // var_dump($data['daftar_hitam']);
        $this->load->view('dashboard/asosiasi/index_ajax', $data);
    }

    public function blacklist_selesai($offset = null)
    {
        $search = [
            'keyword' => trim($this->input->post('search_key')),
            'wilayah' => trim($this->input->post('wilayah')),
        ];

        $this->load->library('pagination');

        $limit = 3;
        $offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $config['base_url'] = base_url('blacklist_selesai/');
        $config['total_rows'] = $this->daftarhitam->get_blacklistselesai($limit, $offset, $search, $count = true);
        $config['per_page'] = $limit;
        // $config['uri_segment'] = 3;
        // $config['num_links'] = 3;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a href="" class="current_page">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = '<iconify-icon inline icon="material-symbols:arrow-forward-rounded"></iconify-icon>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<iconify-icon inline icon="material-symbols:arrow-back-rounded"></iconify-icon>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = '<iconify-icon inline icon="material-symbols:keyboard-double-arrow-left-rounded"></iconify-icon>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<iconify-icon inline icon="material-symbols:keyboard-double-arrow-right-rounded"></iconify-icon>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['daftar_hitam'] = $this->daftarhitam->get_blacklistselesai($limit, $offset, $search, $count = false);

        $data['pagelinks'] = $this->pagination->create_links();
        $data['start'] = ceil(($offset / $config['per_page']) + 1);
        $data['limit'] = ceil($config['total_rows'] / $config['per_page']);
        // var_dump($data['daftar_hitam']);
        $this->load->view('dashboard/asosiasi/blacklist_selesai', $data);
    }
}
