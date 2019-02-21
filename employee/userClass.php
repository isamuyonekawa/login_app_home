<?php
//ユーザーshowで使用する案
class User 
{
    private $name;
    private $id;
    private $userName;
    private $flag;

    public function __construct($id, $last, $first, $userName, $flag)
    {
        $this->id       = $id;
        $this->name     = $last . ' ' . $first;
        $this->userName = $userName;
        $this->flag     = $flag;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getFlag()
    {
        return $this->flag;
    } 

}