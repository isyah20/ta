// base_url = 'http://localhost/procurement-platform';
// let page = $('#pageNow').val();
let perPage = 20;
let keyword = null;
let idPengguna = document.getElementById('idPengguna').innerHTML;

// Save Preferensi
let namaProfil = null, wilayah = null, kataKunci = null, kategoriLpse = [], kualifikasi = [], hps = null;

$('#namaProfil').keyup(function(){
    namaProfil = $(this).val();
});

$('#kataKunci').keyup(function(){
    kataKunci = $(this).val();
});

$('#selectWilayah').change(function(){
    wilayah = $(this).val();
});

$('input[type="checkbox"][name="kategoriLpse"]').on('change', function(){
		
    if (this.checked){
        const index = kategoriLpse.findIndex((obj) => obj === $(this).val());
        if (index === -1) {
            kategoriLpse.push($(this).val());
        } else {
            kategoriLpse[index] = $(this).val();
        }
    } else if (this.checked == false){
        kategoriLpse.splice(kategoriLpse.indexOf($(this).val()), 1);
    }
});

$('input[type="checkbox"][name="kualifikasi"]').on('change', function(){
		
    if (this.checked){
        const index = kualifikasi.findIndex((obj) => obj === $(this).val());
        if (index === -1) {
            kualifikasi.push($(this).val());
        } else {
            kualifikasi[index] = $(this).val();
        }
    } else if (this.checked == false){
        kualifikasi.splice(kualifikasi.indexOf($(this).val()), 1);
    }
});

$('#hps').change(function(){
    hps = $(this).val();
    if($(this).val()==0){
        $('#placeHps').html('Semua');
    } else if($(this).val()==1){
        $('#placeHps').html('<500JT');
    } else if($(this).val()==2){
        $('#placeHps').html('1M - 10M');
    } else if($(this).val()==3){
        $('#placeHps').html('10M - 100M');
    } else if($(this).val()==4){
        $('#placeHps').html('>100M');
    }
});

$('#simpanProfil').click(function(){
    // console.log(namaProfil);
    // console.log(kataKunci);
    // console.log(wilayah);
    // console.log(kategoriLpse);
    // console.log(kualifikasi);
    // console.log(hps);
    if(kategoriLpse == null){
        kategoriLpse = [];
    }
    if(kategoriLpse.length <= 0){
        kategoriLpse = null;
    }
    if(kualifikasi == null){
        kualifikasi = [];
    }
    if(kualifikasi.length <= 0){
        kualifikasi = null;
    }
    $.ajax({
        url : base_url+"/preferensi/saveProfilPreferensi/",
        type : "POST",
        data : {
            postNamaProfil : namaProfil,
            postKataKunci : kataKunci,
            postWilayah : wilayah,
            postHps : hps,
            postKategoriLpse : JSON.stringify(kategoriLpse),
            postKualifikasi : JSON.stringify(kualifikasi),
        },
        success : function(result) {
            console.log('loadPref');
            // $('#loader').hide();
            $('#preferens').html(result);
            resetFormProfil();
        }
    });
});

$('#reset').click(function(){
    resetFormProfil();
});

function resetFormProfil(){
    $('#namaProfil').val('');
    namaProfil = null;
    $('#kataKunci').val('');
    namaProfil = null;
    $('#selectWilayah').val('');
    wilayah = null;
    for(let i=0; i<kategoriLpse.length; i++){
        $('#kategoriLpse'+kategoriLpse[i]).prop('checked',false);
    }
    kategoriLpse = [];
    for(let i=0; i<kualifikasi.length; i++){
        $('#kualifikasi'+kualifikasi[i]).prop('checked',false);
    }
    kualifikasi = [];
    $('input[type="range"][name="hps"]').val('');
    $('#placeHps').html('Semua');
}

// End of Save Preferensi

// console.log(perPage);

// Profil Preferensi
function setPreferensi(idPreferensi){
    // console.log("cek");
    console.log(idPreferensi);
    perPage = 20;
    keyword = null;
    $.ajax({
        url : base_url+"/preferensi/loadProfilPreferensi/",
        type : "POST",
        data : {
            postIdPref : idPreferensi,
        },
        success : function(result) {
            console.log('loadPref');
            // $('#loader').hide();
            $('#preferens').html(result);
            $('.searchTender').val('');
            loadpage(keyword, perPage, 1);
        }
    });
}

function deletePreferensi(idPreferensi){
    // console.log("cek");
    console.log(idPreferensi);
    perPage = 20;
    keyword = null;
    $.ajax({
        url : base_url+"/preferensi/hapusProfilPreferensi/",
        type : "POST",
        data : {
            postIdPref : idPreferensi,
        },
        success : function(result) {
            console.log('loadPref');
            // $('#loader').hide();
            $('#preferens').html(result);
            $('.searchTender').val('');
            loadpage(keyword, perPage, 1);
        }
    });
}

