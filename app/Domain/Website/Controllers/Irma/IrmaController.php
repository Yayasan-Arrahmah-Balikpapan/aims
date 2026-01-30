<?php

namespace App\Domain\Website\Controllers\Irma;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Throwable;
use ProtoneMedia\Splade\Facades\SEO;

class IrmaController extends Controller
{
    // public function kirimNotifWaPendaftaran($nomorhp, $uuid){

    // $isipesan = "Assalamualaikum Wr. Wb.,
    //     Terima kasih telah melakukan pendaftaran Lomba Semarak Ramadhan 1447H.
    //     Segera lakukan pembayaran sesuai dengan invoice yang telah diberikan.

    //     Invoice Anda:
    //     ".url('/ramadhan/lomba/invoice/'.$uuid)."

    //     Untuk informasi lebih lanjut, silakan hubungi admin kami.

    //     Ustadzah Widya
    //     wa.me/6285750223866

    //     Ustad Zaky
    //     wa.me/6281649329520

    //     Yayasan Arrahmah Balikpapan
    // ";
    //     $url        = env('WA_API_URL');
    //     $requestApi = Http::withBasicAuth(env('WA_API_USER'), env('WA_API_PASSWORD'))
    //                         ->withHeaders([
    //                             'Content-Type' => 'application/json',
    //                             'Accept'       => 'application/json',
    //                         ]);

    //     try {
    //         $response = $requestApi->post($url . '/send/message', [
    //             "phone" => $nomorhp . '@s.whatsapp.net',
    //             "message" => $isipesan,
    //         ]);
    //         $message = json_decode($response->body());
    //         return response()->json(['success' => true, 'message' => $message], 200);
    //     } catch (Throwable $th) {
    //         return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
    //     }
    // }

    public function index()
    {
        $page_title = 'IRMA Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description('Komunitas remaja masjid Ar Rahmah Balikpapan. Wadah silaturahmi, dakwah kreatif, dan pengembangan diri generasi muda Islam yang aktif dan positif.')
            ->keywords('IRMA Ar Rahmah, Remaja Masjid Balikpapan, Komunitas Pemuda Islam, Dakwah Kreatif, Kegiatan Remaja Masjid, Organisasi Pemuda Balikpapan, Kajian Remaja, Event Islami Balikpapan')
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.irma.index');
    }
}