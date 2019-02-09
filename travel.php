<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require '/home/dkovalevich/db.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Travel - Milana</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet">

</head>

<body>
<!-- Preloader Start -->
<div id="preloader">
    <div class="yummy-load"></div>
</div>

<!-- ****** Top Header Area Start ****** -->
<div class="top_header_area">
    <div class="container">
        <div class="row">
            <div class="col-5 col-sm-6">
                <!--  Top Social bar start -->
                <div class="top_social_bar">
                    <a href="https://www.instagram.com/milan.kov/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="https://www.facebook.com/milana.kovalevich"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="https://www.youtube.com/channel/UC2ZQmWwe6vT4ete4ht9oNZA"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                </div>
            </div>
            <!--  Login Register Area -->
            <div class="col-7 col-sm-6">
                <div class="signup-search-area d-flex align-items-center justify-content-end">
                    <div class="login_register_area d-flex">
                        <div class="login">
                            <a href="login.php">Sign in</a>
                        </div>
                        <div class="register">
                            <a href="register.php">Sign up</a>
                        </div>
                    </div>
                    <!-- Search Button Area -->
                    <div class="search_button">
                        <a class="searchBtn" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>
                    <!-- Search Form -->
                    <div class="search-hidden-form">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search-anything" placeholder="Search Anything...">
                            <input type="submit" value="" class="d-none">
                            <span class="searchBtn"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ****** Top Header Area End ****** -->

<!-- ****** Header Area Start ****** -->
<header class="header_area">
    <div class="container">
        <div class="row">
            <!-- Logo Area Start -->
            <div class="col-12">
                <div class="logo_area text-center">
                    <a href="index.html" class="milana-logo">Milana</a>
                    <!-- Post Date -->
                    <div class="milana-sub-logo">
                        <a href="#">all things creative blog</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-nav" aria-controls="yummyfood-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                    <!-- Menu Area Start -->
                    <div class="collapse navbar-collapse justify-content-center" id="yummyfood-nav">
                        <ul class="navbar-nav" id="yummy-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="travel.php">Travel <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="events.php">Events</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="life-style.php">Life Style</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ****** Header Area End ****** -->

<!-- ****** Breadcumb Area Start ****** -->
<div class="breadcumb-area" style="background-image: url(img/bg-img/travel2.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumb-title text-center">
                    <h2>Travel</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="breadcumb-nav">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Travel</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ****** Breadcumb Area End ****** -->

<!-- ****** Archive Area Start ****** -->
<section class="archive-area section_padding_80">
    <div class="container">
        <div class="row">


<?php

            $posts = "SELECT * FROM blog_posts WHERE post_category = 1;";
            //Send the query to DB
            $result = @mysqli_query($cnxn, $posts);
            $rows_returned = mysqli_num_rows($result);
            if($rows_returned < 1) {
echo("
<div class='col-12 text-center'>
    <h1 class='post-headline'>Travel Posts Coming Soon</h1>
</div>
");
            } else {
                while ($row = mysqli_fetch_assoc($result)) {

                    $post_id = $row['post_id'];
                    $post_category = $row['post_category'];
                    $post_title = $row['post_title'];
                    $content = $row['content'];
                    $author_name = $row['author_name'];
                    $post_date = $row['post_date'];
                    $image = $row['image'];
                    $comments = $row['comments'];
                    $hearts = $row['hearts'];

                    $month = date('Y', strtotime($post_date));
                    $day = date('Y', strtotime($post_date));
                    $year = date('Y', strtotime($post_date));

                    $myDateTime = DateTime::createFromFormat('Y-m-d', $post_date);
                    $post_date_format = DATE_FORMAT($myDateTime, 'M d, Y');

                    echo("

<div class=\"col-12 col-md-6 col-lg-4\">
    <div class=\"single-post wow fadeInUp\" data-wow-delay=\"0.1s\">
        <!-- Post Thumb -->
        <div class=\"post-thumb\">
            <img src=\"img/blog-img/$image\" alt=\"\">
        </div>
        <!-- Post Content -->
        <div class=\"post-content\">
            <div class=\"post-meta d-flex\">
                <div class=\"post-author-date-area d-flex\">
                    <!-- Post Author -->
                    <div class=\"post-author\">
                        <a href=\"about.php\">By $author_name</a>
                    </div>
                    <!-- Post Date -->
                    <div class=\"post-date\">
                        <a href=\"#\">$post_date_format</a>
                    </div>
                </div>
                <!-- Post Comment & Share Area -->
                <div class=\"post-comment-share-area d-flex\">
                    <!-- Post Favourite -->
                    <div class=\"post-favourite\">
                        <a href=\"#\"><i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i> $hearts</a>
                    </div>
                    <!-- Post Comments -->
                    <div class=\"post-comments\">
                        <a href=\"#\"><i class=\"fa fa-comment-o\" aria-hidden=\"true\"></i> $comments</a>
                    </div>
                    <!-- Post Share -->
                    <div class=\"post-share\">
                        <a href=\"#\"><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i></a>
                    </div>
                </div>
            </div>
            <a href=\"#\">
                <h4 class=\"post-headline\" id='$post_id'>$post_title</h4>
            </a>
        </div>
    </div>
</div>

");
                }
            }



?>

        </div>
    </div>
</section>
<!-- ****** Archive Area End ****** -->

<script>
    $(document).ready(function() {
        $('.single-post').on( 'click', '.post-headline', function () {

            var post_id = $(this).attr('id');
            alert(post_id);
            //window.location.href = "adminPage.php?confirmation=" + data[1];

        });
    });
</script>

<!-- ****** Instagram Area Start ****** -->
<div class="instargram_area owl-carousel section_padding_100_0 clearfix" id="portfolio">

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/1.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/2.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/3.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/4.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/5.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/6.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/1.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="img/instagram-img/2.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- ****** Our Creative Portfolio Area End ****** -->

<!-- ****** Footer Menu Area Start ****** -->
<footer class="footer_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-content">
                    <!-- Menu Area Start -->
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-nav" aria-controls="yummyfood-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                        <!-- Menu Area Start -->
                        <div class="collapse navbar-collapse justify-content-center" id="yummyfood-nav">
                            <ul class="navbar-nav" id="yummy-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="travel.php">Travel <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="events.php">Events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="life-style.php">Life Style</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.php">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Copywrite Text -->
                <div class="copy_right_text text-center">
                    <p>Copyright @2018 All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ****** Footer Menu Area End ****** -->

<!-- Jquery-2.2.4 js -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/bootstrap/popper.min.js"></script>
<!-- Bootstrap-4 js -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins JS -->
<script src="js/others/plugins.js"></script>
<!-- Active JS -->
<script src="js/active.js"></script>
</body>
