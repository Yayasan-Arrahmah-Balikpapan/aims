<x-layouts.main>

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Data Cabang Lomba - {{ $data_cabang->nama }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        <div class="w-full">
            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-700 ">
                    <thead>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="uppercase">
                                <div class="flex items-center gap-1 font-semibold p-2">
                                    Peserta
                                </div>
                            </th>
                            <th scope="col" class="uppercase">
                                <div class="flex items-center gap-1 font-semibold p-2">
                                    Tanggal Lahir
                                </div>
                            </th>
                            <th scope="col" class="uppercase">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peserta_lomba as $item)
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="uppercase p-2">
                                    <span class="text-gray-500 font-semibold">
                                        {{ $item->nama }} <br />
                                        {{ $item->user->phone_number }}
                                    </span>
                                </td>
                                <td class="uppercase p-2">
                                    <span class="text-gray-500 font-semibold">
                                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }} <br />
                                        {{ $item->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.main>
