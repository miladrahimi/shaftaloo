$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
    });

    $.ajax({
        method: 'get',
        url: '/api/v1/users/profile',
    }).done(function (data) {
        $('#username').html('@' + data.username);
        $('#loading').fadeOut('slow');
    }).fail(function () {
        console.log(data);
        // window.location.href = "sign-in.html";
    });

    $.ajax({
        method: 'get',
        url: '/api/v1/dashboard',
    }).done(function (data) {

        console.log(data);
    }).fail(function () {
        console.log(data);
    });
});
