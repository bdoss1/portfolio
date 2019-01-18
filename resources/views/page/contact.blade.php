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
                <form class="row">
                    <div class="col-md-6">
                        <input class="inp" type="text" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <input class="inp" type="text" placeholder="Email">
                    </div>
                    <div class="col-md-12">
                        <textarea placeholder="Your Message" rows="6" class="col-md-12 form-message"></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <input type="submit" value="Submit" class="site-btn2">
                    </div>
                </form>
            </div>


        </section>
    </div>
@endsection