<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 11/08/2017
 * Time: 15:46
 */

require_once 'modele/DatabaseConnector.php';
require_once 'modele/Admins.php';
require_once 'modele/Comments.php';
require_once 'modele/Posts.php';

class BlogController
{

    /**
     * Page d'accueil
     */
    public static function home()
    {
        $posts = Posts::getPostsByPosted(1);

        require './pages/blog/home.php';
    }

    /**
     * Liste des articles
     */
    public static function blog()
    {
        $posts = Posts::getPostsByPosted(1);

        require './pages/blog/blog.php';
    }

    /**
     * Page de l'article avec commentaire
     */
    public static function post()
    {
        $post = Posts::getPostById($_GET['id']);
        $posts = Posts::getPostsByPosted(1);
        $comments = Comments::getCommentsByPostAndSeen($post->getId(), 1);

        if(isset($_POST['submit'])){

            $name    = htmlspecialchars($_POST['name']);
            $email   = htmlspecialchars($_POST['email']);
            $comment = htmlspecialchars($_POST['comment']);
            $errors  = [];

            // Verification que les champs ne sont pas vide
            if(empty($name)|| empty($email) || empty($comment)){
                $errors['empty'] = "Tous les champs ne sont pas remplis";
                require 'pages/error.php';
            } else {
                // Verification du pattern de l'email
                if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
                    $errors['email'] = "L'adresse e-mail n'est pas valide";
                }else{

                    echo '<div class="card green"><div class="card-content white-text">Votre Commentaire a bien été envoyé il est en attente de validation</div></div>';
                }

                // Affichage des erreurs
                if(!empty($errors)){
                    require 'pages/error.php';
                }else{
                    $comment = new Comments(null, $name, $email,$comment, $post, null, null);
                    $comment->addComment();
                }
            }
        }

        require './pages/blog/post.php';

    }

}