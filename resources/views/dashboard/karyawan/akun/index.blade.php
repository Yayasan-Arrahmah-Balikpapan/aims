<x-layouts.main>
    <x-layouts.card>
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Informasi Akun') }}
                </h2>
            </header>
            <h1 class="text-lg font-semibold">
                {{ $user->phone_number }}
            </h1>

            <h1 class="mt-4 text-lg font-semibold">
                Divisi : -
            </h1>

            <x-splade-form method="patch" :action="route('karyawan.akun.update')" :default="$user" class="mt-6 space-y-6" preserve-scroll>
                <x-splade-input id="name" name="name" type="text" :label="__('Nama')" autofocus autocomplete="name" />
                <x-splade-input id="email" name="email" type="email" :label="__('Email')" autocomplete="email" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <Link method="post" href="{{ route('verification.send') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </Link>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif

                <div class="flex items-center gap-4">
                    <x-splade-submit :label="__('Simpan')" />

                    @if (session('status') === 'profile-updated')
                        <p class="text-sm text-gray-600">
                            {{ __('Tersimpan.') }}
                        </p>
                    @endif
                </div>
            </x-splade-form>
        </section>
    </x-layouts.card>
</x-layouts.main>
