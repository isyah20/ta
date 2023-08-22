<?php

declare(strict_types=1);
namespace App\components\traits;

/**
 * Whatsapp trait
 *
 * @author Agus Susilo <smartgdi@gmail.com>
 */
trait Whatsapp
{
    public function sendWhatsappMsg(array $args = []): string
    {
        if (count($args) < 1) {
            return '';
        }

        ['nomorWa' => $nomorWa, 'msg' => $msg] = $args;
        $data = [
            'id_device' => $_SERVER['WA_DEVICE_ID'],
            'api-key' => $_SERVER['WA_API_KEY'],
            'no_hp' => $nomorWa,
            'pesan' => $msg,
        ];

        if (isDevProd() || isProduction()) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api.watsap.id/send-message');
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_POST, 1);

            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } else {
            return sprintf('<pre>%s</pre>', print_r($data, true));
        }
    }
}
