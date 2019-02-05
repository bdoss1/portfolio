require('./../template/cubeportfolio/js/jquery.cubeportfolio.min');
require('./../template/js/jquery.hover3d');


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
    }]
});

$(document).on('click', '.load-more-js', function (e) {
    e.preventDefault();
    let item = $(this);
    let page = parseInt(item.attr('data-page'));
    let url = item.attr('href');

    axios.post(url, {
        page: page
    }).then(response => {

        if (response.data.success) {
            item.attr('data-page', page + 1);
            $("#grid-container").cubeportfolio('appendItems', response.data.items);
            // PORTFOLIO EFFECT
            $(".cbp-item").hover3d({
                selector: "figure",
                perspective: 3000,
                shine: true
            });
            if (!response.data.more_btn.is_visible) $('.is-visible-js').remove();
            $('.count-items-js').text(response.data.more_btn.count_items);
        }
    }).catch(error => {
        // console.log(error.data);
    });


});
