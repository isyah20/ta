<?php

use Google\Service\CloudRun\Route;

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

//===========================================
// Home
//===========================================
$route['faq'] = 'home/faq';
$route['kebijakan_privasi'] = 'home/kebijakan_privasi';
$route['detail_artikel'] = 'home/detail_artikel';
$route['baca_artikel'] = 'home/baca_artikel';
$route['hubungi_kami'] = 'home/hubungi_kami';
$route['tentang_kami'] = 'home/tentang_kami';
$route['detail-tender/(:num)'] = 'home/detail_tender/$1';
$route['detail-pemenang/(:num)'] = 'home/detail_pemenang/$1';
$route['pricing_plan'] = 'home/pricing_plan';
$route['pembayaran'] = 'home/pembayaran';
$route['getFitur/(:any)'] = 'home/getFitur/$1';
$route['invoice'] = 'home/invoice';
$route['cek-promo/(:any)'] = 'Pembayaran/cekpromo/$1';
$route['bayartagihan'] = 'MidtransController/GenerateSnap';
$route['penggunaNpwp'] = 'Pembayaran/ceknpwp';
$route['updateProfil/(:num)'] = 'Pembayaran/updateProfil/$1';
$route['lanjutbayar'] = 'Pembayaran/create';
$route['payment/notification'] = 'Pembayaran/notification';
$route['payment/check-order/(:num)'] = 'Pembayaran/checkOrder/$1';
// $route['dashboard_user'] = 'home/dashboard_user';

//===========================================
// Auth
//===========================================
$route['blank'] = 'auth/register/blankPageMobile';
// Register
$route['register'] = 'auth/register';
$route['register/pengguna'] = 'auth/register/aksi_register';
$route['registerSso'] = 'auth/register/registerSso';
$route['newaccount'] = 'auth/register/newacc';

// verifikasi
$route['verify/(:any)'] = 'auth/register/verify/$1';
$route['verify-mobile/(:any)/(:any)'] = 'auth/register/verifyMobile/$1/$2';
$route['verify/pengguna/(:any)'] = 'auth/register/aksi_verify/$1';
$route['cekemail/verify'] = 'auth/register/cekEmail';
$route['send/verify/(:any)'] = 'auth/register/sendEmail/$1';
$route['lengkapi-profile'] = 'auth/register/lengkapi_profile';
$route['verify-wa'] = 'auth/register/verify_wa';

// Login
$route['login'] = 'auth/login';
$route['logout'] = 'auth/login/aksi_logout';
$route['login/pengguna'] = 'auth/login/aksi_login';
$route['api/login'] = 'api/ApiLogin';
$route['login/google'] = 'auth/login/aksiSso';

//Lupa Password
$route['lupa'] = 'auth/LupaPassword';
$route['lupa/sendemail'] = 'auth/LupaPassword/emailValidation';
$route['lupa/cekemail'] = 'auth/LupaPassword/cekEmail';
$route['lupa/ubah/(:any)'] = 'auth/LupaPassword/resetValidation/$1';
$route['lupa/ubah-mobile/(:any)'] = 'auth/LupaPassword/resetValidationMobile/$1';
$route['lupa/ubah/pass/(:any)'] = 'auth/LupaPassword/ubahPass/$1';

//===========================================
// User
//===========================================
//Dashboard
$route['user-dashboard/chart']['POST'] = 'DashboardUser/chart';

$route['user-dashboard'] = 'DashboardUser';
$route['user-dashboard/list-tender'] = 'DashboardUser/listTenderPage';
$route['suplier'] = 'DashboardUserSupplier';
$route['suplier/test-crm'] = 'DashboardUserSupplier/testCRM';
$route['suplier/leads'] = 'DashboardUserSupplier/dataLeads';
$route['suplier/getleads/(:num)'] = 'DashboardUserSupplier/getDataLeadsById/$1';
$route['suplier/getleads'] = 'DashboardUserSupplier/getDataLeads';
$route['api/getleads'] = 'DashboardUserSupplier/getDataLeads';
$route['api/getJumDataLeads'] = 'DashboardUserSupplier/getJumDataLeads';

$route['suplier/getKontak/(:num)'] = 'DashboardUserSupplier/getKontakLeadById/$1';
$route['suplier/getKontakNama/(:any)'] = 'DashboardUserSupplier/getKontakLeadByNama/$1';
$route['suplier/leads/(:num)'] = 'DashboardUserSupplier/detailDataLead/$1';
$route['suplier/crm'] = 'DashboardUserSupplier/CRM';
$route['suplier/marketing'] = 'DashboardUserSupplier/marketing';
$route['suplier/statistik'] = 'DashboardUserSupplier/datastatistik';
$route['marketing'] = 'DashboardUserMarketing';
$route['api/supplier/lead/filter'] = 'DashboardUserSupplier/getDataLeadFilter';
$route['api/supplier/jumlah-pemenang'] = 'DashboardUserSupplier/getJumlahPemenangTender';
$route['api/supplier/jumlah-pemenang-terbaru'] = 'DashboardUserSupplier/getJumlahPemenangTenderTerbaru';
$route['api/supplier/tim'] = 'DashboardUserSupplier/getTimMarketing';
$route['api/supplier/plot-tim'] = 'DashboardUserSupplier/getPlotTim';
$route['api/supplier/tim-suplier'] = 'DashboardUserSupplier/getTimMarketingByIdSupplier';
$route['api/supplier/lead/tim'] = 'DashboardUserSupplier/getLeadByIdTim';
$route['api/supplier/tim/add'] = 'DashboardUserSupplier/addTimMarketing';
$route['api/supplier/tim/delete/(:num)'] = 'DashboardUserSupplier/deleteTimMarketing/$1';
$route['index_table'] = 'DashboardUserSupplier/index_table';
$route['index_table/(:num)'] = 'DashboardUserSupplier/index_table$1';
$route['asosiasi'] = 'DashboardUserAsosiasi';
$route['asosiasi/(:num)'] = 'DashboardUserAsosiasi/$1';
$route['index_ajax'] = 'DashboardUserAsosiasi/index_ajax';
$route['index_ajax/(:num)'] = 'DashboardUserAsosiasi/index_ajax/$1';
$route['table_ajax'] = 'DashboardUserAsosiasi/table_ajax';
$route['table_ajax/(:num)'] = 'DashboardUserAsosiasi/table_ajax/$1';
$route['chart_dinamis'] = 'DashboardUserAsosiasi/chart_dinamis';
$route['chart_dinamis/(:num)'] = 'DashboardUserAsosiasi/chart_dinamis/$1';
$route['blacklist_selesai'] = 'DashboardUserAsosiasi/blacklist_selesai';
$route['blacklist_selesai/(:num)'] = 'DashboardUserAsosiasi/blacklist_selesai/$1';
$route['add/anggota'] = 'DashboardUserAsosiasi/create';
$route['remove/anggota/(:num)'] = 'DashboardUserAsosiasi/destroy/$1';

