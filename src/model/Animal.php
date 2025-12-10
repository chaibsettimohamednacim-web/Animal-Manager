<?php

class Animal{
    private String $name, $species, $age,$image;
    public function __construct($name, $species, $age,$image){
        $this->name = $name;
        $this->species = $species;
        $this->age = $age;
        $this->image = $image;
    }
    public function getName(){
        return $this->name;
    }
    public function getSpecies(){
        return $this->species;
    }
    public function getAge(){
        return $this->age;
    }
    public function getImage(){
        return $this->image;
    }
}
?>