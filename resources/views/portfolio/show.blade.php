@extends('layouts.main')

@section('content')
    <div class="cont">
        <section class="portfolio-single type-3 top_90 row">
            <div class="col-md-8 offset-md-2 text-center">
                <h1 class="title bottom_45 top_120">{{ $item->title }}</h1>
                <p class="bottom_30">{!! $item->description  !!}</p>
                <ul style="text-align: left;" class="information">
                    @if( $item->link )
                        <li><span>Website:</span> <a target="_blank" href="{{ $item->link }}">{{ $item->link }}</a></li>
                    @endif
                    <li><span>Category:</span>
                        @foreach($item->categories as $category)
                            {{ $category->title }}
                        @endforeach
                    </li>
                </ul>
            </div>

            <div class="col-md-12 portfolio-images top_90">
                @foreach($item->getMedia('images') as $image)
                    <figure><img src="{{ $image->getFullUrl('big') }}" alt="{{ $image->getCustomProperty('alt')}}">
                    </figure>
                    @php
                        $description = null;
                        if($image->hasCustomProperty('description')) {
                            $description = ($image->hasCustomProperty('description.' . app()->getLocale())) ? $image->getCustomProperty('description.' . app()->getLocale()) : $image->getCustomProperty('description.' . config('app.locale'));
                        }
                    @endphp
                    @if($description)
                        <p style="text-align: center;" class="bottom_30">{{ $description }}</p>
                    @endif
                @endforeach
            </div>

            <div class="col-md-12 portfolio-nav text-center top_90">
                <a class="port-next" href="work-5.html">
                    <div class="nav-title">next</div>
                    <div class="next-title">Vrai Vodka</div>
                </a>
            </div>

        </section>

    </div> <!-- cont end -->
@endsection