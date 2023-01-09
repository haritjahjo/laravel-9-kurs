<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;


class Property extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description', 
        'slider',
        'country', 
        'city', 
        'address', 
        'price', 
        'sqm', 
        'bedrooms',
        'bathrooms', 
        'garages',
        'start_date',
        'end_date',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(name:'slider-image')
            ->performOnCollections(collectionNames:'slider')
            ->crop('crop-center', width: 1920, height: 960)
            ->withResponsiveImages()
            ->nonQueued();        
        $this->addMediaConversion('thumb-slider')
            ->performOnCollections(collectionNames:'slider')
            ->crop('crop-center', width: 192, height: 96)
            ->nonQueued();
        $this->addMediaConversion('main')
            ->performOnCollections(collectionNames:'main-images')
            ->crop('crop-center', 600, 800)
            ->nonQueued(); // Trim or crop the image to the center for specified width and height.
        $this->addMediaConversion('thumb-main')
            ->performOnCollections(collectionNames:'main-images')
            ->crop('crop-center', 120, 160)
            ->nonQueued();
    }

    protected function price(): Attribute
    {
        return CastsAttribute::make(
            get: fn ($value) => number_format(intval($value), decimals:0, decimal_separator:'', thousands_separator:','), 
            set: fn ($value) => preg_replace(pattern:'/[^0-9]/', replacement:'', subject: intval($value)),
        );
    }


}
