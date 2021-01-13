<?php

namespace App\Traits;

trait FCM_Push
{

    public function pushNotif($device_id, $title, $msg)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';
        $SERVER_API_TOKEN = 'AAAAOUfBbKU:APA91bEh6u-Dqa_lU_tZ3BWO4YvywLetACvCqnmpjalSo6nqO7ZbXzPnjVV6cQYajpn65KclS5KDCym4UIEYZ3Szq26FmU0qOHhPgYrRm-RRy367lns_2E-ES1mfTwii9RtN_8NP_Ire';

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
