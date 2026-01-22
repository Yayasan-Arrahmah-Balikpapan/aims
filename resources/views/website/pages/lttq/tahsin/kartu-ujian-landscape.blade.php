<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->nama }} - Kartu Peserta Ujian Tahsin LTTQ Arrahmah Balikpapan</title>
</head>
<style>
    @page {
        margin: 0px;
    }
    body {
        margin: 0px;
    }
</style>

<body style="margin: 0; padding: 10px 20px; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5;">

<div style="width: 100%; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); overflow: hidden; border: 1px solid #e0e0e0; position: relative;">

    <!-- Header dengan gradien -->
    <div style="background: #2d7dd2; padding: 25px 30px 15px; position: relative;">
        <div style="display: block; width: 100%;">
            <div style="float: left; width: 70%;">
                <div style="font-size: 26px; font-weight: bold; color: white; margin-bottom: 5px; letter-spacing: 0.5px;">
                    KARTU PESERTA UJIAN
                </div>
                <div style="font-size: 20px; font-weight: bold; color: rgba(255, 255, 255, 0.95); margin-bottom: 8px;">
                    Tahsin LTTQ Arrahmah Balikpapan
                </div>
                <div style="font-size: 14px; font-weight: bold; color: rgba(255, 255, 255, 0.9); background: rgba(255, 255, 255, 0.15); display: inline-block; padding: 4px 12px; border-radius: 20px; margin-top: 8px;">
                    ANGKATAN {{ $data->periode->angkatan }}
                </div>
            </div>
            <div style="float: right; width: 30%; text-align: right;">
                <div style="background: white; padding: 12px; border-radius: 8px; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1); display: inline-block;">
                    <img src="{{ public_path('assets/logo/tahsin_.png') }}" alt="Logo Tahsin" width="90px" />
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <!-- Badge No. Peserta -->
    {{-- <div style="position: absolute; top: 30px; right: 30px; background: #e63946; color: white; padding: 6px 15px; border-radius: 20px; font-weight: bold; font-size: 12px; box-shadow: 0 3px 10px rgba(230, 57, 70, 0.3);">
        No. Peserta: <span style="font-size: 14px;">{{ $data->nis_peserta }}</span>
    </div> --}}

    <!-- Konten utama -->
    <div style="padding: 30px;">
        <!-- Judul informasi peserta -->
        <div style="font-size: 16px; font-weight: bold; color: #1a5fb4; margin-bottom: 20px; padding-bottom: 8px; border-bottom: 2px solid #f0f0f0;">
            INFORMASI PESERTA
        </div>

        <!-- Container untuk informasi peserta -->
        <div style="width: 100%;">
            <!-- Baris 1 -->
            <div style="width: 100%; margin-bottom: 10px;">
                <div style="float: left; width: 48%; margin-right: 4%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">Nama Peserta</div>
                    <div style="font-size: 16px; font-weight: bold; color: #333; background: #f8f9fa; padding: 10px 12px; border-radius: 8px; border-left: 4px solid #1a5fb4;">
                        {{ strtoupper($data->peserta->nama) }}
                    </div>
                </div>
                <div style="float: left; width: 48%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">NIS Peserta</div>
                    <div style="font-size: 14px; font-weight: bold; color: #e63946; background: #f8f9fa; padding: 10px 12px; border-radius: 8px; border-left: 4px solid #e63946;">
                        {{ strtoupper($data->nis_peserta) }}
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>

            <!-- Baris 2 -->
            <div style="width: 100%; margin-bottom: 10px;">
                <div style="float: left; width: 48%; margin-right: 4%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">No. HP (WhatsApp)</div>
                    <div style="font-size: 14px; font-weight: bold; color: #333; background: #f8f9fa; padding: 10px 12px; border-radius: 8px;">
                        {{ strtoupper($data->peserta->phone_number) }}
                    </div>
                </div>
                <div style="float: left; width: 48%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">Level Tahsin</div>
                    <div style="font-size: 14px; font-weight: bold; color: #333; background: #f8f9fa; padding: 10px 12px; border-radius: 8px;">
                        {{ $data->jadwal->level ? $data->jadwal->level->nama : '-' }}
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>

            <!-- Baris 3 -->
            <div style="width: 100%; margin-bottom: 10px;">
                <div style="float: left; width: 48%; margin-right: 4%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">Domisili</div>
                    <div style="font-size: 14px; font-weight: bold; color: #333; background: #f8f9fa; padding: 10px 12px; border-radius: 8px;">
                        {{ isset($data->peserta->biodata['kota_domisili']) ? strtoupper($data->peserta->biodata['kota_domisili']) : '-' }}
                    </div>
                </div>
                <div style="float: left; width: 48%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">Jadwal Tahsin</div>
                    <div style="font-size: 14px; font-weight: bold; color: #333; background: #f8f9fa; padding: 10px 12px; border-radius: 8px;">
                        {{ $data->jadwal->hari_belajar . ' ' . $data->jadwal->jam_mulai }}
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>

            <!-- Baris 4 -->
            <div style="width: 100%; margin-bottom: 10px;">
                <div style="float: left; width: 48%; margin-right: 4%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">Peserta</div>
                    <div style="font-size: 14px; font-weight: bold; color: #333; background: #f8f9fa; padding: 10px 12px; border-radius: 8px;">
                        {{ strtoupper($data->peserta->jenis_peserta) }}
                    </div>
                </div>
                <div style="float: left; width: 48%;">
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">Pengajar</div>
                    <div style="font-size: 14px; font-weight: bold; color: #333; background: #f8f9fa; padding: 10px 12px; border-radius: 8px;">
                        {{ $data->jadwal->pengajar->kode_nama_pengajar }}
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>

        <!-- Tanda tangan -->
        <div style="margin-top: 30px; text-align: center; position: relative; padding-top: 10px; border-top: 1px dashed #ccc;">
            <div style="font-size: 12px; color: #666; margin-bottom: 5px;">
                BALIKPAPAN, {{ \Carbon\Carbon::now()->format('d F Y') }}
            </div>

            <div style="font-size: 12px; color: #666; margin-bottom: 20px;">
                Peserta Ujian Tahsin
            </div>

            <!-- Garis tanda tangan -->
            {{-- <div style="width: 250px; height: 1px; background: #ccc; margin: 0 auto 15px;"></div> --}}

            <div style="font-size: 18px; font-weight: bold; color: #1a5fb4;">
                {{ strtoupper($data->peserta->nama) }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div style="background: #f8f9fa; border-top: 1px solid #e0e0e0; padding: 15px 30px;">
        <div style="width: 100%; margin-bottom: 20px;">
            <!-- Kontak -->
            <div style="float: left; width: 28%; margin-right: 4%;">
                <div style="font-size: 14px; font-weight: bold; color: #1a5fb4; margin-bottom: 12px;">
                    KONTAK
                </div>
                <div style="font-size: 12px; color: #555;">
                    <div style="margin-bottom: 8px;">
                        <strong>Ikhwan:</strong> 0822 5384 5629
                    </div>
                    <div>
                        <strong>Akhwat:</strong> 0819 3041 8501
                    </div>
                </div>
            </div>

            <!-- Rekening -->
            <div style="float: left; width: 68%;">
                <div style="font-size: 14px; font-weight: bold; color: #1a5fb4; margin-bottom: 12px;">
                    REKENING
                </div>
                <div style="font-size: 12px; color: #555;">
                    <div style="margin-bottom: 8px;">
                        <strong>Ikhwan:</strong> Bank Syariah Indonesia - 4550 0000 15 - Yayasan Arrahmah
                    </div>
                    <div>
                        <strong>Akhwat:</strong> Bank Syariah Indonesia - 7009 9997 05 - Yayasan Arrahmah
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <!-- Copyright -->
        <div style="text-align: center; padding-top: 15px; border-top: 1px solid #e0e0e0;">
            <div style="font-size: 12px; font-weight: bold; color: #333; margin-bottom: 5px;">
                Yayasan Arrahmah Balikpapan
            </div>
            <div style="font-size: 11px; color: #666;">
                https://arrahmahbalikpapan.or.id &copy; {{ date('Y') }}
            </div>
        </div>
    </div>

    <!-- Dekorasi corner -->
    <div style="position: absolute; top: 0; right: 0; width: 80px; height: 80px; overflow: hidden;">
        <div style="position: absolute; top: -40px; right: -40px; width: 80px; height: 80px; background: rgba(26, 95, 180, 0.08); transform: rotate(45deg);"></div>
    </div>
    <div style="position: absolute; bottom: 0; left: 0; width: 80px; height: 80px; overflow: hidden;">
        <div style="position: absolute; bottom: -40px; left: -40px; width: 80px; height: 80px; background: rgba(230, 57, 70, 0.08); transform: rotate(45deg);"></div>
    </div>
</div>

</body>
</html>
