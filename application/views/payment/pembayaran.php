<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<?php
$userType = 0;
if (!isset($this->session->user_data['id_pengguna'])) {
    $this->session->set_userdata('checkout_url', current_url());
}

$user = null;
$userId = 0;
if ($this->session->userdata('user_data') != null) {
    $user = $this->session->userdata('user_data');
    $userType = $user['jenis_perusahaan'];
    $userId = $user['id_pengguna'];
}
?>
<style>
    .metode-bayar {
        width: 100%;
        min-height: 0px;
        height: auto;
        background: #ffffff;
        border-radius: 10px;
        padding: 30px;
        z-index: 10;
    }

    .metode-bayar .hero {
        position: relative;
        background: #fff;
        border: 1px solid #d21b1b;
        border-radius: 10px;
        z-index: 1;
    }

    .metode-bayar .hero p {
        margin-bottom: 0px;
    }

    .metode-bayar .hero::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 10px 10px 0px;
        border-style: solid;
        border-color: #d21b1b transparent transparent;
        z-index: -1;
    }

    .metode-bayar .featured .discount,
    .metode-bayar .featured-aktif .discount {
        left: 60%;
        top: -10%;
        z-index: 5;
        display: flex;
        height: 40px;
        width: 40px;
        border: 1px solid #064e3b;
        border-radius: 40px;
        background-color: #34d399;
        color: #ffff;
        font-size: 16px;
        font-weight: 500;
        padding: 2px;
        padding-top: 5px;
        margin: auto;
        text-align: center;
        align-items: center;
        justify-content: center;
        transform: rotate(16.06deg);
    }

    textarea:focus,
    textarea.form-control:focus,
    input.form-control:focus,
    input[type=text]:focus,
    input[type=password]:focus,
    input[type=email]:focus,
    input[type=number]:focus,
    [type=text].form-control:focus,
    [type=password].form-control:focus,
    [type=email].form-control:focus,
    [type=tel].form-control:focus,
    [contenteditable].form-control:focus {
        box-shadow: inset 0 -1px 0 #ddd;
    }

    input[type=text]:focus {
        border-color: #dc3545 !important;
    }

    .payment-detail p {
        font-size: 18px;
    }

    .payment-detail p.bayar {
        font-weight: 900;
        color: #d21b1b;
        font-size: 22px;
    }

    .promo input,
    .promo input:focus {
        text-transform: uppercase;
        color: #d21b1b;

    }

    ::placeholder {
        text-transform: none !important;
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        text-transform: none !important;
    }

    ::-ms-input-placeholder {
        /* Microsoft Edge */
        text-transform: none !important;
    }

    .form-check-input:checked[type="checkbox"] {
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB50lEQVR4nLWWO0sEMRDH4wMfaKWCn0BROytLLQVPyH+WgOiB7Z2CnWAjV4mVhY3oF1C0EqzVQjxfpSh+EB+bnBDNbfbw4u3enrsObLHZZX7zn8xkwpg16Xl5SXQngXdFpNM8EniXwK0ElthPU8BBWucqCkq0X1Nio3hVnBc054MspWnOBxVRseozgC0yI7FK57zAMjYFrFhQmYV7klaJFmKgAszp6enO2louN2RBbyzMZSpIqdQugUvr9N4nGqupCv1nAVLAmlMEz5mDfM5HTWqc8t7JFKRNyoiu6tQAL1qI3kxBimjD6ZmK8rwp5590IJ/zcQl8OKCtBsH8HWRK2FSXk7Invbzc0xJIC9FV8bwZsweNQIqo5Gy+kp43GfFvY5CBSKIzG+XxzwY0Zhwax46azSj1kSAFHDo9cRTC9OxstyJ6dNQ8uMEkAxGd/jqFrTIJbDuQD1+IiShIs9T1/+qNwOmFBD6d9fU4SCyoCsvn+8KzK2bOlLUQHalAzWDmyPGJRppBEoFiYcBqEkhiUCOYJDrXjLW1DKoNvlxuKBIWFMiuIjrR8/PDSSF1g08S3Vhqkf3XKAeujaIl+/JqPsQpa0kJsBLOKQksVD+YK1FcKad5JLBXF4W5EpneyOwCGfgKlHwDvgCUsjjkiJzKHQAAAABJRU5ErkJggg==');
        border-color: #fff !important;
    }
