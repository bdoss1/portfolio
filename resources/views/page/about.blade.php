@extends('layouts.main')

@section('content')
    <section class="titlebar">
        <h1 class="page-title"><span>{{ $page->title }}</span></h1>
        <div id="particles-js"></div>
    </section>

    <hr class="col-md-6">

    <div class="cont">
        <div class="breadcrumbs top_15 bottom_30">
            {{ Breadcrumbs::render('page', $page) }}
        </div>

        <section class="about">
            <!-- ABOUT TEXT -->
            <div class="about-text text-center ">
                {!! $page->content !!}
            </div>
        </section>
    </div>
@endsection