//Competitor
$route['competitor'] = 'Competitor';
$route['api/getSummaryMenang'] = 'Competitor/getSummaryMenang';
$route['api/getSummaryIkutTender'] = 'Competitor/getSummaryIkutTender';
$route['api/getSummaryIkutTenderHPS'] = 'Competitor/getSummaryIkutTenderHPS';
$route['api/getTabelPenawaranTerendah'] = 'Competitor/getTabelPenawaranTerendah';
$route['api/getRataPenawaranTerendah'] = 'Competitor/getRataPenawaranTerendah';
$route['api/getTawaranRendah'] = 'Competitor/getTawaranRendah';

//Market
$route['market'] = 'Market';
$route['api/getListWilayah'] = 'Market/getListWilayah';

//Tender
$route['api/getAllTender'] = 'Tender/getAllTender';
$route['api/getAllTender22'] = 'Tender/getAllTender22';
$route['api/getAllTender21'] = 'Tender/getAllTender21';
$route['api/getAllTender20'] = 'Tender/getAllTender20';
$route['api/getAllTender19'] = 'Tender/getAllTender19';
$route['api/getAllTender18'] = 'Tender/getAllTender18';
$route['api/getAllTender17'] = 'Tender/getAllTender17';
$route['api/getAllTender16'] = 'Tender/getAllTender16';
$route['api/getAllTender15'] = 'Tender/getAllTender15';
$route['api/getAllTender14'] = 'Tender/getAllTender14';
$route['api/getAllTender13'] = 'Tender/getAllTender13';
$route['api/getAllTender12'] = 'Tender/getAllTender12';
$route['api/getAllTender11'] = 'Tender/getAllTender11';
$route['api/getAllTender10'] = 'Tender/getAllTender10';
$route['api/getAllTender9'] = 'Tender/getAllTender9';
$route['api/getAllTender8'] = 'Tender/getAllTender8';
$route['api/getAllTender7'] = 'Tender/getAllTender7';
$route['api/getAllTender6'] = 'Tender/getAllTender6';
$route['api/getAllTender5'] = 'Tender/getAllTender5';
$route['api/getAllTender4'] = 'Tender/getAllTender4';
$route['api/getAllTender3'] = 'Tender/getAllTender3';
$route['api/getAllTender2'] = 'Tender/getAllTender2';
$route['api/getAllTender1'] = 'Tender/getAllTender1';
$route['api/getAllTender0'] = 'Tender/getAllTender0';
$route['api/getTenderTerbaru'] = 'Tender/getTenderTerbaru';
$route['api/getLokasiTenderTerbaru'] = 'Tender/getLokasiTenderTerbaru';
$route['api/getPaketTender'] = 'Tender/getPaketTender';
$route['api/getPaketTender22'] = 'Tender/getPaketTender22';
$route['api/getPaketTender21'] = 'Tender/getPaketTender21';
$route['api/getPaketTender20'] = 'Tender/getPaketTender20';
$route['api/getPaketTender19'] = 'Tender/getPaketTender19';
$route['api/getPaketTender18'] = 'Tender/getPaketTender18';
$route['api/getPaketTender17'] = 'Tender/getPaketTender17';
$route['api/getPaketTender16'] = 'Tender/getPaketTender16';
$route['api/getPaketTender15'] = 'Tender/getPaketTender15';
$route['api/getPaketTender14'] = 'Tender/getPaketTender14';
$route['api/getPaketTender13'] = 'Tender/getPaketTender13';
$route['api/getPaketTender12'] = 'Tender/getPaketTender12';
$route['api/getPaketTender11'] = 'Tender/getPaketTender11';
$route['api/getPaketTender10'] = 'Tender/getPaketTender10';
$route['api/getPaketTender9'] = 'Tender/getPaketTender9';
$route['api/getPaketTender8'] = 'Tender/getPaketTender8';
$route['api/getPaketTender7'] = 'Tender/getPaketTender7';
$route['api/getPaketTender6'] = 'Tender/getPaketTender6';
$route['api/getPaketTender5'] = 'Tender/getPaketTender5';
$route['api/getPaketTender4'] = 'Tender/getPaketTender4';
$route['api/getPaketTender3'] = 'Tender/getPaketTender3';
$route['api/getPaketTender2'] = 'Tender/getPaketTender2';
$route['api/getPaketTender1'] = 'Tender/getPaketTender1';
$route['api/getPaketTender0'] = 'Tender/getPaketTender0';
$route['api/getPengumumanTender'] = 'Tender/getPengumumanTender';
$route['api/getJadwalTender'] = 'Tender/getJadwalTender';
$route['api/getPesertaTender'] = 'Tender/getPesertaTender';
$route['api/getEvaluasiTender'] = 'Tender/getEvaluasiTender';
$route['api/getPemenangTender'] = 'Tender/getPemenangTender';
$route['api/getTenderPemenang'] = 'Tender/getTenderPemenang';
$route['api/getProfilPeserta'] = 'Tender/getProfilPeserta';
$route['api/kirimTenderTerbaru'] = 'Tender/kirimTenderTerbaru';
$route['api/kirimTenderTerbaruByPengguna/(:num)'] = 'Tender/kirimTenderTerbaruByPengguna/$1';
$route['api/kirimPemenangTerbaru'] = 'Tender/kirimPemenangTerbaru';
$route['api/kirimPemenangTerbaruByPengguna/(:num)'] = 'Tender/kirimPemenangTerbaruByPengguna/$1';
$route['api/getKatalogTenderTerbaru'] = 'Tender/getKatalogTenderTerbaru';
$route['api/getKatalogTenderTerbaruByPengguna/(:num)/(:num)'] = 'Tender/getKatalogTenderTerbaruByPengguna/$1/$2';
$route['api/getKatalogTenderTerbaruByPengguna1'] = 'Tender/getKatalogTenderTerbaruByPengguna1';
$route['api/getKatalogPemenangTerbaruByPengguna/(:num)/(:num)'] = 'Tender/getKatalogPemenangTerbaruByPengguna/$1/$2';
$route['api/getKatalogPemenangTerbaruByPengguna1'] = 'Tender/getKatalogPemenangTerbaruByPengguna1';
$route['api/getJumKatalogTenderTerbaru'] = 'Tender/getJumKatalogTenderTerbaru';
$route['api/getJumKatalogTenderTerbaruByPengguna/(:num)'] = 'Tender/getJumKatalogTenderTerbaruByPengguna/$1';
$route['api/getJumKatalogTenderTerbaruByPengguna1'] = 'Tender/getJumKatalogTenderTerbaruByPengguna1';
$route['api/getJumKatalogTenderTerbaruByPengguna/(:num)/(:num)'] = 'Tender/getJumKatalogTenderTerbaruByPengguna/$1/$2';
$route['api/getJumKatalogPemenangTerbaruByPengguna/(:num)'] = 'Tender/getJumKatalogPemenangTerbaruByPengguna/$1';
$route['api/getJumKatalogPemenangTerbaruByPengguna1'] = 'Tender/getJumKatalogPemenangTerbaruByPengguna1';
$route['api/getListLokasiPekerjaan'] = 'api/ApiTender/getListLokasiPekerjaan';
// $route['api/getListLokasiPekerjaan'] = 'Tender/getListLokasiPekerjaan';
$route['api/getListJenisPengadaan'] = 'Tender/getListJenisPengadaan';
// $route['tender/(:num)'] = 'Tender/index/$1';
// $route['open-link'] = 'Tender/openLink';
// $route['tender/list-newest-tender'] = 'Tender/listNewestTender';

