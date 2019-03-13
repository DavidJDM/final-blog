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
    //connect to the database
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

    public function getInfo($id)
    {
        global $dbh;

        $sql = "SELECT * FROM post 
                WHERE category_id = ':id' LIMIT 25";

        $statement = $dbh->prepare($sql);

        //bind all the parameters
        $statement->bindValue(':id', $id, PDO::PARAM_STR);

        $statement->execute();
        $arr = $statement->errorInfo();
        if(isset($arr[2])) {
            print_r($arr[2]);
        }

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $post = new Post();
        $post->setAuthor($results['author']);
        $post->setBody($results['body']);
        $post->setCategoryID($results['category_id']);
        $post->setImage($results['image']);
        $post->setLikes($results['likes']);
        $post->setNumComments($results['num_comments']);
        $post->setNumLikes($results['num_likes']);
        $post->setTitle($results['title']);
        $post->setLikes($results['users_liked']);

        return $post;
    }
}