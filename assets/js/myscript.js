$(document).ready(function () {
    // initialize datatable library
    let lastColumn = $("#table thead tr th").length;
    let table = $('#table').DataTable({
        "paging": true,
        "ordering": true,
        "info": false,
        sDom: "ltrip",
        "lengthChange": false,
        "pageLength": 10,
        "order": [[1, "asc"]],
        "columnDefs": [
            { "orderable": false, "targets": lastColumn - 1 }
        ]
    });

    console.log(table);
});

// register button is clicked
$('.register-btn').click(function () {
    $('.login-btn').slideUp(350);
    setTimeout(() => {
        $('#email').slideDown();
        $('.register-btn').parent().append(`<span class="gotologin">Already have account? click here</span>`);
        $('.register-btn').attr('type', 'submit');
        $('.login-form form').attr('action', 'proses.php?act=register');
    }, 400);
});

// already have account is clicked
$(document).on('click', '.gotologin', function () {
    $('#email').slideUp(350);
    setTimeout(() => {
        $('.login-btn').slideDown();
        $('.gotologin').remove();

    }, 400);
    $('.login-form form').attr('action', 'proses.php?act=login');
    $('.register-btn').attr('type', 'button');
});

// search bar typed
$('#datatableSearch').on('keyup', function () {
    var table = $('#table').DataTable();
    table.search(this.value).draw();
});