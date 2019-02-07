<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="{{ \Illuminate\Support\Facades\URL::current() }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @isset($seo)
        <title>{{ $seo->title ?? config('app.name', 'Portfolio') }}</title>
        @if(!empty($seo->description))
            <meta name="description" content="{{ $seo->description }}">
        @endif
        @if(!empty($seo->keywords))
            <meta name="keywords" content="{{ $seo->keywords }}">
        @endif
    @else
        <title>{{ config('app.name', 'Portfolio') }}</title>
    @endisset

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#000000">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="YarmaT - WebDev">
    <meta name="application-name" content="YarmaT - WebDev">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="{{ asset('favicons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <style>
        /* Preloader */
        body {
            margin: 0;
            padding: 0;
        }

        .preloader {
            position: fixed;
            display: block;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            z-index: 99999;
        }

        .preloader .loader {
            position: absolute;
            width: 30px;
            height: 30px;
            border: 4px solid #000;
            -o-animation: loader 2s infinite ease;
            -ms-animation: loader 2s infinite ease;
            -moz-animation: loader 2s infinite ease;
            -webkit-animation: loader 2s infinite ease;
            animation: loader 2s infinite ease;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
        }

        .preloader .loader .loader-inner {
            display: inline-block;
            width: 100%;
            vertical-align: top;
            background-color: #000;
            -o-animation: loader-inner 2s infinite ease-in;
            -ms-animation: loader-inner 2s infinite ease-in;
            -moz-animation: loader-inner 2s infinite ease-in;
            -webkit-animation: loader-inner 2s infinite ease-in;
            animation: loader-inner 2s infinite ease-in;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-inner {
            0% {
                height: 0%;
            }

            25% {
                height: 0%;
            }

            50% {
                height: 100%;
            }

            75% {
                height: 100%;
            }

            100% {
                height: 0%;
            }
        }
    </style>
</head>
<body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function fadeOutEffect(element, callback) {
            var fadeTarget = element;
            var fadeEffect = setInterval(function () {
                if (!fadeTarget.style.opacity) {
                    fadeTarget.style.opacity = 1;
                }
                if (fadeTarget.style.opacity > 0) {
                    fadeTarget.style.opacity -= 0.1;
                } else {
                    clearInterval(fadeEffect);
                    if (callback) callback();
                }
            }, 1);
        }

        fadeOutEffect(document.getElementsByClassName('loader')[0]);
        fadeOutEffect(document.getElementsByClassName('preloader')[0], function () {
            document.getElementsByClassName('preloader')[0].remove();
        });

    });
</script>

<!-- PRELOADER -->
<div class="preloader">
    <div class="loader">
        <div class="loader-inner"></div>
    </div>
</div>

<div id="app">
    <notifications classes="portfolio_notifications" group="foo" animation-type="velocity"
                   position="top right"></notifications>



    <!-- HEADER -->
    <header>
        @if(config('settings.logo'))
            @if(is_home())
                <img src="{{ asset(config('settings.logo')) }}" alt="{{ config('app.name')}}">
            @else
                <a href="{{ route('index') }}">
                    <img src="{{ asset(config('settings.logo')) }}" alt="{{ config('app.name')}}">
                </a>
            @endif
        @endif
        <div class="nav-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>


    <!-- FULL MENU -->
    <div class="full-menu">
        <div class="full-inner row">
            <nav class="col-md-8">
                {{
                    \Menu::new()
                        ->route('index', __('custom.home'))
                        ->route('page', __('custom.about'), 'about')
                        ->route('portfolio.index', __('custom.portfolio'))
                        ->route('blog.index', __('custom.blog'))
                        ->route('page', __('custom.contact'), 'contact')
                        ->setActiveFromRequest()
                 }}
            </nav>
            <div class="col-md-4 full-contact">
                <ul>
                    <li class="title">@lang('custom.get_in_touch')</li>
                    <li><a href="mailto:{{ config('settings.email') }}">{{ config('settings.email') }}</a></li>
                    <li>
                        @if(config('settings.socials'))
                        <div class="social">
                            @include('partials.social')
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-area">
        <!-- SITE CONTENT -->
        <div class="wrapper">

            @yield('content')

        </div> <!-- wrapper end -->

        <footer>
            <div class="cont">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12 copyright">
                        @if(config('settings.logo'))
                            @if(is_home())
                                <img src="{{ asset(config('settings.logo')) }}" alt="{{ config('app.name')}}">
                            @else
                                <a href="{{ route('index') }}">
                                    <img src="{{ asset(config('settings.logo')) }}"
                                         alt="{{ config('app.name')}}">
                                </a>
                            @endif
                        @endif
                        <p>{{ config('settings.copy') }}</p>
                    </div>
                    <div class="col-md-4 d-sm-none d-md-block">
                        @if(config('settings.socials'))
                            <div class="social">
                                @include('partials.social')
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 d-none d-sm-block getintouch">
                        <div>
                            @if(app()->getLocale() == 'ru')
                                <a href="{{ config('app.url') }}/en">English</a>
                            @endif
                            @if(app()->getLocale() == 'en')
                                <a href="{{ config('app.url') }}">Русский</a>
                            @endif
                        </div>
                        <a href="mailto:{{ config('settings.email') }}">
                            <strong>@lang('custom.get_in_touch')</strong><br>
                            <p>{{ config('settings.email') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<form id="show-me" target="_blank" style="display: none;" action="{{ route('redirect') }}" method="POST">
    @csrf
    <input type="hidden" name="value" value=""/>
</form>
<script>
    document.addEventListener('click', function (event) {

        if (!event.target.matches('.show-me_js')) return;

        event.preventDefault();

        var value = event.target.getAttribute('data-value');

        var form = document.getElementById('show-me');

        var input = form.elements['value'];

        input.value = value;

        form.submit();
    }, false);
</script>

@yield('before.script')
<script>
    window.Portfolio = {
        'captcha': {
            sitekey: '{{ config('captcha.sitekey') }}'
        },
        lang: {
            custom: JSON.parse(`{!! json_encode(__('custom')) !!}`),
            attributes: JSON.parse(`{!! json_encode(__('validation.attributes')) !!}`),
            messages: JSON.parse(`{!! json_encode(__('messages')) !!}`)
        }
    };
</script>
<link rel="stylesheet" href="{{ mix('css/combine.css') }}"/>
<script src="{{ mix('js/combine.js') }}" defer></script>
@yield('after.script')
</body>
</html>
