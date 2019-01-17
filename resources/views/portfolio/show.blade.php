@extends('layouts.main')

@section('content')
    <div class="cont">
        <section class="portfolio-single type-3 top_90 row">
            <div class="col-md-8 offset-md-2 text-center">
                <h1 class="title bottom_45 top_120">{{ $item->title }}</h1>
                <p class="bottom_30">{!! $item->description  !!}</p>
                <ul style="text-align: left; margin-bottom: 30px;" class="information">
                    <li><span>@lang('custom.date'):</span> {{ \Date::parse($item->published_at)->format('j F Y') }}</li>
                    @if( $item->link )
                        <li><span>@lang('custom.link'):</span> <a target="_blank"
                                                                  href="{{ $item->link }}">{{ $item->link }}</a></li>
                    @endif
                    <li><span>@lang('custom.categories'):</span>
                        @foreach($item->categories as $category)
                            <a target="_blank"
                               href="{{ route('category.show_portfolio', $category->slug) }}">{{ $category->title }}</a>
                        @endforeach
                    </li>
                </ul>

                @php
                    $htmlItems = \App\Services\PortfolioHtmlService::get($item->dir_path);
                @endphp
                @if($htmlItems)
                    <ul style="text-align: left; display: block;" class="information">
                        <li>
                            <span>@lang('custom.html'): </span>
                            @foreach($htmlItems as $html)
                                <a target="_blank" href="{{ $html['path'] }}">{{ $html['name'] }}</a>
                            @endforeach
                        </li>
                    </ul>
                @endif
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
                <a class="port-next" href="{{ route('portfolio.show', $next->slug) }}">
                    <div class="nav-title">@lang('custom.next')</div>
                    <div class="next-title">{{ $next->title }}</div>
                </a>
            </div>

        </section>

    </div> <!-- cont end -->
@endsection