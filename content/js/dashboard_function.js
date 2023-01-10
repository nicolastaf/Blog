$(document).ready(function() {

    $('.modal').modal();

    $(document).on('click', '.see_comment', function () {
        var idPost = $(this).attr('id');
        $.ajax({
            url: "content/ajax/see_comment.php",
            method: 'post',
            data: {id: idPost},
            beforeSend: function () {

            }, error: function () {
                alert('Une erreur technique est apparue');

            }, success: function(result) {
                $('#commentaire_'+idPost).hide();
                $('#response').text('Le commentaire a bien été validé');
                $('#response').css({"background-color": "green","color" : "white","padding": "24px","position":"relative","margin":"0.5rem 0 1rem 0","border-radius":"2px"});

            }
        });

    });

    $(document).on('click', '.delete_comment', function () {
        var idPost = $(this).attr('id');
        $.ajax({
            url: "content/ajax/delete_comment.php",
            method: 'post',
            data: {id: idPost},
            beforeSend: function () {

            },
            error: function () {
                alert('Une erreur technique est apparue');

            }, success: function(result) {
                $('#commentaire_'+idPost).hide();
                $('#response').text('Le commentaire a bien été supprimé');
                $('#response').css({"background-color": "tomato","color" : "white","padding": "24px","position":"relative","margin":"0.5rem 0 1rem 0","border-radius":"2px"});

            }
        });

    });

});