// Profile
$route['profile'] = 'profilePengguna';
$route['profile/edit'] = 'profilePengguna/edit';
$route['profile/ubah'] = 'profilePengguna/ubah';
$route['profile/ubah_foto'] = 'profilePengguna/ubah_foto';
$route['update_npwp/(:num)'] = 'DashboardUser/update/$1';
$route['apiRajaOngkir/(:num)'] = 'auth/Register/apiRajaOngkirKabupaten/$1';
$route['getcity/(:num)'] = 'auth/Register/getCities/$1';
$route['getprovince'] = 'auth/Register/getProvince';
$route['api/ubahProfil'] = 'profilePengguna/ubahProfil';
$route['api/getWilayahByName/(:any)'] = 'profilePengguna/getWilayahByName/$1';
$route['api/getListProvinsi'] = 'profilePengguna/getListProvinsi';
$route['api/getListKabupaten'] = 'profilePengguna/getListKabupaten';
$route['api/getProfilPengguna/(:num)'] = 'User/getProfilPengguna/$1';
$route['api/getVerifikasiWA/(:num)'] = 'User/getVerifikasiWA/$1';
$route['api/kirimOTP'] = 'User/kirimOTP';
$route['api/verifyWA'] = 'User/verifyWA';
$route['api/expiredTrial'] = 'User/expiredTrial';

// Preferensi
$route['preferensi'] = 'Preferensi';
$route['api/getPreferensiPengguna/(:num)'] = 'Preferensi/getPreferensiPengguna/$1';
$route['api/getPreferensiListJenisTender/(:num)'] = 'Preferensi/getPreferensiListJenisTender/$1';
$route['api/getPreferensiJenisTender/(:num)'] = 'Preferensi/getPreferensiJenisTender/$1';
$route['api/getPreferensiListLPSE'] = 'Preferensi/getPreferensiListLPSE';
$route['api/simpanPreferensi'] = 'Preferensi/simpanPreferensi';
/*$route['monitoring'] = 'Preferensi/preferensi_notif';
$route['monitoring/(:num)'] = 'Preferensi/hapus_pref/$1';
$route['monitoring/tender'] = 'Preferensi';
$route['selectkateg/(:num)'] = 'Preferensi/selectkateg/$1';*/

//===========================================
// Admin
//===========================================
//Kelola Pengguna
$route['pengguna'] = 'admin/pengguna';
$route['pengguna/create'] = 'admin/pengguna/create';
$route['pengguna/update/(:num)'] = 'admin/pengguna/update/$1';
$route['pengguna/destroy/(:num)'] = 'admin/pengguna/destroy/$1';
$route['pengguna/get-token'] = 'admin/pengguna/getToken';

//Kelola Peserta
$route['peserta'] = 'admin/peserta';
$route['peserta/create'] = 'admin/peserta/create';
$route['peserta/update/(:num)'] = 'admin/peserta/update/$1';
$route['peserta/destroy/(:num)'] = 'admin/peserta/destroy/$1';

