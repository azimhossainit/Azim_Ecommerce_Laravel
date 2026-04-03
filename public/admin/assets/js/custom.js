$(document).on('click', '.wishlist-btn', function () {
    let slug = $(this).data('slug');

    $.ajax({
        url: '/wishlist/add/' + slug,
        type: 'GET',
        success: function (res) {
            if (res.status === 'success') {
                alert(res.message);

                let count = parseInt($('.wishlist-count').text());
                $('.wishlist-count').text(count + 1);
            }
        }
    });
});