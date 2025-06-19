<?php

namespace App\Tables\HRD;

use App\Models\KaryawanKunjungan;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class DataKaryawanKunjungan extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return KaryawanKunjungan::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['user.name', 'tujuan', 'lokasi', 'waktu', 'durasi', 'keterangan'])
            ->column('user.name', sortable: true)
            ->column('tujuan')
            ->column('lokasi')
            ->column('waktu', sortable: true)
            ->column('durasi')
            ->column('keterangan')
            ->column(label: 'Actions')
            ->export()
            ->paginate(10)
            ;

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
