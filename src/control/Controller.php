<?php

require_once "view/View.php";
require_once "model/AnimalBuilder.php";
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
        $af = new AnimalBuilder();
        $this->view->prepareAnimalCreationPage($af);
    }

    public function saveNewAnimal(array $data){
        
        $af = new AnimalBuilder($data);
        if($af->isValid()){
            $animal = $af->createAnimal();
            $id = $this->animalStorage->create($animal);
            $this->view->displayAnimalCreationSuccess($id);
        }
        else{
            $this->view->prepareAnimalCreationPage($af);
        }
    }
}

?>