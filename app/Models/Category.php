<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    protected $guarded = ['id'];

    public function media(){
        return $this->belongsTo(Media::class);
    }
    
    public function thumbnail(): Attribute
{
    $src = asset('default.webp');

    if ($this->media && Storage::exists($this->media->src)) {
        $src = Storage::url($this->media->src);
    }

    return Attribute::make(
        get: fn () => $src
    );
}
}

