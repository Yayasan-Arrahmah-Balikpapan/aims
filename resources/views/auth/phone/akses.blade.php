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
                <div class="text-3xl font-light text-gray-800 py-3">
                    Akses
                </div>
            </div>
            <hr class="my-4" />

            <!-- Email Address -->
            {{-- <x-splade-input id="email" type="email" name="email" label="Nomor Whatsapp Aktif" required autofocus /> --}}
            <label class="mb-2 flex items-center justify-center text-lg font-semibold text-gray-700 py-3">
                Masukkan Nomor HP Whatsapp Aktif :
            </label>
            <div class="flex items-center">
                @include('auth.phone.phone-code')
            </div>
            <div class="flex items-center">
                <div class="relative w-full">
                    <x-splade-input type="tel" name="phone_number" size="20" minlength="9" maxlength="14"
                        class="block px-0 w-full text-center italic text-xl text-gray-900 bg-transparent appearance-none peer"
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
        <PwaInstallButton />
    </div>
</x-guest-layout>