</style>
<section id="payment" class="payment">
    <div class="container-lg py-5 mt-5">
        <div class="row">
            <div class="col-lg-8 mb-3">
                <div class="metode-bayar">
                    <a href="<?= base_url("pricing_plan") ?>">
                        <img src="<?= base_url("assets/img/back.png") ?>" width="40" alt="">
                    </a>
                    <h5 class="text-center">
                        <span style="font-size:26px; font-weight:700">BERLANGGANAN PREMIUM </span>
                        <span style="color:#AF2D1A;font-size:26px; font-weight:700">tender</span>
                        <span style="font-size:26px; font-weight:700">+</span>
                    </h5>

                    <div class="row mb-3" id="list-bulan">

                    </div>

                    <!--FITUR APA SAJA-->

                    <h5 class="text-center mb-3">
                        <span style="font-size:26px; font-weight:700">PILIH FITUR YANG ANDA INGINKAN DI </span>
                        <span style="color:#AF2D1A;font-size:26px; font-weight:700">tender</span>
                        <span style="font-size:26px; font-weight:700">+</span>
                    </h5>
                    <div class="row mb-3" id="list-fitur">
                    </div>
                </div>
            </div>
            <div class="offset-md-3 col-md-6 col-lg-4 offset-lg-0 mb-4">
                <div class="payment-detail justify-content-center shadow rounded-3 p-3 bg-white">
                    <h5 class="text-center fw-bold"> DETAIL PEMBAYARAN</h5>
                    <div class="row mt-4">
                        <div class="col-7">
                            <p>Sub Total</p>
                        </div>
                        <div class="col-5 text-end">
                            <p class="harga">Rp 0</p>
                        </div>
                    </div>
                    <div class="row d-none" id="diskon">
                        <div class="col-7">
                            <p>Diskon</p>
                        </div>
                        <div class="col-5 text-end">
                            <p class="diskon">Rp 0</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <p>PPN 11%</p>
                        </div>
                        <div class="col-5 text-end">
                            <p class="ppn">Rp 0</p>
                        </div>
                    </div>
                    <div class="promo">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control shadow-none" id="kode_promo" name="kode_promo" placeholder="Memiliki kode promo?" aria-describedby="button-addon2">
                            <button class="btn btn-outline-danger fw-bold" type="button" id="btn-promo" disabled="true">Gunakan</button>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <p class="bayar" style="color: #212529;">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="bayar total"><b>Rp 0</b></p>
                        </div>
                    </div>
                    <input type="hidden" id="text_kode" name="text_kode">
                    <input type="hidden" id="text_bulan" name="text_bulan">
                    <input type="hidden" id="text_harga" name="text_harga">
                    <input type="hidden" id="text_ppn" name="text_ppn">
                    <input type="hidden" id="text_diskon" name="text_diskon">
                    <input type="hidden" id="text_diskon_persen" name="text_diskon_persen">
                    <input type="hidden" id="text_total" name="text_total">
                    <a href="javascript:void(0);" class="payment-button mt-4 mb-4 fw-semibold fs-5 rounded-3 d-block text-white text-center py-2" id="btn-bayar">Bayar</a>

                    <div class="row" id="pending-warning" style="display: none;">
                        <div class="col-12">
                            <p class="text-danger">Terdapat pembayaran yang pending!.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="lengkapi-profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Lengkapi Profil</h1>
                </div>
                <div class="modal-body">
                    <div id="isi-nama">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan">
                        </div>
                    </div>
                    <div id="isi-npwp">
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">NPWP Perusahaan</label>
                            <input type="text" class="form-control" name="npwp_perusahaan" id="npwp_perusahaan">
                        </div>
                    </div>
                    <small style="color: #b21b1b;">Anda setuju bahwa data yang Anda berikan adalah data yang valid dan dapat dipertanggungjawabkan</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="simpan-profile">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-af2Q_JsCb0OOmhTq"></script>
