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
            if (!response.data.more_btn.is_visible) $('.is-visible-js').remove();
            $('.count-items-js').text(response.data.more_btn.count_items);
            $('#blog-items').append(response.data.items);
            sitelazyLoad.update();
        }
    }).catch(error => {
        // console.log(error.data);
    });


});
