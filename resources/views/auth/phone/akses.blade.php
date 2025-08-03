<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />
        <x-splade-form action="{{ route('akses.validasi') }}"
                        confirm="Konfirmasi"
                        confirm-text="Apakah Nomor Sudah Benar ?"
                        confirm-button="Benar"
                        cancel-button="Belum"
                        method="POST"
        >
            <div class="flex items-center justify-center">
                <div class="text-4xl font-light text-gray-800 py-3">
                    Akses
                </div>
            </div>
            <hr class="my-4" />

            <!-- Email Address -->
            {{-- <x-splade-input id="email" type="email" name="email" label="Nomor Whatsapp Aktif" required autofocus /> --}}
            <label class="mb-2 flex items-center justify-center text-xl font-semibold text-gray-700 py-3">
                Masukkan Nomor HP Whatsapp Aktif :
            </label>
            <div class="flex items-center">
                @include('auth.phone.phone-code')
            </div>
            <div class="flex items-center">
                <div class="relative w-full">
                    <x-splade-input type="tel" name="phone_number" size="20" minlength="9" maxlength="14"
                        class="block px-0 w-full text-center italic text-3xl text-gray-900 bg-transparent appearance-none peer"
                        placeholder="Masukkan Nomor Disini " required />
                </div>
            </div>

            <div class="flex items-center justify-end ">
                <div class="text-sm text-gray-500">
                    Contoh : 08123456789
                </div>
            </div>

            <div class="flex items-center justify-center py-5">
                <x-splade-submit class="ml-3" label="Klik Untuk Melanjutkan" />
            </div>
        </x-splade-form>
    </x-auth-card>
    <div class="mt-4 text-center">
        <button id="installPWA"
                class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors"
                style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd" />
            </svg>
            Install Aplikasi
        </button>
    </div>
</x-guest-layout>
