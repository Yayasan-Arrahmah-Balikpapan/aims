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
                Pendidikan LTTQ
            </x-website.nav>
        </li>
        <li>
            <a href="#" class="block font-medium py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">
                Ibadah
            </a>
        </li>
        <li>
            <a href="#" class="block font-medium py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">
                Sosial
            </a>
        </li>
        <li>
            <x-website.nav :href="route('website.informasi')" :active="request()->routeIs('website.informasi')">
                Informasi
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
    </ul>
</div>
