<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="content/css/style-admin.css"  media="screen,projection"/>
    <title>Administration</title>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--  WYSIWYG -->
    <script src="content/js/tinymce/tinymce.min.js"></script>
    <script src="content/js/tinymce.js"></script>
</head>
    <body>
    <nav class="blue-grey darken-4">
        <div class="container">
            <div class="nav-wrapper">
                <a href="index.php?controller=admin&page=login" class="brand-logo">Administration du blog</a>
                <?php
                if($page != 'login'){
                    ?>
                    <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li class="<?php echo($page=="dashboard")?"active" : ""; ?> tooltipped" data-position="bottom" data-delay="50" data-tooltip="Tableau de bord"><a href="index.php?controller=admin&page=dashboard"><i class="material-icons">dashboard</i></a></li>
                        <li class="<?php echo($page=="user")?"active" : ""; ?> tooltipped" data-position="bottom" data-delay="50" data-tooltip="Profil"><a href="index.php?controller=admin&page=profil"><i class="material-icons">person_pin_circle</i></a></li>
                        <?php
                            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                                ?>
                                <li class="<?php echo ($page == "write") ? "active" : ""; ?> tooltipped" data-position="bottom" data-delay="50" data-tooltip="Publier un article"><a
                                            href="index.php?controller=admin&page=write"><i class="material-icons">edit</i></a></li>
                                <li class="<?php echo ($page == "list") ? "active" : ""; ?> tooltipped" data-position="bottom" data-delay="50" data-tooltip="Liste des Articles"><a
                                            href="index.php?controller=admin&page=listpost"><i class="material-icons">view_list</i></a></li>
                                <li class="<?php echo ($page == "settings") ? "active" : ""; ?> tooltipped" data-position="bottom" data-delay="50" data-tooltip="Modérateurs"><a
                                            href="index.php?controller=admin&page=settings"><i class="material-icons">settings</i></a>
                                </li>
                                <?php
                            }
                        ?>
                        <li><a href="index.php?controller=admin&page=logout">Déconnexion</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-menu">
                        <li class="<?php echo($page=="dashboard")?"active" : ""; ?>"><a href="index.php?controller=admin&page=dashboard"><i class="material-icons">dashboard</i>Tableau de bord</a></li>
                        <li class="<?php echo($page=="user")?"active" : ""; ?>"><a href="index.php?controller=admin&page=profil"><i class="material-icons">person_pin_circle</i>Profil</a></li>
                        <?php
                        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                            ?>
                            <li class="<?php echo ($page == "write") ? "active" : ""; ?>"><a href="index.php?controller=admin&page=write"><i class="material-icons">edit</i>Publier un article</a></li>
                            <li class="<?php echo ($page == "list") ? "active" : ""; ?>"><a href="index.php?controller=admin&page=listpost"><i class="material-icons">view_list</i>Liste des articles</a></li>
                            <li class="<?php echo ($page == "settings") ? "active" : ""; ?>"><a href="index.php?controller=admin&page=settings"><i class="material-icons">settings</i>Modérateurs</a>
                            </li>
                            <?php
                         }
                        ?>
                        <li><a href="index.php?controller=admin&page=logout">Déconnexion</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </nav>