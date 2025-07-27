$(document).ready(function () {
    $("#searchInput").on("input", function () {
        let query = $(this).val().trim();
        if (query.length === 0) {
            $("#searchResults").html("");
            return;
        }

        $.ajax({
            url: "/search",
            type: "GET",
            data: { query: query },
            dataType: "json",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
            success: function (data) {
                let results = $("#searchResults");
                results.html(
                    data.length > 0
                        ? "<ul>" +
                              data
                                  .map(
                                      (username) =>
                                          `<a href="/@${username}"><li>@${username}</li></a>`
                                  )
                                  .join("")
                        : "<p>No users found.</p>"
                );
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            },
        });
    });
});
