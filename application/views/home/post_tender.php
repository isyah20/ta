<?php
defined('BASEPATH') or exit('No direct script access allowed');
//application/views/home/post_tender.php
?>

<?php
?>
<input id="totalPage" type="hidden" value="<?=$totalPage?>">
<?php
    foreach ($tender as $tender) :
        ?>
        <div class="row-table d-flex mt-1  px-3 py-2 text-body">
            <div class="col-lg-1 col-kode text-start mx-1"><?= $tender['id_tender'] ?></div>
            <div class="col-lg-4 col-nama text-start mx-1">
                <div class="mb-2 p-0">
                    <a class="p-0" style="font-weight: 500; color:#694747;" href="<?= base_url("tender/" . $tender['id_tender']) ?>"><?= $tender['nama_tender'] ?></a>
                </div>
                <div class="row" style="color:#694747;">
                    <p class="col-1">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </p>
                    <p class="col-10 p-0">
                        <?= $tender['lokasi_pekerjaan'] ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-jenis text-start mx-1">
                <p class="mb-2" style="font-weight: 500;"><?= $tender['jenis_tender'] ?></p>
                <p><?= $tender['metode_pemilihan'] ?></p>
            </div>
            <!-- <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;"><?= $tender['tender_status'] ?></div> -->
            <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
                <!-- Button trigger modal -->
                <a class="m-0 p-0 text-body" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('<?= $tender['id_tender'] ?>', '<?= $tender['nama_tender'] ?>')">
                    <?= $tender['tender_status'] ?>
                </a>
                <script>
                    function modalJadwal(id, nama){
                        $.ajax({
                            method: "POST",
                            url: '<?php echo base_url('home/modalJadwal');?>',
                            data : {
                                sendId : id,
                                sendNama : nama,
                            },
                        })
                        .done(function( content ) {
                            // console.log(content);
                            $(".modal-content").html(content);
                            // $(".body-jadwal").html(content);
                            // $("#modalJadwal").show();
                        });
                    }
                </script>
            </div>
            <div class="col-lg col-hps text-start mx-1">
                <h6 style="font-weight: 700;color:#139728;"><?= "Rp. " . number_format($tender['nilai_hps'], 0, ',', '.'); ?></h6>
            </div>
        </div>
    <?php
    endforeach;
?>
<a class="row-table d-flex mt-1 text-body d-none" id="loader" disable="disabled">
    <div class="col text-center mx-1">Tunggu sebentar ...</div>
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    </div>
  </div>
</div>