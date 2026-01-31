<?php

namespace App\Domain\Website\Controllers\Irma;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use ProtoneMedia\Splade\Facades\SEO;
use App\Models\DaftarAnggotaIrma;
use Illuminate\Support\Facades\Validator;

class IrmaController extends Controller
{
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

    public function daftar_anggota()
    {
        $page_title = 'Pendaftaran Anggota IRMA Arrahmah Balikpapan';
        SEO::title($page_title)
            ->description('Komunitas remaja masjid Ar Rahmah Balikpapan. Wadah silaturahmi, dakwah kreatif, dan pengembangan diri generasi muda Islam yang aktif dan positif.')
            ->keywords('IRMA Ar Rahmah, Remaja Masjid Balikpapan, Komunitas Pemuda Islam, Dakwah Kreatif, Kegiatan Remaja Masjid, Organisasi Pemuda Balikpapan, Kajian Remaja, Event Islami Balikpapan')
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('arrahmahbalikpapan.or.id')
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.irma.daftar-anggota');
    }

    public function daftar_anggota_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'gender' => 'required|in:Ikhwan,Akhwat',
            'umur' => 'required|integer|min:13|max:60',
            'telepon' => 'required|string|min:10|max:15|unique:daftar_anggota_irmas,telepon',
            'alamat' => 'required|string',
            'instansi' => 'required|string|max:255',
            'kelas_semester' => 'required|string|max:50',
            'jurusan' => 'nullable|string|max:255',
            'divisi' => 'required|in:Sosial,Media,Dakwah',
            'keahlian' => 'nullable|string',
        ], [
            'telepon.unique' => '⚠️ Nomor WhatsApp :input sudah terdaftar. Gunakan nomor lain untuk mendaftar.',
            'telepon.min' => 'Nomor WhatsApp minimal 10 digit.',
            'telepon.max' => 'Nomor WhatsApp maksimal 15 digit.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DaftarAnggotaIrma::create([
                'nama' => $request->nama,
                'gender' => $request->gender,
                'umur' => (int)$request->umur,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'instansi' => $request->instansi,
                'kelas_semester' => $request->kelas_semester,
                'jurusan' => $request->jurusan,
                'divisi' => $request->divisi,
                'keahlian' => $request->keahlian,
                'status' => 'menunggu verifikasi',
            ]);

            return redirect()->route('website.irma.daftar-anggota')
                ->with('success', 'Pendaftaran berhasil! Tim IRMA akan menghubungi Anda via WhatsApp dalam 3x24 jam.');

        } catch (Throwable $e) {
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage())
                ->withInput();
        }
    }
}