$(document).ready(function() {
    function fullhome() {
        var hometext = $('.home, .portfolio-hero');
        hometext.css({
            "height": $(window).height() + "px"
        });
    }
    fullhome();
    $(window).resize(fullhome);

    $('.element').each(function () {
        $(this).typed({
            strings: [$(this).data('text1'), $(this).data('text2'), $(this).data('text3')],
            loop: $(this).data('loop') ? $(this).data('loop') : false,
            backDelay: $(this).data('backdelay') ? $(this).data('backdelay') : 2000,
            typeSpeed: 10,
        });
    });

    // PORTFOLIO EFFECT
    $(".cbp-item").hover3d({
        selector: "figure",
        perspective: 3000,
        shine: true
    });

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

});