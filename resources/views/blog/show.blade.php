@extends('layouts.main')

@section('content')
    <div class="cont">
        <section class="news-article top_90">
            <article>
                <figure class="article-image bottom_30">
                    <img src="{{ \App\Services\ThumbService::resize($item->image, 1200, 'auto', 90) }}"
                         alt="{{ $item->title}}">
                </figure>
                <div class="breadcrumbs top_15 bottom_15">
                    {{ Breadcrumbs::render('blog.show', $item) }}
                </div>
                @foreach($item->categories as $key => $categoryItem)

                    <a class="news-category_link" href="{{ route('blog.category.show', $categoryItem->slug) }}">
                        <small class="category">{{ $categoryItem->title }} </small>
                    </a>

                @endforeach
                <h1 class="title">{{ $item->title }}</h1>
                <div class="information bottom_30">{{ $item->user->name }},
                    <span>{{ \Date::parse($item->published_at)->format('j F Y') }}</span></div>

                {!! \App\Services\CustomBladeCompiler::render($item->content) !!} {{--Compile blade from string--}}
            </article>

            <comment-component></comment-component>

        </section>

    </div> <!-- cont end -->
@endsection

@section('before.script')
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" defer></script>
    {!! \Comment::config('Blog', $item->id) !!}
@endsection