<div class="cbp-item">
    <a href="{{ route('portfolio.show', $item->slug) }}">
        <figure class="fig">
            @if($item->getFirstMedia('preview'))
            <img src="{{ $item->getFirstMedia('preview')->getFullUrl('small')}}"
                 alt="{{ $item->title}}">
            @endif
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