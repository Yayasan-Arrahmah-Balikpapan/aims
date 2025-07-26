<?php

namespace App\Tables\Admin;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class TlaJadwal extends AbstractTable
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
        return Jadwal::whereHas('periode.unit', function ($query) {
            $query->where('id', 3);
        })->orderBy('created_at', 'desc');
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
        ->withGlobalSearch(columns: ['nama_jadwal', 'pengajar.user.name', 'periode.angkatan', 'hari_belajar'])
        ->rowLink(fn (Jadwal $jadwal) => route('admin.jadwal.show', ['unit' => 'tahsin', 'jadwal' => $jadwal->id],$jadwal))
        ->column(
            key:'periode.nama',
            label:'Periode',
        )
        ->column(
            key:'pengajar.kode_nama_pengajar',
            label:'Pengajar',
            sortable: true
        )
        ->column('jenis_peserta')
        ->column('nama_jadwal')
        ->column(
            key:'level.nama',
            label:'Level',
            sortable: true
        )
        ->column('hari_belajar', sortable: true)
        ->column('jam_mulai')
        ->column('status_belajar', sortable: true)
        ->paginate(15)
        ;
    }
}
