@extends('layouts.main')

@section('content')
    <section class="home">
        <div id="particles-js"></div>
        <div class="home-content">
            <h1 class="hero-title">{!! $page->title !!}</h1>
            {!! $page->content !!}
            @if(config('settings.socials'))
                <div class="social">
                    <a class="text">social links</a>
                    <div class="line"></div>


                    @include('layouts._social')
                </div>
            @endif

        </div>
    </section>

    <div class="cont">
        <section id="portfolio" class="portfolio">
            <div id="grid-container">
                @foreach($portfolioItems as $portfolioItem)
                    @include('portfolio._item', ['item' => $portfolioItem])
                @endforeach
            </div>
            <!-- load more button -->
            <div id="port-loadMore" class="cbp-l-loadMore-button top_120 bottom_90">
                <a href="{{ route('portfolio.index') }}" class="cbp-l-loadMore-link site-btn" rel="nofollow">
                        <span class="cbp-l-loadMore-defaultText">@lang('custom.all_works') (<span
                                    class="cbp-l-loadMore-loadItems">{{ $portfolioItemsCount }}</span>)</span>

                </a>
            </div>
        </section>


        @widget('lastReviews')

        <div class="about">
            @include('partials.skills')
        </div>
    </div> <!-- cont end -->
@endsection


@section('after.script')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
