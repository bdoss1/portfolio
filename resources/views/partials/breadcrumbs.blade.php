@if (count($breadcrumbs))

    <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
        @foreach ($breadcrumbs as $key => $breadcrumb)
            @php
                $position = $key+1;
            @endphp
            @if ($loop->last)

                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="active">
                    <span itemprop="name">{{ $breadcrumb->title }}</span>
                    <meta itemprop="position" content="{{ $position }}">
                </li>

            @elseif ($breadcrumb->url)

                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a href="{{ $breadcrumb->url }}">
                        <span itemprop="name">{{ $breadcrumb->title }}</span>
                    </a>
                    <meta itemprop="position" content="{{ $position }}">
                </li>

            @else

                {{-- Using .active to give it the right colour (grey by default) --}}
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="active">
                    <span itemprop="name">{{ $breadcrumb->title }}</span>
                    <meta itemprop="position" content="{{ $position }}">
                </li>

            @endif
        @endforeach
    </ul>

@endif
