<link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
<script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js"></script>

<style>
    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 8px;
        margin-left: 10px;
        height: 31px;
    }
    
    .select2-container .select2-search--inline .select2-search__field::placeholder {
        font-family: 'Ubuntu', sans-serif;
        color: #6c757d;
    }
    
    .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single {
        min-height: 38px;
        border: 1px solid #cccccc;
        padding-bottom: 0;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin: 6px 0 6px 6px;
    }
    
    #preferensi_notif label { margin-bottom: 3px; }
    
    .bootstrap-duallistbox-container label { margin-bottom: 8px !important; }
    
    .bootstrap-duallistbox-container .filter {
        height: 35px;
        border: 1px solid #cccccc;
        box-shadow: none;
    }
    
    .moveall, .removeall, .move, .remove {
        border: 1px solid #ccc !important;
    }

    .moveall::after, .move::after, .removeall::after, .remove::after {
        font-size: 30px;
        font-weight: 500;
        position: absolute;
        top: -7px;
        right: 70px;
    }

    .moveall::after { content: "\00BB"; }

    .move::after { content: "\203A"; }

    .removeall::after { content: "\00AB"; }

    .remove::after { content: "\2039"; }

    .form-control option {
        padding: 10px;
        border-bottom: 1px solid #efefef;
    }

    .btn-group>.btn-group:not(:first-child), .btn-group>:not(.btn-check:first-child)+.btn {
        height: 35px;
        margin-bottom: 2px;
    }

    .btn-group>.btn-group:not(:last-child)>.btn,
    .btn-group>.btn.dropdown-toggle-split:first-child,
    .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
        height: 35px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        margin-bottom: 2px;
    }
    
    /*#alert-message .btn-close {
        top: 0;
        right: 0;
        z-index: 2;
        padding: 1.25rem 1rem;
    }*/
</style>

