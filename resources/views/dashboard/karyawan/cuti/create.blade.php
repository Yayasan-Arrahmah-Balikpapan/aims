<x-splade-modal>
    <h1 class="text-2xl font-bold mb-4">Form Pengajuan Cuti</h1>
    <x-splade-form action="{{ route('karyawan.cuti.store') }}">
        @csrf
        <x-splade-input name="tanggal_mulai" type="date" label="Tanggal Mulai" required date/>
        <x-splade-input name="tanggal_selesai" type="date" label="Tanggal Selesai" required date/>
        <x-splade-textarea name="alasan" type="text" label="Keperluan Cuti" required autosize />
        <x-splade-submit label="Submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" />
    </x-splade-form>
</x-splade-modal>