//Kelola Wilayah
$route['wilayah'] = 'admin/Wilayah';
$route['wilayah/create'] = 'admin/Wilayah/create';
$route['wilayah/update/(:num)'] = 'admin/Wilayah/update/$1';
$route['wilayah/destroy/(:num)'] = 'admin/Wilayah/destroy/$1';

//Kelola Tahapan
$route['tahapan'] = 'admin/Tahapan';
$route['tahapan/create'] = 'admin/Tahapan/create';
$route['tahapan/update/(:num)'] = 'admin/Tahapan/update/$1';
$route['tahapan/destroy/(:num)'] = 'admin/Tahapan/destroy/$1';

//Kelola Kategori LPSE
$route['kategori-lpse'] = 'admin/KategoriLpse';
$route['kategori-lpse/create'] = 'admin/KategoriLpse/create';
$route['kategori-lpse/update/(:num)'] = 'admin/KategoriLpse/update/$1';
$route['kategori-lpse/destroy/(:num)'] = 'admin/KategoriLpse/destroy/$1';

//Kelola Jenis Tender
$route['jenis-tender'] = 'admin/JenisTender';
$route['jenis-tender/create'] = 'admin/JenisTender/create';
$route['jenis-tender/update/(:num)'] = 'admin/JenisTender/update/$1';
$route['jenis-tender/destroy/(:num)'] = 'admin/JenisTender/destroy/$1';

//Kelola Jenis Jadwal
$route['jadwal'] = 'admin/Jadwal';
$route['jadwal/create'] = 'admin/Jadwal/create';
$route['jadwal/update/(:num)'] = 'admin/Jadwal/update/$1';
$route['jadwal/destroy/(:num)'] = 'admin/Jadwal/destroy/$1';

//Kelola Perubahan Jadwal
$route['perubahan-jadwal/(:num)'] = 'admin/PerubahanJadwal/getPerubahan/$1';
$route['perubahan-jadwal/create/(:num)'] = 'admin/PerubahanJadwal/create/$1';

//Kelola Tender
$route['tender/getData'] = 'admin/Tender/getData';
$route['lpse/getData'] = 'admin/Lpse/getData';
$route['tender'] = 'admin/Tender';
$route['tender/create'] = 'admin/Tender/create';
$route['tender/update/(:num)'] = 'admin/Tender/update/$1';
$route['tender/destroy/(:num)'] = 'admin/Tender/destroy/$1';
// $route['tender/peserta_tender'] = 'Tender/scrapping_tender';

//Kelola LPSE
$route['lpse'] = 'admin/Lpse';
$route['lpse/create'] = 'admin/Lpse/create';
$route['lpse/update/(:num)'] = 'admin/Lpse/update/$1';
$route['lpse/destroy/(:num)'] = 'admin/Lpse/destroy/$1';

//Hasil Evaluasi
$route['hasil_evaluasi'] = 'admin/HasilEvaluasi';

//Kelola Pemenang
$route['pemenang'] = 'admin/Pemenang';
$route['pemenang/create'] = 'admin/Pemenang/create';
$route['pemenang/edit/(:num)'] = 'admin/Pemenang/edit/$1';
$route['pemenang/update/(:num)/(:num)'] = 'admin/Pemenang/update/$1/$1';
$route['pemenang/destroy/(:num)'] = 'admin/Pemenang/destroy/$1';

//Kelola Peserta Tender
$route['peserta-tender'] = 'admin/PesertaTender';
$route['peserta-tender/create'] = 'admin/PesertaTender/create';
$route['peserta-tender/edit/(:num)'] = 'admin/PesertaTender/edit/$1';
$route['peserta-tender/update/(:num)/(:num)'] = 'admin/PesertaTender/update/$1/$1';
$route['peserta-tender/destroy/(:num)'] = 'admin/PesertaTender/destroy/$1';

//Kelola Preferensi
$route['kelola-preferensi'] = 'admin/Preferensi';
$route['preferensi/create'] = 'admin/Preferensi/create';
$route['preferensi/edit/(:num)'] = 'admin/Preferensi/edit/$1';
$route['preferensi/update/(:num)/(:num)'] = 'admin/Preferensi/update/$1/$1';
$route['preferensi/destroy/(:num)'] = 'admin/Preferensi/destroy/$1';

//RUP
$route['rup'] = 'admin/Rup';
$route['rup/create'] = 'admin/Rup/create';
$route['rup/update/(:num)'] = 'admin/Rup/update/$1';
$route['rup/destroy/(:num)'] = 'admin/Rup/destroy/$1';

//Artikel
$route['artikel'] = 'admin/artikel';

//===========================================
// API
//===========================================

$route['api/statistikhome'] = 'api/ApiTender/getdatastatistik';

//restAPI route for Suplier 
$route['api/supplier/get'] = 'api/ApiSupplier';
$route['api/supplier/create'] = 'api/ApiSupplier/create';
$route['api/supplier/delete/(:num)'] = 'api/ApiSupplier/deleteTim/$1';
$route['api/supplier/update/(:num)'] = 'api/ApiSupplier/editTimMarketing/$1';
$route['api/supplier/getId/(:num)'] = 'api/ApiSupplier/getbyId/$1';
$route['api/supplier/getProfile/(:num)'] = 'api/ApiSupplier/getProfile/$1';
$route['api/supplier/insertProfile/(:num)'] = 'api/ApiSupplier/insertProfile/$1';
$route['api/supplier/getContact/(:num)'] = 'api/ApiSupplier/getContact/$1';
$route['api/supplier/getContactById/(:num)'] = 'api/ApiSupplier/getContactById/$1';
$route['api/supplier/insertContact'] = 'api/ApiSupplier/insertContact';
$route['api/supplier/updateContact/(:num)'] = 'api/ApiSupplier/updateContact/$1';
$route['api/supplier/deleteContact/(:num)'] = 'api/ApiSupplier/deleteContact/$1';
$route['api/supplier/getPemenangByNPWP/(:any)'] = 'api/ApiSupplier/getPemenangByNPWP/$1';
// $route['api/supplier/getPemenangFilter/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'api/ApiSupplier/getPemenangFilter/$1/$2/$3/$4/$5/$6';
// $route['api/supplier/getPemenangFilter'] = 'api/ApiSupplier/getPemenangFilter';
$route['api/supplier/getPemenangFilter'] = 'api/ApiSupplier/pemenangFiltered';

