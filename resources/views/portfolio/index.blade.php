@extends('layouts.main')

@section('content')
    <section class="titlebar">
        @isset($category)
            <h1 class="page-title page-title_small"><span>{{ $page->title }}</span> {{ $category->title }}</h1>
        @else
            <h1 class="page-title "><span>{{ $page->title }}</span></h1>
        @endisset
        <div id="particles-js"></div>
    </section>

    <hr class="col-md-6">

    <div class="cont">
        <div class="breadcrumbs top_15 bottom_15">
            @isset($category)
                {{ Breadcrumbs::render('portfolio.category.show', $category) }}
            @else
                {{ Breadcrumbs::render('portfolio.index') }}
            @endisset
        </div>

        <div class="categories-menu bottom_30">
            @php
                $categoryMenu = \Menu::new()->setActiveFromRequest();
                $categoryMenu->route('portfolio.index', __('custom.all_works'));
                foreach ($categories as $category_item) {
                    $categoryMenu->route('portfolio.category.show', $category_item->title, $category_item->slug);
                }
            @endphp
            {{ $categoryMenu }}
        </div>

        <section id="portfolio" class="portfolio">
            @if(count($items) > 0)
            <div id="grid-container" class="portfolio-items-js">
                @foreach($items as $item)
                    @include('portfolio._item', ['item' => $item])
                @endforeach

            </div>
            @else
                @lang('messages.its_empty')
            @endif
        @if($isButtonVisible)
            <!-- load more button -->
                @isset($category)

                    <div id="port-loadMore" class="is-visible-js cbp-l-loadMore-button top_120 bottom_90">
                        <a data-page="2" href="{{ route('portfolio.category.load', $category->slug) }}"
                           class="load-more-js cbp-l-loadMore-link site-btn" rel="nofollow">
                            <span class="cbp-l-loadMore-defaultText">@lang('custom.load_more') (<span
                                        class="count-items-js cbp-l-loadMore-loadItems">{{ $moreCountItems }}</span>)</span>
                        </a>
                    </div>
                @else
                    <div id="port-loadMore" class="is-visible-js cbp-l-loadMore-button top_120 bottom_90">
                        <a data-page="2" href="{{ route('portfolio.load') }}"
                           class="load-more-js cbp-l-loadMore-link site-btn" rel="nofollow">
                            <span class="cbp-l-loadMore-defaultText">@lang('custom.load_more') (<span
                                        class="count-items-js cbp-l-loadMore-loadItems">{{ $moreCountItems }}</span>)</span>
                        </a>
                    </div>
                @endif
            @endif
        </section>
    </div>
@endsection

@section('after.script')
    <script src="{{ mix('js/portfolio.js') }}" defer></script>
@endsection
