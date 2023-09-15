<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    .animation {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .thead {
        color: #fff;
        background-color: #E05151;
        text-align: left;
        font-size: 15px;
    }

    tbody {
        text-align: left;
        font-size: 15px;
    }

    .green-text {
        color: #139728;
    }

    .rounded {
        width: 25px;
        height: 25px;
        background-color: #553333;
        border-radius: 10px 10px 10px 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 15px;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);

    }

    .btn-custom {
        padding-left: 10px;
        padding-right: 10px;
        background-color: #EB650D;
        color: #fff;
    }

    .underlined {
        border-collapse: collapse;
        width: 100%;
    }

    .animation {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .thead {
        color: #fff;
        background-color: #E05151;
        text-align: left;
        font-size: 15px;
    }

    tbody {
        text-align: left;
        font-size: 15px;
    }

    .green-text {
        color: #139728;
    }

    .rounded {
        width: 25px;
        height: 25px;
        background-color: #553333;
        border-radius: 10px 10px 10px 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 15px;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);

    }

    .btn-custom {
        padding-left: 10px;
        padding-right: 10px;
        background-color: #EB650D;
        color: #fff;
    }

    .underlined {
        border-collapse: collapse;
        width: 100%;
    }
</style>
<section class="pt-5 mt-5">
    <div class="container pb-3 pt-2 mb-4 border-bottom">
        <div class="col-md-6">
            <h2>Hi Bambang
            </h2>
        </div>
        <!-- <div class="col-6">
            <div class="search">
                <input type="text" class="search__input" placeholder="Type your text">
                <button class="search__button">
                    <svg class="search__icon" aria-hidden="true" style="margin-right: 10px;" viewBox="0 0 24 24">
                        <g>
                            <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div> -->

    </div>
    <!-- table -->
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped custom-table-container">
                        <thead class="thead">
                            <tr>
                                <th class="custom-padding">No.</th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-apartment.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Nama Perusahaan
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-status.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Status
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-priority.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Prioritas
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-date.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Jadwal
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-cp.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Contact Person
                                </th>
                                <th class="custom-padding"></th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-notes.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Catatan
                                </th>
                            </tr>
                        </thead>
                        <tbody id="data-leads">
                            <tr class="my-2">
                                <td><span class="rounded">1</span></td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>Negotiation</td>
                                <td>High</td>
                                <td>02/12/2024</td>
                                <td>0811-2345-6666 (Office)</td>
                                <td>office@telkom.co.id</td>
                                <td>Lancarr Semua Gess</td>
                            </tr>
                            <tr class="my-2">
                                <td><span class="rounded">1</span></td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>Done</td>
                                <td>Very High</td>
                                <td>02/10/2024</td>
                                <td>0811-2345-6666 (Office)</td>
                                <td>office@telkom.co.id</td>
                                <td>Sudah selesai tinggal promosi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="wow fadeInUp" id="pagination-container" data-wow-delay="0.5s"></div>
</section>

<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>