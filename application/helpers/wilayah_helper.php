<?php

function getWilayah($id_lpse)
{
    if (
        $id_lpse == 10 || $id_lpse == 57 || $id_lpse == 58 || $id_lpse == 68 || $id_lpse == 72 || $id_lpse == 78 || $id_lpse == 111
        || $id_lpse == 116 || $id_lpse == 122 || $id_lpse == 128 || $id_lpse == 152 || $id_lpse == 162 || $id_lpse == 164 || $id_lpse == 171
    ) {
        return 'Jawa Timur';
    } elseif ($id_lpse == 14 || $id_lpse == 34 || $id_lpse == 93 || $id_lpse == 137 || $id_lpse == 163) {
        return 'Jawa Barat';
    } elseif (
        $id_lpse == 29 || $id_lpse == 32 || $id_lpse == 42 || $id_lpse == 48 || $id_lpse == 51 || $id_lpse == 53 || $id_lpse == 60
        || $id_lpse == 88 || $id_lpse == 90 || $id_lpse == 91 || $id_lpse == 94 || $id_lpse == 104 || $id_lpse == 108 || $id_lpse == 115
        || $id_lpse == 129 || $id_lpse == 138 || $id_lpse == 140 || $id_lpse == 141 || $id_lpse == 146 || $id_lpse == 148 || $id_lpse == 160
    ) {
        return 'Jawa Tengah';
    } elseif ($id_lpse == 13 || $id_lpse == 21 || $id_lpse == 54) {
        return 'Daerah Istimewa Yogyakarta';
    } elseif ($id_lpse == 127) {
        return 'DKI Jakarta';
    } elseif ($id_lpse == 14 || $id_lpse == 98 || $id_lpse == 99) {
        return 'Banten';
    } elseif ($id_lpse == 66) {
        return 'Banten';
    } elseif ($id_lpse == 17 || $id_lpse == 33 || $id_lpse == 113 || $id_lpse == 167) {
        return 'Bali';
    } elseif ($id_lpse == 20 || $id_lpse == 106 || $id_lpse == 151) {
        return 'Aceh';
    } elseif ($id_lpse == 27) {
        return 'Sumatera Utara';
    } elseif ($id_lpse == 16 || $id_lpse == 50 || $id_lpse == 157) {
        return 'Sumatera Barat';
    } elseif (
        $id_lpse == 102 || $id_lpse == 103 || $id_lpse == 107 || $id_lpse == 142 || $id_lpse == 153 || $id_lpse == 156
        || $id_lpse == 168
    ) {
        return 'Sumatera Selatan';
    } elseif ($id_lpse == 70 || $id_lpse == 155) {
        return 'Jambi';
    } elseif ($id_lpse == 19 || $id_lpse == 39 || $id_lpse == 161 || $id_lpse == 165) {
        return 'Riau';
    } elseif ($id_lpse == 22 || $id_lpse == 26 || $id_lpse == 147) {
        return 'Kepulauan Riau';
    } elseif ($id_lpse == 46 || $id_lpse == 121 || $id_lpse == 150 || $id_lpse == 166) {
        return 'Lampung';
    } elseif ($id_lpse == null) {
        return 'Bengkulu';
    } elseif ($id_lpse == 31 || $id_lpse == 86 || $id_lpse == 96 || $id_lpse == 139) {
        return 'Kepulauan Bangka Belitung';
    } elseif ($id_lpse == 37 || $id_lpse == 120 || $id_lpse == 133) {
        return 'Nusa Tenggara Barat';
    } elseif ($id_lpse == 131 || $id_lpse == 135 || $id_lpse == 169) {
        return 'Nusa Tenggara Timur';
    } elseif ($id_lpse == 12) {
        return 'Kalimantan Tengah';
    } elseif ($id_lpse == 23 || $id_lpse == 24 || $id_lpse == 56 || $id_lpse == 59 || $id_lpse == 85 || $id_lpse == 172) {
        return 'Kalimantan Selatan';
    } elseif ($id_lpse == 35 || $id_lpse == 43 || $id_lpse == 52) {
        return 'Kalimantan Timur';
    } elseif ($id_lpse == 62 || $id_lpse == 97 || $id_lpse == 110 || $id_lpse == 118 || $id_lpse == 132 || $id_lpse == 175) {
        return 'Kalimantan Barat';
    } elseif ($id_lpse == null) {
        return 'Kalimantan Utara';
    } elseif ($id_lpse == 30 || $id_lpse == 36 || $id_lpse == 45 || $id_lpse == 174) {
        return 'Sulawesi Selatan';
    } elseif ($id_lpse == 173) {
        return 'Sulawesi Utara';
    } elseif ($id_lpse == null) {
        return 'Sulawesi Barat';
    } elseif ($id_lpse == 81) {
        return 'Sulawesi Tenggara';
    } elseif ($id_lpse == 149 || $id_lpse == 154) {
        return 'Sulawesi Tengah';
    } elseif ($id_lpse == null) {
        return 'Gorontalo';
    } elseif ($id_lpse == null) {
        return 'Maluku';
    } elseif ($id_lpse == null) {
        return 'Maluku Utara';
    } elseif ($id_lpse == 41) {
        return 'Papua';
    } elseif ($id_lpse == null) {
        return 'Papua Barat';
    }
    // return
}
