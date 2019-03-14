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
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

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
        $statement->bindValue(':email', $email, PDO::PARAM_INT);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return sizeof($results) == 0;
    }
}