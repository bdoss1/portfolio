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

        <section class="contact col-md-8 offset-md-2 top_90">
            <div class="contact-info text-center">
                {!! $page->content !!}
            </div>
            <div class="contact-form top_90">
                <contact-form-component
                        route="{{ route('form.contact') }}"
                        is-user-logged="{{ \Auth::check() }}"
                ></contact-form-component>
            </div>


        </section>
    </div>
@endsection
