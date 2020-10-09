$(function() {
    $(".js-delete-row").on("click", function() {
        const id = $(this).attr("data-id");

        $.ajax({
            method: "GET",
            url: "/CRUD/delete.php?id=" + id + "&redirect=false"
        }).then(function() {
            window.location = "/CRUD/"
        })
    })
})