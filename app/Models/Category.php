<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Services\UploadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
   use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
           get:fn () => UploadService::url($this->image),
        )  ;
    }
}

