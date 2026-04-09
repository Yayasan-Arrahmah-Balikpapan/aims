<?php

namespace App\Services;
use App\Contracts\NotificationService;
use Illuminate\Support\Facades\Http;

use Throwable;


class WhatsappService implements NotificationService
{

    public function kirimNotifWa($nomorhp, $isipesan){
        // $apikey     = env('WAHA_API_KEY');
        // $url        = env('WAHA_API_URL');
        // $sessionApi = env('WAHA_API_SESSION');
        // $requestApi = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Accept'       => 'application/json',
        //     'X-Api-Key'    => $apikey,
        // ]);

        // // SOP based on https://waha.devlike.pro/docs/overview/how-to-avoid-blocking/

        // try {
        //     #1 Send Seen
        // $data = [
        //     "session" => $sessionApi,
        //     "chatId" => $nomorhp . '@c.us',
        // ];

        // // $requestApi->post($url . '/api/sendSeen', $data);

        // // $requestApi->post($url . '/api/startTyping', $data);

        // // sleep(3);

        // // $requestApi->post($url . '/api/stopTyping', $data);

        // $requestApi->post($url . '/api/sendText', array_merge($data, [
        //     "text" => $isipesan,
        // ]));
        // // $requestApi->get($url.'/api/sendText', [
        //     //     "session" => $sessionApi,
        //     //     "phone"  => $nomorhp.'@c.us',
        //     //     "text"    => $isipesan,
        //     // ]);
        // } catch (Throwable $th) {
        //     // throw $th;
        //     // bypass error
        // }

        $url        = env('WA_API_URL');
        $requestApi = Http::withBasicAuth(env('WA_API_USER'), env('WA_API_PASSWORD'))
                            ->withHeaders([
                                'Content-Type' => 'application/json',
                                'Accept'       => 'application/json',
                                'X-Device-Id'  => env('WA_API_DEVICE'),
                            ]);

        try {
            $response = $requestApi->post($url . '/send/message', [
                "phone" => $nomorhp . '@s.whatsapp.net',
                "message" => $isipesan,
            ]);
            $message = json_decode($response->body());
            return response()->json(['success' => true, 'message' => $message], 200);
        } catch (Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}

