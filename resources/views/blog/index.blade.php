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
        <div class="breadcrumbs top_15 bottom_30">
            @isset($category)
                {{ Breadcrumbs::render('blog.category.show', $category) }}
            @else
                {{ Breadcrumbs::render('blog.index') }}
            @endisset
        </div>

        <section class="our-news">
            <div id="blog-items" class="row ">

                @forelse($items as $item)
                    @include('blog._item', ['item' => $item])
                    <!-- a news -->
                @empty
                    <div class="col-md">@lang('messages.its_empty')</div>
                @endforelse


            </div>

        @if($isButtonVisible)
            <!-- load more button -->
                @isset($category)

                    <div id="port-loadMore" class="is-visible-js cbp-l-loadMore-button  bottom_90">
                        <a data-page="2" href="{{ route('blog.category.load', $category->slug) }}"
                           class="load-more-js cbp-l-loadMore-link site-btn" rel="nofollow">
                            <span class="cbp-l-loadMore-defaultText">@lang('custom.load_more') (<span
                                        class="count-items-js cbp-l-loadMore-loadItems">{{ $moreCountItems }}</span>)</span>
                        </a>
                    </div>
                @else
                    <div id="port-loadMore" class="is-visible-js cbp-l-loadMore-button  bottom_90">
                        <a data-page="2" href="{{ route('blog.load') }}"
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
    <script src="{{ mix('js/blog.js') }}"></script>
@endsection