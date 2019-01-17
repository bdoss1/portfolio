@extends('layouts.main')

@section('content')
    <section class="titlebar">
        <h1 class="page-title"><span>Portfolio</h1>
        <div id="particles-js"></div>
    </section>

    <hr class="col-md-6 bottom_60">

    <div class="cont">
        <section id="portfolio" class="portfolio">

            <div id="grid-container">

                @foreach($items as $item)
                    <div class="cbp-item photography">
                        <a href="{{ route('portfolio.show', $item->slug) }}">
                            <figure class="fig">
                                <img src="{{ $item->getFirstMedia('preview')->getFullUrl('small')}}"
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
                @endforeach

            </div>
            <!-- load more button -->
            <div id="port-loadMore" class="cbp-l-loadMore-button top_120 bottom_90">
                <a href="port.html" class="cbp-l-loadMore-link site-btn" rel="nofollow">
                    <span class="cbp-l-loadMore-defaultText">Load More (<span class="cbp-l-loadMore-loadItems">2</span>)</span>
                    <span class="cbp-l-loadMore-loadingText">Loading...</span>
                    <span class="cbp-l-loadMore-noMoreLoading">No More Works</span>
                </a>
            </div>
        </section>
    </div>
@endsection

@section('after.script')

    <script>
        $('#grid-container').cubeportfolio({
            layoutMode: 'grid',
            filters: '.portfolio-filter',
            gridAdjustment: 'responsive',
            animationType: 'skew',
            defaultFilter: '*',
            gapVertical: 30,
            gapHorizontal: 30,
            singlePageAnimation: 'fade',
            mediaQueries: [{
                width: 700,
                cols: 3,
            }, {
                width: 480,
                cols: 2,
                options: {
                    caption: '',
                    gapHorizontal: 30,
                    gapVertical: 20,
                }
            }, {
                width: 320,
                cols: 1,
                options: {
                    caption: '',
                    gapHorizontal: 50,
                }
            }],
            singlePageCallback: function (url, element) {
                var t = this;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    timeout: 30000
                })
                    .done(function (result) {
                        t.updateSinglePage(result);
                    })
                    .fail(function () {
                        t.updateSinglePage('AJAX Error! Please refresh the page!');
                    });
            },
            plugins: {
                loadMore: {
                    element: '#port-loadMore',
                    action: 'click',
                    loadItems: 3,
                }
            }
        });
    </script>
@endsection