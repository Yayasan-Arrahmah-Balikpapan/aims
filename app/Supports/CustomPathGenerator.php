<?php

namespace App\Supports;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Carbon;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $date = Carbon::now();
        return $date->format('Y/m/d/') . $media->id . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}
