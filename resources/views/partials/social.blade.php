@foreach(json_decode(config('settings.socials'), true) as $key => $social)
    <a style="cursor: pointer;" onclick="$(this).next().submit()"><i class="fab {{ $social['icon'] }}"></i> </a>
    <form style="display: none;" method="POST" target="_blank" action="{{ hide_redirect($social['url']) }}">
        @csrf
    </form>
@endforeach
