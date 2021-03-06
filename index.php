<?php
/**
 * fat free home page
 * final project
 * 02/15/2019
 */
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require fat-free
require_once('vendor/autoload.php');
session_start();

//Create an instance of the Base class
$f3 = Base::instance();

//Turn of fat free error reporting
$f3->set('DEBUG', 3);

//file for validation
include('model/register-validation.php');

// Default Route
$f3->route('GET /', function($f3) {
    $f3->set('title', 'Home');

    //connect to database and get 12 most recent events posts
    $db = new Database();
    $db->connect();
    $posts = $db->getHomepagePosts();
    $popularPosts = $db->getPopularPosts();

    $_SESSION['posts'] = $posts;
    $_SESSION['popularPosts'] = $popularPosts;

    $template = new Template();
    echo $template->render('views/home.html');
});

// Route to home page
$f3->route('GET|POST /home', function($f3) {
    $f3->set('title', 'Home');

    //connect to database and get 12 most recent events posts
    $db = new Database();
    $db->connect();
    $posts = $db->getHomepagePosts();
    $popularPosts = $db->getPopularPosts();

    $_SESSION['posts'] = $posts;
    $_SESSION['popularPosts'] = $popularPosts;

    $template = new Template();
    echo $template->render('views/home.html');
});

// Route to travel page
$f3->route('GET /travel', function($f3) {
    $f3->set('title', 'Travel');

    //connect to database and get 12 most recent travel posts
    $db = new Database();
    $db->connect();
    $results = $db->getPostInfo(1);
    if(!empty($_SESSION['user'])) {
        $userLikes = $db->getPostsLiked($_SESSION['user']->getId());

        $likes = array();
        foreach($userLikes as $like) {
            $likes[] = $like['post_id'];
        }
        $f3->set('likes', $likes);
    }
    $f3->set('results', $results);

    $template = new Template();
    echo $template->render('views/travel.html');
});

// Route to events page
$f3->route('GET|POST /events', function($f3) {
    $f3->set('title', 'Events');

    //connect to database and get 12 most recent events posts
    $db = new Database();
    $db->connect();
    $results = $db->getPostInfo(2);
    if(!empty($_SESSION['user'])) {
        $userLikes = $db->getPostsLiked($_SESSION['user']->getId());

        $likes = array();
        foreach($userLikes as $like) {
            $likes[] = $like['post_id'];
        }
        $f3->set('likes', $likes);
    }
    $f3->set('results', $results);

    $template = new Template();
    echo $template->render('views/events.html');
});

// Route to events page
$f3->route('GET|POST /contact', function($f3) {
    $f3->set('title', 'Contact');

    $template = new Template();
    echo $template->render('views/contact.html');
});

// Route to events page
$f3->route('GET|POST /life-style', function($f3) {
    $f3->set('title', 'Life Style');

    //connect to database and get 12 most recent life-style posts
    $db = new Database();
    $db->connect();
    $results = $db->getPostInfo(3);
    if(!empty($_SESSION['user'])) {
        $userLikes = $db->getPostsLiked($_SESSION['user']->getId());

        $likes = array();
        foreach($userLikes as $like) {
            $likes[] = $like['post_id'];
        }
        $f3->set('likes', $likes);
    }
    $f3->set('results', $results);

    $template = new Template();
    echo $template->render('views/life-style.html');
});

// Route to register page
$f3->route('GET|POST /register', function($f3) {
    $f3->set('title', 'Register');

    if(isset($_POST['signup'])) {
        //get POST information
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $re_pass = $_POST['re_pass'];

        $validEmail = validateEmail($email);
        $validPass = validatePassword($pass, $re_pass);
        $f3->set('validEmail', $validEmail);
        $f3->set('validPass', $validPass);
        $db = new Database();
        $db->connect();

        if($validEmail && $validPass) {
            $db->createUser($name, $email, $pass);
            $f3->reroute('home');
        }

        else {
            $emailTaken = $db->emailExists($email);
            if($emailTaken) {
                $f3->set("emailTaken", true);
            }
        }
    }

    $template = new Template();
    echo $template->render('views/register.html');
});

// Route to sign in page
$f3->route('GET|POST /sign-in', function($f3) {
    $f3->set('emailExists', true);
    $f3->set('invalidPassword', false);
    $f3->set('title', 'Sign-in');

    if(isset($_POST['signin'])) {
        //get POST information
        $email = $_POST['your_email'];
        $pass = $_POST['your_pass'];

        $db = new Database();
        $db->connect();
        $userAdmin = $db->checkAdminSignin($email, $pass);
        $user = $db->checkSignin($email, $pass);
        $emailExists = $db->emailExists($email);

        if($userAdmin !== false)
        {
            $_SESSION['user'] = $user;
            $f3->reroute('admin');
        }

        if($user !== false) {
            $_SESSION['user'] = $user;
            $f3->reroute('home');
        }

        else {
            if(!$emailExists) {
                $f3->set('emailExists', false);
            }

            else {
                $f3->set('emailExists', true);
                $f3->set('invalidPassword', true);
            }
        }
    }


    $template = new Template();
    echo $template->render('views/sign-in.html');
});

// Route to sign in page
$f3->route('GET|POST /view-post-@postid', function($f3, $params) {
    preg_match_all('!\d+!', $params[0], $postid);
    $postid = $postid[0][0];
    $f3->set('postid', $postid);

    $db = new Database();
    $db->connect();
    $post = $db->getSinglePost($postid);
    $_SESSION['post'] = $post;

    $popularPosts = $db->getPopularPosts();
    $_SESSION['popularPosts'] = $popularPosts;

    $template = new Template();
    echo $template->render('views/post_view.html');
});

// Route to create-post page
$f3->route('GET|POST /create-post', function($f3) {
    $f3->set('title', 'Create Post');
    $db = new Database();


    if(isset($_POST['create-post'])) {
        $db->connect();
        $db->createPost($_POST['title'], $_POST['body'], $_POST['author'], $_POST['image'], $_POST['category']);
    }

    $template = new Template();
    echo $template->render('views/create-post.html');
});

// Route to view-members page
$f3->route('GET|POST /view-members', function($f3) {

    $db = new Database();
    $db->connect();
    $members = $db->getMembers();
    $f3->set('members', $members);

    $template = new Template();
    echo $template->render('views/view-members.html');
});

// Route to view-posts page
$f3->route('GET|POST /view-posts', function($f3) {
    $f3->set('title', 'View Posts');

    $db = new Database();
    $db->connect();
    $posts = $db->getPosts();
    $f3->set('posts', $posts);

    $template = new Template();
    echo $template->render('views/view-posts.html');
});


//route to sign in page after signing out
$f3->route('GET|POST /sign-out', function($f3) {
    $_SESSION['user'] = null;

    $f3->reroute('sign-in');
});

//route to test page
$f3->route('GET|POST /checkLikedStatus', function($f3) {
    if(empty($_SESSION['user'])) {
        echo false;
    }
    else {
        include('jquery/likeButton.php');
    }

});

$f3->run();