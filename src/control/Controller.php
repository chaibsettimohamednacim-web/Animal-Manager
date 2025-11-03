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
        $a = new Animal($data['name'],$data['species'], $data['age']);
        $this->animalStorage->create($a);
        $this->view->prepareDebugPage($data);
    }
}

?>