<?php

namespace App\Traits;

trait FCM_Push
{

    public function pushNotif($device_id, $title, $msg)
    {

          
        $path = __DIR__.'\config.json';    

        $pathJson = file_get_contents($path);

        $json = json_decode($pathJson, true);

        $url = 'https://fcm.googleapis.com/fcm/send';
        $SERVER_API_TOKEN = $json['server_key'];

        // dd($SERVER_API_TOKEN);
        $data = [
            "registration_ids" => $device_id,
            'priority' => 'high',
            'data' => [
                'click_action'  => 'FLUTTER_NOTIFICATION_CLICK',
                'title' => $title,
                'body' => $msg,
            ],
        ];

        $data_json = json_encode($data);

        $header = [
            'Authorization : key=' . $SERVER_API_TOKEN,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

        $response = curl_exec($ch);

        return $response;
    }
}