//restAPI route for DaftarHItam
$route['api/daftarhitambynpwp'] = 'api/ApiDaftarHitam/daftarhitambynpwp';

//restAPI route for ASOSIASI
$route['api/asosiasi'] = 'api/ApiAnggotaAsosiasi';
$route['api/asosiasibypengguna'] = 'api/ApiAnggotaAsosiasi/getdatadinamis';
$route['api/asosiasi/create'] = 'api/ApiAnggotaAsosiasi/create';
$route['api/asosiasi/destroy/(:num)'] = 'api/ApiAnggotaAsosiasi/destroy/$1';
// $route['api/asosiasifilter'] = 'api/ApiAnggotaAsosiasi/asosiasifilter';
// $route['api/asosiasifilterhps'] = 'api/ApiAnggotaAsosiasi/asosiasifilterhps';
// $route['api/testing_penurunan'] = 'api/ApiAnggotaAsosiasi/testing';
// $route['api/asosiasibylpse'] = 'api/ApiAnggotaAsosiasi/asosiasibylpse';

// restAPI route for pengguna
$route['api/pengguna'] = 'api/ApiPengguna/index';
$route['api/pengguna/(:num)'] = 'api/ApiPengguna/getId/$1';
$route['api/pengguna/email/(:any)'] = 'api/ApiPengguna/getEmail/$1';
$route['api/pengguna/create'] = 'api/ApiPengguna/create';
$route['api/pengguna/update/(:num)'] = 'api/ApiPengguna/update/$1';
$route['api/pengguna/delete/(:num)'] = 'api/ApiPengguna/destroy/$1';
$route['api/pengguna/change-password/(:num)'] = 'ProfilePengguna/changePassword/$1';
$route['api/pengguna/check-user-trial'] = 'api/ApiPengguna/checkAndUpdateUserType';

// restAPI route for verify
$route['api/verify/status/(:any)'] = 'api/ApiPengguna/verifyCheck/$1';
$route['api/verify/(:any)'] = 'api/ApiPengguna/verify/$1';
$route['api/verifySend'] = 'api/ApiPengguna/verifySend';

// fixed one (maybe)
$route['api/cekVerif'] = 'api/ApiPengguna/checkVerif/$1';
$route['api/verifikasi'] = 'api/ApiPengguna/verif/$1';

// restAPI Detail Tender
$route['api/detailtender'] = 'api/ApiDetailTender/index';
$route['api/detailtender/(:num)'] = 'api/ApiDetailTender/getId/$1';
// $route['api/detailtender/(:num)'] = 'api/ApiDetailTender/getDetailTenderById/$1';
$route['api/detailtender/create'] = 'api/ApiDetailTender/create';
$route['api/detailtender/update/(:num)'] = 'api/ApiDetailTender/update/$1';
$route['api/detailtender/delete/(:num)'] = 'api/ApiDetailTender/destroy/$1';

//restAPI Syarat Kualifikasi
$route['api/syaratkualifikasi/(:num)'] = 'api/ApiSyaratKualifikasi/getId/$1';

// restAPI route for Jadwal
$route['api/jadwal-origin'] = 'api/ApiJadwal/indexOrigin';
$route['api/jadwal'] = 'api/ApiJadwal/index';
$route['api/jadwal/(:num)'] = 'api/ApiJadwal/getId/$1';
$route['api/jadwal/tender/(:num)'] = 'api/ApiJadwal/getJadwalTender/$1';
$route['api/jadwal/perubahan/(:num)'] = 'api/ApiJadwal/getPerubahanJadwal/$1';
$route['api/jadwal/create'] = 'api/ApiJadwal/create';
$route['api/jadwal/update/(:num)'] = 'api/ApiJadwal/update/$1';
$route['api/jadwal/delete/(:num)'] = 'api/ApiJadwal/destroy/$1';

// restAPI route for LPSE
$route['api/lpse'] = 'api/ApiLpse/index';
$route['api/lpse/page'] = 'api/ApiLpse/lpseAll';
$route['api/lpse/page/(:num)'] = 'api/ApiLpse/lpseAll/$1';
$route['api/lpse/(:num)'] = 'api/ApiLpse/getId/$1';
$route['api/lpse/create'] = 'api/ApiLpse/create';
$route['api/lpse/namaNamaLpseById'] = 'api/ApiLpse/namaNamaLpseById';
$route['api/lpse/getLpseByWilKat'] = 'api/ApiLpse/getLpseByWilKat';
$route['api/lpse/getByIdWilayah/(:num)'] = 'api/ApiLpse/getByIdWilayah/$1';
$route['api/lpse/getlatong/(:num)'] = 'api/ApiLpse/getlatlong/$1';
$route['api/lpse/update/(:num)'] = 'api/ApiLpse/update/$1';
$route['api/lpse/delete/(:num)'] = 'api/ApiLpse/destroy/$1';

// restAPI route for Kategori LPSE
$route['api/kategorilpse'] = 'api/ApiKategoriLpse/index';
$route['api/kategorilpse/(:num)'] = 'api/ApiKategoriLpse/getId/$1';
$route['api/kategorilpse/create'] = 'api/ApiKategoriLpse/create';
$route['api/kategorilpse/namaNamaKategoriById'] = 'api/ApiKategoriLpse/namaNamaKategoriById';
$route['api/kategorilpse/update/(:num)'] = 'api/ApiKategoriLpse/update/$1';
$route['api/kategorilpse/delete/(:num)'] = 'api/ApiKategoriLpse/destroy/$1';

