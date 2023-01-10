<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Jean Forteroche - BILLET SIMPLE POUR L'ALASKA</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Projet 4 - OpenClassRooms - développer un blog en php proécédural vers une arhitecture MVC en POO ">
        <meta name="author" content="Nicolas STAFFENT">
        <meta name="developer web" content="Développeur web junior">
        <meta name="application-name" content="Blog">
        <meta name="contact" content="nicolas.staffent@gmail.com ’[adresse]’"/>
        <meta name="mobile-agent" content="format=html5; url=mobile.htm"/>
        <meta name="robots" content="index,follow"/>
        <meta name="generator" content="Blog 1.0"/>
        <meta name="version" content="1.0"/>
        <!-- Import font-awesome Icon font-->
        <link href="https://use.fontawesome.com/5ca8949820.css" media="all" rel="stylesheet">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="././content/css/style-blog.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <header>
            <nav class="blue-grey darken-4">
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="index.php" class="brand-logo">Jean Forteroche</a>
                        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down">
                            <li class="<?php echo($page=="home")?"active" : ""; ?>"><a href="index.php?controller=blog&page=home"><i class="material-icons">home</i></a></li>
                            <li class="<?php echo($page=="blog")?"active" : ""; ?>"><a href="index.php?controller=blog&page=blog">Chapitres</a></li>
                        </ul>
                        <ul class="side-nav" id="mobile-menu">
                            <li class="<?php echo($page=="home")?"active" : ""; ?>"><a href="index.php?controller=blog&page=home"><i class="material-icons">home</i></a></li>
                            <li class="<?php echo($page=="blog")?"active" : ""; ?>"><a href="index.php?controller=blog&page=blog">Chapitres</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>