<section id="preferensi_notif" class="py-5 bg-light">
    <div class="container-xl py-5">
        <div class="row justify-content-center">
            <div class="col-lg p-0">
                <div class="row mx-2 mt-2 p-0 mb-4 justify-content-center">
                    <div class="col-lg-9 col-xl-7 border rounded-3 p-3 shadow bg-white">
                        <!--<form id="preferensi-form" action="" method="POST" enctype="multipart/form-data">-->
                            <h4 class="border-bottom pb-3 mb-4 text-center">Preferensi Tender</h4>
                            <!--<div class="mt-3 alert alert-success" id="alert-message" style="display: none;">
                                <div></div>
                                <button class="btn-close position-absolute" aria-label="Close"></button>
                            </div>-->

                            <input type="hidden" name="id_preferensi" id="id_preferensi">
                            
                            <div class="kunci mb-3 row">
                                <label for="keyword" class="col-sm-4 col-xl-3 col-form-label">Kata Kunci<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <select class="col-lg keyword-multiple-limit form-select text-align-center my-lg-2 my-1" id="keyword" name="keyword[]" multiple="multiple" style="height: 75%;" placeholder="Kata Kunci">
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="kunci mb-3 row">
                                <label for="kategori" class="col-sm-4 col-xl-3 col-form-label">Jenis Pengadaan<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <select class="col-lg select2-jenis-pengadaan form-select text-align-center my-lg-2 my-1" id="kategori" name="kategori[]" multiple="multiple"></select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="border rounded-3 my-3">
                                <div class="row mx-0">
                                    <label class="col-3 col-sm-4 col-xl-3 col-form-label ps-0">Nilai <span class="lbl-hps"></span><span class="text-danger fw-bold ms-1">*</span></label>
                                    <div class="col-9 col-sm-8 col-xl-9 mt-2 ps-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkallhps">
                                            <label class="form-check-label" for="checkallhps">Semua</label>
                                            <div class="form-text mt-0 mb-2">Centang untuk menampilkan semua nilai <span class="txt-hps"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-light m-0 border-top formset-hps justify-content-center">
                                    <div class="col-12 text-center">
                                        <p class="my-3">Silakan atur rentang nilai <span class="txt-hps"></span> pada kolom di bawah ini:</p>
                                    </div>
                                    <div class="col-sm-5 pe-sm-0">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Nilai Awal (Rp)</span>
                                            <input class="form-control" type="text" name="nilai_hps_awal" id="nilai_hps_awal">
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-center py-1 px-0 d-none d-sm-block">-</div>
                                    <div class="col-sm-5 ps-sm-0">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Nilai Akhir (Rp)</span>
                                            <input class="form-control" type="text" name="nilai_hps_akhir" id="nilai_hps_akhir">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="m-0 border p-3 rounded-3">
                                <h5 class="mb-2">Pengaturan LPSE</h5>
                                <p>Berikut ini merupakan pengaturan LPSE yang dapat Anda tentukan sesuai kebutuhan.<br>LPSE terpilih adalah sumber paket tender yang berasal dari LPSE terkait yang akan ditampilkan sebagai informasi tender terbaru.</p>
                                <div class="row m-0 bg-light border p-2 pb-3 rounded-3">
                                    <div class="col">
                                        <input type="hidden" name="all_lpse" id="all_lpse">
                                        <select multiple="multiple" size="10" name="id_lpse[]" id="id_lpse"></select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-3 mb-1">
                                <button class="btn btn-success btn-lg col mx-0" id="btn-simpan-preferensi">Simpan</button>
                            </div>
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var listLpseDBox, jenis_tender = [], lpse = [], status, kategori, jenis;
    
    $(document).ready(function() {
        $.ajax({
            url : "<?= base_url() ?>api/getPreferensiPengguna/"+id_pengguna,
            type: "GET",
			dataType: "JSON",
            success : function(data){
                setTimeout(function(){
                    kategori = $('#kategori_user').val();
                    if (kategori == '2') $('.lbl-hps, .txt-hps').html('HPS');
                    else {
                        $('.lbl-hps').html('Penawaran');
                        $('.txt-hps').html('penawaran');
                    }
                    
                    status = $('#status_user').val();
                    if (status == '0') {
                        $('.form-select, .form-check-input, .form-control, #id_lpse, #btn-simpan-preferensi').prop('disabled',true);
                    } else {
                        $('.form-select, .form-check-input, .form-control, #id_lpse, #btn-simpan-preferensi').prop('disabled',false);
                    }
                        
                    jenis = $('#jenis_user').val();
                    
                    if (data != null) {
                        let keyword = (data.keyword != '' && data.keyword != null) ? data.keyword.split('|') : [];
                        for (let i=0; i<keyword.length; i++) {
                            $('#keyword').append('<option value="'+keyword[i]+'" selected>'+keyword[i]+'</option>');
                        }
                        
                        jenis_tender = (data.jenis_pengadaan != '' && data.jenis_pengadaan != null) ? data.jenis_pengadaan.split(',') : [];
                        lpse = (data.id_lpse != '' && data.id_lpse != null) ? data.id_lpse.split('|') : [];
                        
                        $('#kategori').prop('disabled',true);
                        $.ajax({
                            url : "<?= base_url() ?>api/getPreferensiListJenisTender/"+jenis,
                            type: "GET",
                            dataType: "JSON",
                            success : function(res){
                                for (let i=0; i<res.length; i++) {
                                    let pilih = '';
                                    if ($.inArray(res[i].id_jenis, jenis_tender) !== -1) pilih = 'selected';
                                            
                                    $('#kategori').append('<option value="'+res[i].id_jenis+'" '+pilih+'>'+res[i].jenis_tender+'</option>');
                                }
                                    
                                $('#kategori').prop('disabled',false);
                            },
                            error: function (jqXHR, textStatus, errorThrown){}
                        });
                        
                        if (data.nilai_hps_akhir == 0) $('#checkallhps').prop('checked', true);
                        else $('#checkallhps').prop('checked', false);
                        
                        $('#id_preferensi').val(data.id_preferensi);
                        $('#nilai_hps_awal').val(data.nilai_hps_awal);
                        $('#nilai_hps_akhir').val(data.nilai_hps_akhir);
                    } else {
                        $('#checkallhps').prop('checked', true);
                        
                        let keyword;
                        if (kategori == '2') {
                            if (jenis != '3') keyword = ['konsultansi','perencanaan','pengawasan'];
                            else keyword = ['konstruksi','renovasi','pembangunan'];
                        } else keyword = ['pengadaan','belanja','konstruksi'];
                        
                        for (let i=0; i<keyword.length; i++) {
                            $('#keyword').append('<option value="'+keyword[i]+'" selected>'+keyword[i]+'</option>');
                        }
                            
                        $('#kategori').prop('disabled',true);
                        $.ajax({
                            url : "<?= base_url() ?>api/getPreferensiListJenisTender/"+jenis,
                            type: "GET",
                            dataType: "JSON",
                            success : function(res){
                                for (let i=0; i<res.length; i++) {
                                    $('#kategori').append('<option value="'+res[i].id_jenis+'" selected>'+res[i].jenis_tender+'</option>');
                                }
                                    
                                $('#kategori').prop('disabled',false);
                            },
                            error: function (jqXHR, textStatus, errorThrown){}
                        });
                    }
                    
                    checkboxHps();
                    
                    const getToken = () => {
                        return new Promise((resolve, reject) => {
                            $.ajax({url: `${base_url}pengguna/get-token`})
                            .done(resp => resolve(resp))
                            .fail(err => reject(err))
                        })
                    }
                    
                    getToken().then(token => {
                        $.ajax({
                            url: `${base_url}api/lpse`,
                            data: {nolimit: 1},
                            headers: {
                                'Authorization': 'Basic ' + btoa(`${token.key}:${token.token}`)
                            }
                        }).done(resp => {
                            const items = resp.data;
                            if (lpse.length == 0) {
                                for (let val of items) {
                                    listLpseDBox.append(`<option value="${val.id_lpse}" selected>${val.nama_lpse}</option>`);
                                }
                            } else {
                                for (let val of items) {
                                    let pilih = '';
                                    if ($.inArray(val.id_lpse, lpse) !== -1) pilih = 'selected';
                                    
                                    listLpseDBox.append(`<option value="${val.id_lpse}" `+pilih+`>${val.nama_lpse}</option>`);
                                }
                            }
                            
                            listLpseDBox.bootstrapDualListbox('refresh');
                        }).fail(err => console.log(err))
                    }).catch(err => console.log(err))
                }, 1000);
            },
            error: function (jqXHR, textStatus, errorThrown){}
        });
        
        /*$('#alert-message').find('.btn-close').on('click', function () {
            $(this).parent().css('display', 'none');
        })*/

        $('.select2-jenis-pengadaan').select2({
            placeholder: 'Jenis Pengadaan',
        });
        
        let keywordOpts = {
            placeholder: 'Kata Kunci',
            minimumInputLength: 3,
            tags: true,
        }
        
        $('.keyword-multiple-limit').select2(keywordOpts);

        setTimeout(function(){
            if (['0', '2'].indexOf(status) >= 0) {
                keywordOpts = {...keywordOpts, maximumSelectionLength: 3};
                $('.keyword-multiple-limit').select2(keywordOpts);
            }
        }, 500);
        
        $('#nilai_hps_awal, #nilai_hps_akhir').inputmask('decimal', {
          'alias': 'numeric',
          'groupSeparator': '.',
          'autoGroup': true,
          'digits': 0,
          'digitsOptional': false,
          'allowMinus': false,
          'placeholder': '0',
          'rightAlign': false,
          'autoUnmask': true
        }).on('keyup',function(){
            let hps_awal = $('#nilai_hps_awal').val();
            let hps_akhir = $('#nilai_hps_akhir').val();
            
            if (parseInt(hps_akhir) < parseInt(hps_awal)) $('#nilai_hps_akhir').addClass('is-invalid');
            else $('#nilai_hps_akhir').removeClass('is-invalid');
        });
        
        listLpseDBox = $('select[name="id_lpse[]"]').bootstrapDualListbox({
            nonSelectedListLabel: 'Daftar LPSE',
            selectedListLabel: 'LPSE Terpilih',
            removeAllLabel: 'Hapus Semua',
            moveAllLabel: 'Pilih Semua',
            filterPlaceHolder: 'Cari LPSE',
            selectedFilter: '',
            infoText: false,
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,
            helperSelectNamePostfix: '',
            // moveAllLabel: '<iconify-icon icon="material-symbols:keyboard-double-arrow-right"></iconify-icon>',
            // moveSelectedLabel: '<iconify-icon icon="material-symbols:keyboard-double-arrow-right"></iconify-icon>'
        });
        
        $('#checkallhps').on('change', function() {
            checkboxHps();
        });
        
        $('#btn-simpan-preferensi').on('click', function (e) {
            let valid = validateForm();
            if (!valid) return e.preventDefault();
                
            simpanPreferensi(e);
            e.preventDefault();
        });
    });
    
    function checkboxHps(){
        if ($('#checkallhps').is(':checked')) {
            $('#nilai_hps_akhir, #nilai_hps_awal').val(0);
            $('.formset-hps').slideUp();
        } else {
            $('.formset-hps').slideDown();
        }
    }
    
    function showErrorFeedback(userPrefError) {
        const listField = []
        for (let [key, val] of Object.entries(userPrefError)) {
            listField.push({id: val.id, value: val.value})
        }

        for (let val of listField) {
            if (val.value.length > 0) {
                $(`#${val.id}`).parent().find('div.invalid-feedback').text(val.value).show()
            } else {
                $(`#${val.id}`).parent().find('div.invalid-feedback').text(val.value).hide()
            }
        }
    }
    
    function validateForm() {
        let valid = true;
        let userPrefError = {
            keyword: {id: 'keyword', value: ''},
            procurementType: {id: 'kategori', value: ''},
            hps: {id: 'nilai_hps_akhir', value: ''},
            lpse: {id: 'id_lpse', value: ''},
        };

        const validateKeyword = (userPrefErr) => {
            let keyword = $('#keyword').val();
            let valid = false;
            
            if (keyword.length < 1) {
                userPrefError = {...userPrefError, keyword: {...userPrefError.keyword, value: 'Kata kunci wajib diisi!'}};
            } else if (status != '1' && keyword.length > 3) {
                userPrefError = {...userPrefError, keyword: {...userPrefError.keyword, value: 'Kata kunci untuk akun standard hanya boleh 3 item!'}};
            } else {
                userPrefError = {...userPrefError, keyword: {...userPrefError.keyword, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateKeyword(userPrefError);
        
        const validateProcurementType = (userPrefErr) => {
            let kategori = $('#kategori').val();
            let valid = false;
            
            if (kategori.length < 1) {
                userPrefError = {...userPrefError, procurementType: {...userPrefError.procurementType, value: 'Jenis pengadaan wajib dipilih!'}};
            } else {
                userPrefError = {...userPrefError, procurementType: {...userPrefError.procurementType, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateProcurementType(userPrefError);

        let isAllHpsChecked = $('#checkallhps').is(':checked');
        if (!isAllHpsChecked) {
            let txt_hps = kategori == '2' ? 'HPS' : 'penawaran';
            let hps_awal = $('#nilai_hps_awal').val();
            let hps_akhir = $('#nilai_hps_akhir').val();
            
            if (parseInt(hps_akhir) <= 0) {
                valid = valid && false;
                userPrefError = {...userPrefError, hps: {...userPrefError.hps, value: 'Nilai '+txt_hps+' akhir wajib diisi!'}};
            } if (parseInt(hps_akhir) < parseInt(hps_awal)) {
                valid = valid && false;
                userPrefError = {...userPrefError, hps: {...userPrefError.hps, value: 'Nilai '+txt_hps+' akhir harus lebih besar!'}};
            } else {
                valid = valid && true;
                userPrefError = {...userPrefError, hps: {...userPrefError.hps, value: ''}};
            }
        }
        
        const validateLPSE = (userPrefErr) => {
            let lpse = $('#id_lpse').val();
            let valid = false;
            
            if (lpse.length < 1) {
                userPrefError = {...userPrefError, lpse: {...userPrefError.lpse, value: 'LPSE wajib dipilih!'}};
            } else {
                userPrefError = {...userPrefError, lpse: {...userPrefError.lpse, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateLPSE(userPrefError);
        
        showErrorFeedback(userPrefError);
        return valid;
    }
    
    function simpanPreferensi(e) {
        // let alertMsg = $('#alert-message');
        
        let total_lpse = listLpseDBox.find('option').length;
        let lpse_terpilih = listLpseDBox.val().length;
        if (lpse_terpilih == total_lpse) {
            $('#all_lpse').val('1');
            $('#id_lpse').val([]);
        } else $('#all_lpse').val('0');
        
        let btnSave = $('#btn-simpan-preferensi');
        let formData = $('#preferensi_notif :input').serialize();
        btnSave.prop('disabled', true);
        $.ajax({
            type: "POST",
            url: "<?= base_url('api/simpanPreferensi') ?>",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: () => {
                // alertMsg.hide();
                btnSave.text('Menyimpan...');
            }
        }).done(function (resp) {
            // alertMsg.removeClass('alert-danger alert-success').addClass('alert-success').show().find('div').html(resp.Info);
            toastr.success(resp.Info, 'Informasi', opsi_toastr);
            
            if (kategori == '2') {
                $.ajax({
                    url: "<?= base_url('api/kirimTenderTerbaruByPengguna/') ?>"+id_pengguna,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        setTimeout(() => {
                            window.location.href = `${base_url}user-dashboard`;
                        }, 500);
                    }
                });
            } else if (kategori == '4') {
                $.ajax({
                    url: "<?= base_url('api/kirimPemenangTerbaruByPengguna/') ?>"+id_pengguna,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        setTimeout(() => {
                            window.location.href = `${base_url}suplier`;
                        }, 500);
                    }
                });
            }
        }).fail(function (err) {
            let msg = 'Preferensi tender tidak dapat disimpan.';
            if (err.hasOwnProperty('responseText')) {
                let errs = JSON.parse(err.responseText);
                msg = errs.message;
            }
            
            toastr.error(msg, 'Kesalahan', opsi_toastr);
            
            /*const switchClass = (elm, err) => {
                if (err == 1 && elm.hasClass('alert-success')) {
                    elm.removeClass('alert-success').addClass('alert-danger');
                } else if (err == 0 && elm.hasClass('alert-danger')) {
                    elm.removeClass('alert-danger').addClass('alert-success');
                }
                return elm;
            }
            
            let alertElm = switchClass(alertMsg, 1);
            alertElm.find('div').html(msg).parent().show();*/
        });
        btnSave.text('Simpan').prop('disabled', false);

        return e.preventDefault();
    }

    /*function hapusPref(id) {
        Swal.fire({
            title: 'Hapus Data',
            text: "Apakah Anda yakin akan menghapus data preferensi?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#D54425',
            cancelButtonColor: '#E6B034',
            confirmButtonText: 'HAPUS',
            cancelButtonText: 'BATAL',
            reverseButtons: 'true'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('monitoring/') ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire({
                            icon: "Success",
                            title: "Informasi",
                            text: "Data preferensi berhasil dihapus.",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#preferensi-form').reset();
                        })
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire('Kesalahan', 'Terjadi masalah saat menghapus data', 'error');
                    }
                });
            }
        })
    }*/
</script>