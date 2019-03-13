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

    $db = new Database();
    $db->connect();
    $db->getInfo(1);

    $template = new Template();
    echo $template->render('travel.php');
});

// Route to events page
$f3->route('GET|POST /events', function($f3) {
    $f3->set('title', 'Yummy Blog - Food Blog Template');

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
    $f3->set('title', 'Yummy Blog - Food Blog Template');

    $template = new Template();
    echo $template->render('views/life-style.html');
});

$f3->run();