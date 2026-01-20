jQuery(function ($) {
    let page = 1;
    let loading = false;

    $("#load-more").on("click", function () {
        if (loading) return;
        loading = true;

        $.ajax({
            url: ajaxurl.ajax_url,
            type: "POST",
            data: {
                action: "load_more_posts",
                page: page
            },
            success: function (data) {
                if (data.trim() === "") {
                    $("#load-more").text("Hết bài viết").prop("disabled", true);
                } else {
                    $("#post-list").append(data);
                    page++;
                }
                loading = false;
            }
        });
    });
});