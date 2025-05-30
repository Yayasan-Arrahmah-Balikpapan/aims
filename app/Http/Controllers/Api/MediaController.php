<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // <-- Tambahkan baris ini
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct(protected MediaService $service) {}

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        return response()->json($this->service->storeFromRequest($request));
    }

    public function list()
    {
        return response()->json($this->service->list());
    }


    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return response()->json($this->service->update($id, request()->get('name')));
    }

    public function delete($id)
    {
        $this->service->delete($id);
        return response()->noContent();
    }
}
