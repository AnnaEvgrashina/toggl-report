$('#daterangepicker').daterangepicker({
    locale: {
        format: 'DD.MM.YYYY'
    }
});

$('body').on('click', '#form-report input[type=submit]', function (e) {
    e.preventDefault();
    e.stopPropagation();
    $.ajax({
        type: 'POST',
        url: '/getReport',
        data: ({
            _token: $('#form-report input[type=hidden]').val(),
            access_token: $('#form-report #access_token').val(),
            email: $('#form-report #email').val(),
            password: $('#form-report #password').val(),
            dates: $('#form-report #daterangepicker').val()
        }),
        success: function (response) {
            $('#report').html(response);
        }
    });
});