loadpage(keyword, perPage, 1);

$('.searchTender').keyup(function(){

    // keyword = $(this).val();
    $('#keyword').val($(this).val());
    if (keyword == ''){
        loadpage(keyword, $('#perPage').val(), $('#pageNow').val());
    } else {
        loadpage($('#keyword').val(), $('#perPage').val(), $('#pageNow').val());
    }
});

$('#perPage-20').click(function(){
    // perPage = 20;
    $('#perPage').val('20');
    if (keyword == null){
        loadpage(keyword, $('#perPage').val(), $('#pageNow').val());
    } else {
        loadpage($('#keyword').val(), $('#perPage').val(), $('#pageNow').val());
    }
});

$('#perPage-40').click(function(){
    // perPage = 40;
    $('#perPage').val('40');
    if (keyword == null){
        loadpage(keyword, $('#perPage').val(), $('#pageNow').val());
    } else {
        loadpage($('#keyword').val(), $('#perPage').val(), $('#pageNow').val());
    }
});

$('#perPage-80').click(function(){
    // perPage = 80;
    $('#perPage').val('80');
    if (keyword == null){
        loadpage(keyword, $('#perPage').val(), $('#pageNow').val());
    } else {
        loadpage($('#keyword').val(), $('#perPage').val(), $('#pageNow').val());
    }
});

// function loadPreferensiList(){
//     $.ajax({
//         url: base_url+"/preferensi/pagination/" + page + '/' + perPage + '/' + keyword,
//         type: 'get',    
//         dataType: 'json',       
//         success: function(json) {
//             dataTable = `<div class="d-none"></div>`;
//             // console.log(json['pagination_results']);
//             if (json['pagination_results'] !== null){
//                 $.each(json['pagination_results'], function(key, tender) {
//                     dataTable += 
//                     `   <input id="pageNow" type="hidden" value="`+json['page_now']+`">
//                         <input id="perPage" type="hidden" value="`+json['per_page']+`">
//                         <input id="keyword" type="hidden" value="`+json['keyword']+`">
//                         <div class="row-table d-flex mt-1 px-3 py-2 text-body">
//                             <div class="col-lg-1 col-kode text-start mx-1">`+tender['id_tender']+`</div>
//                             <div class="col-lg-4 col-nama text-start mx-1">
//                                 <div class="mb-2 p-0">
//                                     <a class="p-0" style="font-weight: 500; color:#694747;" href="`+base_url+`/tender/`+tender['id_tender']+`">`+tender['nama_tender']+`</a>
//                                 </div>
//                                 <div class="row" style="color:#694747;">
//                                     <p class="col-1">
//                                         <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
//                                             <path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
//                                             <path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
//                                         </svg>
//                                     </p>
//                                     <p class="col-10 p-0">
//                                         `+tender['lokasi_pekerjaan']+`
//                                     </p>
//                                 </div>
//                             </div>
//                             <div class="col-lg-3 col-jenis text-start mx-1">
//                                 <p class="mb-2" style="font-weight: 500;">`+tender['jenis_tender']+`</p>
//                                 <p>`+tender['metode_pemilihan']+`</p>
//                             </div>
//                             <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
//                                 <!-- Button trigger modal -->
//                                 <a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('`+tender['id_tender']+`', '`+tender['nama_tender']+`')">
//                                     `+tender['tender_status']+`
//                                 </a>`;
//                 dataTable += `  <script>
//                                     function modalJadwal(id, nama){
//                                         $.ajax({
//                                             method: "POST",
//                                             url: '`+base_url+`/home/modalJadwal',
//                                             data : {
//                                                 sendId : id,
//                                                 sendNama : nama,
//                                             },
//                                         })
//                                         .done(function( content ) {
//                                             console.log(id);
//                                             // console.log(content);
//                                             $(".modal-content").html(content);
//                                             // $(".body-jadwal").html(content);
//                                             // $("#modalJadwal").show();
//                                         });
//                                     }
//                                 </script>`;
//                 dataTable += `
//                             </div>
//                             <!-- <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
//                             </div> -->
//                             <div class="col-lg col-hps text-start mx-1">
//                                 <h6 style="font-weight: 700;color:#139728;">`+formatRupiah(tender['nilai_hps'], 'Rp. ')+`</h6>
//                             </div>
//                         </div>`;
//                 });
//             } else {
//                 dataTable += `  <input id="pageNow" type="hidden" value="`+json['page_now']+`">
//                                 <input id="perPage" type="hidden" value="`+json['per_page']+`">
//                                 <input id="keyword" type="hidden" value="`+json['keyword']+`">
//                                 <a class="row-table d-flex mt-1 mb-2 text-body" disable="disabled">
//                                     <div class="col text-center mx-1">Tidak ada data</div>
//                                 </a>`
//             }

//             $('.myTablePreferensi').html(dataTable); 
            
