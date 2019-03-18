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
    $f3->set('title', 'Milana\'s Blog | Home');

    $template = new Template();
    echo $template->render('views/home.html');
});

// Route to home page
$f3->route('GET|POST /home', function($f3) {
    $f3->set('title', 'Milana\'s Blog | Home');

    $template = new Template();
    echo $template->render('views/home.html');
});

// Route to travel page
$f3->route('GET|POST /travel', function($f3) {
    $f3->set('title', 'Milana\'s Blog | Travel');

    //connect to database and get 12 most recent travel posts
    $db = new Database();
    $db->connect();
    $results = $db->getPostInfo(1);
    if(!empty($_SESSION['user'])) {
        $userLikes = $db->getPostsLiked($_SESSION['user']->getId());
        foreach($userLikes as $userLike) {
            $likes[] = $userLike['post_id'];
        }
    }

    $f3->set('likes', $likes);
    $f3->set('results', $results);

    $template = new Template();
    echo $template->render('views/travel.html');
});

// Route to events page
$f3->route('GET|POST /events', function($f3) {
    $f3->set('title', 'Milana\'s Blog | Events');

    //connect to database and get 12 most recent events posts
    $db = new Database();
    $db->connect();
    $results = $db->getPostInfo(2);
    $f3->set('results', $results);

    $template = new Template();
    echo $template->render('views/events.html');
});

// Route to events page
$f3->route('GET|POST /contact', function($f3) {
    $f3->set('title', 'Yummy Blog - Food Blog Template');

    $template = new Template();
    echo $template->render('views/contact.html');
});

// Route to events page
$f3->route('GET|POST /life-style', function($f3) {
    $f3->set('title', 'Milana\'s Blog | Life-Style');

    //connect to database and get 12 most recent list-style posts
    $db = new Database();
    $db->connect();
    $results = $db->getPostInfo(3);
    $f3->set('results', $results);

    $template = new Template();
    echo $template->render('views/life-style.html');
});

// Route to register page
$f3->route('GET|POST /register', function($f3) {
    $f3->set('title', 'Yummy Blog - Food Blog Template');

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
    $f3->set('title', 'Milana\'s Blog | Sign-in');

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

// Route to admin page
$f3->route('GET|POST /admin', function($f3) {
    $f3->set('title', 'Milana\'s Blog | Admin');

    if(isset($_POST['signin'])) {
        //get POST information
        $email = $_POST['your_email'];
        $pass = $_POST['your_pass'];

        $db = new Database();
        $db->connect();
        $user = $db->checkSignin($email, $pass);

        if($user !== false) {
            $_SESSION['user'] = $user;
            $f3->reroute('home');
        }
    }

    $template = new Template();
    echo $template->render('views/admin.html');
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
        echo true;
    }

});

//view as admin
$f3->route('GET|POST /view-admin', function($f3) {
    if($_SESSION['user']->getAdminView() == 0) {
        $_SESSION['user']->setAdminView(1);
    }
    else {
        $_SESSION['user']->setAdminView(0);
    }

    $f3->reroute('home');
});

$f3->run();