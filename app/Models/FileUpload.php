<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FileUpload extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'user_id', 'type', 'tag', 'category', 'data'];

    protected $casts = [
        'data' => 'array',
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('uploads')
            ->useDisk('public')
            ;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(600)
            ->nonQueued();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media_uploads()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
