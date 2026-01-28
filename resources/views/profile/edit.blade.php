<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mx-auto  space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="" dusk="update-profile-information">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="" dusk="update-profile-information">
                        @include('profile.partials.update-phone')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="" dusk="update-password">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="" dusk="update-password">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="p-2">
                                <a class="block border border-red-300 bg-red-50 rounded-md p-4 text-sm uppercase hover:bg-gray-100" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" dusk="delete-user">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