// restAPI route for Tahapan
$route['api/tahapan'] = 'api/ApiTahapan/index';
$route['api/tahapan/(:num)'] = 'api/ApiTahapan/getId/$1';
$route['api/tahapan/create'] = 'api/ApiTahapan/create';
$route['api/tahapan/update/(:num)'] = 'api/ApiTahapan/update/$1';
$route['api/tahapan/delete/(:num)'] = 'api/ApiTahapan/destroy/$1';

// restAPI route for daftarhitam
$route['api/daftarhitam'] = 'api/ApiDaftarHitam/index';
$route['api/daftarhitam/(:num)'] = 'api/ApiDaftarHitam/getId/$1';
$route['api/daftarhitam/create'] = 'api/ApiDaftarHitam/create';
$route['api/daftarhitam/update/(:num)'] = 'api/ApiDaftarHitam/update/$1';
$route['api/daftarhitam/delete/(:num)'] = 'api/ApiDaftarHitam/destroy/$1';
$route['api/jmldata_blacklist'] = 'api/ApiDaftarHitam/jmldatablacklist';

// restAPI route for tender
$route['api/tender'] = 'api/ApiTender/index';
$route['api/tender/page'] = 'api/ApiTender/tenderAll';  //pagination
$route['api/tender/page/(:num)'] = 'api/ApiTender/tenderAll/$1'; //pagination
$route['api/tender-limit'] = 'api/ApiTender/indexLim';
$route['api/tender-count'] = 'api/ApiTender/indexC';
$route['api/tender-default'] = 'api/ApiTender/default';
$route['api/tender-default-limit'] = 'api/ApiTender/defaultLim';
$route['api/tender-default-count'] = 'api/ApiTender/defaultC';
$route['api/tender/(:num)'] = 'api/ApiTender/getId/$1';
// $route['api/tender/cek-tender-baru'] = 'api/ApiTender/cekTenderBaru';
// $route['api/tender/notif-tender-baru'] = 'Tender/notifTenderBaru';
// $route['api/tender/preferensi-tender-baru'] = 'api/ApiTender/preferensiTenderBaru';
$route['api/tender/sp-notifikasi-tender-baru'] = 'api/ApiTender/spNotifikasiTenderBaru';
$route['api/tender/notifikasi-tender-baru'] = 'api/ApiTender/notifikasiTenderBaru';
$route['api/tender/notifikasi-tender-baru-by-keyword'] = 'api/ApiTender/notifikasiTenderBaruByKeyword';
$route['api/tender/notifikasi-tender-baru-dashboard-user'] = 'api/ApiTender/notifikasiTenderBaruDashboardUser';
$route['api/tender/notif'] = 'api/ApiTender/tenderNotif';
$route['api/tender/s'] = 'api/ApiTender/search';
$route['api/tender/s-limit'] = 'api/ApiTender/searchLim';
$route['api/tender/s-count'] = 'api/ApiTender/searchC';
$route['api/tender/s-forecastingTender'] = 'api/ApiTender/searchForecastingTender';
$route['api/tender/s-getHpsPerMonth'] = 'api/ApiTender/searchHpsPerMonth';
$route['api/tender/s-getSelesaiPerMonth'] = 'api/ApiTender/searchTenderSelesaiPerMonth';
$route['api/tender/s-getUlangPerMonth'] = 'api/ApiTender/searchTenderUlangPerMonth';
$route['api/tender/s-getGagalPerMonth'] = 'api/ApiTender/searchTenderGagalPerMonth';
$route['api/tender/create'] = 'api/ApiTender/create';
$route['api/tender/update/(:num)'] = 'api/ApiTender/update/$1';
$route['api/tender/delete/(:num)'] = 'api/ApiTender/destroy/$1';
$route['api/tender/list-newest-tender'] = 'api/ApiTender/getListNewestTender';
$route['api/tender/list-winner-tender/(:num)'] = 'api/ApiTender/listWinnerTender/$1';
// Tender suplier
$route['api/tender/count-total'] = 'api/ApiTenderSupplier/totalTender';
$route['api/tender/count-active'] = 'api/ApiTenderSupplier/totalTenderActive';
$route['api/tender/count-today'] = 'api/ApiTenderSupplier/totalTenderToday';
$route['api/tender/count-proctype'] = 'api/ApiTenderSupplier/totalTenderByProcurementType';
$route['api/tender/winner-tender-by-filters/(:num)'] = 'api/ApiTenderSupplier/getWinnerTenderByFilters/$1';

