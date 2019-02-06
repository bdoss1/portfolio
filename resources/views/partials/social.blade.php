@foreach(json_decode(config('settings.socials'), true) as $key => $social)
    <a style="cursor: pointer;" onclick="$(this).next().submit()"><i class="fab {{ $social['icon'] }}"></i> </a>
    <form style="display: none;" method="POST" target="_blank" action="{{ route('redirect') }}">
        @csrf
        <input type="hidden" name="value" value="{{ encrypt($social['url']) }}">
    </form>
@endforeach
