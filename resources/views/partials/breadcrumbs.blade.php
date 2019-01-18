@if (count($breadcrumbs))

    <ul>
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($loop->last)

                <li class="active">
                    {{ $breadcrumb->title }}
                </li>

            @elseif ($breadcrumb->url)

                <li>
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                </li>

            @else

                {{-- Using .active to give it the right colour (grey by default) --}}
                <li class="active">
                    {{ $breadcrumb->title }}
                </li>

            @endif
        @endforeach
    </ul>

@endif
