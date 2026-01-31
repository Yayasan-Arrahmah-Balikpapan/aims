@extends('website.layouts.web')

@section('content')
<main>
<section class="relative w-full min-h-screen flex items-center justify-center bg-white overflow-hidden py-20">

    <img src="{{ asset('assets/bg/bg-irma-hero.png') }}" 
         alt="Masjid Background" 
         class="absolute inset-0 w-full h-full object-cover opacity-30 pointer-events-none" />
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-white/60 via-white/40 to-emerald-50/30 backdrop-blur-sm"></div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-200/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-72 h-72 bg-teal-200/20 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Side - Text Content -->
            <div class="text-center lg:text-left space-y-8">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white backdrop-blur-sm border-2 border-emerald-200 rounded-full shadow-lg">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-bold text-emerald-700 tracking-wide">IKATAN REMAJA MASJID AR-RAHMAH</span>
                </div>
                
                <!-- Main Heading -->
                <div class="space-y-4">
                    <h1 class="font-black text-gray-900 leading-none">
                        <span class="block text-3xl sm:text-4xl md:text-5xl mb-2" style="color: #164e4e;">Generasi Muda</span>
                        <span class="block text-5xl sm:text-6xl md:text-7xl lg:text-8xl" style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">BERAKHLAK</span>
                        <span class="block text-3xl sm:text-4xl md:text-5xl mt-2" style="color: #164e4e;">& Berdaya Saing</span>
                    </h1>
                </div>
                
                <!-- Description -->
                <div class="bg-white backdrop-blur-sm rounded-2xl p-6 border-2 border-gray-100 shadow-lg">
                    <p class="text-lg sm:text-xl text-gray-700 leading-relaxed">
                        Bersama membangun generasi muda yang 
                        <span class="font-bold" style="color: #0B6E4F;">religius, berintegritas,</span> dan 
                        <span class="font-bold" style="color: #50C878;">berdaya saing global</span> di 
                        <span class="font-bold" style="color: #0B6E4F;">Masjid Ar-Rahmah Balikpapan</span>.
                    </p>
                </div>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                    <a href="#pendaftaran" 
                       class="group px-8 py-4 rounded-xl text-white font-black text-lg shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
                       style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%);">
                        <span class="flex items-center gap-2">
                            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Daftar Sekarang
                        </span>
                    </a>
                    
                    <a href="#tentang" 
                       class="px-8 py-4 bg-white border-2 border-gray-200 text-gray-900 rounded-xl font-bold text-lg hover:border-emerald-500 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <span class="flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Tentang Kami
                        </span>
                    </a>
                </div>


            </div>

            <!-- Right Side - Logo -->
            <div class="flex justify-center lg:justify-end">
                <div class="relative group">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/30 to-teal-400/30 blur-3xl rounded-full group-hover:blur-[100px] transition-all duration-500"></div>
                    
                    <!-- Decorative Ring -->
                    <div class="absolute inset-0  rounded-full" style="transform: scale(1.1);"></div>
                    <div class="absolute inset-0 rounded-full" style="transform: scale(1.2); animation: spin 20s linear infinite;"></div>
                    
                    <!-- Logo Container -->
                    <div class="relative z-10 bg-white/40 backdrop-blur-sm rounded-full p-8 border-4 border-white shadow-2xl">
                        <img src="{{ asset('assets/logo/logo-irma.svg') }}" 
                             alt="Logo IRMA" 
                             class="h-64 sm:h-80 md:h-96 w-auto object-contain drop-shadow-2xl group-hover:scale-105 transition-transform duration-500" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes spin {
    from {
        transform: scale(1.2) rotate(0deg);
    }
    to {
        transform: scale(1.2) rotate(360deg);
    }
}
</style>

<!-- Section Visi & Misi -->

