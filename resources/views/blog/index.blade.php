@extends('layouts.main')

@section('content')
    <section class="titlebar">
        @isset($category)
            <h1 class="page-title page-title_small"><span>@lang('custom.blog')</span> {{ $category->title }}</h1>
        @else
            <h1 class="page-title "><span>@lang('custom.blog')</span></h1>
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
            <div class="row">


                @forelse($items as $item)
                    <div class="col-md-4 col-sm-6 news bottom_60 bottom_60">
                        <article class="news-box">
                            <a href="{{ route('blog.show', $item->slug) }}">
                                <figure>
                                    @if($item->getFirstMedia('preview'))
                                        <img src="{{ $item->getFirstMedia('preview')->getFullUrl('small')}}"
                                             alt="{{ $item->title}}">
                                    @endif
                                </figure>
                            </a>
                            @foreach($item->categories as $categoryItem)
                                <a class="news-category_link"
                                   href="{{ route('blog.category.show', $categoryItem->slug) }}">
                                    <small>{{ $categoryItem->title }}</small>
                                </a>
                            @endforeach
                            <a class="hover_no_decoration" href="{{ route('blog.show', $item->slug) }}">
                                <h4 class="title">{{ $item->title }}</h4>
                            </a>
                            <p>{{ $item->description }}</p>
                            <div class="information">{{ $item->user->name }},
                                <span>{{ \Date::parse($item->published_at)->format('j F Y') }}</span></div>
                        </article>
                    </div>
                    <!-- a news -->
                @empty
                    <div class="col-md">@lang('messages.its_empty')</div>
                @endforelse


            </div>


        </section>
    </div>
@endsection
