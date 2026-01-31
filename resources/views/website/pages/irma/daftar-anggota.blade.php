<div class="min-h-screen bg-gray-100">

    <div class="text-center py-4 bg-gray-100">
        <p class="text-md space-x-10">
            <Link href="{{ url('/') }}" class=" text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </Link>

            <!-- @auth
                <Link href="{{ url('/') }}/dashboard" class="p-2 border rounded-md border-gray-600 text-800 hover:text-primary-900">
                    Ke Dashboard &#x02192;
                </Link>
            @endauth -->
        </p>
    </div>
    <div class="flex justify-center items-center p-4 bg-gray-100 min-h-screen">
        <div class="bg-white rounded-2xl p-8 border-2 border-gray-100 shadow-xl w-full max-w-lg">
           
            <!-- HEADER SECTION: LOGO & JUDUL -->
            <div class="text-center mb-8">
                <!-- Logo IRMA -->
                <img 
                    src="{{ asset('assets/logo/logo-irma.svg') }}" 
                    alt="Logo IRMA" 
                    class="h-24 mx-auto mb-4 hover:scale-105 transition-transform duration-300"
                >
                
                <!-- Judul Utama + Emoji ✨ -->
                <h1 class="text-3xl font-black text-gray-900 mb-2 flex items-center justify-center gap-3">
                    <span class="text-2xl">🎉</span>
                    Pendaftaran Anggota Baru
                    <span class="text-2xl">🚀</span>
                </h1>
                
                <!-- Sub-judul / Deskripsi Singkat + Emoji -->
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 p-4 rounded-2xl border-2 border-emerald-100 shadow-sm mt-2">
                    <p class="text-sm text-gray-700 leading-relaxed flex items-center justify-center gap-2 flex-wrap">
                        Mari bergabung dan bertumbuh bersama
                        <span class="text-[#0B6E4F] font-bold">Ikatan Remaja Masjid (IRMA)</span>
                        <span>🕌</span>
                        <br class="sm:hidden">
                        <span class="text-sm text-orange-600 font-bold">Arrahmah Balikpapan</span>
                        <span>📍</span>
                    </p>
                </div>
            </div>

            <!-- ERROR/SUCCESS MESSAGE -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl shadow-md">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl shadow-md">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl shadow-md">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-red-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <div>
                            <p class="font-bold text-red-900 mb-2">Periksa kembali:</p>
                            <ul class="text-sm text-red-800 space-y-1 max-h-32 overflow-y-auto">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- FORM START -->
            <form action="{{ route('website.irma.daftar-anggota.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- SECTION 1: DATA DIRI -->
                <div class="space-y-4">
                    <h3 class="text-lg font-black text-[#0B6E4F] border-b-2 border-gray-100 pb-2 mb-4">
                        1. Data Diri
                    </h3>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-bold text-gray-900 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nama" 
                            name="nama" 
                            required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors"
                            placeholder="Masukkan nama lengkap"
                        >
                    </div>

                    <!-- Gender (Ikhwan/Akhwat) -->
                    <div>
                        <label for="gender" class="block text-sm font-bold text-gray-900 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="gender" 
                            name="gender" 
                            required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors appearance-none bg-white"
                        >
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Ikhwan">Ikhwan</option>
                            <option value="Akhwat">Akhwat</option>
                        </select>
                    </div>

                    <!-- Umur -->
                    <div>
                        <label for="umur" class="block text-sm font-bold text-gray-900 mb-2">
                            Umur <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="umur" 
                            name="umur" 
                            required
                            min="13"
                            max="60"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors"
                            placeholder="Masukkan umur"
                        >
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="telepon" class="block text-sm font-bold text-gray-900 mb-2">
                            Nomor Telepon (WhatsApp) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="telepon" 
                            name="telepon" 
                            required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors"
                            placeholder="08xxxxxxxxxx"
                        >
                    </div>

                    <!-- Alamat Rumah -->
                    <div>
                        <label for="alamat" class="block text-sm font-bold text-gray-900 mb-2">
                            Alamat Rumah <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="alamat" 
                            name="alamat" 
                            required
                            rows="3"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors resize-none"
                            placeholder="Masukkan alamat lengkap"
                        ></textarea>
                    </div>
                </div>

                <!-- SECTION 2: PENDIDIKAN -->
                <div class="space-y-4 pt-4">
                    <h3 class="text-lg font-black text-[#0B6E4F] border-b-2 border-gray-100 pb-2 mb-4">
                        2. Pendidikan
                    </h3>

                    <!-- Asal Sekolah/Kampus -->
                    <div>
                        <label for="instansi" class="block text-sm font-bold text-gray-900 mb-2">
                            Asal Sekolah / Kampus / Instansi <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="instansi" 
                            name="instansi" 
                            required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors"
                            placeholder="Contoh: Universitas Mulawarman"
                        >
                    </div>

                    <!-- Kelas / Semester -->
                    <div>
                        <label for="kelas_semester" class="block text-sm font-bold text-gray-900 mb-2">
                            Kelas / Semester <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="kelas_semester" 
                            name="kelas_semester" 
                            required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors"
                            placeholder="Contoh: Semester 4"
                        >
                    </div>

                    <!-- Jurusan (Opsional) -->
                    <div>
                        <label for="jurusan" class="block text-sm font-bold text-gray-900 mb-2">
                            Jurusan <span class="text-gray-400 font-normal text-xs">(Opsional)</span>
                        </label>
                        <input 
                            type="text" 
                            id="jurusan" 
                            name="jurusan" 
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors"
                            placeholder="Contoh: Teknik Informatika"
                        >
                    </div>
                </div>

                <!-- SECTION 3: MINAT & POTENSI -->
                <div class="space-y-4 pt-4">
                    <h3 class="text-lg font-black text-[#0B6E4F] border-b-2 border-gray-100 pb-2 mb-4">
                        3. Minat & Potensi
                    </h3>

                    <!-- Divisi -->
                    <div>
                        <label for="divisi" class="block text-sm font-bold text-gray-900 mb-2">
                            Pilih Divisi <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="divisi" 
                            name="divisi" 
                            required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors appearance-none bg-white"
                        >
                            <option value="">Pilih divisi yang diminati</option>
                            <option value="Sosial">Sosial</option>
                            <option value="Media">Media</option>
                            <option value="Dakwah">Dakwah</option>
                        </select>
                    </div>

                    <!-- Keahlian Khusus -->
                    <div>
                        <label for="keahlian" class="block text-sm font-bold text-gray-900 mb-2">
                            Keahlian Khusus <span class="text-gray-400 font-normal text-xs">(Opsional)</span>
                        </label>
                        <textarea 
                            id="keahlian" 
                            name="keahlian" 
                            rows="3"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#50C878] focus:outline-none transition-colors resize-none"
                            placeholder="Contoh: Desain Grafis, Public Speaking, Menulis..."
                        ></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button 
                        type="submit"
                        class="w-full py-4 rounded-xl text-white font-black text-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
                        style="background: linear-gradient(135deg, #50C878 0%, #0B6E4F 100%);"
                    >
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Daftar Sekarang
                        </span>
                    </button>
                    <div class="mt-6 p-4 bg-gradient-to-r from-orange-50 to-red-50 border-2 border-orange-200 rounded-2xl shadow-lg animate-pulse">
                        <div class="flex items-start gap-3">
                            <div class="text-sm leading-relaxed">
                                <p class="font-bold text-orange-900 mb-1 flex items-center gap-2">
                                    ⚠️ <span>PENTING!</span>
                                </p>
                                <p class="text-orange-800">
                                    Dengan mendaftar, Anda menyetujui untuk dihubungi oleh tim IRMA melalui WhatsApp atau telepon. Pastikan nomor yang dimasukkan benar dan aktif.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>