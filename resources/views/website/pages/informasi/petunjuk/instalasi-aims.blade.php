@extends('website.layouts.web')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-t-lg p-6 -mx-6 -mt-6 mb-6">
            <h1 class="text-3xl font-bold">📲 Panduan Instalasi AIMS</h1>
            <p class="mt-2 opacity-90">Ikuti langkah-langkah berikut untuk menginstal aplikasi AIMS</p>
        </div>

        <div class="space-y-6">
            <div class="bg-blue-50 rounded-lg p-4">
                <h2 class="text-xl font-semibold text-blue-800 mb-3">Langkah Instalasi</h2>
                <ol class="space-y-4">
                    <li class="flex items-start space-x-3 bg-white p-4 rounded-md shadow-sm">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">1</div>
                        <div>
                            <p class="font-medium">Akses Halaman Instalasi</p>
                            <p class="text-gray-600 mt-1">
                                Buka halaman <code class="bg-gray-100 px-2 py-1 rounded">/login</code>
                                atau temukan tautan instalasi di bagian footer website
                            </p>
                        </div>
                    </li>

                    <li class="flex items-start space-x-3 bg-white p-4 rounded-md shadow-sm">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">2</div>
                        <div>
                            <p class="font-medium">Mulai Proses Instalasi</p>
                            <p class="text-gray-600 mt-1">
                                Klik tombol
                                <span class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-full text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Instal Sekarang
                                </span>
                            </p>
                        </div>
                    </li>

                    <li class="flex items-start space-x-3 bg-white p-4 rounded-md shadow-sm">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">3</div>
                        <div>
                            <p class="font-medium">Konfirmasi Instalasi</p>
                            <p class="text-gray-600 mt-1">
                                Klik <strong class="text-green-600">Oke</strong> untuk menyelesaikan proses instalasi
                            </p>
                        </div>
                    </li>
                </ol>
            </div>

            <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                <h3 class="text-lg font-semibold text-green-800 mb-2">💡 Tips Instalasi</h3>
                <ul class="list-disc list-inside text-green-700 space-y-2">
                    <li>Pastikan koneksi internet stabil</li>
                    <li>Gunakan browser versi terbaru</li>
                    <li>Izinkan akses penyimpanan ketika diminta</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
