$(function () {
    var $mainForm = $('#main-form');
    var $phoneField = $('#phone');
    var $simpleFilter = $('.simplefilter li');

    $simpleFilter.on('click', function (e) {
        $simpleFilter.removeClass('active');
        $(e.target).addClass('active');
    });

    $mainForm.on('submit', function (e) {
        var data = {
            phone: $phoneField.val(),
        };

        $.ajax({
            url: '/request',
            method: 'POST',
            data: data,
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });

        return false;
    });

});
