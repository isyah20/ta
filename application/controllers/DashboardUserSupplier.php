<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class DashboardUserSupplier extends CI_Controller
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 4) {
        if (!get_cookie('id_pengguna')) {
            redirect('login');
        }

        // $this->load->library('input');
        $this->load->helper('tanggal');
        $this->load->model('Lpse_model');
        $this->load->model('Pemenang_model');
        $this->load->model('Supplier_model');
        $this->load->model('api/Pemenang_model', 'pemenang');
        $this->init();
    }

    public function getToken()
    {
        $this->output->set_header('Content-Type: application/json');
        echo json_encode([], JSON_NUMERIC_CHECK);
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('dashboard/supplier/index');
        $this->load->view('templates/footer');
    }

    // public function addToLeads($id){
    //     $id_exists = $this->Supplier_model->isIdPemenangExists($id);

    //     if ($id_exists) {
    //         echo 'ID sudah ada di database.';
    //     } else {
    //         $data = [
    //             "id_pemenang" => $id,
    //         ];

    //         $this->db->insert('data_leads', $data);
    //     }
    //     $response = array(
    //         'Success' => true,
    //         'Info' => 'Preferensi tender berhasil disimpan.',
    //     );

    //     $this->output
    //          ->set_status_header(200)
    //          ->set_content_type('application/json')
    //          ->set_output(json_encode($response, JSON_PRETTY_PRINT))
    //          ->_display();
    //     exit;
    // }

    public function dataLeads()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('dashboard/supplier/data_leads');
        $this->load->view('templates/footer');
    }

    public function getDataLeads()
    {
        $data = $this->Supplier_model->getDataLeads();
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function getDataLeadsById($id)
    {
        $data = $this->Supplier_model->getDataLeadById($id);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function getKontakLeadById($id)
    {
        $data = $this->Supplier_model->getKontakLeadById($id);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function getKontakLeadByNama($nama)
    {
        $data = $this->Supplier_model->getKontakLeadByName($nama);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function updateDataLeads($id)
    {
        // Mengambil data dari formulir
        $dataLeads = array(
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'profil' => $this->input->post('profil')
            // Tambahkan kolom lain sesuai kebutuhan
        );

        $this->Supplier_model->updateDataLead($id, $dataLeads);

        // Mengambil data dari formulir kontak
        $kontakData = $this->input->post('kontak');

        // Insert data kontak ke tabel kontak
        foreach ($kontakData as $kontak) {
            $dataKontak = array(
                'id_lead' => $id, // ID lead yang sesuai
                'nama' => $kontak['nama'],
                'posisi' => $kontak['posisi'],
                'email' => $kontak['email'],
                'no_telp' => $kontak['no_telp']
            );
            $this->Supplier_model->insertKontakLead($dataKontak);
        }

        // Redirect atau tampilkan pesan sukses
        redirect('suplier/leads');
    }

    public function deleteDataLeadById($id)
    {
        $this->Supplier_model->deleteKontakLeadById($id);
        $this->Supplier_model->deleteDataLeadById($id);
        redirect('suplier/leads');
    }

    public function CRM()
    {
        // $data = $this->Supplier_model->insertUpdatePlotTim(1, 12);
        // var_dump($data);
        // die;

        $data = [
            'title' => 'Dashboard'
        ];

        // var_dump($_COOKIE['id_pengguna']);
        // die;
        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('dashboard/supplier/crm');
        $this->load->view('templates/footer');
    }

    public function marketing()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('dashboard/supplier/marketing');
        $this->load->view('templates/footer');
    }
    public function testCRM()
    {
        $id_lead = $this->input->post('id_lead');
        $id_tim = $this->input->post('id_tim');
        if ($id_tim == 0) {
            $data = $this->Supplier_model->deletePlotTimByIdLead($id_lead);
        } else {
            $data = $this->Supplier_model->insertUpdatePlotTim($id_lead, $id_tim);
        }
        // $data = $this->Supplier_model->insertUpdatePlotTim($id_lead, $id_tim);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function getPlotTim()
    {
        $data = $this->Supplier_model->getPlotTim();
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }
    public function getTimMarketing()
    {
        $data = $this->Supplier_model->getTimMarketing();
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }
    public function getLeadByIdTim()
    {
        $id_tim = $this->input->get('id_tim');
        $data = $this->Supplier_model->getDataLeadByIdTim($id_tim);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }
    public function getTimMarketingByIdSupplier()
    {
        $data = $this->Supplier_model->getTimBySupplierId($_COOKIE['id_pengguna']);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function getTimMarketingById($id)
    {
        $data = $this->Supplier_model->getTimMarketingById($id);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function addTimMarketing()
    {
        $data = [
            'nama_tim' => $this->input->post('nama_tim'),
            'posisi' => $this->input->post('posisi'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
        ];

        // $this->db->insert('tim_marketing', $data);
        $data = $this->Supplier_model->createTimMarketing($data);

        $response = array(
            'Data' => $data,
            'Success' => true,
            'Info' => 'Tim marketing berhasil ditambahkan.',
        );

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function table_data()
    {
        $search = [
            // 'keyword' => trim($this->input->post('search_key')),
            'lpse' => trim($this->input->post('lpse')),
            // 'tahun' => trim($this->input->post('tahun')),
        ];
        $orderby = $this->input->post('orderby');
        // $id_pengguna = $this->session->user_data['id_pengguna'];
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

            return $this->Supplier_model->getTabelDefault($datatable, $search, $orderby);
            // var_dump($this->Tender_model->getTabelDefault($datatable));
        }
    }

    public function getdata_bylpse()
    {
        $search = [
            'lpse' => trim($this->input->post('lpse')),
            // 'tahun' => trim($this->input->post('tahun')),
        ];
        // var_dump($search);
        // die;
        $totaltender = $this->Supplier_model->getPemenangTotal($search);
        $totaldata = [];
        foreach ($totaltender as $t) {
            $totaldata[0] = (int) $t['totalall'];
            $totaldata[1] = (int) $t['aktif'];
            $totaldata[2] = (int) $t['today'];
            $totaldata[3] = (int) $t['kat_1'];
            $totaldata[4] = (int) $t['kat_2'];
            $totaldata[5] = (int) $t['kat_3'];
            $totaldata[6] = (int) $t['kat_4'];
            $totaldata[7] = (int) $t['kat_5'];
            $totaldata[8] = (int) $t['total'];
        }
?>
        <p class="d-none" id="chart1"><?php echo json_encode($totaldata) ?></p>
<?php
    }

    //     public function fetch()
    //     {
    //         // $limit = 10;
    //         // $start = 0;
    //         $output = '';
    //         $this->load->model('Pemenang_model');
    //         // $coba = $this->Pemenang_model->getdata($limit, $start);
    //         // foreach ($coba->result() as $row) {
    //         //     var_dump($row);
    //         // }
    //         // die;
    //         // $data = $this->Pemenang_model->getAllPemenangbyIdTahapan();
    //         $data = $this->Pemenang_model->getdata($this->input->post('limit'), $this->input->post('start'));
    //         if ($data->num_rows() > 0) {
    //             foreach ($data->result() as $row) {
    //                 $hps = number_format($row->nilai_hps, 0, ",", ".");
    //                 $output .= '
    // 					<tr class="post_data">
    //                         <td class="col-lg-1 text-center col-kode text1 mx-1">' . $row->id_pemenang . '</td>
    //                         <td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; " class="col-lg-2 col-nama mx-1"><a href="#" type="button" class="text2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id_pemenang . '">' . $row->nama_peserta . '</a>
    //                         <!-- Modal -->
    //                         <div class="modal fade showProfile" id="exampleModal' . $row->id_pemenang . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    //                             <div class="modal-dialog modal-dialog-centered">
    //                                 <div class="modal-content">
    //                                     <div class="modal-header">
    //                                         <img style="width: 100%;" src="' . base_url("assets/img/background_modal.png") . '" alt="">
    //                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    //                                     </div>
    //                                     <div class="modal-body">
    //                                         <div class="border_img">
    //                                             <img style="width: 110px; height: 110px; " src="' . base_url("assets/img/profile_popup.png") . '" alt="">
    //                                         </div>
    //                                         <div class="container text_nama mt-5 pt-1">
    //                                             <h3>' . $row->nama_peserta . '</h3>
    //                                             <p>' . $row->alamat . '</p>
    //                                             <div class="d-flex justify-content-center text-center">
    //                                                 <div class="col-lg m-2 chart-bg">
    //                                                     <h4>' . $row->ikut . '</h4>
    //                                                     <p class="description">Ikut Tender</p>
    //                                                 </div>
    //                                                 <div class="col-lg m-2 chart-bg">
    //                                                     <h4>' . $row->menang . '</h4>
    //                                                     <p class="description">Menang</p>
    //                                                 </div>
    //                                                 <div class="col-lg m-2 chart-bg">
    //                                                     <h4>' . $row->kalah . '</h4>
    //                                                     <p class="description">Kalah</p>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="d-flex p-2 text_detail">
    //                                                 <div class="col-lg">
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="material-symbols:call" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>Nomor Telpon</h3>
    //                                                             <p>' . $row->no_telp . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="mdi:email" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>Email</h3>
    //                                                             <p>' . $row->email . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                 </div>
    //                                                 <div class="col-lg">
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="material-symbols:assignment" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>NPWP</h3>
    //                                                             <p>' . $row->npwp . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="material-symbols:location-on" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>Alamat</h3>
    //                                                             <p>' . $row->alamat . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                 </div>
    //                                             </div>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                         </td>
    //                         <td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; " class="col-lg-4 col-jenis text3 mx-1">' . $row->nama_tender . '</td>
    //                         <td class="col-lg-2 col-klpd text4 mx-1"> Rp. ' . $hps . '</td>
    //                         <td class="col-lg-2 text-center col-klpd text2 mx-1">' . date('d M Y', strtotime($row->tgl_mulai)) . '</td>
    //                     </tr>

    // 				';
    //             }
    //         } else {
    //
    //             <tr class="text-center">
    //                 <td class="text-center" colspan="4">Data Tidak Ada</td>
    //             </tr> -->
    //             <?php
    //         }
    //         echo $output;
    //     }

    //     public function fetch_id()
    //     {
    //         $output = '';
    //         $data = $this->input->post();
    //         // var_dump($this->input->post('id'));
    //         if ($data != NULL) {
    //             $data = $this->Pemenang_model->getdata_id($this->input->post('limit'), $this->input->post('start'), $this->input->post('id'));
    //             if ($data->num_rows() > 0) {
    //                 foreach ($data->result() as $row) {
    //                     $hps = number_format($row->nilai_hps, 0, ",", ".");
    //                     $output .= '
    // 					<tr class="post_data">
    //                         <td class="col-lg-1 text-center col-kode text1 mx-1">' . $row->id_pemenang . '</td>
    //                         <td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; " class="col-lg-2 col-nama mx-1"><a href="#" type="button" class="text2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id_pemenang . '">' . $row->nama_peserta . '</a>
    //                         <!-- Modal -->
    //                         <div class="modal fade showProfile" id="exampleModal' . $row->id_pemenang . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    //                             <div class="modal-dialog modal-dialog-centered">
    //                                 <div class="modal-content">
    //                                     <div class="modal-header">
    //                                         <img style="width: 100%;" src="' . base_url("assets/img/background_modal.png") . '" alt="">
    //                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    //                                     </div>
    //                                     <div class="modal-body">
    //                                         <div class="border_img">
    //                                             <img style="width: 110px; height: 110px; " src="' . base_url("assets/img/profile_popup.png") . '" alt="">
    //                                         </div>
    //                                         <div class="container text_nama mt-5 pt-1">
    //                                             <h3>' . $row->nama_peserta . '</h3>
    //                                             <p>' . $row->alamat . '</p>
    //                                             <div class="d-flex justify-content-center text-center">
    //                                                 <div class="col-lg m-2 chart-bg">
    //                                                     <h4>' . $row->ikut . '</h4>
    //                                                     <p class="description">Ikut Tender</p>
    //                                                 </div>
    //                                                 <div class="col-lg m-2 chart-bg">
    //                                                     <h4>' . $row->menang . '</h4>
    //                                                     <p class="description">Menang</p>
    //                                                 </div>
    //                                                 <div class="col-lg m-2 chart-bg">
    //                                                     <h4>' . $row->kalah . '</h4>
    //                                                     <p class="description">Kalah</p>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="d-flex p-2 text_detail">
    //                                                 <div class="col-lg">
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="material-symbols:call" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>Nomor Telpon</h3>
    //                                                             <p>' . $row->no_telp . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="mdi:email" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>Email</h3>
    //                                                             <p>' . $row->email . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                 </div>
    //                                                 <div class="col-lg">
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="material-symbols:assignment" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>NPWP</h3>
    //                                                             <p>' . $row->npwp . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                     <div class="d-flex p-2">
    //                                                         <div class="p-2 align-self-center">
    //                                                             <iconify-icon inline icon="material-symbols:location-on" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
    //                                                         </div>
    //                                                         <div>
    //                                                             <h3>Alamat</h3>
    //                                                             <p>' . $row->alamat . '</p>
    //                                                         </div>
    //                                                     </div>
    //                                                 </div>
    //                                             </div>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                         </td>
    //                         <td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; " class="col-lg-4 col-jenis text3 mx-1">' . $row->nama_tender . '</td>
    //                         <td class="col-lg-2 col-klpd text4 mx-1"> Rp. ' . $hps . '</td>
    //                         <td class="col-lg-2 text-center col-klpd text2 mx-1">' . date('d M Y', strtotime($row->tgl_mulai)) . '</td>
    //                     </tr>';
    //                 }
    //             } else {
    //
    //                 <tr class="text-center">
    //                     <td class="text-center" colspan="4">Data Tidak Ada</td>
    //                 </tr>
    //             <?php
    //             }
    //             echo $output;
    //         } else if ($data == null) {
    //
    //             <tr class="text-center">
    //                 <td class="text-center" colspan="4">Data Tidak Ada</td>
    //             </tr> -->
    // <?php
    //         }
    //     }


    public function getJumTender()
    {
        $response = $this->Supplier_model->getJumTender()->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getListJenisTender()
    {
        $items = $this->Supplier_model->getListJenisTender();
        echo json_encode($items);
    }
}
