<?php

namespace App\Tables\Admin;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class RtqPengajar extends AbstractTable
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
        return Pengajar::where('unit_id', 2)->orderBy('created_at', 'desc');
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
            ->withGlobalSearch(columns: ['user.name','user.phone_number'])
            ->rowLink(fn (Pengajar $pengajar) => route('admin.pengajar.show', ['unit' => 'tahsin', 'pengajar' => $pengajar->id],$pengajar))
            ->column('id', sortable: true)
            ->column(
                key:'kode_nama_pengajar',
                label:'Pengajar',
            )
            ->column(
                key:'user.name',
                label:'Nama',
            )
            ->column(
                key:'user.phone_number',
                label:'No Telp',
            )
            ->paginate(15)
            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
            ;
    }
}
