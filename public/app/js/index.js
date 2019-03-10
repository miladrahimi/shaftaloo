$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
    });

    let app = new Vue({
        el: '#app',
        data: {
            user: {},
            balances: [],
            transactions: [],
        },
        methods: {
            loadingHide: function () {
                $('#loading').fadeOut('slow');
            },
            color: function (value, prefix = 'badge-') {
                return prefix + (value > 0 ? 'success' : 'warning')
            },
        },
    });

    $.ajax({
        method: 'get',
        url: '/api/v1/users/profile',
    }).done(function (user) {
        app.user = user;
        app.loadingHide();
    }).fail(function (data) {
        if (data.status === 401) {
            window.location.href = "sign-in.html";
        }

        console.log(data);
    });

    $.ajax({
        method: 'get',
        url: '/api/v1/dashboard',
    }).done(function (data) {
        app.balances = data.balances;
        app.transactions = data.transactions;
        console.log(data.transactions);
    }).fail(function () {
        console.log(data);
    });
});
