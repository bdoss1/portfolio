@extends('layouts.main')

@section('content')
    <section class="home">
        <div id="particles-js"></div>
        <div class="home-content">
            <h1 class="hero-title">Создание<br><span>сайтов</span></h1>
            <p class="top_45">Меня зовут Ярослав. В области веб-разработки я уже более 6-ти лет. <br/>За это время я
                накопил не малый опыт. <br/>И если Вам нужен <span class="element" data-text1="качественный"
                                                                   data-text2="интересный" data-text3="уникальный"
                                                                   data-loop="true" data-backdelay="1500"></span>
                сайт - вы по адресу! </p>
            <div class="social">
                <a class="text">social links</a>
                <div class="line"></div>
                <a href="#"><i class="fab fa-facebook"></i> </a>
                <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i> </a>
                <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i> </a>
                <a href="#"><i class="fab fa-behance" aria-hidden="true"></i> </a>
                <a href="#"><i class="fab fa-dribbble" aria-hidden="true"></i> </a>
            </div>
        </div>
    </section>

    <div class="cont">
        <section id="portfolio" class="portfolio">
            <div id="grid-container">
                @foreach($portfolioItems as $portfolioItem)
                    @include('portfolio._item', ['item' => $portfolioItem])
                @endforeach
            </div>
            <!-- load more button -->
            <div id="port-loadMore" class="cbp-l-loadMore-button top_120 bottom_90">
                <a href="{{ route('portfolio.index') }}" class="cbp-l-loadMore-link site-btn" rel="nofollow">
                        <span class="cbp-l-loadMore-defaultText">@lang('custom.all_works') (<span
                                    class="cbp-l-loadMore-loadItems">{{ $portfolioItemsCount }}</span>)</span>

                </a>
            </div>
        </section>

        <hr class="top_90 bottom_90 col-md-8">

        <section class="widget-twitter top_60">
            <div class="widget-title">
                <h2 class="classic-title">Latest Tweets</h2>
            </div>
            <div class="tweet">
                <ul>
                    <li class="item">12312</li>
                </ul>
            </div>
            <a href="https://twitter.com/envato" target="_blank" class="twitter-account">@envato</a>
        </section>
    </div> <!-- cont end -->
@endsection


@section('after.script')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection