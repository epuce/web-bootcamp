$(function () {
    var $submit = $('#submit');
    var $delete = $('.delete');
    var $form = $('#form');

    $submit.on('click', function (e) {
        e.preventDefault();

        var $this = $(this);
        var formArray = $form.serializeArray();
        var action = null;

        switch ($this[0].name) {
            case 'update':
                action = 'put';
                break;
            case 'submit':
                action = 'post';
                break;
        }

        $.ajax({
            type: 'POST',
            url: 'src/' + action +'.php',
            data: {
                name: formArray[0] && formArray[0].value,
                profession: formArray[1] && formArray[1].value,
                id: formArray[2] && formArray[2].value,
            }
        }).then(function (response) {
            console.log(response);
            // window.location = window.location.origin;
        });
    });

    $delete.on('click', function () {
        $.ajax({
            type: 'GET',
            url: 'src/delete.php',
            data: {
                id: $(this).attr('data-id'),
            }
        }).then(function (response) {
            console.log(response);
            window.location = window.location.origin;
        });
    })
});