<div class="cbp-item">
    <a href="{{ route('portfolio.show', $item->slug) }}">
        <figure class="fig">
            <img src="{{ \App\Services\ThumbService::resize($item->image, 450, 'auto', 90) }}"
                 alt="{{ $item->title}}">
            <figcaption>
                <h3>{{ $item->title}}</h3>
                <p>
                    @foreach($item->categories as $category)
                        {{ $category->title }}
                    @endforeach
                </p>
            </figcaption>
        </figure>
    </a>
</div>
