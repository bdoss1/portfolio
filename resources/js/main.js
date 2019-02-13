require('./../template/cubeportfolio/js/jquery.cubeportfolio.min');
require('./../template/js/typed');
require('./../template/js/jquery.hover3d');

$(document).ready(function () {
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

    setTimeout(() => {
        // PORTFOLIO EFFECT
        $(".cbp-item").hover3d({
            selector: "figure",
            perspective: 3000,
            shine: true
        });

        $('#grid-container').cubeportfolio({
            layoutMode: 'grid',
            gridAdjustment: 'responsive',
            animationType: 'skew',
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
            }]
        });
    }, 100);


});