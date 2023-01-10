<?php

    require "../../modele/DatabaseConnector.php";
    require "../../modele/Comments.php";
    require "../../modele/Admins.php";
    require "../../modele/Posts.php";

    $comment = Comments::getCommentsById($_POST['id']);
    $comment->setSeen(1);
    $comment->updateComment();