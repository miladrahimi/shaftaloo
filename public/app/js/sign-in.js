$(document).ready(function () {
    $('#loading').fadeOut('slow');

    window.error = function (message) {
        $('#error').html(message);
        $('#error-container').slideDown('fast');
    };

    $('#sign-in input[type=button]').click(function () {
        let btn = $(this);
        btn.val('Please wait...').prop('disabled', true);

        $('#error-container').slideUp('fast');

        $.ajax({
            method: 'post',
            url: '/oauth/token',
            data: {
                grant_type: 'password',
                client_id: $('meta[name=client-id]').attr('content'),
                client_secret: $('meta[name=client-secret]').attr('content'),
                username: $('#username').val(),
                password: $('#password').val(),
            }
        }).done(function (data) {
            if (data.access_token !== undefined) {
                localStorage.setItem("token", data.access_token);
                window.location.href = "index.html";
            } else {
                window.error('Unknown error.');
            }
        }).fail(function (error) {
            window.error(error.responseJSON.message);
        }).always(function () {
            btn.val('Sign in').prop('disabled', false);
        });
    });
});
