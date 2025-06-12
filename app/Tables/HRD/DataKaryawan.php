<?php

namespace App\Tables\HRD;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class DataKaryawan extends AbstractTable
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
        return Karyawan::query();
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
            ->withGlobalSearch(columns: ['id'])
            // ->column('id', sortable: true)
            ->column(
                key:'nip',
                label:'NIP',
            )
            ->column(
                key:'user.name',
                label:'Nama',
            )
            ->column(
                key:'user.phone_number',
                label:'No Telp',
            )
            ->column(
                key:'jenis_kelamin',
                label:'Jenis Kelamin',
            )
            ->column(
                key:'divisi.nama',
                label:'Divisi',
            )
            ->column(
                key:'status_bekerja',
                label:'Status',
            )

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
            ->paginate(10)
            ;
    }
}