// restAPI route for peserta_tender
$route['api/pesertatender'] = 'api/ApiPesertaTender/index';
$route['api/pesertatender/(:num)'] = 'api/ApiPesertaTender/getId/$1';
$route['api/pesertatender/getByLpse'] = 'api/ApiPesertaTender/getPesertaTenderByLpse';
$route['api/pesertatender/getPemenang'] = 'api/ApiPesertaTender/getPemenangTender';
$route['api/pesertatender/getPenawar'] = 'api/ApiPesertaTender/getPenawarTender';
$route['api/pesertatender/getPeserta'] = 'api/ApiPesertaTender/getPesertaTender';
$route['api/pesertatenderbytender/(:num)'] = 'api/ApiPesertaTender/getIdByIdTender/$1';
$route['api/pesertatender/create'] = 'api/ApiPesertaTender/create';
$route['api/pesertatender/menawarPerMonthByLpse'] = 'api/ApiPesertaTender/getPesertaMenawarPerMonth';
$route['api/pesertatender/mendaftarPerMonthByLpse'] = 'api/ApiPesertaTender/getPesertaMendaftarPerMonth';
$route['api/pesertatender/update/(:num)'] = 'api/ApiPesertaTender/update/$1';
$route['api/pesertatender/delete/(:num)'] = 'api/ApiPesertaTender/destroy/$1';
// $route['api/pesertatendermonthly/(:num)'] = 'api/ApiPesertaTender/getIdMonthly/$1';
// $route['api/pesertatenderannual/(:num)'] = 'api/ApiPesertaTender/getIdAnnual/$1';
// $route['api/pesertatendertotal/(:num)'] = 'api/ApiPesertaTender/getIdtotal/$1';
// $route['api/pesertatenderhps/(:num)'] = 'api/ApiPesertaTender/getIdHps/$1';
// $route['api/pesertatenderpenurunan/(:num)'] = 'api/ApiPesertaTender/getIdPenurunan/$1';
$route['api/pesertatenderklpd/(:num)'] = 'api/ApiPesertaTender/getIdKlpd/$1';
$route['api/pesertacompetitor'] = 'api/ApiPesertaTender/getIdCompetitor';
$route['api/pesertatender/filter'] = 'api/ApiPesertaTender/getIdFilter';
$route['api/pesertatender/filterhps'] = 'api/ApiPesertaTender/getIdFilterHps';
$route['api/pesertatender/filterklpd'] = 'api/ApiPesertaTender/getIdFilterKlpd';
$route['api/pesertatender/filterakumulasi'] = 'api/ApiPesertaTender/getIdFilterAkumulasi';
$route['api/pesertatender/filterpenurunan'] = 'api/ApiPesertaTender/getIdFilterPenurunan';

// restAPI route for peserta
$route['api/peserta'] = 'api/ApiPeserta/index';
$route['api/peserta/(:num)'] = 'api/ApiPeserta/getId/$1';
$route['api/pesertanpwp/(:num)'] = 'api/ApiPeserta/getNpwp/$1';
$route['api/pesertanpwp'] = 'api/ApiPeserta/getPesertaNpwp';
$route['api/peserta/create'] = 'api/ApiPeserta/create';
$route['api/peserta/update/(:num)'] = 'api/ApiPeserta/update/$1';
$route['api/peserta/delete/(:num)'] = 'api/ApiPeserta/destroy/$1';

//restApi route for Paket
$route['api/paket'] = 'api/ApiPaket/index';
$route['api/paket/s-getHpsPerMonth'] = 'api/ApiPaket/searchHpsPerMonth';

// restAPI route for wilayah
$route['api/wilayah'] = 'api/ApiWilayah/index';
$route['api/wilayah/(:num)'] = 'api/ApiWilayah/getId/$1';
$route['api/wilayah/s'] = 'api/ApiWilayah/search';
$route['api/wilayah/create'] = 'api/ApiWilayah/create';
$route['api/wilayah/getWilayahByName'] = 'api/ApiWilayah/getWilayahByName';
$route['api/wilayah/namaNamaWilayahById'] = 'api/ApiWilayah/namaNamaWilayahById';
$route['api/wilayah/update/(:num)'] = 'api/ApiWilayah/update/$1';
$route['api/wilayah/delete/(:num)'] = 'api/ApiWilayah/destroy/$1';

// restAPI route for jenis tender
$route['api/jenistender'] = 'api/ApiJenisTender/index';
$route['api/jenistender/(:num)'] = 'api/ApiJenisTender/getId/$1';
$route['api/jenistender/s'] = 'api/ApiJenisTender/search';
$route['api/jenistender/create'] = 'api/ApiJenisTender/create';
$route['api/jenistender/namaNamaJenisTenderById'] = 'api/ApiJenisTender/namaNamaJenisTenderById';
$route['api/jenistender/update/(:num)'] = 'api/ApiJenisTender/update/$1';
$route['api/jenistender/delete/(:num)'] = 'api/ApiJenisTender/destroy/$1';

// restAPI route for Pemenang
$route['api/pemenang'] = 'api/ApiPemenang/index';
$route['api/pemenang/(:num)'] = 'api/ApiPemenang/getId/$1';
$route['api/pemenang/perMonthByLpse'] = 'api/ApiPemenang/getPemenangPerMonthByLpse';
$route['api/pemenang/create'] = 'api/ApiPemenang/create';
$route['api/pemenang/update/(:num)'] = 'api/ApiPemenang/update/$1';
$route['api/pemenang/delete/(:num)'] = 'api/ApiPemenang/destroy/$1';
$route['api/pemenangbyid'] = 'api/ApiPemenang/getAllPemenangbyLpse';
$route['api/pemenangbyidtahapan'] = 'api/ApiPemenang/getIdTahapan';
$route['api/pemenangbyidlim'] = 'api/ApiPemenang/getDataPemenang';
$route['api/jml_data_pemenang'] = 'api/ApiPemenang/jmldata';
$route['api/total_data'] = 'api/ApiPemenang/getDataTotal';

// restAPI route for Preferensi
$route['api/preferensi'] = 'api/ApiPreferensi/index';
$route['api/preferensi/(:num)'] = 'api/ApiPreferensi/getId/$1';
$route['api/preferensi/byIdUser/(:num)'] = 'api/ApiPreferensi/getByIdUser/$1';
$route['api/preferensi/byIdPref/(:num)'] = 'api/ApiPreferensi/getIdPref/$1';
$route['api/preferensi/createProfil'] = 'api/ApiPreferensi/create';
$route['api/preferensi/update/(:num)'] = 'api/ApiPreferensi/update/$1';
$route['api/preferensi/updateByIdPref/(:num)'] = 'api/ApiPreferensi/updateByIdPref/$1';
$route['api/preferensi/delete/(:num)'] = 'api/ApiPreferensi/destroy/$1';

