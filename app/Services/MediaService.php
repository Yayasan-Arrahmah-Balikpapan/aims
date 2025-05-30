<?php

namespace App\Services;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MediaService
{
    public function storeFromRequest(Request $request)
    {
        $user =  Auth::guard('sanctum')->user();

        // Simpan dulu FileUpload record
        $upload = FileUpload::create([
            'name' => $request->file('file')->getClientOriginalName(),
            'user_id' => $user->id
        ]);

        // Upload ke media library
        $media = $upload->addMediaFromRequest('file')
            ->usingFileName(Str::uuid() . '.' . $request->file('file')->getClientOriginalExtension())
            ->withCustomProperties(['uploaded_by' => $user->name])
            ->toMediaCollection('uploads', 'public');

        return [
            'id' => $media->id,
            'url' => $media->getUrl(),
            'name' => $media->name,
            'size' => $media->size,
            'created_at' => $media->created_at->format('Y-m-d H:i'),
            'uploaded_by' => $user->name
        ];
    }

    public function list()
    {
        $perPage = request()->get('per_page', 10);
        $search = request()->get('search');

        $query = FileUpload::with(['media_uploads', 'user'])
            ->whereHas('media_uploads');

        if ($search) {
            $query->whereHas('media_uploads', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $uploads = $query->latest()->paginate($perPage);

        $data = $uploads->getCollection()->map(function ($upload) {
            $media = $upload->getFirstMedia('uploads');

            if (!$media) {
                return null;
            }

            return [
                'id' => $media->id,
                'name' => $media->name,
                'url' => $media->getUrl(),
                'thumbnail' => $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : null,
                'size' => $media->size,
                'uploaded_by' => $media->getCustomProperty('uploaded_by') ?? optional($upload->user)->name ?? 'Unknown',
                'created_at' => $media->created_at->format('Y-m-d H:i'),
                'type' => $media->mime_type
            ];
        })->filter()->values();

        // Set collection ke data yang sudah difilter
        $uploads->setCollection($data);

        return response()->json([
            'data' => $uploads->items(),
            'meta' => [
                'current_page' => $uploads->currentPage(),
                'from' => $uploads->firstItem(),
                'to' => $uploads->lastItem(),
                'per_page' => $uploads->perPage(),
                'total' => $uploads->total(),
                'last_page' => $uploads->lastPage(),
            ]
        ]);
    }

    public function update($id, $name)
    {

        // Update the Media record
        $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($id);
        $media->name = $name;
        $media->save();

        // Also update the associated FileUpload if needed
        $fileUpload = FileUpload::whereHas('media_uploads', function($q) use ($id) {
            $q->where('id', $id);
        })->first();

        if ($fileUpload) {
            // If you have a name field in FileUpload that should match
            $fileUpload->name = $name;
            $fileUpload->save();
        }

        return response()->json([
            'message' => 'File name updated successfully',
            'data' => [
                'id' => $media->id,
                'name' => $media->name
            ]
        ]);
    }

    public function delete($id)
    {
        $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($id);

        // Find and delete the associated FileUpload record
        $fileUpload = FileUpload::whereHas('media_uploads', function($q) use ($id) {
            $q->where('id', $id);
        })->first();

        if ($fileUpload) {
            $fileUpload->delete();
        }

        $media->delete();

        return response()->json([
            'message' => 'File deleted successfully',
            'deleted_id' => $id
        ]);
    }
}
