<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 3/8/2019
 * Time: 1:41 PM
 */

/**
 * Class Database database class to insert and get information
 */
class Database
{
    /**
     * Connect to the database
     */
    public function connect()
    {
        //require_once('/home/dkovalev/final-config.php');
        require_once('/home/bskargre/final-config.php');

        try {
            //instantiate a database object
            $GLOBALS['dbh'] = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $id param ID used to get information from database (travel => 1, events => 2, life-style => 3)
     * @return array returns a post object array with top 25 posts sorted by date
     */
    public function getPostInfo($id)
    {
        global $dbh;

        $sql = "SELECT * FROM posts
                WHERE category_id = :id
                ORDER BY date DESC
                LIMIT 12";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':id', $id, PDO::PARAM_STR);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * @param $email the email from the user to check the database for availability
     * @return bool returns true if there are no emails matching the email
     * given by the user in the database
     */
    public function isEmailAvailable($email)
    {
        global $dbh;

        $sql = "SELECT * FROM users
                WHERE email = :email";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return sizeof($results) == 0;
    }

    public function createUser($name, $email, $pass)
    {
        global $dbh;

        $email = strtolower($email);
        $sql = "INSERT INTO users(fullname, email, password)
                VALUES(:fullname, :email, :password)";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':fullname', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password', SHA1($pass), PDO::PARAM_STR);


        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }
    }

    public function checkSignin($email, $pass)
    {
        global $dbh;

        $sql = "SELECT fullname, email, password FROM users
                WHERE email = :email AND password = :password";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password', SHA1($pass), PDO::PARAM_STR);


        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(sizeof($results) == 1) {
            //construct a new user with values and a signed in as true boolean
            global $user;
            //$user = new User($results['user_id'], $results['fullname'], $results['email'], true);
            $user->setId($results['user_id']);
            $user->setEmail($results['email']);
            $user->setName($results['fullname']);
            $user->setSignedIn(true);
            return $user;
        }
        return false;
    }
}