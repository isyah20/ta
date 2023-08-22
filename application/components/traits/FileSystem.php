<?php
namespace App\components\traits;

use Symfony\Component\Filesystem\Filesystem as FileHelper;

/**
 * FileSystem
 *
 * FileSystem berisi kumpulan fungsi yang berhubungan sistem file, seperti buat folder, hapus
 * folder, normalisasi nama file sehingga url friendly dll.
 *
 * @author    Agus Susilo <smartgdi@gmail.com>
 * @copyright Copyright (c) 2017 PT. ECC (ecc.co.id)
 */

trait FileSystem
{
    /**
     * Normalisasi nama file sehingga url friendly. contoh: 'Feb, 20 oct 2017_photo.png' akan diubah menjadi
     * feb-20-oct-2017-photo.png
     *
     * @param string nama file
     * @param boolean true|false paksa nama file menjadi lower case semua atau tidak
     * @param boolean true|false hapus semua yang non abjad dan angka atau tidak
     * @param array daftar karakter yang tidak akan dihilangkan/ dibuang
     *
     * @return string nama yang sudah dinormalisasi
     */
    public function sanitizeFileName(
        $string,
        $forceLowerCase = true,
        $anal = false,
        $excludeStripChar = []
    ) {
        $strip = ["~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[",
            "{", "]", "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;",
            "&#8221;", "&#8211;", "&#8212;", "â€”", "â€“", ",", "<", ".", ">", "/", "?", ];

        if (is_array($excludeStripChar) && count($excludeStripChar) > 0) {
            foreach ($strip as $key => $val) {
                if (in_array($val, $excludeStripChar)) {
                    unset($strip[$key]);
                }
            }
        }

        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = preg_replace('/[^\00-\255]+/u', '', $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        if ($forceLowerCase && function_exists('mb_strtolower')) {
            return mb_strtolower($clean, 'UTF-8');
        } elseif ($forceLowerCase && !function_exists('mb_strtolower')) {
            return strtolower($clean);
        }

        return $clean;
    }

    /**
     * Mengambil nama file berdasarkan dot(.)
     *
     * @param string $fileName
     * @return string
     */
    public function extractFileName($fileName): string
    {
        return substr($fileName, 0, strrpos($fileName, '.'));
    }

    /**
     * Mengambil ektensi file berdasarkan titik(.)
     *
     * @param string $fileName
     * @param boolean $withDot sertakan titiknya/tidak
     * @return string ektensi file
     */
    public function extractFileExt($fileName, $withDot = false): string
    {
        if ($withDot) {
            return substr($fileName, strrpos($fileName, '.'));
        }
        return substr($fileName, strrpos($fileName, '.') + 1);
    }

    /**
     * Mengembalikan nama dan tipe file
     *
     * contoh: ```php
     * $imageInfo = $this->extractImageInfo('logo-perusahaan.png');
     * output:
     * Array (
     *   'name' => 'logo-perusahaan',
     *   'type' => 'png',
     * )
     * ```
     * @param string $fileName
     * @return array
     */
    public function extractImageInfo($fileName): array
    {
        return [
            'name' => $this->extractFileName($fileName),
            'type' => $this->extractFileExt($fileName),
        ];
    }

    /**
     * Wrapper Filesystem class
     *
     * dokumentasi lengkapnya bisa dilihat di https://symfony.com/doc/current/components/filesystem.html
     * contoh: ```php
     * class CvBiodata {
     *   use \app\components\traits\FileSystem;
     *
     *   public function savePhoto() {
     *     self::fs()->mkdir('hello/world', 0777);
     *   }
     * }
     * ```
     *
     * @return object Filesystem instance
     */
    public static function fs()
    {
        return new FileHelper();
    }
}
