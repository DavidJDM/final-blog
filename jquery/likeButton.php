<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 3/16/2019
 * Time: 12:43 PM
 */

$post_id = $_POST['post_id'];
$user_id = $_SESSION['user']->getId();
$db = new Database();
//echo $post_id;
$db->connect();

$db->updateNumLikes($post_id, $user_id);