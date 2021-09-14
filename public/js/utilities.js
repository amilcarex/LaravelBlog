
let url = "http://localhost/blog-feragon-full/public";


$(document).ready(function () {

    $(document).on("click", "#content-user-flip", function (e) {
        e.preventDefault();
        $('#content-user-flip').toggleClass("flipped");
    });
    let page = 2;
    $("#container-scroll-posts").scroll(function (e) {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {

            axios
                .get(url + "/blog-scroll?page=" + page)
                .then((response) => {
                    $('#container-scroll-posts').append(response.data);
                    page++;
                })
        }
    });

    $(document).on("click", "#post-to-article", function (e) {

        let post = $(this).attr('post');
        let slug = $(this).attr('slug');
        axios
            .get(url + "/article/" + post)
            .then(response => {
                $('#article-info').html(response.data.view);
                $('#article-content').html(response.data.content);
                window.history.pushState({ href: slug }, '', slug);
            })
    });


    $(document).on("change", "#category", function (e) {
            let category = $(this).val();
            axios
                .get(url + '/filter-category/' + category)
                .then(response => {
                    $('#container-scroll-posts').html(response.data);
                })
    })

})