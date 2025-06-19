<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Data Agenda
        </h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <x-layouts.card>
            <h4 class="text-xl font-bold px-4">Tambah Data Agenda</h4>
            <x-splade-form action="{{ route('hrd.agenda.store') }}"
                preserve-scroll
                :default="[
                    'jumlah_hari' => 1,
                ]"
            >
                @csrf
                <div class="relative p-4">
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-input name="nama" :label="__('Nama Kegiatan')" required/>
                        <x-splade-select name="jenis" :label="__('Jenis')" required>
                            <option value="LIBUR">Libur</option>
                            <option value="RAPAT">Rapat</option>
                            <option value="ACARA">Acara</option>
                            <option value="RAKER">Raker</option>
                            <option value="CUTI BERSAMA">Cuti Bersama</option>
                        </x-splade-select>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-input name="tanggal" :label="__('Tanggal')" date required/>
                        <x-splade-input type="number" name="jumlah_hari" :label="__('Berapa Hari ?')" min="1" required/>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-textarea name="keterangan" :label="__('Keterangan')" autosize/>
                    </div>
                </div>
                <div class="p-4">
                    <x-splade-submit label="Tambah"/>
                </div>
            </x-splade-form>
        </x-layouts.card>
    </div>
    <x-layouts.card>
        <x-splade-table :for="$agendas">
            <x-splade-cell actions as="$data">
                    <div class="flex items-center gap-1">
                        <x-splade-form action="{{ route('hrd.agenda.destroy', $data->id) }}" method="DELETE"
                            confirm="Konfirmasi Hapus Data"
                            confirm-text="Apakah yakin data agenda ini dihapus ?"
                            confirm-button="Ya"
                            cancel-button="Tidak"
                            preserve-scroll
                        >
                            @csrf
                            <button type="submit" class="text-red-500 underline">Hapus</button>
                        </x-splade-form>
                    </div>
                </x-splade-cell>
        </x-splade-table>
    </x-layouts.card>
</x-layouts.main>
