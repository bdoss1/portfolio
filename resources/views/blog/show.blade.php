@extends('layouts.main')

@section('content')
    <div class="cont">
        <section class="news-article top_90">
            <article>
                <figure class="article-image bottom_30">
                    @if($item->getFirstMedia('preview'))
                        <img src="{{ $item->getFirstMedia('preview')->getFullUrl('big') }}"
                             alt="{{ $item->title}}">
                    @endif
                </figure>
                <div class="breadcrumbs top_15 bottom_15">
                    {{ Breadcrumbs::render('blog.show', $item) }}
                </div>
                @foreach($item->categories as $categoryItem)
                    <a class="news-category_link" href="{{ route('blog.category.show', $categoryItem->slug) }}">
                        <small class="category">{{ $categoryItem->title }}</small>
                    </a>
                @endforeach
                <h1 class="title">{{ $item->title }}</h1>
                <div class="information bottom_30">{{ $item->user->name }},
                    <span>{{ \Date::parse($item->published_at)->format('j F Y') }}</span></div>
                {!! $item->content !!}
            </article>

            <comment-component
                model="{{ \App\Models\Blog::class }}"
                model-id="{{ $item->id }}"
                prefix="{{ config('comment.prefix') }}"
                is-user-logged="{{ Auth::check() }}"
            ></comment-component>

            <!-- COMMENTS -->
            <div class="article-comments top_120">
                <h2 class="subtitle">Post Comments</h2>
                <!-- a comment -->
                <div class="comment row top_60">
                    <figure class="col-md-2">
                        <img src="images/comment-1.jpg" alt="">
                    </figure>
                    <div class="comment-content col-md-10">
                        <h3 class="title top_15">Mary R. Peterson</h3>
                        <span class="date">March 2, 2018</span>
                        <p>He must have tried it a hundred times, shut his eyes so that he wouldn't have to look at the
                            floundering legs, and only stopped when he began to feel a mild, dull pain there. </p>
                        <a href="#" class="reply">Reply</a>
                    </div>
                </div>
                <!-- a comment -->
                <div class="comment reply row top_45">
                    <figure class="col-md-2">
                        <img src="images/comment-2.jpg" alt="">
                    </figure>
                    <div class="comment-content col-md-10">
                        <h3 class="title top_15">Charles A. Bullock</h3>
                        <span class="date">March 19, 2018</span>
                        <p>He must have tried it a hundred times, shut his eyes so that he wouldn't have to look at the
                            floundering legs, and only stopped when he began to feel a mild, dull pain there. </p>
                        <a href="#" class="reply">Reply</a>
                    </div>
                </div>
                <!-- a comment -->
                <div class="comment row top_45">
                    <figure class="col-md-2">
                        <img src="images/comment-3.jpg" alt="">
                    </figure>
                    <div class="comment-content col-md-10">
                        <h3 class="title top_15">Geoffrey B. Ashley</h3>
                        <span class="date">February 5, 2018</span>
                        <p>He must have tried it a hundred times, shut his eyes so that he wouldn't have to look at the
                            floundering legs, and only stopped when he began to feel a mild, dull pain there. </p>
                        <a href="#" class="reply">Reply</a>
                    </div>
                </div>
            </div>

            <!-- LEAVE A COMMENT -->
            <div class="leave-reply top_90">
                <h2 class="subtitle bottom_45">Leave a Reply</h2>
                <form class="row">
                    <div class="col-md-4">
                        <input class="inp" type="text" placeholder="Name">
                    </div>
                    <div class="col-md-4">
                        <input class="inp" type="text" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <input class="inp" type="text" placeholder="Website">
                    </div>
                    <div class="col-md-12">
                        <textarea placeholder="Your Comment" rows="8" class="col-md-12 form-message"></textarea>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Submit" class="site-btn2">
                    </div>
                </form>
            </div>

        </section>

    </div> <!-- cont end -->
@endsection
