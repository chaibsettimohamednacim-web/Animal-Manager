<?php

class Animal{
    public String $name, $species, $age;
    public function __construct($name, $species, $age){
        $this->name = $name;
        $this->species = $species;
        $this->age = $age;
    }
}
?>