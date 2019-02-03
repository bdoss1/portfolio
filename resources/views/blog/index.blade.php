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
            <div class="row">

                @forelse($items as $item)
                    @include('blog._item', ['item' => $item])
                    <!-- a news -->
                @empty
                    <div class="col-md">@lang('messages.its_empty')</div>
                @endforelse


            </div>


        </section>
    </div>
@endsection
