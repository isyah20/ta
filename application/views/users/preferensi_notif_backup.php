<?php

use App\components\UserCategory;
use App\components\UserType;

$userType = 0;
$userCat = 0;

if ($this->session->userdata('user_data') != null && isset($this->session->user_data['status'])) {
    $userType = (int) $this->session->user_data['status'];
}

if ($this->session->userdata('user_data') != null && isset($this->session->user_data['kategori'])) {
    $userCat = (int) $this->session->user_data['kategori'];
}

if ($preferensi != null) {
    $nilai_awal = $preferensi['nilai_hps_awal'];
    // Mengubah format uang ke format Rupiah
    $nilai_hps_awal = "Rp " . number_format($nilai_awal, 0, ",", ".");
    $nilai_akhir = $preferensi['nilai_hps_akhir'];
    // Mengubah format uang ke format Rupiah
    $nilai_hps_akhir = "Rp " . number_format($nilai_akhir, 0, ",", ".");
}

//$isDisabledInputBtn = $userStatus == UserType::FREE || ($userStatus == UserType::TRIAL && $trialUserDuration == 0);
$isDisabledInputBtn = False;
$isSupplier = $userCat == UserCategory::SUPPLIER;
?>
<!-- plugin -->
<script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">

<div class="d-none" id="idPengguna"><?= $idPengguna ?></div>
<style>
    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-selection--single {
        min-height: 38px;
        border: 1px solid #B89494;
    }
    .moveall,
    .removeall,
    .move,
    .remove {
        border: 1px solid #ccc !important;


    }

    .moveall::after,
    .move::after,
    .removeall::after,
    .remove::after {
        font-size: 30px;
        font-weight: 500;
        position: absolute;
        top: -7px;
        right: 70px;
    }

    .moveall::after {
        content: "\00BB";

    }

    .move::after {
        content: "\203A";


    }

    .removeall::after {
        content: "\00AB";
    }

    .remove::after {
        content: "\2039";
    }


    .form-control option {
        padding: 10px;
        border-bottom: 1px solid #efefef;
    }


    .btn-group>.btn-group:not(:first-child),
    .btn-group>:not(.btn-check:first-child)+.btn {
        margin-inline: 0px;
        height: 35px;
        margin-bottom: 2px;
    }

    .btn-group>.btn-group:not(:last-child)>.btn,
    .btn-group>.btn.dropdown-toggle-split:first-child,
    .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
        height: 35px;
        margin-inline: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        margin-bottom: 2px;
    }
    #alert-message .btn-close {
        top: 0;
        right: 0;
        z-index: 2;
        padding: 1.25rem 1rem;
    }
</style>
<section id="preferensi_notif" class="py-5 bg-light">
    <div class="container-xl py-5">
        <div class="row justify-content-center">
            <div class="col-lg p-0">

                <div class="row mx-2 mt-2 p-0 mb-4 justify-content-center">
                    <div class="col-lg-9 col-xl-7 border rounded-3 p-3 shadow bg-white">
                        <?php
                        $isNew = 0;
