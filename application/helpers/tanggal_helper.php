<?php

function tgl_indo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

function tgl_umum($tanggal)
{
    $bulan = [
        "Januari" => 'January',
        "Februari" => 'February',
        "Maret" => 'March',
        "April" => 'April',
        "Mei" => 'May',
        "Juni" => 'June',
        "Juli" => 'July',
        "Agustus" => 'August',
        "September" => 'September',
        "Oktober" => 'October',
        "November" => 'November',
        "Desember" => 'December',
    ];
    $pecahkan = explode(' ', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[0] . ' ' . $bulan[$pecahkan[1]] . ' ' . $pecahkan[2];
}
