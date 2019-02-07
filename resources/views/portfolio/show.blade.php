@extends('layouts.main')

@section('content')
    <div class="cont">
        <section class="portfolio-single type-3 top_90 row">
            <div class="col-md-8 offset-md-2 text-center">
                <div class="breadcrumbs top_15 bottom_15">
                    {{ Breadcrumbs::render('portfolio.show', $item) }}
                </div>
                <h1 class="title bottom_45 top_45">{{ $item->title }}</h1>
                <p class="bottom_30">{!! $item->description  !!}</p>
                <ul style="text-align: left; margin-bottom: 30px;" class="information">
                    <li><span>@lang('custom.date'):</span> {{ \Date::parse($item->published_at)->format('j F Y') }}</li>
                    @if( $item->link )
                        <li>
                            <span>@lang('custom.link'): </span>
                            <form target="_blank" style="display: inline;" action="{{ route('redirect') }}"
                                  method="post">
                                @csrf
                                <input type="hidden" name="value" value="{{ encrypt($item->link) }}">
                                <button class="link-style" type="submit">@lang('custom.open')</button>
                            </form>
                    @endif
                    <li><span>@lang('custom.categories'):</span>
                        @foreach($item->categories as $key => $category)


                            @if((count($item->categories) - 1) != $key)
                                <a target="_blank" href="{{ route('portfolio.category.show', $category->slug) }}">
                                    {{ $category->title }}
                                </a>,
                            @else
                                <a target="_blank" href="{{ route('portfolio.category.show', $category->slug) }}">
                                    {{ $category->title }}
                                </a>
                            @endif


                        @endforeach
                    </li>
                </ul>
                @if($htmlItems)
                    <ul style="text-align: left; display: block;" class="information">
                        <li>
                            <span>@lang('custom.html'): </span>
                            @foreach($htmlItems as $key => $html)

                                @if((count($htmlItems) - 1) != $key)
                                    {!! redirect_item($html->url, $html->title) !!},
                                @else
                                    {!! redirect_item($html->url, $html->title) !!}
                                @endif

                            @endforeach
                        </li>
                    </ul>
                @endif
            </div>

            <div class="col-md-12 portfolio-images top_90">
                {!! $item->content !!}
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
