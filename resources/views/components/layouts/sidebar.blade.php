@props(['unit'])

<x-splade-script>
    const sidebar = document.getElementById('sidebar');

    if (sidebar) {
        const toggleSidebarMobile = (sidebar, toggleSidebarMobileHamburger, toggleSidebarMobileClose) => {
            sidebar.classList.toggle('hidden');
            toggleSidebarMobileHamburger.classList.toggle('hidden');
            toggleSidebarMobileClose.classList.toggle('hidden');
        }

        const toggleSidebarMobileEl = document.getElementById('toggleSidebarMobile');
        const toggleSidebarMobileHamburger = document.getElementById('toggleSidebarMobileHamburger');
        const toggleSidebarMobileClose = document.getElementById('toggleSidebarMobileClose');

        toggleSidebarMobileEl.addEventListener('click', () => {
            toggleSidebarMobile(sidebar, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
        });
    }

</x-splade-script>

<aside id="sidebar" class="fixed top-0 left-0 z-10 flex flex-col flex-shrink-0 hidden w-[200px] bg-white border-r border-gray-200 h-full pt-16 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 ">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
                {{-- @if (Request::is('super-admin*'))
                    <x-layouts.sidebar.super-admin />
                @endif--}}
                @if (Request::is('super-admin*'))
                    <x-layouts.sidebar.super-admin />
                @endif
                @if (Request::is('dashboard/admin*'))
                    <x-layouts.sidebar.admin :unit="$unit ?? null"/>
                @endif
                @if (Request::is('dashboard/pengajar*'))
                    <x-layouts.sidebar.pengajar :unit="$unit ?? null"/>
                @endif
                @if (Request::is('dashboard/ketua*'))
                    <x-layouts.sidebar.ketua-unit :unit="$unit ?? null"/>
                @endif
                @if (Request::is('dashboard/penguji*'))
                    <x-layouts.sidebar.penguji :unit="$unit ?? null"/>
                @endif
                @if (Request::is('dashboard/karyawan*'))
                    <x-layouts.sidebar.karyawan/>
                @endif
                @if (Request::is('dashboard/hrd*'))
                    <x-layouts.sidebar.hrd/>
                @endif
                @if (Request::is('dashboard/keuangan*'))
                    <x-layouts.sidebar.keuangan/>
                @endif
                {{-- @role('ketua-divisi-pendidikan')
                    <x-layouts.sidebar.ketua-divisi-pendidikan />
                @role('ketua-divisi-dkm')
                    <x-layouts.sidebar.ketua-divisi-dkm />
                @role('ketua-divisi-keuangan')
                    <x-layouts.sidebar.ketua-divisi-keuangan />
                @role('ketua-divisi-fundraising')
                    <x-layouts.sidebar.ketua-divisi-fundraising />
                @role('admin')
                    <x-layouts.sidebar.admin />
                @role('ketua-unit')
                    <x-layouts.sidebar.ketua-unit />
                @role('penguji')
                    <x-layouts.sidebar.penguji />
                @role('pengajar')
                    <x-layouts.sidebar.pengajar />
                @role('kasir')
                    <x-layouts.sidebar.kasir />
                @role('keuangan')
                    <x-layouts.sidebar.keuangan />
                @role('pimpinan')
                    <x-layouts.sidebar.pimpinan />
                @role('dkm')
                    <x-layouts.sidebar.dkm />
                @role('laziz')
                    <x-layouts.sidebar.laziz />
                @role('mci')
                    <x-layouts.sidebar.mci />
                @role('super-admin')
                    <x-layouts.sidebar.super-admin />
                @role('cms')
                    <x-layouts.sidebar.cms />
                @role
                    <x-layouts.sidebar.guest /> --}}
                <div class="pt-4 space-y-2">
                    <a href="#" target="_blank" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
                        @svg('carbon-information', 'text-gray-600 h-6 w-6')
                        <span class="ml-3" sidebar-toggle-item="">Bantuan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
