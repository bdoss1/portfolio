<div class="cbp-item">
    <a href="{{ route('portfolio.show', $item->slug) }}">
        <figure class="fig">
            @php
                $image = getimagesize( \Storage::disk('public')->path(str_replace('storage/','', $item->image)));
            @endphp
            <img width="{{ $image[0] }}" height="{{ $image[1] }}"
                 src="data:image/gif;base64,R0lGODlhAQABAPAAAP///////yH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                 data-cbp-src="{{ \App\Services\ThumbService::resize($item->image, 450, 'auto', 90) }}"
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
