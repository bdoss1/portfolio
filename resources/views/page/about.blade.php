@extends('layouts.main')

@section('content')
    <section class="titlebar">
        <h1 class="page-title"><span>@lang('custom.about')</span></h1>
        <div id="particles-js"></div>
    </section>

    <hr class="col-md-6">

    <div class="cont">
        <div class="breadcrumbs top_15 bottom_30">
            {{ Breadcrumbs::render() }}
        </div>

        <section class="about">
            <!-- ABOUT TEXT -->
            <div class="about-text text-center ">
                <h2 class="subtitle">It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a
                    heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to
                    look out the window at the dull weather.</h2><br>
                <p>What about if he reported sick? But that would be extremely strained and suspicious as in fifteen
                    years of service Gregor had never once yet been ill.</p>
                <p>A collection of textile samples lay spread out on the table and above it there hung a picture that he
                    had recently cut out of an illustrated magazine and housed in a nice, gilded frame. </p>
                <p>What about if he reported sick? But that would be extremely strained and suspicious as in fifteen
                    years of service Gregor had never once yet been ill.</p>
            </div>
        </section>
    </div>
@endsection