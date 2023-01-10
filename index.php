<?php

    session_start();

    if (!isset($_GET['controller']) && !isset($_GET['page'])){
        $_GET['controller'] = 'blog';
        $_GET['page'] = 'home';
    }

    if (isset($page)){
        $page = $_GET['page'];
    } else {
        $page = 'erreur';

    }

    ob_start();

    if (isset($_GET['controller'])){
        switch ($_GET['controller']){
            case 'blog' :
                require_once 'controller/BlogController.php';
                if(testMethod("BlogController")){
                    $blog = new BlogController();
                    call_user_func(array($blog, $_GET['page']));
                } else {

                    require 'pages/blog/error_blog.php';
                }
                break;

            case 'admin' :
                require_once 'controller/AdminController.php';
                if(testMethod("AdminController")){
                    $admin = new AdminController();
                    call_user_func(array($admin,$_GET['page']));

                } else {
                    require 'pages/blog/error_blog.php';
                }
                break;

            default :
                require 'pages/blog/error_blog.php';
        }
    } else {
        $_GET['controller'] = 'blog';
        require 'pages/blog/error_blog.php';
    }

    function testMethod ($controller){
        if(!isset($_GET['page'])){
            return false;
        }

        // Liste toutes les methodes de la classe
        $listMethod = get_class_methods($controller);

        foreach ($listMethod as $methodController){
            if($methodController == $_GET['page']){
                return true;
            }
        }

        return false;
    }

    $content = ob_get_clean();
    require 'pages/view.php';



