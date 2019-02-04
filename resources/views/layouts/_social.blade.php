@foreach(json_decode(config('settings.socials'), true) as $social)
    <a href="{{ $social['url'] }}"><i class="fab {{ $social['icon'] }}"></i> </a>
@endforeach
