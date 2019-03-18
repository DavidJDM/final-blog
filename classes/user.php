<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 3/14/2019
 * Time: 12:17 PM
 */

class User implements JsonSerializable
{
    public $id;
    public $name;
    public $email;
    public $admin;
    public $adminView;

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

    public function jsonSerialize()
    {
        return array(
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email
        );
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getAdminView()
    {
        return $this->adminView;
    }

    /**
     * @param mixed $adminView
     */
    public function setAdminView($adminView)
    {
        $this->adminView = $adminView;
    }


}