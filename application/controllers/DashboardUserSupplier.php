<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
        $this->load->model('api/Supplier_api');
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
        // var_dump(api_url());
        // die;
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

    public function getJumDataLeads()
    {
        $response = $this->Supplier_model->getJumDataLeads()->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getDataLeads()
    {
        $page_size = $_GET['pageSize'];
        $page_number = ($_GET['pageNumber'] - 1) * $page_size;
        $response = $this->Supplier_model->getDataLeads($page_number, $page_size)->result();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function exportLeads()
    {
        // require_once __DIR__ . '...\vendor\autoload.php';
        require_once 'vendor\autoload.php';
        $spreadsheet = new Spreadsheet();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $activeSheet = $spreadsheet->getActiveSheet();


        // Buat sebuah variabel untuk menampung pengaturan style judul
        $style_title = [
            'font' => [
                'bold'  => true,
                'size'  => 15,
                'name'  => 'Calibri'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => 'FFFFFF',
                ],
            ], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border top dengan garis tipis
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'E05151',
                ],
                'endColor' => [
                    'argb' => 'E05151',
                ],
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row_center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row_left = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        //judul
        // $title = $tipe == 1 ? 'Rekap Pelatihan ' . $bulan[date('n')] . ' Tahun ' . date('Y') : 'Rekap Pelatihan Tahun ' . date('Y');
        // $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:N2'); // Set Merge Cell pada kolom A1 sampai F1
        // $activeSheet->getStyle('A2')->applyFromArray($style_title);

        $activeSheet->setCellValue('A4', 'No');
        $activeSheet->setCellValue('B4', 'Nama Perusahaan');
        $activeSheet->setCellValue('C4', 'NPWP');;
        $activeSheet->setCellValue('D4', 'Nama Kontak');
        $activeSheet->setCellValue('E4', 'Posisi');
        $activeSheet->setCellValue('F4', 'Email');
        $activeSheet->setCellValue('G4', 'No Telp/WA');
        $activeSheet->setCellValue('H4', 'Alamat');



        for ($i = 4; $i <= 4; $i++) {
            $activeSheet->getStyle('A' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('B' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('C' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('D' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('E' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('F' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('G' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('H' . $i)->applyFromArray($style_col);
        }

        // // DATA
        $data = $this->Supplier_model->getAllDataLeads()->result_array();
        $index = 5;
        $temp = "";
        $kontak_merged = [];
        foreach ($data as $key => $value) {
            var_dump($data);
            // die;

            $kontak = $this->Supplier_api->getContact($value['id_lead']);
            $kontak_merged[$key] = '';
            $activeSheet->setCellValue('A' . $index, $index - 4);
            $activeSheet->setCellValue('B' . $index, $value['nama_perusahaan']);
            $activeSheet->setCellValue('C' . $index, $value['npwp']);
            $activeSheet->setCellValue('D' . $index, '');
            $activeSheet->setCellValue('E' . $index, '');
            $activeSheet->setCellValue('F' . $index, '');
            $activeSheet->setCellValue('G' . $index, '');
            $activeSheet->setCellValue('H' . $index, $value['kabupaten'] . ', ' . $value['provinsi']);
            foreach ($kontak as $keyKontak => $valueKontak) {
                // var_dump($valueKontak['nama']);
                // die;
                $kontak_merged[$key] = $kontak_merged[$key] . $valueKontak['nama'];
            }
            var_dump($kontak_merged);
            die;
        }
        var_dump($kontak_merged);
        die;
        // foreach ($data as $dt => $value) {
        //     // DATA BEST
        //     $dataBest = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id'] . ''));

        //     $activeSheet->setCellValue('A' . $index, $index - 5);
        //     $activeSheet->setCellValue('B' . $index, $dataBest->courses[0]->fullname);
        //     $activeSheet->setCellValue('C' . $index, $dataBest->courses[0]->categoryname);
        //     $activeSheet->setCellValue('D' . $index, date('Y-m-d', strtotime($value['start_registration'])));
        //     $activeSheet->setCellValue('E' . $index, date('Y-m-d', strtotime($value['end_registration'])));
        //     $activeSheet->setCellValue('F' . $index, $this->toDMY($dataBest->courses[0]->startdate));
        //     $activeSheet->setCellValue('G' . $index, $this->toDMY($dataBest->courses[0]->enddate));
        //     $activeSheet->setCellValue('H' . $index, $value['batch']);
        //     $activeSheet->setCellValue('I' . $index, $value['target_participant']);
        //     $activeSheet->setCellValue('J' . $index, $value['place']);
        //     $activeSheet->setCellValue('K' . $index, $value['contact_person']);
        //     $activeSheet->setCellValue('L' . $index, $value['quota']);
        //     $activeSheet->setCellValue('M' . $index, $value['method']);
        //     $activeSheet->setCellValue('N' . $index, $value['source_funds']);

        //     $activeSheet->getStyle('A' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('B' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('C' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('D' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('E' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('F' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('G' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('H' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('I' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('J' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('K' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('L' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('M' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('N' . $index)->applyFromArray($style_row_center);
        //     $index++;
        // }

        //mengatur warptext disetiap kolom
        foreach (range('A', $activeSheet->getHighestDataColumn()) as $col) {
            $activeSheet->getStyle($col)->getAlignment()->setWrapText(true);
        }

        //mengatur weight pada cell
        $activeSheet->getColumnDimension('B')->setWidth(25);
        $activeSheet->getColumnDimension('C')->setWidth(25);
        $activeSheet->getColumnDimension('D')->setWidth(25);
        $activeSheet->getColumnDimension('E')->setWidth(25);
        $activeSheet->getColumnDimension('F')->setWidth(25);
        $activeSheet->getColumnDimension('G')->setWidth(25);
        $activeSheet->getColumnDimension('H')->setWidth(50);
        // $activeSheet->getColumnDimension('I')->setWidth(20);
        // $activeSheet->getColumnDimension('J')->setWidth(25);
        // $activeSheet->getColumnDimension('K')->setWidth(25);
        // $activeSheet->getColumnDimension('L')->setWidth(15);
        // $activeSheet->getColumnDimension('M')->setWidth(15);
        // $activeSheet->getColumnDimension('N')->setWidth(15);
        $title = "test";
        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }

    public function getDataLeadsById($id)
    {
        $data = $this->Supplier_model->getDataLeadById($id);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function detailDataLead($id)
    {
        $data = [
            'title' => 'Dashboard'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('dashboard/supplier/detail_lead');
        $this->load->view('templates/footer');
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
        // if ($id_tim == 0) {
        //     $data = $this->Supplier_model->deletePlotTimByIdLead($id_lead);
        // } else {
        $data = $this->Supplier_model->insertUpdatePlotTim($id_lead, $id_tim);
        // }
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


    public function getDataLeadFilter()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $keyword = $this->input->get('key');
        $data = $this->Supplier_model->getDataLeadFilter($id_pengguna, $keyword);
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function getJumlahPemenangTender()
    {
        $response = $this->Supplier_model->getJumlahPemenangTender()->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }
    public function getJumlahPemenangTenderTerbaru()
    {
        $response = $this->Supplier_model->getJumlahPemenangTenderTerbaru()->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }
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
