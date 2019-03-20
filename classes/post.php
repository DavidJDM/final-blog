<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 3/13/2019
 * Time: 1:38 PM
 */

class Post
{
    private $postID;
    private $categoryID;
    private $title;
    private $body;
    private $author;
    private $numLikes;
    private $numComments;
    private $image;
    private $date;

    /**
     * Post constructor.
     * @param $postID
     * @param $categoryID
     * @param $title
     * @param $body
     * @param $author
     * @param $numLikes
     * @param $numComments
     * @param $image
     * @param $date
     */
    public function __construct($postID, $categoryID, $title, $body, $author, $numLikes, $numComments, $image, $date)
    {
        $this->postID = $postID;
        $this->categoryID = $categoryID;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->numLikes = $numLikes;
        $this->numComments = $numComments;
        $this->image = $image;
        $this->date = $date;
    }


    /**
     * @return mixed
     */
    public function getPostID()
    {
        return $this->postID;
    }

    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @param mixed $categoryID
     */
    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getNumComments()
    {
        return $this->numComments;
    }

    /**
     * @param mixed $numComments
     */
    public function setNumComments($numComments)
    {
        $this->numComments = $numComments;
    }

    /**
     * @return mixed
     */
    public function getNumLikes()
    {
        return $this->numLikes;
    }

    /**
     * @param mixed $numLikes
     */
    public function setNumLikes($numLikes)
    {
        $this->numLikes = $numLikes;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}