$actionUrl = base_url() . 'preferensi/edit_pref';
$isArray = is_array($preferensi);
if ($isArray && count($preferensi) == 0) {
    $actionUrl = base_url() . 'preferensi/inputpref';
    $isNew = 1;
}
?>
                        <form id="preferensi-form" action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data">
                            <h4 class="border-bottom pb-2 mb-4 text-center">Preferensi Tender</h4>
                            <div class="mt-3 alert alert-success" id="alert-message" style="display: none;">
                                <div></div>
                                <button class="btn-close position-absolute" type="button" aria-label="Close"></button>
                            </div>

                            <input class="form-control my-lg-2 my-1" type="hidden" name="id_preferensi" id="id_preferensi" placeholder="id_preferensi" aria-label="default input example" value="<?= $preferensi ? $preferensi['id_preferensi'] : "" ?>">
                            
                            <div class="kunci mb-3 row">
                                <label for="keyword" class="col-sm-4 col-xl-3 col-form-label">Kata Kunci<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <select class="keyword-multiple-limit col-lg form-select text-align-center my-lg-2 my-1" id="keyword" 
                                        name="keyword[]" multiple="multiple" style=" height:75%;" placeholder="Kata Kunci" <?= ($isDisabledInputBtn ? 'disabled="true"' : '') ?>>
                                        <?php
                if ($preferensi) {
                    if (isset($preferensi['keyword'])) {
                        foreach ($preferensi['keyword'] as $val):
                            ?>
                                                                            <option value="<?= $val ?>" selected><?= $val ?></option>
                                                                <?php
                        endforeach;
                    }
                } ?>
                                    </select>
                                    <div class="invalid-feedback">Kata kunci wajib diisi!</div>
                                </div>
                            </div>
                            <?php /* OLD
                            <div class="kunci mb-3">
                                <label for="keyword" class="form-label">Kata Kunci</label>
                                <select class="keyword-multiple-limit col-lg form-select text-align-center my-lg-2 my-1" id="keyword" name="keyword[]" multiple="multiple" style=" height:75%;" placeholder="Kata Kunci">
                                    <?php
                                    if ($preferensi) {
                                        if (isset($preferensi['keyword'])) {
                                            foreach ($preferensi['keyword'] as $val) :
                                                ?>
                                                <option value="<?= $val ?>" selected><?= $val ?></option>
                                    <?php
                                            endforeach;
                                        }
                                    } ?>
                                </select>
                                <div class="invalid-feedback">Kata kunci wajib diisi!.</div>
                            </div> */ ?>
                            <div class="kunci mb-3 row">
                                <?php $listId = array_reduce($procurementType, fn ($acc, $item) => [...$acc, $item['id_jenis']], []); ?>
                                <label for="kategori" class="col-sm-4 col-xl-3 col-form-label">Jenis Pengadaan<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <select class="js col-lg form-select text-align-center my-lg-2 my-1" id="kategori" name="kategori[]" multiple="multiple" 
                                         <?= ($isDisabledInputBtn ? 'disabled="true"' : '') ?>>
                                        <?php if ($isSupplier && empty($listId)): ?>
                                            <?php foreach ($listProcurementType as $val): ?>
                                            <option value="<?= $val['id_jenis'] ?>" selected><?= $val['jenis_tender'] ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?php foreach ($listProcurementType as $val): ?>
                                            <option value="<?= $val['id_jenis'] ?>" <?= in_array($val['id_jenis'], $listId) ? 'selected' : ''?>><?= $val['jenis_tender'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="invalid-feedback">Jenis pengadaan wajib dipilih!</div>
                                </div>
                            </div>
                            <div class="border rounded-3 my-3">
                                <div class="row mx-0">
                                    <label class="col-3 col-sm-4 col-xl-3 col-form-label">Nilai HPS</label>
                                    <div class="col-9 col-sm-8 col-xl-9 mt-2">
                                        <div class="form-check">
                                            <?php
                    $checked = true;
if (is_array($preferensi) && count($preferensi) > 0 && (float) $preferensi['nilai_hps_akhir'] > 0) {
    $checked = false;
}
?>
                                            <input class="form-check-input" type="checkbox" value="" id="checkallhps" <?= ($checked ? 'checked' : '') ?> name="checkallhps" 
                                            <?= ($isDisabledInputBtn ? 'disabled="true"' : '') ?>>
                                            <label class="form-check-label" for="checkallhps">Semua</label>
                                            <div class="form-text mt-0 mb-2">Centang untuk menampilkan semua nilai HPS</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-light m-0 border-top formset-hps justify-content-center">
                                    <div class="col-12 text-center">
                                        <p class="my-3">Silakan atur rentang nilai HPS pada form di bawah ini:</p>
                                    </div>
                                    <div class="col-sm-5 pe-sm-0">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Nilai Awal</span>
                                            <input class="form-control" type="text" name="nilai_hps_awal" id="nilai_hps_awal" placeholder="Nilai HPS awal" value="<?= $nilai_hps_awal ?? '' ?>" 
                                            <?= ($isDisabledInputBtn ? 'disabled="true"' : '') ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-center py-1 px-0 d-none d-sm-block">-</div>
                                    <div class="col-sm-5 ps-sm-0">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Nilai Akhir</span>
                                            <input class="form-control" type="text" name="nilai_hps_akhir" id="nilai_hps_akhir" placeholder="Nilai HPS akhir" value="<?= $nilai_hps_akhir ?? '' ?>" 
                                            <?= ($isDisabledInputBtn ? 'disabled="true"' : '') ?>>
                                            <div class="invalid-feedback">Nilai HPS akhir wajib diisi!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php /* <div class="row">
                                <div class="col-md-6">
                                    <label for="nilai_hps_awal" class="form-label">HPS Awal</label>
                                    <input class="form-control mb-3" type="text" name="nilai_hps_awal" id="nilai_hps_awal" placeholder="Nilai HPS awal" value="<?= $nilai_hps_awal ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="nilai_hps_akhir" class="form-label">HPS Akhir</label>
                                    <input class="form-control mb-3" type="text" name="nilai_hps_akhir" id="nilai_hps_akhir" placeholder="Nilai HPS akhir" value="<?= $nilai_hps_akhir ?? '' ?>">
                                </div>
                            </div> */ ?>
                             <div class="m-0 border p-3 rounded-3">
                                <h5 class="mb-2">Pengaturan LPSE</h5>
                                <p>Di bawah ini merupakan pengaturan LPSE yang dapat Anda tentukan sesuai kebutuhan.<br>LPSE terpilih adalah sumber paket tender yang berasal dari LPSE terkait yang akan ditampilkan sebagai informasi tender terbaru.</p>
                                <div class="row m-0 bg-light border p-2 rounded-3">
                                    <div class="col">
                                        <select multiple="multiple" size="10" name="id_lpse[]" title="id_lpse[]" id="id_lpse">
                                            
                                            <?php /*foreach ($lpse as $data) :
                                                <?php if ($preferensi) {
                                                    ?>
                                                    <option value="<?= $data['id_lpse'] ?>" <?= in_array($data['id_lpse'], $preferensi['id_lpse']) ? 'selected' : '' ?>><?= $data['nama_lpse'] ?></option>
                                                <?php
                                                } else {
                                                    ?>
                                                    <option value="<?= $data['id_lpse'] ?>"><?= $data['nama_lpse'] ?></option>
                                            <?php
                                                }
                                            endforeach;*/ ?>
                                        </select>
                                        <div class="invalid-feedback">Daftar LPSE wajib dipilih!</div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            </script>

                            <?php
                            $isArray = is_array($preferensi);
if ($isArray && count($preferensi) == 0):
    ?>
                                <div class="d-flex my-3">
                                    <button type="button" class="btn btn-success btn-lg col me-2" id="btn-update-pref">Simpan</button>
                                </div>
                            <?php else: ?>
                                <div class="d-flex my-3">
                                <button type="button" class="btn btn-success btn-lg col me-2" id="btn-update-pref" <?= ($isDisabledInputBtn ? 'disabled="true"' : '') ?>>Update</button>
    <?php /*<button type="button" onclick="hapusPref(<?= $preferensi['id_preferensi'] ?>)" class="btn btn-danger btn-lg col ms-2" style="height: 52px; ">
                                        Hapus
                                    </button>*/ ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section id="tender_home" class="list_tender d-none" style="padding-top: 100px;">
    <div class="container text-left">
        <div class="row justify-content-md-left">
            <div class="row mx-1 p-0 mb-4">
                <h2 class="p-0 m-0" style="font-weight: 700; color: #694747;">List Tender</h2>
                <p class="p-0" style="color: #694747;">Data berikut adalah daftar paket yang sesuai dengan
                    preferensi Anda
                </p>
            </div>

            <div class="col d-flex flex-row justify-content-start align-items-center p-0">
                <p class="m-0">Tampilkan data per halaman</p>
                <div class="d-flex flex-row">
                    <button id="perPage-20" class="mx-1" style="border: 2px solid #B89494; border-radius: 10px; list-style: none; width: 45px; height: 45px;">20</button>
                    <button id="perPage-40" class="mx-1" style="border: 2px solid #B89494; border-radius: 10px; list-style: none; width: 45px; height: 45px;">40</button>
                    <button id="perPage-80" class="mx-1" style="border: 2px solid #B89494; border-radius: 10px; list-style: none; width: 45px; height: 45px;">80</button>
                </div>
            </div>
            <div class="col d-flex justify-content-lg-end justify-content-md-start justify-content-start align-items-center p-0 mt-md-2 mt-lg-0 mt-2">
                <div class="d-flex p-0 cari-tender" style="width: 580px; height: 45px;">
                    <div class="col d-flex flex-row group-input text-start p-0 align-item-center">
                        <span class="col-1 d-flex justify-content-center align-items-center img-search" width="30px" height="30px" style="color: #DD4B39;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>
                        <input class="col searchTender" type="text" placeholder="Cari Nama Paket atau K/L/PD">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container" id="table">
        <div class="row pt-4 justify-content-center mx-1 data-table p-0">
            <table class="table table-borderless" style="width: 100%;margin-bottom: 1px;">
                <thead>
                    <tr class="head-table">
                        <th width="10%">Kode</th>
                        <th width="40%">Nama Paket</th>
                        <th width="15%">Jenis Pengadaan</th>
                        <th width="20%">Tahapan</th>
                        <th width="15%">HPS</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        
        <?php /*
        <div class="row my-2" id="pagination-preferensi">
            <div class="col d-flex flex-row justify-content-start align-items-center">
                <p class="m-0">Halaman</p>
                <div class="d-flex justify-content-center align-items-center mx-1" style="border: 3px solid #B89494; border-radius: 10px; width: 45px; height: 45px;">
                    <?= ceil($this->uri->segment(3) / $this->perPage) + 1 ?>
                </div>
                <p class="m-0">dari <?= $totalPage ?></p>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="table-pagination"></div>
            </div>
        </div>
    */ ?>
    </div>
</section>

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>-->

<script src="<?= base_url('assets/js/users/preferensi_tender.js')?>"></script>
<script src="<?= base_url('assets/js/home/timeline.js') ?>"></script>

<script>
    const userPref = JSON.parse('<?= json_encode($preferensi) ?>');
    const isNew = <?= $isNew ?>;
    const userType = <?= $userType ?>;
    const isDisabledInputBtn = parseInt('<?= ($isDisabledInputBtn ? 1 : "0") ?>');
    let listLpseDBox;
    var id_pengguna = <?= $idPengguna ?>;
    var kategori_user = <?= $this->session->user_data['kategori'] ?>;

    function hapusPref(id) {
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
    }

    function editPref(evt) {
        const btnSave = $('#btn-update-pref')
        const alertMsg = $('#alert-message')
        const countSelectedProcurementType = $('#kategori option:selected').length
        const procurementTypeOpts = $('.js').select2('data');
        const listProcurementType = []
        if (countSelectedProcurementType > 0) {
            for (let val of procurementTypeOpts) {
                listProcurementType.push(parseInt(val.id))
            }
        } else {
            const selectTwo = $('#kategori option')
            selectTwo.each(function () {
                listProcurementType.push(parseInt($(this).val()))
            })
        }
        
        const isAllHpsChecked = $('#checkallhps').is(':checked')
        const form = $('#preferensi-form')[0];
        const formData = new FormData(form);
        formData.append('procurement_type[]', listProcurementType)
        if (isAllHpsChecked) {
            formData.append('all_hps_checked', 1)
        }

        if (!formData.has('keyword[]')) {
            const keyword = $('#keyword').val()
            formData.append('keyword[]', keyword)
        }
        if (formData.has('id_lpse[]_helper2')) {
            formData.delete('id_lpse[]_helper2')
        }
        
        // jika jumlah id lpse yang dipilih dan tidak dipilih sama maka user dianggap memilih semua lpse.
        // jika tidak sama maka simpan yang dipilih saja agar tidak terlalu banyak data.
        const cntTotalLpse = listLpseDBox.find('option').length
        const cntSelLpse = listLpseDBox.val().length
        const cntNotSelLpse = listLpseDBox.find('option:not(:selected)').length
        if (cntSelLpse == cntTotalLpse) {
            formData.set('id_lpse[]', [])
        }

        const switchClass = (elm, err) => {
            if (err == 1 && elm.hasClass('alert-success')) {
                elm.removeClass('alert-success').addClass('alert-danger')
            } else if (err == 0 && elm.hasClass('alert-danger')) {
                elm.removeClass('alert-danger').addClass('alert-success')
            }
            return elm
        }
        
        const actionUrl = $('#preferensi-form').attr('action')
        let btnSaveLabel = 'Update'
        if (isNew == 1) {
            btnSaveLabel = 'Simpan'
        }
        btnSave.attr('disabled', true)
        $.ajax({
            type: "POST",
            url: `${actionUrl}`,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: () => {
                alertMsg.hide()
                $('#btn-update-pref').text('Menyimpan...')
            }
        })
        .done(function (resp) {
            btnSave.attr('disabled', false)
            const data = JSON.parse(resp)
            const err = parseInt(data.error)
            alertMsg.removeClass('alert-danger alert-success').addClass('alert-success')
                .show().find('div').html(data.message)
            $('#btn-update-pref').text(btnSaveLabel)
            
            if (kategori_user == '2') {
                $.ajax({
                    url: "<?= base_url('api/kirimTenderTerbaruByPengguna/') ?>"+id_pengguna,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        setTimeout(() => {
                            window.location.href = `${base_url}user-dashboard`
                        }, 500);
                    }
                });
            } else if (kategori_user == '4') {
                $.ajax({
                    url: "<?= base_url('api/kirimPemenangTerbaruByPengguna/') ?>"+id_pengguna,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        setTimeout(() => {
                            window.location.href = `${base_url}suplier`
                        }, 500);
                    }
                });
            }
        })
        .fail(function (err) {
            btnSave.attr('disabled', false)
            let msg = 'Preferensi tender tidak dapat disimpan.'
            if (err.hasOwnProperty('responseText')) {
                const errs = JSON.parse(err.responseText)
                msg = errs.message
            }
            const alertElm = switchClass(alertMsg, 1)
            alertElm.find('div').html(msg).parent().show()
            $('#btn-update-pref').text(btnSaveLabel)
        });

        return evt.preventDefault()
    }

    function reloadTender() {
        tabel_tender.ajax.reload();
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

    function validateForm () {
        let valid = true
        const isAllHpsChecked = $('#checkallhps').is(':checked')
        let userPrefError = {
            keyword: {id: 'keyword', value: ''},
            procurementType: {id: 'kategori', value: ''},
            hps: {id: 'nilai_hps_akhir', value: ''},
            lpse: {id: 'id_lpse', value: ''},
        };

        // Validasi kata kunci
        const validateKeyword = (userPrefErr) => {
            const keyword = $('#keyword').val();
            let valid = false
            if (keyword.length < 1) {
                userPrefError = {...userPrefError, keyword: {...userPrefError.keyword, value: 'Kata kunci wajib diisi!.'}};
            } else if ((userType == 0 || userType == 2) && keyword.length > 3) {
                userPrefError = {...userPrefError, keyword: {...userPrefError.keyword, value: 'Kata kunci untuk pengguna gratis hanya 3 kata!.'}};
            } else {
                userPrefError = {...userPrefError, keyword: {...userPrefError.keyword, value: ''}};
                valid = true
            }
            return valid
        }
        $('#keyword').on('select2:select', () => {
            validateKeyword(userPrefError)
            showErrorFeedback(userPrefError)
        })
        $('#keyword').on('select2:unselect', () => {
            validateKeyword(userPrefError)
            showErrorFeedback(userPrefError)
        })
        valid = valid && validateKeyword(userPrefError)

        // Nilai hps akhir 
        if (!isAllHpsChecked) {
            let endHpsValue = $('#nilai_hps_akhir').val()
            endHpsValue = endHpsValue.substring(2).trim()
            endHpsValue = parseFloat(endHpsValue)
            if (endHpsValue <= 0) {
                valid = valid && false
                userPrefError = {...userPrefError, hps: {...userPrefError.hps, value: 'Nilai HPS akhir wajib diisi!.'}};
            } else {
                valid = valid && true
                userPrefError = {...userPrefError, hps: {...userPrefError.hps, value: ''}};
            }
        }
        showErrorFeedback(userPrefError)
        return valid
    }

    let tabel_tender;
    $(document).ready(function() {
        $('#alert-message').find('.btn-close').on('click', function () {
            $(this).parent().attr('style', 'display: none;')
        })

        // Jenis pengadaan
        $('#kategori1').on('change', function() {
            // Mendapatkan nilai terpilih pada Select2
            var value = $(this).val();
            var kateg1 = [3, 4, 7];
            var kateg2 = [5, 6, 7];
            var kateg3 = [1, 2, 7, 8];
            var selectjenis = $('.js');
            $.ajax({
                type: "get",
                url: `${base_url}selectkateg/${value}`,
                success: function(response) {
                    selectjenis.html('');
                    $.each(response, function(i, v) {
                        selectjenis.append(`<option value="${v.id_jenis}">${v.jenis_tender}</option>`);
                    });
                }
            });

        });

        const selectjenis = $('.js');
        selectjenis.select2({
            placeholder: "Jenis Pengadaan",
        });

        // keyword select2
        let keywordOpts = {
            placeholder: 'Kata Kunci',
            // height: "52px",
            // border: "1px",
            // solid: "#B89494",
            // allowClear: true,
            minimumInputLength: 3,
            // closeOnSelect: false,
            // allowHtml: true,
            tags: true,
        }

        if ([0, 2].indexOf(userType) >= 0) {
            keywordOpts = {...keywordOpts, maximumSelectionLength: 3}
        }

        $('.keyword-multiple-limit').select2(keywordOpts);
        
        listLpseDBox = $('select[name="id_lpse[]"]').bootstrapDualListbox({
            nonSelectedListLabel: 'Daftar LPSE',
            selectedListLabel: 'LPSE Terpilih',
            // preserveSelectionOnMove: 'moved',
            // moveAllLabel: '<iconify-icon icon="material-symbols:keyboard-double-arrow-right"></iconify-icon>',
            removeAllLabel: 'Hapus Semua',
            moveAllLabel: 'Pilih Semua',
            filterPlaceHolder: 'Cari...',
            selectedFilter: '',
            infoText: false,
            // tambahan
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,
            // moveSelectedLabel: '<iconify-icon icon="material-symbols:keyboard-double-arrow-right"></iconify-icon>'

        });
        
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
            })
            .done(resp => {
                const items = resp.data
                if ((!Array.isArray(userPref) && userPref.id_lpse.length == 0) || Array.isArray(userPref)) {
                    for (let val of items) {
                        listLpseDBox.append(`<option value="${val.id_lpse}" selected>${val.nama_lpse}</option>`)
                    }
                } else {
                    const listId = userPref.id_lpse.map(item => parseInt(item))
                    for (let val of items) {
                        if (listId.indexOf(parseInt(val.id_lpse)) >= 0) {
                            listLpseDBox.append(`<option value="${val.id_lpse}" selected>${val.nama_lpse}</option>`)
                        } else {
                            listLpseDBox.append(`<option value="${val.id_lpse}">${val.nama_lpse}</option>`)
                        }
                    }
                }
                listLpseDBox.bootstrapDualListbox('refresh');
            })
            .fail(err => console.log(err))
        })
        .catch(err => console.log(err))

        // Nilai HPS
        const nilai_hps_awal = document.getElementById('nilai_hps_awal');
        nilai_hps_awal.addEventListener('input', function(e) {
            nilai_hps_awal.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        const nilai_hps_akhir = document.getElementById('nilai_hps_akhir');
        nilai_hps_akhir.addEventListener('input', function(e) {
            nilai_hps_akhir.value = formatRupiah(this.value, 'Rp. ');
            const hpsa = nilai_hps_akhir.value.split(' ');
            // console.log(hpsa);
            const hpsawal = nilai_hps_awal.value.split(' ');
            var hpsaValue = parseInt(hpsa[1].replace(/\./g, ''), 10);
            var hpsawalValue = parseInt(hpsawal[1].replace(/\./g, ''), 10);
            // memeriksa apakah nilai akhir lebih kecil dari nilai awal
            if (parseInt(hpsaValue) <= parseInt(hpsawalValue)) {
                // console.log(nilai_hps_awal.value);
                $('#nilai_hps_akhir').addClass('is-invalid');
            } else {
                $('#nilai_hps_akhir').removeClass('is-invalid');
            }
        });

        // Handle tombol Update preferensi
        $('#btn-update-pref').on('click', function (evt) {
            const valid = validateForm()
            if (!valid) {
                return evt.preventDefault()
            }
            editPref(evt)
            evt.preventDefault()
        });

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        tabel_tender = $("#tabel-tender").DataTable({
            "language": {
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sInfoEmpty": "",
                "sInfoFiltered": "(terfilter dari _MAX_ data)",
                "emptyTable": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
                "sLengthMenu": "Data per Halaman: _MENU_",
                "sLoadingRecords": "<iconify-icon icon='eos-icons:loading' style='color: #b02d1a;' width='80' height='80'></iconify-icon><br>Silakan tunggu, data sedang di-load...",
                "sProcessing": "<iconify-icon icon='eos-icons:loading' style='color: #b02d1a;' width='80' height='80'></iconify-icon>",
                "sSearch": "Cari Data:",
                "sSearchPlaceholder": "Masukkan kata kunci...",
                "sZeroRecords": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "previous": "Sebelumnya",
                    "next": "Berikutnya"
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "<?= base_url('home/getTabelTender') ?>",
                "type": "POST",
                data: function(data) {
                    // data.nama = $('#detail_nama_pekerjaan').val();
                    data.cari = keyword;
                    data.cariWilayah = JSON.stringify(wilayah);
                    data.cariKLPD = JSON.stringify(klpd);
                    data.cariJenisPengadaan = JSON.stringify(jenisPengadaan);
                    data.cariHPS = JSON.stringify(hps);
                    data.cariKualifikasi = JSON.stringify(kualifikasi);
                    data.cariTahun = JSON.stringify(tahun);
                    data.cariTahapan = JSON.stringify(tahapan);
                    data.cariTender = $('.valTender').val();
                    data.cariHPSUrut = $('.valHPS').val();
                    data.cariOrderBy = JSON.stringify(orderby);
                }
            },
            "columnDefs": [{
                "targets": [2, 4],
                "visible": false,
                "searchable": false
            }],
            "dom": "tr",
            "bDeferRender": true,
            "bFilter": false,
            "bLengthChange": false,
            "bAutoWidth": false,
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);

                let nama_paket = `<strong>` + data[1] +
                    `</strong><p class="sub-data"><i class="bi bi-geo-alt" style="margin-right: 3px;color: #694747;"></i>` +
                    data[2] + `</p>`;
                let jenis = `<strong>` + data[3] + `</strong><p class="sub-data">` + data[4] + `</p>`;

                $('td:eq(0)', row).prop("align", "center");
                $('td:eq(1)', row).html(nama_paket);
                $('td:eq(2)', row).html(jenis);
                $('td:eq(4)', row).prop("align", "right").css({
                    "padding-right": "15px",
                    "color": "#139728",
                    "font-weight": "600"
                });
            },

            drawCallback: function(oSettings) {
                if (oSettings.fnRecordsDisplay() == 0) {
                    $('#tabel-tender_wrapper .dataTables_scroll .dataTables_scrollBody').css(
                        'min-height', '300px');
                    $('#tabel-tender.dataTable td.dataTables_empty').css('padding-bottom', '23px').html(
                        "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada tender yang sesuai"
                    );
                    $('#tabel-tender_wrapper .dataTables_scroll .dataTables_scrollBody').css(
                        'min-height', '170px');
                } else {
                    $('#tabel-tender_wrapper .dataTables_scroll .dataTables_scrollBody').css(
                        'min-height', '0');
                }
            },
            scrollY: 700,
            scrollCollapse: true,
            scroller: true
        });
        // check nilai hps
        function checkboxHps(){
            var checkBoxHps = document.getElementById("checkallhps");
            if (checkBoxHps.checked == true) {
                $('#nilai_hps_akhir').val('Rp 0')
                $('#nilai_hps_awal').val('Rp 0')
                $('.formset-hps').slideUp();
            } else {
                $('.formset-hps').slideDown();
            }
        }
        $('#checkallhps').on('change', function() {
            checkboxHps();
        });
        checkboxHps();
    });
</script>
