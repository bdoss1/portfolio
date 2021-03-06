$(document).ready(function () {
    $('.full-menu').removeAttr('style');

    // RESPONSIVE MENU
    $('.nav-icon').click(function () {
        $('body').toggleClass('full-open');
    });

    if ($('#particles-js').length > 0) {
        particlesJS('particles-js',
            {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ddd"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#888888"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 5,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#777",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true,
                "config_demo": {
                    "hide_card": false,
                    "background_color": "#b61924",
                    "background_image": "",
                    "background_position": "50% 50%",
                    "background_repeat": "no-repeat",
                    "background_size": "cover"
                }
            }
        );
    }


    var owlcar = $('.owl-carousel');
    if (owlcar.length) {
        owlcar.owlCarousel({
            items: 1,
            autoHeight: true,
            dots: true
        });
    }
    // OWL CAROUSEL GENERAL JS
    // var owlcar = $('.owl-carousel');
    // if (owlcar.length) {
    //     owlcar.each(function () {
    //         var $owl = $(this);
    //         var itemsData = $owl.data('items');
    //         var autoPlayData = $owl.data('autoplay');
    //         var paginationData = $owl.data('pagination');
    //         var navigationData = $owl.data('navigation');
    //         var stopOnHoverData = $owl.data('stop-on-hover');
    //         var itemsDesktopData = $owl.data('items-desktop');
    //         var itemsDesktopSmallData = $owl.data('items-desktop-small');
    //         var itemsTabletData = $owl.data('items-tablet');
    //         var itemsTabletSmallData = $owl.data('items-tablet-small');
    //         $owl.owlCarousel({
    //             items: itemsData,
    //             autoHeight:true
    //             , pagination: paginationData
    //             , navigation: navigationData
    //             , autoPlay: autoPlayData
    //             , stopOnHover: stopOnHoverData
    //             , navigationText: ["<", ">"]
    //             , itemsCustom: [
    //                 [0, 1]
    //                 , [500, itemsTabletSmallData]
    //                 , [710, itemsTabletData]
    //                 , [992, itemsDesktopSmallData]
    //                 , [1199, itemsDesktopData]
    //             ]
    //             ,
    //         });
    //     });
    // }

});

document.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
});

window.sitelazyLoad = new LazyLoad({
    elements_selector: ".lazy-load-image",
    callback_load: function (el) {
        $(el).removeAttr('width')
            .removeAttr('height');
        $(el).parent().removeClass('lazy-wrap_loading');
    }
});



