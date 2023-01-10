@php
    $img = $project->media[0];

@endphp
<div class="carousel-item-b swiper-slide">
    <div class="card-box-a card-shadow">
    <div class="img-box-a">
        <img src="{{ "/storage/" .$img->id . "/conversions/real-invest-" . $img->name . "-thumb-image.jpg"}}" alt="" class="img-a img-fluid">
    </div>
    <div class="card-overlay">
        <div class="card-overlay-a-content">
        <div class="card-header-a">
            <h2 class="card-title-a">
            <a style="font-size:80%; font-weight:300; text-shadow:2px 2px 2px #000; " href="property-single.html">{{$project->title}}</a>
            </h2>
            <p class="text-white">{{ $project->city}} | {{$project->country}}</p>
        </div>
        <div class="card-body-a">
            <div class="price-box d-flex">
            <span class="price-a">${{ $project->price}}</span>
            </div>
            <a href="#" class="link-a">Click here to view
            <span class="bi bi-chevron-right"></span>
            </a>
        </div>
        <div class="card-footer-a">
            <ul class="card-info d-flex justify-content-around">
            <li>
                <h4 class="card-info-title">Area</h4>
                <span>{{ number_format($project->sqm, 0,".", ",") }}m
                <sup>2</sup>
                </span>
            </li>
            <li>
                <h4 class="card-info-title">Beds</h4>
                <span>{{$project->bedrooms}}</span>
            </li>
            <li>
                <h4 class="card-info-title">Baths</h4>
                <span>{{$project->bathrooms}}</span>
            </li>
            <li>
                <h4 class="card-info-title">Garages</h4>
                <span>{{$project->garages}}</span>
            </li>
            </ul>
        </div>
        </div>
    </div>
    </div>
</div><!-- End carousel item -->