$(function() {
    var $makeRequest = $('.make-request');
    var $progress = $('.progress');
    var page = 1;
    var progressInterval;

    $makeRequest.on('click', function() {
        $.ajax({
            method: "GET",
            url: "https://reqres.in/api/users?page=" + page
        }).done(handleResponse)
    })

    function handleResponse(response) {
        response.data.forEach(function(value, index) {
            const img = "<img src=\""+value.avatar+"\">"
            const row = "\
            <tr>\
                "+ addCell(value.id, "cell-id") +"\
                "+ addCell(img, "cell-img") +"\
                "+ addCell(value.first_name) +"\
                "+ addCell(value.last_name) +"\
                "+ addCell(value.email) +"\
            </tr>";

            $('#data-table').find('tbody').append(row)
        })

        page ++;

        if (!response.data.length) {
            $makeRequest.attr('disabled', true);
        }
    }

    function addCell(val, className = "") {
        return "<td class=\""+ className +"\">"+val+"</td>"
    }

    $('.start-action').on('click', startProgress)
    $('.stop-action').on('click', stopProgress)
    $('.reset-action').on('click', resetProgress)

    function startProgress() {
        const cycleInterval = $('#cycle-interval').val()
        let width = 0;

        if (cycleInterval > 0 ) {
            $progress.width(0);

            progressInterval = setInterval(function() {
                width ++;
                $progress.width(width + "%");

                if (width >= 100) {
                    stopProgress();
                }
            }, cycleInterval * 1000 / 100)
        } else {
            $('#cycle-interval').addClass('error')
            $('.error-box').show()
        }
    }

    $('#cycle-interval').on('focus', function() {
        $('#cycle-interval').removeClass('error')
        $('.error-box').hide()
    })

    function stopProgress() {
        clearInterval(progressInterval);
    }

    function resetProgress() {
        stopProgress()
        $('#cycle-interval').val("")
        $progress.width(0);
    }
})