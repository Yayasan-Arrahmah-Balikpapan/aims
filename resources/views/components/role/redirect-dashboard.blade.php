@if ($role === 'ketua-divisi-pendidikan')
    {{ url('/dashboard/pendidikan') }}
@elseif ($role === 'ketua-divisi-dkm')
    {{ url('/dashboard/dkm') }}
@elseif ($role === 'ketua-divisi-keuangan')
    {{ url('/dashboard/keuangan') }}
@elseif ($role === 'ketua-divisi-fundraising')
    {{ url('/dashboard/fundraising') }}
@elseif ($role === 'admin-tahsin')
    {{ url('/dashboard/admin/tahsin') }}
@elseif ($role === 'ketua-unit-tahsin')
    {{ url('/dashboard/ketua/tahsin') }}
@elseif ($role === 'penguji-tahsin')
    {{ url('/dashboard/penguji/tahsin') }}
@elseif ($role === 'pengajar-tahsin')
    {{ url('/dashboard/pengajar/tahsin') }}
@elseif ($role === 'admin-rtq')
    {{ url('/dashboard/admin/rtq') }}
@elseif ($role === 'ketua-unit-rtq')
    {{ url('/dashboard/ketua/rtq') }}
@elseif ($role === 'penguji-rtq')
    {{ url('/dashboard/penguji/rtq') }}
@elseif ($role === 'pengajar-rtq')
    {{ url('/dashboard/pengajar/rtq') }}
@elseif ($role === 'admin-tla')
    {{ url('/dashboard/admin/tla') }}
@elseif ($role === 'ketua-unit-tla')
    {{ url('/dashboard/ketua/tla') }}
@elseif ($role === 'penguji-tla')
    {{ url('/dashboard/penguji/tla') }}
@elseif ($role === 'pengajar-tla')
    {{ url('/dashboard/pengajar/tla') }}
@elseif ($role === 'admin-rq')
    {{ url('/dashboard/admin/rq') }}
@elseif ($role === 'ketua-unit-rq')
    {{ url('/dashboard/ketua/rq') }}
@elseif ($role === 'penguji-rq')
    {{ url('/dashboard/penguji/rq') }}
@elseif ($role === 'pengajar-rq')
    {{ url('/dashboard/pengajar/rq') }}
@elseif ($role === 'admin-tahla')
    {{ url('/dashboard/admin/tahla') }}
@elseif ($role === 'ketua-unit-tahla')
    {{ url('/dashboard/ketua/tahla') }}
@elseif ($role === 'penguji-tahla')
    {{ url('/dashboard/penguji/tahla') }}
@elseif ($role === 'pengajar-tahla')
    {{ url('/dashboard/pengajar/tahla') }}
@elseif ($role === 'kasir')
    {{ url('/dashboard/kasir') }}
@elseif ($role === 'keuangan')
    {{ url('/dashboard/keuangan') }}
@elseif ($role === 'pimpinan')
    {{ url('/dashboard/pimpinan') }}
@elseif ($role === 'dkm')
    {{ url('/dashboard/dkm') }}
@elseif ($role === 'laziz')
    {{ url('/dashboard/laziz') }}
@elseif ($role === 'mci')
    {{ url('/dashboard/mci') }}
@elseif ($role === 'super-admin')
    {{ url('/super-admin') }}
@elseif ($role === 'cms')
    {{ url('/dashboard/cms') }}
@elseif ($role === 'karyawan')
{{ url('/dashboard/karyawan') }}
@elseif ($role === 'hrd')
{{ url('/dashboard/hrd') }}
@else
    {{ url('/dashboard') }}
@endif
