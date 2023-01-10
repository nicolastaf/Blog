<?php

require_once 'modele/DatabaseConnector.php';
require_once 'modele/Admins.php';
require_once 'modele/Comments.php';
require_once 'modele/Posts.php';

Class AdminController {

    /**
     * page login
     */
    public function login(){
        if(isset($_SESSION['role'])){
            header("Location: index.php?controller=admin&page=dashboard");
        }

        if(isset($_POST['submit'])){
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
            $password = sha1($password);

            $errors = [];

            if(empty($email) || empty($password)){
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            }else{
                $userValid = Admins::getAdminByEmailAndPassword($email, $password);

                if($userValid != false){
                    if ($userValid->getRole() == 'admin' || $userValid->getRole() == 'modo')
                    {
                        $_SESSION['role'] = $userValid->getRole();
                        $_SESSION['email'] = $userValid->getEmail();
                    }

                    header("Location: index.php?controller=admin&page=dashboard");
                } else {
                    $errors['exist'] = "Cet utilisateur n'existe pas";
                }

            }

            if(!empty($errors)){
                require_once 'pages/error.php';
            }

        }

        require 'pages/admin/login.php';
    }

    /**
     * page dashbord
     */
    public function dashboard(){
        //on verifie son role est bien admin ou moderateur
        if (!isset($_SESSION['role'])) {

            header("Location:index.php?controller=admin&page=login");

        }

        //on recupere les commentaires pour les valider
        $comments = Comments::getCommentsBySeen(0);

        //on recupere le nbr users
        $users = Admins::getAllAdmins();

        //on comptabilise le nbr de commentaires
        $count_comments = Comments::countComments();

        //on comptabilise le nbr d'articles
        $count_articles = Posts::countArticles();

        //on comptabilise le nbr d'utilisateurs
        $count_users = Admins::countUsers();

        require 'pages/admin/dashboard.php';

    }

    /**
     * page listpost
     */
    public function listpost(){
        //on verifie son role est bien admin
        if ($_SESSION['role'] != 'admin'){

            header("Location:index.php?controller=admin&page=login");

        }

        $posts = Posts::getAllPosts();

        require 'pages/admin/list.php';

    }

    /**
     * page post
     */
    public function post()
    {
        //on verifie son role est bien admin
        if ($_SESSION['role'] != 'admin') {

            header("Location: index.php?controller=admin&page=login");
        }

        $post = Posts::getPostById($_GET['id']);

        require 'pages/admin/post.php';

        if ($post == false) {

            header("Location:index.php?controller=admin&page=error");
        }

        // On controle le form puis UPDATE l'article
        if (isset($_POST['submit'])) {

            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));

            if (isset($_POST['public'])) {
                $posted = 1;

            } else {
                $posted = 0;

            }

            $errors = [];

            if (empty($title) || empty($content)) {

                $errors['empty'] = "Veuillez remplir tous les champs";
            }

            // Si $_FILES existe on verifie son extension
            if (!empty($_FILES['image']['name'])) {
                $file = $_FILES['image']['name'];
                $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', 'JPEG', '.GIF'];
                $extension = strrchr($file, '.');

                // Si l'extension de user n'est pas dans le array on refuse
                if (!in_array($extension, $extensions)) {
                    $errors['image'] = "Cette image n'est pas valide";
                }

            }

            if (!empty($errors)) {
                require 'pages/error.php';

            } else {
                // Si le $_FILES exist alors on le prend, sinon on reprend l'ancien.
                $image = (!empty($_FILES['image']['name']))?$_FILES['image']['name']:$post->getImage();

                $upArticle = new Posts($_GET['id'], $title, $content, Admins::getAdminByEmail($_SESSION['email']), $image, null, $posted);
                $upArticle->updatePost();

                ?>
                <script>
                    window.location.replace("index.php?controller=admin&page=post&id=<?= $_GET['id'] ?>");
                </script>
                <?php

            }

        }

    }

    /**
     * page creation d'article
     */
    public function write(){
        // page admin accessible que si logged
        if($_SESSION['role'] != 'admin'){

            header("Location:index.php?controller=admin&page=login");
        }

        require 'pages/admin/write.php';

        if(isset($_POST['post'])){

            $title   = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $posted  = isset($_POST['public']) ? "1" : "0";

            $errors  = [];

            if(empty($title) || empty($content)){

                $errors['empty'] = "Veuillez remplir tous les champs";
            }

            if(!empty($_FILES['image']['name'])){

                $file       = $_FILES['image']['name'];
                $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','JPEG','.GIF'];
                $extension  = strrchr($file,'.');

                if(!in_array($extension, $extensions)){
                    $errors['image'] = "Cette image n'est pas valide";
                }
            }

            if(!empty($errors)){
                require_once 'pages/error.php';

            }else{

                $image = $_FILES['image']['name'];
                $post = new Posts(null, $title, $content, Admins::getAdminByEmail($_SESSION['email']), $image, null, $posted);
                $post->addPost();

                header("Location: index.php?controller=admin&page=listpost");
            }

        }
    }

    /**
     * Page creation d'administrateur
     */
    public function settings(){
        // page admin accessible que si logged
        if($_SESSION['role'] != 'admin'){
            header("Location:index.php?controller=admin&page=login");
        }

        $users = Admins::getAllAdmins();

        function generatePassword($length)
        {
            $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
            return substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
        }

        if(isset($_POST['submit'])){

            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $email_again = htmlspecialchars(trim($_POST['email_again']));
            $role = htmlspecialchars($_POST['role']);
            $password = generatePassword(8);
            $passwordEncrypt = sha1($password);

            $errors = [];

            if(empty($name) || empty($role) || empty($email) || empty($email_again)){

                $errors['empty'] = "Veuillez remplir tous les champs";
            }

            if($email != $email_again){

                $errors['different'] = "Les adresses email ne sont pas identiques";
            }

            $user = Admins::getAdminByEmail($email);
            if($user->getEmail() == $email){
                $errors['taken'] = "L'adresse email est déjà utilisée";
            }

            if(!empty($errors)){
                require_once 'pages/error.php';
            }else{
                $ajoutModerateur = new Admins(null, $name, $email, $passwordEncrypt, null, $role);
                $ajoutModerateur->addAdmin();

                $subject = "Blog Jean Forteroche - Inscription";
                $message = '
                     <html lang="fr" style="font-family: sans-serif;">
                         <head>
                             <meta charset="utf-8">
                         </head>
                         <body>
                             Bonjour '.$name.',<br />
                             Nous vous remercions de votre inscription.<br/>
                             Voici vos identifiants por votre prochaine connexion:<br/>
                             Identifiant: '.$email.'<br/><br/>
                             Votre mot de passe : '.$password.'<br/><br/>
                             En tant que: '.$role.'<br/><br/>
                             Pour terminer votre inscription cliquez<a href="http://www.nicolas-staffent.com/projet4-OC/pages/index.php?controller=admin&page=login"> sur ce lien</a><br><br>
                             Bien cordialement
        
                             Jean Forteroche
                         </body>
                     </html>
                 ';
                $header = "MIME-Version: 1.0 \r\n";
                $header .= "Content-type: text/html; charset=UTF-8\r\n";
                $header .= 'From: no-reply@blog.com' . "\r\n" . 'reply-To: nicolas.staffent@gmail.com';

               mail($email,$subject,$message,$header);

                ?>
                <script>
                    window.location.replace("index.php?controller=admin&page=settings");
                </script>
                <?php

            }
        }
        require 'pages/admin/settings.php';
    }

    /**
     * Page profil connecté
     */
    public function profil(){
        if (!isset($_SESSION['role'])) {

            header("Location: index.php?controller=admin&page=login");
        }

        $profil = Admins::getAdminByEmail($_SESSION['email']);

        require "pages/admin/profil.php";

        if(isset($_POST['submit'])){
            $password_confirm = htmlspecialchars(trim($_POST['password_confirm']));
            $password = htmlspecialchars(trim($_POST['password']));
            $passwordEncrypt = sha1($password);

            $errors = [];

            if ($password != $password_confirm){
                $errors['pass'] = "Les mots de passe ne sont pas identique";
            }

            if(empty($password) || empty($password_confirm)){
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            }else{
                $profil->setPassword($passwordEncrypt);
                $profil->updateAdmins();

                echo '<div class="card green"><div class="card-content white-text">Votre mot de passe a bien été modifié avec succès</div></div>';

            }

            if(!empty($errors)){
                require_once 'pages/error.php';
            }

        }

    }

    /**
     * Page des utilisateurs
     */
    public function users(){
        if ($_SESSION['role'] != 'admin') {

            header("Location: index.php?controller=admin&page=login");
        }

        $user = Admins::getAdminById($_GET['id']);

        require 'pages/admin/users.php';

        if(isset($_POST['submit'])){
            $password_confirm = htmlspecialchars(trim($_POST['password_confirm']));
            $password = htmlspecialchars(trim($_POST['password']));
            $passwordEncrypt = sha1($password);

            $errors = [];

            if ($password != $password_confirm){
                $errors['pass'] = "Les mots de passe ne sont pas identique";
            }

            if(empty($password) || empty($password_confirm)){
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            }else{
                $user->setPassword($passwordEncrypt);
                $user->updateAdmins();

                echo '<div class="card green"><div class="card-content white-text">Votre mot de passe a bien été modifié avec succès</div></div>';

            }

            if(!empty($errors)){
                require_once 'pages/error.php';
            }

        }

    }

    /**
     * page de deconnexion
     */
    public function logout(){

        $_SESSION['email'] = null;
        $_SESSION['role']  = null;
        session_destroy();

        header("Location:index.php?controller=admin&page=login");

    }
}






