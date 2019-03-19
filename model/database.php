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
        if($_SERVER['HTTP_HOST'] == "dkovalevich.greenriverdev.com") {
            require_once('/home/dkovalev/final-config.php');
        }

        else if($_SERVER['HTTP_HOST'] == "bskar.greenriverdev.com") {
            require_once('/home/bskargre/final-config.php');
        }

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


    public function getPostsLiked($user_id)
    {
        global $dbh;

        $sql = "SELECT post_id FROM posts_liked
                WHERE user_id = :user_id";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $userLikes = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $userLikes;
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
        $sql = "INSERT INTO users(fullname, email, password, admin, admin_view)
                VALUES(:fullname, :email, :password, 0, 0)";

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

    public function checkAdminSignin($email, $pass)
    {
        global $dbh;

        if(strtolower($email) === "admin" && $pass === "adminmilana2019") {

            return true;
        }
        return false;
    }

    public function checkSignin($email, $pass)
    {
        global $dbh;

        $sql = "SELECT user_id, fullname, email, password, admin, admin_view FROM users
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

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if(!empty($results)) {
            //construct a new user with values and a signed in as true boolean
            $user = new User();

            $user->setId($results['user_id']);
            $user->setEmail($results['email']);
            $user->setName($results['fullname']);
            $user->setAdmin($results['admin']);
            $user->setAdminView($results['admin_view']);
            return $user;
        }
        return false;
    }

    /**
     * Determines whether the user has already liked a post and then updates the database accordingly
     * (num_likes decrements if it is already liked by this user or num_likes increments if it is not liked
     * by this user)
     * @return bool boolean whether the email already exists in the database or not
     */
    public function emailExists($email)
    {
        global $dbh;

        $sql = "SELECT user_id FROM users WHERE email = :email";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if(!empty($results)) {
            return true;
        }
        return false;
    }

    public function updateNumLikes($post_id, $user_id)
    {
        global $dbh;

        $sql = "SELECT posts_liked.user_id, posts_liked.post_id, posts.num_likes 
        FROM posts_liked INNER JOIN posts ON posts_liked.post_id = posts.post_id
        WHERE posts_liked.post_id = :post_id AND posts_liked.user_id = :user_id";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':post_id', $post_id, PDO::PARAM_STR);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);


        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        //if the logged in user has not liked this post before update the database
        if(empty($results)) {
            $sql = "INSERT INTO posts_liked (user_id, post_id)
                    VALUES(:user_id, :post_id)";

            $statement = $dbh->prepare($sql);

            $statement->bindValue(':post_id', $post_id, PDO::PARAM_STR);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);

            $statement->execute();
            $arr = $statement->errorInfo();
            if(isset($arr[2])) {
                print_r($arr[2]);
            }

            $sql = "UPDATE posts
                    SET num_likes = num_likes + 1
                    WHERE post_id = :post_id";

            $statement = $dbh->prepare($sql);

            $statement->bindValue(':post_id', $post_id, PDO::PARAM_STR);

            $statement->execute();
            $arr = $statement->errorInfo();
            if(isset($arr[2])) {
                print_r($arr[2]);
            }
        }

        else {
            $sql = "DELETE FROM posts_liked
                    VALUES(:user_id, :post_id)";

            $statement = $dbh->prepare($sql);

            $statement->bindValue(':post_id', $post_id, PDO::PARAM_STR);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);

            $statement->execute();
            $arr = $statement->errorInfo();
            if(isset($arr[2])) {
                print_r($arr[2]);
            }

            $sql = "UPDATE posts
                    SET num_likes = num_likes - 1
                    WHERE post_id = :post_id";

            $statement = $dbh->prepare($sql);

            $statement->bindValue(':post_id', $post_id, PDO::PARAM_STR);

            $statement->execute();
            $arr = $statement->errorInfo();
            if(isset($arr[2])) {
                print_r($arr[2]);
            }
        }
    }

    public function getSinglePost($postid)
    {
        global $dbh;

        $sql = "SELECT * FROM `posts` WHERE post_id = :post_id;";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':post_id', $postid, PDO::PARAM_STR);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getPopularPosts()
    {
        global $dbh;

        $sql = "SELECT * FROM posts ORDER BY num_likes DESC LIMIT 5";

        $statement = $dbh->prepare($sql);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function formatDate($date)
    {
        $month = date('M', strtotime($date));
        $day = date('t', strtotime($date));
        $year = date('Y', strtotime($date));

        return $month . " " . $day . ", " . $year;
    }
}