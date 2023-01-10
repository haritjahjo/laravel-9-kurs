<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends Controller
{
    public function getHomeData()
    {
        $slider = Property::where('visible', '=', 1)
            ->withWhereHas('media', function($query){
                $query->where('collection_name', '=', 'slider');
            })
            ->where('slider', '=', 1)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        //dd($slider);

        $newProjects = Property::where('visible', '=', 1)
            ->withWhereHas('media', function($query){
                $query->where('collection_name', '=', 'thumb-slider')
                ->orderBy('order_column' , 'asc');
            })
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();

            //dd($newProjects);
        return view('pages.welcome', [
            'slider' => $slider,
            'newProjects' => $newProjects,
        ]);
    }
}
