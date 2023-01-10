$(document).ready(function () {

    $('.parallax').parallax();

    $('.modal').modal();

    $(document).on('click', '.delete-post-confirm', function () {
        var idPost = $(this).attr('id');
        $.ajax({
            url: "content/ajax/delete_post.php",
            method: 'post',
            data: {id: idPost},
            beforeSend: function () {

            },
            error: function () {
                alert('Une erreur technique est apparue');

            }, success: function(result) {
                $('#article_'+idPost).hide();
                $('#response-post').text("L'article a bien été supprimé");
                $('#response-post').css({"background-color": "tomato","color" : "white","padding": "24px","position":"relative","margin":"0.5rem 0 1rem 0","border-radius":"2px"});

            }

        });

    });


});
