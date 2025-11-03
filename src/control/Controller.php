<?php

require_once "view/View.php";
require_once "model/Animal.php";
require_once "model/AnimalStorage.php";

class Controller{
    public View $view;
    public AnimalStorage $animalStorage ;
    public function __construct($view, $animalStorage){
        $this->view = $view;
        $this->animalStorage = $animalStorage;
    }
    public function showInformation($id) {
        $animal = $this->animalStorage->read($id);
        if( $animal === null){
            $this->view->prepareUnknownAnimalPage();
        }
        else{
            $this->view->prepareAnimalPage($animal); 
        }
    }
    public function showWelcome(){
        $this->view->prepareWelcomePage();
    }

    public function showList(){
        $this->view->prepareListPage($this->animalStorage->readAll());
    }

    public function createNewAnimal(){
        $this->view->prepareAnimalCreationPage();
    }

    public function saveNewAnimal(array $data){
        $name ='';
        $species ='';
        $age='';
        $errors =array();
        if(key_exists('name',$data) && !empty($data['name'])){
            $name = $data['name'];
        }else{
            $errors['name'] = "Veuillez saisir un nom correcte";
        }
        if( key_exists('species',$data) && !empty($data['species']) ){
            $species = $data['species'];
        }else{
            $errors['species'] = "Veuillez saisir une espece correcte";
        } 
        if( key_exists('age',$data) && !empty($data['age'])){
            $age = $data['age'];
        }else{
            $errors['age'] = "Veuillez saisir un age correcte";
        }  
        if(empty($errors)){ 
            $a = new Animal($data['name'],$data['species'], $data['age']);
            $this->animalStorage->create($a);
            $this->view->prepareDebugPage($data);
        }
        else{
            $this->view->prepareAnimalCreationPage($data, $errors);
        }
    }
}

?>