<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 3/13/2019
 * Time: 7:48 PM
 */

/**
 * @para $email takes an email from the register page and verifies if it is valid
 * @return bool true if the email is valid, or else returns false
 */
function validateEmail($email)
{
    $db = new Database();
    $db->connect();
    $emailAvailable = $db->isEmailAvailable($email);
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false && $emailAvailable;
}

function validatePassword($pass, $re_pass)
{
    return $pass === $re_pass && !empty($pass);
}