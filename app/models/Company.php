<?php

namespace App\Models;

class Company
{
    public int $id;
    public string $name;
    public string $address;
    public string $email;


    public function setId($id)
    {
        $this->id=$id;
    }
    public function setName($name)
    {
        $this->name=$name;
    }
    public function setAdress($address)
    {
        $this->address=$address;
    }
    public function setEmail($email){

     $this->email=$email;
    }



    public function getAdress()
    {
        $this->address;
    }
    public function getId()
    {
        $this->id;
    }
    public function getName()
    {
        $this->address;
    }

    public function getEmail()
    {

        $this->email ;
    }
}