<script defer src="<?= base_url() ?>assets/js/alpine-3.12.0.js"></script>
<script>
    const userType = <?= $userType ?>;
    const userId = <?= $userId ?>;
    const ENT_BUSINESS_CONSULTANT = 1;
    const PERSONAL_CONSULTANT = 2;
    const CONTRACTOR = 3;

    document.addEventListener('alpine:init', () => {
        Alpine.store('payment', {
            userId: 0,
            listSelectedPkg: [],
        });
    })

    $(document).ready(function() {
        let id_paket = sessionStorage.getItem('paket_pembelian');
        if (id_paket == null) {
            window.location.href = `${base_url}pricing_plan`;
        } else if (id_paket == 3) {
            window.location.href = "https://wa.me/6281804180069?text=Halo%20Tim%20Tenderplus.id%2C%20Saya%20ingin%20berlangganan%20%2APaket%20Premium%2A%20akun%20asosiasi.%20Apakah%20saya%20bisa%20mendapatkan%20informasi%20lebih%20lanjut%3F%20Terima%20kasih";
        } else {
            getBulan();
            getFitur();
        }
    });

    $("#list-bulan").on('click', '.col.month', function() {
        let id_paket = sessionStorage.getItem('paket_pembelian');
        let total = 0;
        let bulan = $(this).data('bulan');
        const radio = $(this).find('input[type=radio]');

        // ubah status checkbox
        radio.prop('checked', !radio.prop('checked'));

        $('input[type=checkbox]:checked').each(function() {
            // ambil harga dari atribut data-harga
            var harga = parseInt($(this).parent().parent().parent().data('harga'));

            // tambahkan harga ke total
            total += harga;
        });
        $('.col.month').removeClass('aktif');
        $('.durasi.price').removeClass('aktif-white');
        $('.durasi.hargaa').removeClass('text-white');
        $(this).addClass('aktif');
        $(this).find('.price').addClass('aktif-white');
        $(this).find('.hargaa').addClass('text-white');
        $('#id_paket').val(id_paket);
        hitung(total, bulan);
    });


    const addPkg = (id) => {
        const listPkg = Alpine.store('listSelectedPkg')
        if (Array.isArray(listPkg)) {
            listPkg.push(id)
            Alpine.store('listSelectedPkg', listPkg)
        } else {
            Alpine.store('listSelectedPkg', [id])
        }
    }

    const removePkg = (id) => {
        const listPkg = Alpine.store('listSelectedPkg')
        const filtered = listPkg.filter(val => val != id)
        Alpine.store('listSelectedPkg', filtered)
    }

    $("#list-fitur").on('click', '.col.featured', function() {
        //console.log('list-fitur .col.featured')
        // let id_paket = sessionStorage.getItem('paket_pembelian');
        let total = 0;
        let bulan = $(".col.month.aktif").data('bulan');
        const checkbox = $(this).find('input[type=checkbox]');

        checkbox.prop('checked', !checkbox.prop('checked'));

        const colFeat = $(this)
        $('input[type=checkbox]:checked').each(function() {
            var harga = parseInt($(this).parent().parent().parent().data('harga'));
            total += harga;
        });

        const listPkg = Alpine.store('listSelectedPkg')
        if ($(this).hasClass('aktif')) {
            $(this).removeClass('aktif');
            $(this).find('.price').removeClass('aktif-white');
            hitung(total, bulan);
            removePkg(parseInt(colFeat.attr('id-pkg')))
        } else {
            $(this).addClass('aktif');
            $(this).find('.price').addClass('aktif-white');
            hitung(total, bulan);
            addPkg(parseInt(colFeat.attr('id-pkg')))
        }
    });

    $("#list-fitur").on('click', 'input[type=checkbox]', function() {
        const checkbox = $(this);
        checkbox.prop('checked', !checkbox.prop('checked'));
    });

    $("#list-bulan").on('click', 'input[type=radio]', function() {
        const radio = $(this);
        radio.prop('checked', !radio.prop('checked'));
    });

    function hitung(harga, bulan) {
        let tipe = sessionStorage.getItem('paket_pembelian');
        var harga = 120000;
        if (tipe == 4) {
            harga = 1000000;
        }
        const TAX = 0.11

        const val_diskon = $('#text_diskon_persen').val();
        const val_diskon2 = val_diskon != '' ? val_diskon : 0;
        let dataFeature = [];
        var elFeature = document.querySelectorAll('.aktif.feature');
        elFeature.forEach(function(element) {
            dataFeature.push(parseInt(element.getAttribute('data-harga')));
        });
        let featureTotal = dataFeature.reduce(function(acc, current) {
            return acc + current;
        }, 0);
        if (tipe != 4 && elFeature.length > 1) {
            harga + featureTotal;
        }
        let total6 = parseInt(harga * 6);
        let per12bulan = parseInt(harga - (0.25 * harga));
        let total12 = parseInt(per12bulan * 12);
        let per24bulan = parseInt(harga - (0.375 * harga));
        let total24 = parseInt(per24bulan * 24);
        let total26 = parseInt((harga * 6) / (1 - 0.10));
        let total212 = parseInt((total6 * 2) / (1 - 0.25));
        let total224 = parseInt((total12 * 2) / (1 - 0.60));
        if (tipe == 4) {
            per12bulan = 900000;
            total12 = 10800000;
            per24bulan = 700000;
            total24 = 16800000;
            total212 = 12000000;
            total224 = 24000000;
        }
        let subtotal = 0;
        if (bulan == 6) {
            subtotal = total6
        } else if (bulan == 12) {
            subtotal = total12
        } else {
            subtotal = total24
        }
        let diskon = parseInt(subtotal * (val_diskon2 / 100));
        let ppn = parseInt((subtotal - diskon) * TAX);
        let total = parseInt((subtotal + ppn - diskon));

        $('p#harga').each(function() {
            $(this).html(harga.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).replace(/\,00/, '') + "/Bulan");
        });
        $('#harga-6bulan').html(harga.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, '/Bulan'));
        $('#total6').html(total6.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        $('#harga-12bulan').html(per12bulan.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, '/Bulan'));
        $('#total12').html(total12.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        $('#harga-24bulan').html(per24bulan.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, '/Bulan'));
        $('#total24').html(total24.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        //$('#total26').html(total26.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).replace(/\,00/, ''));
        $('#total212').html(total212.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        $('#total224').html(total224.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        let checkboxes = document.getElementsByName('inlineCheckboxOptions');
        let selectedCheckboxes = Array.from(checkboxes).filter((checkbox) => checkbox.checked).map((checkbox) => checkbox.value);
        let radio = $('input[name="inlineRadioOptions"]:checked').val();
        $(".harga").html(subtotal.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        $(".ppn").html(ppn.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        // $(".lama").html(bulan + " Bulan");
        $(".diskon").html(diskon.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        $(".total").html(total.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).replace(/\,00/, ''));
        $("#text_bulan").val(bulan);
        $("#text_harga").val(subtotal);
        $("#text_ppn").val(ppn);
        $("#text_diskon").val(diskon);
        $("#text_total").val(total);
        let hemat12 = 'Hemat 25%'
        let hemat24 = 'Hemat 28%'
        if (tipe == 4) {
            hemat12 = 'Hemat 10%'
            hemat24 = 'Hemat 30%'
        }
        $("#hemat12").text(hemat12)
        $("#hemat24").text(hemat24)
    }

    function checkOrder(userId) {
        if (userId < 1) {
            return;
        }

        const listPkgId = Alpine.store('listSelectedPkg')
        return new Promise((resolve, reject) => {
            $.ajax({
                    url: `${base_url}payment/check-order/${userId}`,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        list_pkg_id: listPkgId
                    }
                })
                .done(resp => resolve(resp))
                .fail(err => reject(err))
        })
    }

    function Bayar() {
        let id_paket = sessionStorage.getItem('paket_pembelian');
        let kategori = <?= (!isset($this->session->user_data['kategori'])) ? '0' : $this->session->user_data['kategori'] ?>;
        let id_pengguna = <?= (!isset($this->session->user_data['id_pengguna'])) ? '0' : $this->session->user_data['id_pengguna'] ?>;
        if (id_pengguna == '0') {
            window.location.href = `${base_url}login`;
        } else {

            if (id_paket != kategori) {
                sessionStorage.setItem('paket_pembelian', kategori);
                var akun = '';
                var link = '';
                var akun2 = '';
                switch (kategori) {
                    case 2:
                        akun = 'penyedia jasa';
                        link = '<?= base_url('pembayaran') ?>';
                        akun2 = 'supplier';
                        break;
                    case 3:
                        akun = 'asosiasi';
                        link = 'https://wa.me/6281804180069?text=Halo%20Tim%20Tenderplus.id%2C%20Saya%20ingin%20berlangganan%20%2APaket%20Premium%2A%20akun%20asosiasi.%20Apakah%20saya%20bisa%20mendapatkan%20informasi%20lebih%20lanjut%3F%20Terima%20kasih';
                        break;
                    default:
                        akun = 'supplier';
                        link = '<?= base_url('pembayaran') ?>';
                        akun2 = 'penyedia jasa';
                }
                Swal.fire({
                    icon: 'warning',
                    html: 'Akun anda terdaftar sebagai <b>' + akun + "</b>",
                    confirmButtonText: 'Daftar sebagai ' + akun2,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = `${base_url}newaccount`;
                    }
                })
            } else {
                ceknpwp();
            }
        }
    }

    $('#btn-bayar').on('click', function(evt) {
        if (userId < 1) {
            window.location.href = `${base_url}login`;
            return evt.preventDefault();
        }

        checkOrder(userId).then(resp => {
                if (resp.error_code == 0) {
                    Bayar()
                }
            })
            .catch(err => {
                console.log(err)
                $('#pending-warning').show();
                setTimeout(() => {
                    $('#pending-warning').hide();
                }, 10000)
            });

        return evt.preventDefault();
    });

    function generateSnap() {
        let nama_customer = $('#nama_perusahaan').val();
        let email = '<?= (!isset($this->session->user_data['email'])) ? 0 : $this->session->user_data['email'] ?>';
        let bulan = $("#text_bulan").val();
        let harga = $("#text_harga").val();
        let ppn = $("#text_ppn").val();
        let diskon = $("#text_diskon").val();
        let total = $("#text_total").val();
        let kode_promo = $('#text_kode').val();
        $.ajax({
            url: "<?= base_url('bayartagihan') ?>",
            cache: false,
            type: "POST",
            data: {
                "nama_pengguna": nama_customer,
                "email": email,
                "durasi_bulan": bulan,
                "harga": harga,
                "ppn": ppn,
                "diskon": diskon,
                "kode_promo": kode_promo.toUpperCase(),
                "total": total
            },
            dataType: "JSON",
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $.LoadingOverlay("hide");
                snap.pay(data, {
                    onSuccess: function(result) {
                        // lanjutBayar(result);
                        // console.log(data);
                        // console.log(result);
                        lanjutBayar(data, JSON.stringify(result));
                    },
                    onPending: function(result) {
                        // console.log(data);
                        // console.log(result);
                        lanjutBayar(data, JSON.stringify(result));
                        // lanjutBayar(result);
                    },
                    onError: function(result) {
                        // console.log(data);
                        // console.log(result);
                        lanjutBayar(data, JSON.stringify(result));
                        // lanjutBayar(result);
                    }
                });
            }
        });
    }

    function lanjutBayar(snapToken, result) {
        let nama_customer = $('#nama_perusahaan').val();
        let email = '<?= (!isset($this->session->user_data['email'])) ? 0 : $this->session->user_data['email'] ?>';
        let bulan = $("#text_bulan").val();
        let harga = $("#text_harga").val();
        let ppn = $("#text_ppn").val();
        let diskon = $("#text_diskon").val();
        let total = $("#text_total").val();
        let kode_promo = $('#text_kode').val();
        let checkboxes = document.getElementsByName('inlineCheckboxOptions');
        let selectedCheckboxes = Array.from(checkboxes).filter((checkbox) => checkbox.checked).map((checkbox) => checkbox.value);

        $.ajax({
                url: `${base_url}lanjutbayar`,
                cache: false,
                type: "POST",
                data: {
                    "nama_pengguna": nama_customer,
                    "email": email,
                    "durasi_bulan": bulan,
                    "harga": harga,
                    "ppn": ppn,
                    "diskon": diskon,
                    "kode_promo": kode_promo.toUpperCase(),
                    "total": total,
                    "token": snapToken,
                    "result": result,
                    "detail_order": JSON.stringify(selectedCheckboxes)
                },
                dataType: "JSON"
            }).done(resp => {})
            .fail(err => console.log(err))
    }

    function Tooltips() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    }

    function getFitur() {
        let id_paket = sessionStorage.getItem('paket_pembelian');
        $('#list-fitur').html('');
        drawhtml = '';
        $.ajax({
            url: "<?= base_url('getFitur/') ?>" + id_paket,
            type: "GET",
            dataType: "JSON",
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $.LoadingOverlay("hide");
                drawhtml += `<div class="col col-md-4 featured-aktif aktif feature" data-harga="${data[0].harga}" id-pkg="${data[0].id_paket_pembelian}">
                        <div class="box px-2 py-4 text-center hover-scale h-100 d-flex align-items-center">
                            <img class="selected" src="${base_url}assets/img/check_circle_icon.png" width="40" alt="">
                            <div class="w-100">
                                <img src="${base_url}assets/img/logomark-tenderplus-white.png" width="40" alt="">
                                <input class="form-check-input d-none" type="checkbox" name="inlineCheckboxOptions" id="inlineCheckbox${data[0].id_paket_pembelian}" value="${data[0].id_paket_pembelian}" checked="true" disabled="true">
                                <p class="mt-3 mb-2">${data[0].nama_paket}</p>
                                <!--<div class="price aktif-white d-inline-block py-1 px-2">
                                    <p class="m-0" id="notif-tender">Rp ${number_format(data[0].harga, 0, ',', '.')}/Bulan</p>
                                </div>--!>
                            </div>
                        </div>
                    </div>`;
                addPkg(parseInt(data[0].id_paket_pembelian))
                for (let val of data.slice(1)) {
                    const pkgId = parseInt(val.id_paket_pembelian)
                    //const disabledFeature = userType == 0 || [CONTRACTOR, PERSONAL_CONSULTANT].indexOf(userType) >= 0
                    const disabledFeature = 'disabled'
                    drawhtml += `<div class="col col-md-4 feature ${disabledFeature ? 'disabled':'featured'}" data-harga="${val.harga}" id-pkg="${pkgId}">
                        <div class="box px-2 py-4 text-center ${disabledFeature ? '':'hover-scale'} h-100 d-flex align-items-center" ${disabledFeature ? 'data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Fitur ini tidak dapat digunakan"':''}>
                            <img class="selected" src="${base_url}assets/img/${disabledFeature ? 'close-icon.png':'check_circle_icon.png'}" width="40" alt="">
                            <div class="w-100">
                                <img src="${base_url}assets/img/logomark-tenderplus-white.png" width="40" alt="">
                                <input class="form-check-input d-none" type="checkbox" name="inlineCheckboxOptions" id="inlineCheckbox${val.id_paket_pembelian}" value="${val.id_paket_pembelian}" ${disabledFeature ? 'disabled':''}">
                                <p class="mt-3 mb-2">${val.nama_paket}</p>
                                <div class="price d-inline-block py-1 px-2">
                                    <p class="m-0"> Coming Soon </p>
                                </div>
                            </div>
                        </div>
                    </div>`;
                }
                $('#list-fitur').html(drawhtml);
                // $('#list-fitur > div').each(function (index, item) {
                //     const id = parseInt($(item).attr('id-pkg'))
                //     const unchecked = [2, 3].indexOf(id) >= 0
                //     if (unchecked) {
                //         $(item).trigger('click')
                //     }
                // })

                let total = 0;
                let bulan = $(".col.month.aktif").data('bulan');

                $('input[type=checkbox]:checked').each(function() {
                    // ambil harga dari atribut data-harga
                    var harga = parseInt($(this).parent().parent().parent().data('harga'));
                    // tambahkan harga ke total
                    total += harga;
                });
                hitung(total, bulan);
                let selectPkt = $('#total12').text();
                let intSlctPkt = parseInt(selectPkt.replace(/\D/g, ''));
                let selectFit = $('#notif-tender').text();
                let intSlctFit = parseInt(selectFit.replace(/\D/g, ''));
                let hargaAwal = intSlctPkt;
                let ppnAwal = hargaAwal * 0.11;
                let totalAwal = hargaAwal + ppnAwal;
                $(".harga").html(hargaAwal.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).replace(/\,00/, ''));
                $(".ppn").html(ppnAwal.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).replace(/\,00/, ''));
                $(".total").html(totalAwal.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).replace(/\,00/, ''));

                $('#list-fitur div[id-pkg] input[type="checkbox"]').each(function(index, item) {
                    let pkgId = $(item).parents('div[id-pkg]').attr('id-pkg')
                    pkgId = parseInt(pkgId)
                    if ((userType == 0 || [PERSONAL_CONSULTANT, CONTRACTOR].indexOf(userType) >= 0) && [2, 3].indexOf(pkgId) >= 0) {
                        $(item).attr('disabled', 'true');
                        const myTimeout = setTimeout(Tooltips, 1000);
                    }
                })
            }
        });
    }

    function number_format(number, decimals, decPoint, thousandsSep) {
        decimals = decimals || 0;
        number = parseFloat(number);

        if (!decPoint || !thousandsSep) {
            decPoint = '.';
            thousandsSep = ',';
        }

        var roundedNumber = Math.round(Math.abs(number) * ('1e' + decimals)) + '';
        var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
        var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
        var formattedNumber = "";

        while (numbersString.length > 3) {
            formattedNumber += thousandsSep + numbersString.slice(-3)
            numbersString = numbersString.slice(0, -3);
        }

        return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
    }


    function getBulan() {
        $('#list-bulan').html('');
        var drawhtml = `<div class="col col-md-4 p-2 month mb-3" data-bulan="6">
                            <div class="box box-package p-2 text-center hover-scale" style="margin-top: 70px; height: 150px;">
                                <img src="<?= base_url("assets/img/logomark-tenderplus-white.png") ?>" width="40" alt="">
                                <input class="form-check-input d-none" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="6">
                                <label for="inlineRadio3" class="d-block"><h5>6 Bulan</h5></label>
                                <div class="durasi price d-inline-block py-1 px-2">
                                    <p id="harga-6bulan" class="m-0">Rp 0,-/Bulan</p>
                                </div>
                                <h4 class="durasi hargaa mt-4" id="total6">Rp 0,-</h4>
                            </div>
                        </div>
                        <div class="col col-md-4 p-2 month mb-3 aktif" data-bulan="12">
                            <div class="hero aktif mb-4 hover-scale">
                                <div class="box p-2 text-center">
                                    <div class="col-md-auto">
                                        <label for="inlineRadio4" style="" id="hemat12">Hemat <strong>25%</strong></label>
                                    </div>
                                    <img src="<?= base_url("assets/img/check_circle_icon.png") ?>" width="40" alt="">
                                </div>
                            </div>
                            <div class="box box-package p-2 text-center hover-scale">
                                <img src="<?= base_url("assets/img/logomark-tenderplus-white.png") ?>" width="40" alt="">
                                <input class="form-check-input d-none" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="12" checked="true">
                                <label for="inlineRadio4" class="d-block"><h5>12 Bulan</h5></label>
                                <div class="durasi price d-inline-block py-1 px-2">
                                    <p id="harga-12bulan" class="m-0">Rp 0,-/Bulan</p>
                                </div>
                                <h6 class="durasi hargaa my-2 text-white" id='total212'>Rp 0,-</h6>
                                <h4 class="durasi hargaa" id="total12">Rp 0,-</h4>
                            </div>
                        </div>

                        <div class="col col-md-4 p-2 month mb-3" data-bulan="24">
                            <div class="hero aktif mb-4 hover-scale">
                                <div class="box p-2 text-center">
                                    <div class="col-md-auto">
                                        <label for="inlineRadio5" style="" id="hemat24">Hemat <strong>60%</strong></label>
                                    </div>
                                    <img src="<?= base_url("assets/img/check_circle_icon.png") ?>" width="40" alt="">
                                </div>
                            </div>
                            <div class="box box-package p-2 text-center hover-scale">
                                <img src="<?= base_url("assets/img/logomark-tenderplus-white.png") ?>" width="40" alt="">
                                <input class="form-check-input d-none" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="24">
                                <label for="inlineRadio5" class="d-block"><h5>24 Bulan</h5></label>
                                <div class="durasi price d-inline-block py-1 px-2">
                                    <p id="harga-24bulan" class="m-0">Rp 0,-/Bulan</p>
                                </div>
                                <h6 class="durasi hargaa my-2 text-black" id="total224">Rp 0,-</h6>
                                <h4 class="durasi hargaa" id="total24">Rp 0,-</h4>
                            </div>
                        </div>`;
        $('#list-bulan').html(drawhtml);
    }

    $('#kode_promo').on('input', function(e) {
        let bulan = $('#text_bulan').val();
        let harga = $('#text_harga').val() / bulan;
        if ($(this).val() == '') {
            $('#text_diskon_persen').val(0);
            $('#text_kode').val('');
            $('#btn-promo').attr('disabled', 'disabled');
            $('#text_diskon_persen').val('');
            $('#text_kode').val('');
            if (!$('#diskon').hasClass('d-none')) {
                $('#diskon').addClass('d-none');
            }
            hitung(harga, bulan);
        } else $('#btn-promo').removeAttr('disabled');
    }).keypress(function(e) {
        if (e.which == 13) {
            $('#btn-promo').click();
        }
    });

    $('#btn-promo').on('click', function() {
        $('#text_kode').val($('#kode_promo').val());
        cekPromo();
    })

    function cekPromo() {
        let kode_promo = $('#kode_promo').val();
        let bulan = $('#text_bulan').val();
        let harga = $('#text_harga').val() / bulan;
        if (kode_promo != '') {
            $.ajax({
                url: "<?= base_url('cek-promo/') ?>" + kode_promo,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data != null) {
                        if (data.status == '1') {
                            if (data.kuota > 0) {
                                $('#text_diskon_persen').val(data.diskon);
                                $('#text_kode').val(kode_promo);

                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'success',
                                    title: 'Kode promo berhasil digunakan',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                $('#diskon').removeClass('d-none')
                                hitung(harga, bulan)
                            } else {
                                $('#text_diskon_persen').val('');
                                $('#text_kode').val('');
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'info',
                                    title: 'Kuota kode promo telah habis',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                hitung(harga, bulan);
                            }
                        } else if (data.status == '0') {
                            $('#text_diskon_persen').val('');
                            $('#text_kode').val('');
                            Swal.fire({
                                position: 'center-center',
                                icon: 'info',
                                title: 'Periode promo belum dimulai',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            hitung(harga, bulan);
                        } else {
                            $('#text_diskon_persen').val('');
                            $('#text_kode').val('');
                            Swal.fire({
                                position: 'center-center',
                                icon: 'info',
                                title: 'Periode promo telah berakhir',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            hitung(harga, bulan);
                        }
                    } else {
                        $('#text_diskon_persen').val('');
                        $('#text_kode').val('');
                        Swal.fire({
                            position: 'center-center',
                            icon: 'info',
                            title: 'Kode promo tidak ditemukan',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        hitung(harga, bulan);
                    }
                }
            });
        }
    }

    // NOTE: Pengisian NPWP dipindah ke halaman dashboard user.
    function ceknpwp() {
        generateSnap();
        //
        // let kategori = <?= (!isset($this->session->user_data['kategori'])) ? '0' : $this->session->user_data['kategori'] ?>;
        // if (kategori == 2){
        //     $.ajax({
        //       url: "<?= base_url('penggunaNpwp') ?>",
        //       type: "GET",
        //       dataType: "JSON",
        //       success: function(data) {
        //           if((data.npwp == null || data.npwp == '') && (data.nama == null || data.nama == '')){
        //               $('#lengkapi-profile').modal('show');
        //           } else if ((data.npwp == null || data.npwp == '') && (data.nama != null || data.nama != '')){
        //               $('#nama_perusahaan').val(data.nama);
        //               $('#lengkapi-profile').modal('show');
        //               $('#isi-nama').hide();
        //           } else {
        //               $('#nama_perusahaan').val(data.nama);
        //               $('#npwp_perusahaan').val(data.npwp);
        //               generateSnap();
        //           }
        //       }
        //     })
        // } else {
        //     $.ajax({
        //       url: "<?= base_url('penggunaNpwp') ?>",
        //       type: "GET",
        //       dataType: "JSON",
        //       success: function(data) {
        //           if(data.nama == null || data.nama == ''){
        //               $('#lengkapi-profile').modal('show');
        //               $('#isi-npwp').hide();
        //           } else {
        //               $('#nama_perusahaan').val(data.nama);
        //               $('#npwp_perusahaan').val(data.npwp);
        //               generateSnap();
        //           }
        //       }
        //     })
        // }
    }

    $('#isi-npwp').find('input[name="npwp_perusahaan"]').inputmask({
        mask: '9{2}.9{3}.9{3}.9{1}-9{3}.9{3}',
        greedy: false,
        definitions: {
            '9': {
                validator: '[0-9]',
                cardinality: 1
            }
        }
    });

    $('#simpan-profile').on('click', function(e) {
        e.preventDefault();
        let nama = $('#nama_perusahaan').val();
        let npwp = $('#npwp_perusahaan').val() === '' ? "" : $('#npwp_perusahaan').val();
        $.ajax({
            url: `${base_url}updateProfil/${userId}`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "npwp": npwp
            },
            dataType: "JSON",
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $.LoadingOverlay("hide");
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: 'Berhasil menyimpan data',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('#lengkapi-profile').modal('hide');
                generateSnap();
            }
        })
    })
</script>