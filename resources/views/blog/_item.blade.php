<div class="col-md-4 col-sm-6 news bottom_60 bottom_60">
    <article class="news-box">
        <a href="{{ route('blog.show', $item->slug) }}">
            <figure>
                <img src="{{ \App\Services\ThumbService::fit($item->image, 450, 300, 90) }}"
                     alt="{{ $item->title}}">
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
