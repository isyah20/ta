<script>
    $(document).ready(function() {
        $('#submit-input-kriteria').click(function(event) {
            event.preventDefault();

            var criteriaName = $('input[name=nama_kriteria]').val();
            var weight = $('input[name=bobot]').val();

            // Debugging: Cek nilai input
            console.log("Nama Kriteria: " + criteriaName);
            console.log("Bobot: " + weight);

            if (!criteriaName || !weight) {
                alert("Please fill in all fields correctly.");
            } else {
                $.ajax({
                    url: '<?= base_url("Ahp/add_kriteria") ?>',
                    type: 'POST',
                    data: {
                        nama_kriteria: criteriaName,
                        bobot: weight
                    },
                    beforeSend: addAuthorizationHeader,
                    success: function(response) {
                        console.log("Server Response: ", response);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: ", xhr.responseText);
                    }
                });
            }
        });

        $('#submit-input-alternatif').click(function(event) {
            event.preventDefault();

            var riwayatPerusahaan = $('input[name=riwayat_perusahaan]').val();
            var riwayatMenang = $('input[name=riwayat_menang]').val();
            var lokasiTender = $('input[name=lokasi_tender]').val();
            var nilaiHps = $('input[name=nilai_hps]').val();

            // Debugging: Cek nilai input
            console.log("Riwayat Perusahaan: " + riwayatPerusahaan);
            console.log("Riwayat Menang: " + riwayatMenang);
            console.log("Lokasi Tender: " + lokasiTender);
            console.log("Nilai HPS: " + nilaiHps);

            if (!riwayatPerusahaan || !riwayatMenang || !lokasiTender || !nilaiHps) {
                alert("Please fill in all fields correctly.");
            } else {
                $.ajax({
                    url: '<?= base_url("Ahp/add_alternatif") ?>',
                    type: 'POST',
                    data: {
                        riwayat_perusahaan: riwayatPerusahaan,
                        riwayat_menang: riwayatMenang,
                        lokasi_tender: lokasiTender,
                        nilai_hps: nilaiHps
                    },
                    beforeSend: addAuthorizationHeader,
                    success: function(response) {
                        console.log("Server Response: ", response);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: ", xhr.responseText);
                    }
                });
            }
        });
    });
</script>