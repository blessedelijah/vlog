<?php include "function.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>My Vlog Website</title>
</head>
<body>
    <header id="header" class="animate__animated">
        <nav>
            <div id="vloggy" class="animate__animated animate__bounce">Vloggy</div>
                <ul id="nav-container">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="category.php?cat=news">News</a></li>
                    <li><a href="category.php?cat=fashion">fashion</a></li>
                    <li id="mega_con">
                        More<i class="fa-solid fa-angle-down" id="arrow-down"></i>
                        <ul id="mega">
                            <li><a href="category.php?cat=sports">Sports</a></li>
                            <li><a href="category.php?cat=lifestyle">Lifestyle</a></li>
                            <li><a href="category.php?cat=tech">Tech</a></li>
                        </ul>
                    </li>
                </ul>
            <article id="signup-socials">
                <?php
                    if(isset($_SESSION['username'])){
                        CheckProfileImage_FrontEnd();
                    }else{
                        echo '<div id="signin_btn"><a href="login.php">Sign In</a></div>';
                    }
                ?>
                
                <ul id="social_icon_holder">
                    <li><i class="fa-brands fa-x-twitter"></i></li>
                    <li><i class="fa-brands fa-facebook-f"></i></li>
                    <li><i class="fa-brands fa-instagram"></i></li>
                    <li><i class="fa-brands fa-linkedin-in"></i></li>
                </ul>
            </article>
        </nav>
    </header>