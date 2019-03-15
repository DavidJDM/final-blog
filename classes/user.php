<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 3/14/2019
 * Time: 12:17 PM
 */

class User
{
    public $id;
    public $name;
    public $email;
    public $signedIn;

    /**
     * User constructor.
     * @param $id
     * @param $name
     * @param $email
     * @param $signedIn
     */
    public function __construct($id, $name, $email, $signedIn = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->signedIn = $signedIn;
    }

    /**
     * User constructor.
     * @param $id
     * @param $name
     * @param $email
     * @param $signedIn
     */


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSignedIn()
    {
        return $this->signedIn;
    }

    /**
     * @param mixed $signedIn
     */
    public function setSignedIn($signedIn)
    {
        $this->signedIn = $signedIn;
    }


}