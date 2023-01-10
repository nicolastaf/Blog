<?php

    require "../../modele/Comments.php";
    require "../../modele/DatabaseConnector.php";

    $comment = Comments::deleteComment($_POST['id']);