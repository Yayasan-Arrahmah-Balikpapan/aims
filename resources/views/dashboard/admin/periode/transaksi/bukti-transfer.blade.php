<x-splade-modal :unit="$unit">
    <div class="flex items-center justify-center">
        <img src="{{ Storage::url($data_transaksi->data_pembayaran['bukti_transfer']) }}" alt="bukti transfer" class="w-full">
    </div>
</x-splade-modal>

