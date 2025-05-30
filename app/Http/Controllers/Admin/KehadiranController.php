<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{

    public function index($unit, $periode)
    {
        $kehadirans = \App\Models\Absen::all();
        $dataperiode = \App\Models\Periode::find( $periode);

        // return response()->json($kehadirans);
        return view('dashboard.admin.periode.kehadiran.index', compact('unit','periode', 'kehadirans', 'dataperiode'));

    }

    public function create($unit, $periode)
    {
        return view('dashboard.admin.periode.kehadiran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Add other fields validation here
        ]);

        $kehadiran = \App\Models\Absen::create($validated);

        return redirect()->route('admin.kehadiran.index')
                        ->with('success', 'Kehadiran created successfully.');
    }

    public function show($id)
    {
        $kehadiran = \App\Models\Absen::findOrFail($id);
        return view('admin.kehadiran.show', compact('kehadiran'));
    }

    public function edit($id)
    {
        $kehadiran = \App\Models\Absen::findOrFail($id);
        return view('admin.kehadiran.edit', compact('kehadiran'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Add other fields validation here
        ]);

        $kehadiran = \App\Models\Absen::findOrFail($id);
        $kehadiran->update($validated);

        return redirect()->route('admin.kehadiran.index')
                        ->with('success', 'Kehadiran updated successfully.');
    }

    public function destroy($id)
    {
        $kehadiran = \App\Models\Absen::findOrFail($id);
        $kehadiran->delete();

        return redirect()->route('admin.kehadiran.index')
                        ->with('success', 'Kehadiran deleted successfully.');
    }

}
