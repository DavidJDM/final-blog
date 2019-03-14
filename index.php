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
$f3->route('GET /travel', function($f3) {
    $f3->set('title', 'Milana\'s Blog | Travel');

    //connect to database and get 12 most recent travel posts
    $db = new Database();
    $db->connect();
    $results = $db->getPostInfo(1);
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
        if($validEmail && $validPass) {
            $db = new Database();
            $db->connect();
            $db->createUser($name, "", $email, $pass);
            $f3->reroute('home');
        }
    }

    $template = new Template();
    echo $template->render('views/register.html');
});

// Route to sign in page
$f3->route('GET|POST /sign-in', function($f3) {
    $f3->set('title', 'Yummy Blog - Food Blog Template');

    $template = new Template();
    echo $template->render('views/sign-in.html');
});

$f3->run();