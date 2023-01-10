<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 17/08/2017
 * Time: 18:11
 */

    require "../../modele/DatabaseConnector.php";
    require "../../modele/Posts.php";

    $post = Posts::deletePost($_POST['id']);