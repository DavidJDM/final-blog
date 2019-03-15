<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 3/15/2019
 * Time: 1:25 PM
 */

global $user;
echo "<script>alert('hello')</script>";
if($user->getSignedIn()) {
    $id = $_POST['id'];

    $db = new Database();
    $db->connect();
}
else {
    return false;
}
