<x-splade-modal :unit="$unit">
    <x-splade-form action="{{ route('admin.pengajar.store', ['unit' => $unit]) }}" method="POST" onkeydown="return event.key != 'Enter';"

    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Tambah Data Pengajar
            </x-forms.header>

            <x-forms.body >
                <x-splade-input name="kode_nama_pengajar" :label="__('Kode Nama Pengajar')" required min="3" oninvalid="this.setCustomValidity('Harus Diisi, Minimal 3 Huruf')"/>
                {{-- <x-splade-select name="pengajars[]" :options="$pengajars" option-label="name" option-value="id" multiple choices /> --}}
                <x-splade-select name="pengajars" :label="__('User Akun')" :options="$pengajars" option-label="name" option-value="id" choices />
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

