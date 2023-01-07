<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

}
