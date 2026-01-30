<x-splade-script>
    const webmenu = document.getElementById('webmenu');

    if (webmenu) {
        const togglewebmenuMobile = (webmenu, togglewebmenuMobileHamburger, togglewebmenuMobileClose) => {
            webmenu.classList.toggle('hidden');
            togglewebmenuMobileHamburger.classList.toggle('hidden');
            togglewebmenuMobileClose.classList.toggle('hidden');
        }

        const togglewebmenuMobileEl = document.getElementById('togglewebmenuMobile');
        const togglewebmenuMobileHamburger = document.getElementById('togglewebmenuMobileHamburger');
        const togglewebmenuMobileClose = document.getElementById('togglewebmenuMobileClose');

        togglewebmenuMobileEl.addEventListener('click', () => {
            togglewebmenuMobile(webmenu, togglewebmenuMobileHamburger, togglewebmenuMobileClose);
        });
    }

</x-splade-script>

<div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="webmenu">
    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
        <li>
            <x-website.nav :href="route('website.yayasan')" :active="request()->routeIs('website.yayasan')">
                Yayasan
            </x-website.nav>
        </li>
        <li>
            <x-website.nav :href="route('website.lttq')" :active="request()->routeIs('website.lttq')">
                Pendidikan
            </x-website.nav>
        </li>
        <li>
            <x-website.nav :href="route('website.ibadah')" :active="request()->routeIs('website.ibadah')">
                Ibadah
            </x-website.nav>
        </li>
        <li>
            <x-website.nav :href="route('website.sosial')" :active="request()->routeIs('website.sosial')">
                Sosial
            </x-website.nav>
        </li>
        <li>
            <x-website.nav :href="route('website.agenda')" :active="request()->routeIs('website.agenda')">
                Agenda
            </x-website.nav>
        </li>
            {{-- <x-website.nav :href="route('website.kontak')" :active="request()->routeIs('website.kontak')">
                Kontak
            </x-website.nav> --}}
        {{-- <li>
            <x-website.nav :href="route('website.quranic-camp')" :active="request()->routeIs('website.quranic-camp')">
                Quranic Camp 🏕️
            </x-website.nav>
        </li> --}}
        <li>
            <x-website.nav :href="route('website.ramadhan')" :active="request()->routeIs('website.ramadhan')">
                Ramadhan ☪️
            </x-website.nav>
        </li>
        <li>
            <x-website.nav :href="route('website.irma')" :active="request()->routeIs('website.irma')">
                IRMA 🚀
            </x-website.nav>
        </li>
    </ul>
    @auth
        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0 sm:hidden">
            <li>
                <x-website.nav :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    Profile
                </x-website.nav>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-website.nav :href="route('logout')" :active="request()->routeIs('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-website.nav>
                </form>
            </li>
        </ul>
    @endauth
</div>
