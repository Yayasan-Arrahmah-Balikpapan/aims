<x-splade-modal :unit="$unit">
    <x-splade-form action="{{ route('admin.pengajar.import.store', ['unit' => $unit]) }}" method="POST"  enctype="multipart/form-data"

    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Import Data Pengajar
            </x-forms.header>

            <x-forms.body >
                <x-splade-file name="file" :label="__('Upload File')" required />
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

