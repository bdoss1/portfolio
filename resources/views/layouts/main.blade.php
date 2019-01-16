<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gorge Portfolio Template</title>
    <meta name="description" content="Gorge Portfolio Template">
    <meta name="keywords" content="personal, portfolio">

    <!-- Google Web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
</head>
<body>
<div id="app">

    <!-- PRELOADER -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>


    <!-- HEADER -->
    <header>
        <img src="images/logo2.png" alt="Профессиональная разработка сайтов - yarmat.su">
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
                <ul>
                    <li><a href="index.html">Главная</a></li>
                    <li><a href="about.html">Обо мне</a></li>
                    <li><a href="news.html">Блог</a></li>
                    <li><a href="contact.html">Контакты</a></li>
                </ul>
            </nav>
            <div class="col-md-4 full-contact">
                <ul>
                    <li class="title">Связаться</li>
                    <li><a href="mailto:yarmatsu@gmail.com">yarmatsu@gmail.com</a></li>
                    <li>
                        <div class="social">
                            <a href="#"><i class="fab fa-facebook"></i> </a>
                            <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i> </a>
                            <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i> </a>
                            <a href="#"><i class="fab fa-behance" aria-hidden="true"></i> </a>
                            <a href="#"><i class="fab fa-dribbble" aria-hidden="true"></i> </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- SITE CONTENT -->
    <div class="wrapper">

        @yield('content')

    </div> <!-- wrapper end -->

    <footer>
        <div class="cont">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 copyright">
                    <img src="images/logo2.png" alt="">
                    <p>© 2018 Gorge Creative Agency</p>
                </div>
                <div class="col-md-4 d-sm-none d-md-block">
                    <div class="social">
                        <a href="#"><i class="fab fa-facebook"></i> </a>
                        <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i> </a>
                        <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i> </a>
                        <a href="#"><i class="fab fa-behance" aria-hidden="true"></i> </a>
                        <a href="#"><i class="fab fa-dribbble" aria-hidden="true"></i> </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 d-none d-sm-block getintouch">
                    <a href="#">
                        <strong>Get In Touch</strong><br>
                        <p>hi@gergedigital.co</p>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</div>

@yield('before.script')
<script src="{{ mix('js/app.js') }}"></script>
@yield('after.script')
</body>
</html>