<section id="tentang" class="py-24 bg-white">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8 mb-5">
        <!-- Header -->
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 mb-4 text-xs font-bold tracking-widest uppercase" style="background-color: #D1F2EB; color: #0B6E4F; border-radius: 9999px; border: 1px solid #50C878;">
                📚 INFORMASI ORGANISASI
            </span>
            <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-4">VISI & MISI</h2>
            <div class="flex justify-center gap-2 mt-4">
                <div style="width: 48px; height: 4px; background-color: #50C878; border-radius: 4px;"></div>
                <div style="width: 48px; height: 4px; background-color: #14B8A6; border-radius: 4px;"></div>
                <div style="width: 48px; height: 4px; background-color: #22C55E; border-radius: 4px;"></div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-stretch mt-8">
            <!-- VISI Card -->
            <div class="w-full lg:w-1/2 rounded-2xl p-8 lg:p-10" style="background: linear-gradient(135deg, #D1F2EB 0%, #E0F2F1 100%); box-shadow: 0 10px 40px rgba(0,0,0,0.1); border: 2px solid #50C878;">
                <!-- Header -->
                <div class="flex items-center gap-4 mb-6 ">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #50C878 0%, #14B8A6 100%); box-shadow: 0 4px 12px rgba(80, 200, 120, 0.3);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-3xl lg:text-4xl font-black text-gray-900">VISI</h3>
                </div>

                <!-- Quote -->
                <div class="bg-white rounded-2xl p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <p class="text-xl lg:text-2xl text-gray-800 leading-relaxed font-semibold">
                        "Menjadi pusat peradaban pemuda Muslim Balikpapan yang 
                        <span class="text-[#0B6E4F] font-bold">religius</span>, 
                        <span class="text-[#14B8A6] font-bold">berintegritas</span>, dan 
                        <span class="text-[#22C55E] font-bold">berdaya saing global</span>."
                    </p>
                </div>
            </div>

            <!-- MISI Cards -->
            <div class="w-full lg:w-1/2 flex flex-col">
                <div class="mb-5">
                    <h3 class="text-3xl font-black text-gray-900 mb-2">MISI</h3>
                    <p class="text-gray-600 font-medium">Pilar utama dalam mencapai visi organisasi</p>
                </div>

                <div class="flex flex-col gap-4">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl p-5 border-2 border-gray-100 hover:border-[#50C878] hover:shadow-lg transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%);">
                                <span class="text-base font-black text-white">01</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-black text-gray-900 mb-1">SPIRITUAL</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">Memakmurkan Masjid Ar Rahmah dengan kegiatan ibadah yang hidup, nyaman, dan relevan bagi generasi muda.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl p-5 border-2 border-gray-100 hover:border-[#14B8A6] hover:shadow-lg transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);">
                                <span class="text-base font-black text-white">02</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-black text-gray-900 mb-1">INTELEKTUAL & DIGITAL</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">Meningkatkan kapasitas anggota dalam penguasaan literasi digital, manajemen organisasi, dan teknologi informasi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl p-5 border-2 border-gray-100 hover:border-[#22C55E] hover:shadow-lg transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                                <span class="text-base font-black text-white">03</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-black text-gray-900 mb-1">SOSIAL & KEPEMIMPINAN</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">Membangun sinergi sosial melalui pelayanan masyarakat yang berdampak langsung pada warga sekitar masjid.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Section Program -->

<section id="program" class="py-24 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <span class="inline-block px-4 py-2 mb-4 text-xs font-bold tracking-widest uppercase" style="background-color: #D1F2EB; color: #0B6E4F; border-radius: 9999px; border: 1px solid #50C878;">
                🎯 PROGRAM UNGGULAN
            </span>
            <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-4">PROGRAM KAMI</h2>
            <div class="flex justify-center gap-2 mt-4">
                <div style="width: 48px; height: 4px; background-color: #50C878; border-radius: 4px;"></div>
                <div style="width: 48px; height: 4px; background-color: #14B8A6; border-radius: 4px;"></div>
                <div style="width: 48px; height: 4px; background-color: #22C55E; border-radius: 4px;"></div>
            </div>
            <p class="text-gray-600 font-medium mt-6 max-w-2xl mx-auto">
                Program strategis yang dirancang untuk mengembangkan potensi pemuda Muslim melalui pendekatan holistik
            </p>
        </div>

        <!-- Programs Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Program 1 -->
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-[#50C878] hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-[#50C878] transition-colors">Semarak Ramadhan Ar Rahmah</h3>
                        <span class="inline-block px-2 py-1 text-xs font-bold rounded-full" style="background-color: #D1F2EB; color: #0B6E4F;">EVENT TAHUNAN</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    IRMA sebagai mitra strategis Panitia Ramadhan, mengelola kegiatan spesifik seperti Pesantren Kilat, Festival Anak Sholeh, hingga Sahur on the Road.
                </p>
                <div class="flex items-center gap-2 text-[#50C878] font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <span>Event Management & Leadership</span>
                </div>
            </div>

            <!-- Program 2 -->
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-[#14B8A6] hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-[#14B8A6] transition-colors">IRMA Connect</h3>
                        <span class="inline-block px-2 py-1 text-xs font-bold rounded-full" style="background-color: #E0F2F1; color: #0D9488;">RIHLAH & STUDI TIRU</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Kunjungan strategis ke organisasi pemuda atau masjid percontohan untuk benchmarking sistem manajemen terbaik dan memperluas networking.
                </p>
                <div class="flex items-center gap-2 text-[#14B8A6] font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <span>Benchmarking & Networking</span>
                </div>
            </div>

            <!-- Program 3 -->
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-[#22C55E] hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-[#22C55E] transition-colors">Sportivity</h3>
                        <span class="inline-block px-2 py-1 text-xs font-bold rounded-full" style="background-color: #DCFCE7; color: #16A34A;">SPORT & SOLIDARITY</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Agenda rutin bulanan (Futsal/Minisoccer/Badminton) yang mengundang komunitas remaja masjid lain untuk mempererat ukhuwah.
                </p>
                <div class="flex items-center gap-2 text-[#22C55E] font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <span>Kebugaran & Bonding</span>
                </div>
            </div>

            <!-- Program 4 -->
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-[#50C878] hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-[#50C878] transition-colors">Ar Rahmah Academy</h3>
                        <span class="inline-block px-2 py-1 text-xs font-bold rounded-full" style="background-color: #D1F2EB; color: #0B6E4F;">ARMY</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Kelas berbagi ilmu di mana anggota IRMA mengajar warga/anak-anak materi seperti Bahasa Inggris, Desain Grafis, atau Bimbingan Belajar Gratis.
                </p>
                <div class="flex items-center gap-2 text-[#50C878] font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <span>Pengabdian Masyarakat</span>
                </div>
            </div>

            <!-- Program 5 -->
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-[#14B8A6] hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-[#14B8A6] transition-colors">Leadership & Upgrading Camp</h3>
                        <span class="inline-block px-2 py-1 text-xs font-bold rounded-full" style="background-color: #E0F2F1; color: #0D9488;">LUC</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Pelatihan intensif setahun sekali (kemah/outbound) fokus pada pemecahan masalah organisasi dan peningkatan soft-skill kepemimpinan.
                </p>
                <div class="flex items-center gap-2 text-[#14B8A6] font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <span>Soliditas & Soft-Skill</span>
                </div>
            </div>

            <!-- Program 6 -->
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-[#22C55E] hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-[#22C55E] transition-colors">Ar Rahmah Talk</h3>
                        <span class="inline-block px-2 py-1 text-xs font-bold rounded-full" style="background-color: #DCFCE7; color: #16A34A;">A-TALK</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Konten kreatif berupa obrolan santai membahas isu remaja dari sudut pandang Islam, didistribusikan via Instagram Reels atau YouTube.
                </p>
                <div class="flex items-center gap-2 text-[#22C55E] font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <span>Syiar Digital</span>
                </div>
            </div>

            <!-- Program 7 -->
            <div class="md:col-span-2 lg:col-span-3 bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-[#50C878] hover:shadow-xl transition-all duration-300 group">
                <div class="flex flex-col lg:flex-row items-start gap-6">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%);">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-[#50C878] transition-colors">Digital Squad & Tech Santri</h3>
                            <span class="inline-block px-2 py-1 text-xs font-bold rounded-full mb-3" style="background-color: #D1F2EB; color: #0B6E4F;">UNIT KHUSUS</span>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                Unit khusus bertanggung jawab mengelola website masjid, sistem informasi jamaah, dan media sosial. Anggota diajarkan CMS, desain Canva, hingga administrasi digital untuk memberikan hard-skill teknologi yang bernilai jual sekaligus modernisasi manajemen masjid.
                            </p>
                            <div class="flex items-center gap-2 text-[#50C878] font-bold text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                <span>Hard-Skill Teknologi & Modernisasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- Form Pendaftaran Anggota Baru -->

<section id="pendaftaran" class="py-24 bg-white">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <span class="inline-block px-4 py-2 mb-4 text-xs font-bold tracking-widest uppercase" style="background-color: #D1F2EB; color: #0B6E4F; border-radius: 9999px; border: 1px solid #50C878;">
                📝 BERGABUNG BERSAMA KAMI
            </span>
            <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-4">PENDAFTARAN</h2>
            <div class="flex justify-center gap-2 mt-4">
                <div style="width: 48px; height: 4px; background-color: #50C878; border-radius: 4px;"></div>
                <div style="width: 48px; height: 4px; background-color: #14B8A6; border-radius: 4px;"></div>
                <div style="width: 48px; height: 4px; background-color: #22C55E; border-radius: 4px;"></div>
            </div>
            <p class="text-gray-600 font-medium mt-6 max-w-2xl mx-auto">
                Daftarkan dirimu sekarang dan menjadi bagian dari keluarga besar IRMA
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <!-- Left Side - Info -->
            <div class="w-full lg:w-2/5">
                <div class="rounded-2xl p-8" style="background: linear-gradient(135deg, #D1F2EB 0%, #E0F2F1 100%); border: 2px solid #50C878;">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center p-3" style="background: linear-gradient(135deg, #50C878 0%, #14B8A6 100%); box-shadow: 0 4px 12px rgba(80, 200, 120, 0.3);">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900">Kenapa Bergabung?</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="flex gap-3 items-start">
                            <div class="flex-shrink-0 w-6 h-6 rounded-lg flex items-center justify-center" style="background-color: #50C878;">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Pengembangan Diri</h4>
                                <p class="text-sm text-gray-600">Tingkatkan skill kepemimpinan dan manajemen organisasi</p>
                            </div>
                        </div>

                        <div class="flex gap-3 items-start">
                            <div class="flex-shrink-0 w-6 h-6 rounded-lg flex items-center justify-center" style="background-color: #14B8A6;">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Networking Luas</h4>
                                <p class="text-sm text-gray-600">Bangun relasi dengan pemuda Muslim se-Balikpapan</p>
                            </div>
                        </div>

                        <div class="flex gap-3 items-start">
                            <div class="flex-shrink-0 w-6 h-6 rounded-lg flex items-center justify-center" style="background-color: #22C55E;">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Program Berkualitas</h4>
                                <p class="text-sm text-gray-600">Ikuti program pelatihan dan kegiatan bermanfaat</p>
                            </div>
                        </div>

                        <div class="flex gap-3 items-start">
                            <div class="flex-shrink-0 w-6 h-6 rounded-lg flex items-center justify-center" style="background-color: #50C878;">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Berkontribusi</h4>
                                <p class="text-sm text-gray-600">Berperan aktif dalam pengembangan masjid dan masyarakat</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-white rounded-xl">
                        <p class="text-sm text-gray-600 italic">
                            "Bersama IRMA, kita tumbuh menjadi generasi muda Muslim yang religius, berintegritas, dan berdaya saing global."
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="w-full lg:w-3/5">
                <div class="bg-white rounded-2xl p-8 border-2 border-gray-100">
                    
                    <div class="flex items-center gap-4 mb-8 text-center lg:text-left">
                        <div>
                            <h2 class="text-2xl font-black text-gray-900">Mulai Daftar!</h2>
                            <p class="text-gray-700 font-medium">Klik tombol di bawah</p>
                        </div>
                    </div>
                    
                    <div class="text-center mb-6">
                        <a href="{{ route('website.irma.daftar-anggota') }}" 
                        class="group inline-block w-full max-w-sm px-8 py-4 rounded-xl text-white font-black text-lg shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
                        style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%);">
                            
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                Daftar Sekarang
                            </span>
                        </a>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-lg flex items-center justify-center" style="background-color: #50C878;">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-700">Dihubungi via WhatsApp dalam 3x24 jam 📱</p>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-lg flex items-center justify-center" style="background-color: #14B8A6;">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-700">Gratis & mudah prosesnya 📌</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


</main>

@endsection