// restAPI route for Peserta Tender
$route['api/pesertatender'] = 'api/ApiPesertaTender/index';
$route['api/pesertatender/(:num)'] = 'api/ApiPesertaTender/getId/$1';
$route['api/pesertatender/create'] = 'api/ApiPesertaTender/create';
$route['api/pesertatender/update/(:num)'] = 'api/ApiPesertaTender/update/$1';
$route['api/pesertatender/delete/(:num)'] = 'api/ApiPesertaTender/destroy/$1';
// restAPI route for hasil evaluasi
$route['api/hasilevaluasi/tender/(:num)'] = 'api/ApiHasilEvaluasi/getId/$1';

// restAPI route for pemenang
$route['api/pemenang/tender/(:num)'] = 'api/ApiPemenang/getTenderId/$1';

// API Preferensi
$route['api/preferensi'] = 'api/ApiPreferensi/getAll';
// $route['api/preferensi/tender'] = 'api/ApiPreferensi/preferensiTender';
// $route['api/preferensi/(:num)'] = 'api/ApiPreferensi/$1';
$route['api/preferensi/tender/(:num)'] = 'api/ApiPreferensi/preferensiTender/$1';
$route['api/preferensi/create'] = 'api/ApiPreferensi';
$route['api/preferensi/update/(:num)'] = 'api/ApiPreferensi/update/$1';
$route['api/preferensi/s/(:num)'] = 'api/ApiPreferensi/tenderS/$1';

// API Supplier
// $route['api/supplier/tim'] = 'api/ApiSupplier';
// $route['api/supplier/tim/create'] = 'api/ApiSupplier/create';

//===========================================
// Scrapping
//===========================================

//restAPI route for scrapping
$route['api/scrapping'] = 'api/ApiScrapping';
$route['api/scrapping/tender'] = 'api/ApiScrapping/tender';
$route['api/scrapping/tender/(:num)'] = 'api/ApiScrapping/tender';
// $route['api/tender/page/(:num)'] = 'api/ApiTender/tenderAll/$1';
$route['api/scrapping/status'] = 'api/ApiScrapping/status';
$route['api/scrapping/status/(:num)'] = 'api/ApiScrapping/status';
$route['api/scrapping/jadwal'] = 'api/ApiScrapping/jadwal';
$route['api/scrapping/jadwal/update'] = 'api/ApiScrapping/jadwalUpdate';
$route['api/scrapping/pengumuman'] = 'api/ApiScrapping/pengumuman';
$route['api/scrapping/peserta'] = 'api/ApiScrapping/peserta';
$route['api/scrapping/peserta/tender'] = 'api/ApiScrapping/pesertaTender';
$route['api/scrapping/pemenang'] = 'api/ApiScrapping/pemenang';

//restAPI route for testing scrapping
$route['api/scrapping/testing'] = 'api/ApiTesting';
$route['api/scrapping/testing/pengumuman'] = 'api/ApiTesting/pengumuman';
$route['api/scrapping/testing/peserta/tender'] = 'api/ApiTesting/pesertaTender';
$route['api/scrapping/testing/peserta'] = 'api/ApiTesting/peserta';
$route['api/scrapping/testing/tahap'] = 'api/ApiTesting/tahap';
$route['api/scrapping/testing/evaluasi'] = 'api/ApiTesting/evaluasi';
$route['api/scrapping/testing/pemenang'] = 'api/ApiTesting/pemenang';

// API Order
$route['api/order/check-duedate'] = 'api/ApiOrder/checkDueDate';

// profile setting
$route['profile'] = 'profilePengguna';
$route['profile/edit'] = 'profilePengguna/edit';
$route['profile/ubah'] = 'profilePengguna/ubah';
$route['profile/upload-photo/(:num)'] = 'profilePengguna/uploadPhotoProfile/$1';
$route['npwp'] = 'profilePengguna/updateNpwp';

//restAPI route for paket pembelian
$route['pembayaran/paketpembelian'] = 'Pembayaran/paketPembelian';

// ================================================================
// MOBILE API
// ================================================================
// mobile restAPI route for Auth
$route['api-mobile/login'] = 'api-mobile/ApiAuth/login';
$route['api-mobile/regist'] = 'api-mobile/ApiAuth/regist';
$route['api-mobile/complete-profil'] = 'api-mobile/ApiAuth/completeProfil';
$route['api-mobile/send-reset-key'] = 'api-mobile/ApiAuth/sendResetKey';
$route['api-mobile/get-reset-key'] = 'api-mobile/ApiAuth/getResetKey';
$route['api-mobile/change-password/(:any)'] = 'api-mobile/ApiAuth/changePassword/$1';
$route['api-mobile/send-verify'] = 'api-mobile/ApiAuth/verifySend';
$route['api-mobile/verify'] = 'api-mobile/ApiAuth/verify';
$route['api-mobile/check-verify'] = 'api-mobile/ApiAuth/verifyCheck';

// mobile restAPI route for pengguna
$route['api-mobile/pengguna'] = 'api-mobile/ApiPengguna/index';
$route['api-mobile/pengguna/create'] = 'api-mobile/ApiPengguna/create';
$route['api-mobile/pengguna/update/(:num)'] = 'api-mobile/ApiPengguna/update/$1';
$route['api-mobile/pengguna/delete/(:num)'] = 'api-mobile/ApiPengguna/destroy/$1';
$route['api-mobile/pengguna/check-user-trial'] = 'api-mobile/ApiPengguna/checkAndUpdateUserType';


//Admin
// $route['admin'] = 'admin/admin';
// $route['pengguna'] = 'admin/pengguna';
// $route['wilayah'] = 'admin/wilayah';
// $route['peserta']           = 'admin/peserta';
// $route['data_lpse']         = 'admin/admin/data_lpse';
// $route['kategori_lpse']     = 'admin/kategorilpse';
// $route['preferensi']        = 'admin/admin/preferensi';
// $route['tahapan']           = 'admin/tahapan';
// $route['jadwal']            = 'admin/jadwal';
// $route['data_tender']       = 'admin/admin/data_tender';
