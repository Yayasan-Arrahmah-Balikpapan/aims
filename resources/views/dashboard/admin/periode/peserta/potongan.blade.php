<x-splade-modal :unit="$unit">
    <x-splade-form action="#" method="POST" onkeydown="return event.key != 'Enter';"
        :default="[
            'penerimaan' => 'umum',
            'domisili' => '1',
        ]"
    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Potongan Biaya Peserta
            </x-forms.header>

            <x-forms.body >
                <div class="flex items-center">
                    <span>Rp. </span>
                    <x-splade-input type="number" name="potongan" class="flex-grow" :label="__('Potongan Biaya')" required min="0" oninvalid="this.setCustomValidity('Harus Diisi, Minimal 0')" />
                </div>
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

