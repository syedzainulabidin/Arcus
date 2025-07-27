$(document).ready(function () {
    $("#username").on("input", function () {
        let username = $(this).val();
        if (username.length > 2) {
            $.ajax({
                url: "/check-username",
                type: "POST",
                data: {
                    username: username,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.available === true) {
                        // available
                        $("#username-status").html(
                            '<abbr title="Username Available"><i class="icon action tx-highlight bxr bx-check"></i></abbr>'
                        );
                    } else if (response.available === false) {
                        // not available
                        $("#username-status").html(
                            '<abbr title="Username Not Available"><i class="icon action tx-highlight bxr bx-block"></i></abbr>'
                        );
                    } else if (response.available === null) {
                        // unknown or error state
                        $("#username-status").html(
                            '<abbr title="Username Status Unknown"><i class="icon action tx-highlight bx bx-check-circle"></i></abbr>'
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", xhr.status, error);
                    $("#username-status").html(
                        '<i class="material-icons tx-warning">warning</i>'
                    );
                },
            });
        } else {
            $("#username-status").html("");
        }
    });
});
