<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Supplier_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => base_url('api/'),
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    public function getPemenangTotal($search, int $pageSize = 20, int $pageNumber = 0)
    {
        // 1. Jumlah tender
        $this->db->select('COUNT(kode_tender)');
        $this->db->from('paket');
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        // $this->db->where('npwp', $npwp, null, false);
        $totalall = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_pemenang)');
        // $this->db->from('supplier_jadwal');
        // $total_sub = $this->db->get_compiled_select();

        // 2. Jumlah peserta tender
        $this->db->select("COUNT(peserta_tender.`kode_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("paket", "paket.`kode_tender` = peserta_tender.`kode_tender`");
        $this->db->where("peserta_tender.harga_penawaran != 0", null, false);
        $this->db->where("paket.status_tender NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')", null, false);
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("paket.id_lpse = '$lpse'");
            }
        }
        $aktif = $this->db->get_compiled_select();

        // 3. Jumlah tender by tanggal pembuatan
        $this->db->select('COUNT(kode_tender)');
        $this->db->from('paket');
        $this->db->where('tanggal_pembuatan = CURDATE()');
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $total_today = $this->db->get_compiled_select();

        // $this->db->select('COUNT(DATEDIFF(CURDATE(),tgl_mulai))');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('DATEDIFF(CURDATE(),tgl_mulai) = 0');
        // $total_today = $this->db->get_compiled_select();

        // 4. Jumlah jenis pengadaan 4
        $this->db->select("COUNT(jenis_pengadaan)");
        $this->db->from("paket");
        $this->db->where("jenis_pengadaan = 4");
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $kat_1 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 4');
        // $kat_1 = $this->db->get_compiled_select();

        // 5. Jumlah jenis pengadaan 1
        $this->db->select("COUNT(jenis_pengadaan)");
        $this->db->from("paket");
        $this->db->where("jenis_pengadaan = 1");
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $kat_2 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 1');
        // $kat_2 = $this->db->get_compiled_select();

        // 6. Jumlah jenis pengadaan 7
        $this->db->select("COUNT(jenis_pengadaan)");
        $this->db->from("paket");
        $this->db->where("jenis_pengadaan = 7");
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $kat_3 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 7');
        // $kat_3 = $this->db->get_compiled_select();

        // 7. Jumlah jenis pengadaan 2
        $this->db->select("COUNT(jenis_pengadaan)");
        $this->db->from("paket");
        $this->db->where("jenis_pengadaan = 2");
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $kat_4 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 2');
        // $kat_4 = $this->db->get_compiled_select();

        // 8. Jumlah jenis pengadaan 3
        $this->db->select("COUNT(jenis_pengadaan)");
        $this->db->from("paket");
        $this->db->where("jenis_pengadaan = 3");
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $kat_5 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 3');
        // $kat_5 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = ');
        // $kat_6 = $this->db->get_compiled_select();

        // $this->db->select('*');
        $this->db->select("($totalall) as totalall");
        // $this->db->select("($total_sub) as total_sub");
        $this->db->select("($total_today) as today");
        $this->db->select("($aktif) as aktif");
        $this->db->select("($kat_1) as kat_1");
        $this->db->select("($kat_2) as kat_2");
        $this->db->select("($kat_3) as kat_3");
        $this->db->select("($kat_4) as kat_4");
        $this->db->select("($kat_5) as kat_5");
        // $this->db->select("($kat_1) as kat_1");
        $this->db->select('COUNT(id_pemenang) AS total');
        $this->db->from('pemenang');
        $this->db->join('paket', 'paket.kode_tender = pemenang.kode_tender');
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("paket.id_lpse = '$lpse'");
            }
        }
        $this->db->limit($pageSize, $pageNumber);
        // $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        // $this->db->where('peserta_tender.npwp', $npwp);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTabelDefault($datatable, $search, $orderby)
    {
        $this->db->select('*');
        $this->db->from('supplier_list');
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        if ($orderby != null) {
            if ($orderby === "urut1") {
                $this->db->order_by('supplier_list.nilai_hps', 'asc');
            } elseif ($orderby === "urut2") {
                $this->db->order_by('supplier_list.nilai_hps', 'desc');
            } else {
                $this->db->order_by('supplier_list.nilai_hps');
            }
        }
        $supplier = $this->db->get_compiled_select();
        $data = $this->db->query($supplier);
        $total_filter = $data->num_rows();
        // var_dump($total_filter);
        $data->free_result();
        $start = $datatable['start'];
        $length = $datatable['length'];
        if ($length != -1) {
            $supplier .= " LIMIT {$start}, {$length}";
        }
        $data = $this->db->query($supplier);
        $option['draw'] = $datatable['draw'];
        $option['recordsTotal'] = $total_filter;
        $option['recordsFiltered'] = $total_filter;
        $option['data'] = [];
        $n = 1;
        // $n++;
        foreach ($data->result() as $row) {
            // var_dump($row);
            $data = [];
            $data[] = '<div class="text-center col-kode text1 mx-1">' . $n++ . '</div>';
            $data[] = '<div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; " class="col-nama mx-1"><a href="#" type="button" class="text2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id_pemenang . '">' . $row->nama_peserta . '</a>
            <!-- Modal -->
            <div class="modal fade showProfile" id="exampleModal' . $row->id_pemenang . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img style="width: 100%;" src="' . base_url("assets/img/background_modal.png") . '" alt="">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="border_img">
                                <img style="width: 110px; height: 110px; " src="' . base_url("assets/img/profile_popup.png") . '" alt="">
                            </div>
                            <div class="container text_nama mt-5 pt-1">
                                <h3>' . $row->nama_peserta . '</h3>
                                <p>' . $row->alamat . '</p>
                                <div class="d-flex justify-content-center text-center">
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->ikut . '</h4>
                                        <p class="description">Ikut Tender</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->menang . '</h4>
                                        <p class="description">Menang</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->kalah . '</h4>
                                        <p class="description">Kalah</p>
                                    </div>
                                </div>
                                <div class="d-flex p-2 text_detail">
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:call" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Nomor Telpon</h3>
                                                <p>' . $row->no_telp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="mdi:email" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Email</h3>
                                                <p>' . $row->email . '</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:assignment" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>NPWP</h3>
                                                <p>' . $row->npwp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:location-on" style="color: #d21b1b;" height="20px" width="20px"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Alamat</h3>
                                                <p>' . $row->alamat . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>';
            $data[] = '<div class="col-jenis text3 mx-1">' . $row->nama_tender . '</div>';
            $data[] = '<div class="col-klpd text4 mx-1"> Rp. ' . number_format($row->nilai_hps, 0, ",", ".") . '</div>';
            $data[] = '<div class="text-center col-klpd text2 mx-1">' . date('d F Y', strtotime($row->tgl_mulai)) . '</div>';
            $option['data'][] = $data;
        }
        // $n++;
        return print_r(json_encode($option));
    }

    public function getJumTender()
    {
        // $sql = "SELECT COUNT(kode_tender) AS jum_tender FROM tender_terbaru WHERE akhir_daftar>=CURRENT_TIMESTAMP";
        $sql = "SELECT COUNT(kode_tender) AS jum_tender FROM tender_terbaru";

        return $this->db->query($sql);
    }

    public function getListJenisTender(){
        $sql = "SELECT jenis_tender.jenis_tender, COUNT(id_pemenang) AS total_tender
        FROM pemenang, jenis_tender
        WHERE pemenang.jenis_tender = jenis_tender.id_jenis
        GROUP BY jenis_tender.jenis_tender";

        return $this->db->query($sql)->result();
    }

    public function isIdPemenangExists($id) {
        $query = $this->db->get_where('data_leads', array('id_pemenang' => $id));
        return $query->num_rows() > 0;
    }

    public function getDataLeads(){
        $sql = "SELECT data_leads.*,
        IFNULL(kontak_lead.nama, '') AS nama_kontak, 
               IFNULL(kontak_lead.posisi, '') AS posisi, 
               IFNULL(kontak_lead.no_telp, '') AS no_telp, 
               IFNULL(kontak_lead.email, '') AS email
        FROM data_leads
        LEFT JOIN (
            SELECT kontak_lead.*
            FROM kontak_lead
            INNER JOIN (
                SELECT id_lead, MIN(id_kontak) AS oldest
                FROM kontak_lead
                GROUP BY id_lead
            ) oldest_contacts ON kontak_lead.id_lead = oldest_contacts.id_lead
            AND kontak_lead.id_kontak = oldest_contacts.oldest
        ) kontak_lead ON data_leads.id_lead = kontak_lead.id_lead";

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function getDataLeadById($id)
    {
        $this->db->select('data_leads.*, pemenang.* ');
        $this->db->from('data_leads');
        $this->db->join('pemenang', 'data_leads.id_pemenang = pemenang.id_pemenang');
        $this->db->where('data_leads.id_lead', $id);

        $query = $this->db->get();
        return $query->row(); 
    }

    public function getKontakLeadById($id)
    {
        $this->db->select('*');
        $this->db->from('kontak_lead');
        $this->db->where('id_lead', $id);

        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function updateLeadData($id, $data) {
        $this->db->where('id_lead', $id);
        $this->db->update('data_leads', $data);
        return $this->db->affected_rows();
    }

    public function updateCompletedDataLead($id_lead, $completed) {
        $data = array('completed' => $completed);
        $this->db->where('id_lead', $id_lead);
        $this->db->update('data_leads', $data);
    }

    public function getTimMarketing()
    {
        $this->db->select(['*']);
        $this->db->from('tim_marketing');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTimMarketingbyId($id)
    {
        $this->db->select(['*']);
        $this->db->from('tim_marketing');
        $this->db->where('id_tim', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function createTimMarketing($data)
    {
        // $data = [
        //     'nama_tim' => $this->input->post('nama_tim', true),
        //     'posisi' => $this->input->post('posisi', true),
        //     'no_telp' => $this->input->post('no_telp', true),
        //     'email' => $this->input->post('email', true),
        //     'alamat' => $this->input->post('alamat', true), 
        // ];
        $this->db->insert('tim_marketing', $data);
        return $this->db->affected_rows();
    }
}