//             pagination = `  <div class="col d-flex flex-row justify-content-start align-items-center">
//                                 <p class="m-0">Halaman</p>
//                                 <div class="d-flex justify-content-center align-items-center mx-1" style="border: 3px solid #B89494; border-radius: 10px; width: 45px; height: 45px;">
//                                     `+page+`
//                                 </div>
//                                 <p class="m-0">dari `+json['total_page']+`</p>
//                             </div>
//                             <div class="col d-flex justify-content-end">
//                                 <div class="table-pagination">`+json['pagination_links']+`</div>
//                             </div>`
//             $('#pagination-preferensi').html(pagination);
//         },
//     });
// }

function loadpage(keyword, perPage, page){
    // $('#keyword').val(), $('#perPage').val()
    // console.log(perPage);
    // console.log(base_url+"/preferensi/pagination/" + page + '/' + perPage + '/' + keyword);
    $.ajax({
        url: `${base_url}preferensi/pagination/${page}/${perPage}/${keyword}`,
        type: 'get',    
        dataType: 'json',       
        success: function(json) {
            dataTable = `<div class="d-none"></div>`;
            // console.log(json['pagination_results']);
            if (json['pagination_results'] !== null){
                $.each(json['pagination_results'], function(key, tender) {
                    dataTable += 
                    `   <input id="pageNow" type="hidden" value="`+json['page_now']+`">
                        <input id="perPage" type="hidden" value="`+json['per_page']+`">
                        <input id="keyword" type="hidden" value="`+json['keyword']+`">
                        <div class="row-table d-flex mt-1 px-3 py-2 text-body">
                            <div class="col-lg-1 col-kode text-start mx-1">`+tender['id_tender']+`</div>
                            <div class="col-lg-4 col-nama text-start mx-1">
                                <div class="mb-2 p-0">
                                    <a class="p-0" style="font-weight: 500; color:#694747;" href="`+base_url+`/tender/`+tender['id_tender']+`">`+tender['nama_tender']+`</a>
                                </div>
                                <div class="row" style="color:#694747;">
                                    <p class="col-1">
                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </p>
                                    <p class="col-10 p-0">
                                        `+tender['lokasi_pekerjaan']+`
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-jenis text-start mx-1">
                                <p class="mb-2" style="font-weight: 500;">`+tender['jenis_tender']+`</p>
                                <p>`+tender['metode_pemilihan']+`</p>
                            </div>
                            <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
                                <!-- Button trigger modal -->
                                <a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('`+tender['id_tender']+`', '`+tender['nama_tender']+`')">
                                    `+tender['tender_status']+`
                                </a>`;
                dataTable += `  <script>
                                    function modalJadwal(id, nama){
                                        $.ajax({
                                            method: "POST",
                                            url: '`+base_url+`/home/modalJadwal',
                                            data : {
                                                sendId : id,
                                                sendNama : nama,
                                            },
                                        })
                                        .done(function( content ) {
                                            console.log(id);
                                            // console.log(content);
                                            $(".modal-content").html(content);
                                            // $(".body-jadwal").html(content);
                                            // $("#modalJadwal").show();
                                        });
                                    }
                                </script>`;
                dataTable += `
                            </div>
                            <!-- <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
                            </div> -->
                            <div class="col-lg col-hps text-start mx-1">
                                <h6 style="font-weight: 700;color:#139728;">`+formatRupiah(tender['nilai_hps'], 'Rp. ')+`</h6>
                            </div>
                        </div>`;
                });
            } else {
                dataTable += `  <input id="pageNow" type="hidden" value="`+json['page_now']+`">
                                <input id="perPage" type="hidden" value="`+json['per_page']+`">
                                <input id="keyword" type="hidden" value="`+json['keyword']+`">
                                <a class="row-table d-flex mt-1 mb-2 text-body" disable="disabled">
                                    <div class="col text-center mx-1">Tidak ada data</div>
                                </a>`
            }

            $('.myTablePreferensi').html(dataTable); 
            
            pagination = `  <div class="col d-flex flex-row justify-content-start align-items-center">
                                <p class="m-0">Halaman</p>
                                <div class="d-flex justify-content-center align-items-center mx-1" style="border: 3px solid #B89494; border-radius: 10px; width: 45px; height: 45px;">
                                    `+page+`
                                </div>
                                <p class="m-0">dari `+json['total_page']+`</p>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <div class="table-pagination">`+json['pagination_links']+`</div>
                            </div>`
            $('#pagination-preferensi').html(pagination);
            console.log('loadPage');
        },
    });
}

function formatRupiah(angka, prefix){
    let number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

$(document).ready(function(){

    $(document).on("click", ".page-item a", function(event){
        event.preventDefault();
        var page = $(this).data("ci-pagination-page");
        // loadpage(keyword, perPage, page);
        if (keyword == null){
            loadpage(keyword, $('#perPage').val(), page);
        } else {
            loadpage($('#keyword').val(), $('#perPage').val(), page);
        }
    });

});
