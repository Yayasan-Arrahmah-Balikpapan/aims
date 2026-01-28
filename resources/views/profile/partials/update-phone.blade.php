<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Nomor Handphone') }}
        </h2>

        {{-- <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p> --}}
    </header>

    <x-splade-form method="patch" :action="route('phone.update', ['id' => $user->id])" :default="$user"  class="mt-6 space-y-2" preserve-scroll>
        <div class="flex text-gray-700 pt-2">
            Nomor Handphone <span aria-hidden="true" class="text-red-600 pl-1">*</span>
        </div>
        <div class="flex items-center">
            @include('auth.phone.phone-code')
        </div>
        <div class="flex items-center">
            <div class="relative w-full">
                <x-splade-input type="tel" name="phone_number" size="20" minlength="9" maxlength="14"
                    class="block px-0 w-full text-center italic text-3xl text-gray-900 bg-transparent appearance-none peer"
                    placeholder="Masukkan Nomor Handphone : 081234567 " required autofocus/>
            </div>
        </div>

        <div class="flex items-center justify-end ">
            <div class="text-sm text-gray-500">
                Contoh : 08123456789
            </div>
        </div>
        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Save')" />

            @if (session('status') === 'phone-updated')
                <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </x-splade-form>
</section>
