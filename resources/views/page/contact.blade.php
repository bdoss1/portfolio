@extends('layouts.main')

@section('content')
    <section class="titlebar">
        <h1 class="page-title"><span>@lang('custom.contact')</span></h1>
        <div id="particles-js"></div>
    </section>

    <hr class="col-md-6">

    <div class="cont">
        <div class="breadcrumbs top_15 bottom_30">
            {{ Breadcrumbs::render() }}
        </div>

        <section class="contact col-md-8 offset-md-2 top_90">
            <div class="contact-info text-center">
                <p>1444 S. Alameda Street Los Angeles, California 90021 </p>
                <a href="hi@gorge.com">hi@gorge.com</a>
                <p>0800 123 456789</p>
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