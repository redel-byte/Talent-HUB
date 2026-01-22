<?php
class Category
{
    public int $id;
    public string $name;


    public function setId( $id){

    $this->id=$id;
    }
    public function setName($name){

    $this->name=$name;
    }


    public function getId(){

    return $this->id;
    }
    public function getName(){

    return $this->name;
    }
}
