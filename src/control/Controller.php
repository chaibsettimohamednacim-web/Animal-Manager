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
        $movePath = null;
        if (isset($_FILES[AnimalBuilder::IMAGE_REF]) && $_FILES[AnimalBuilder::IMAGE_REF]['error'] !== UPLOAD_ERR_NO_FILE) {
            $imageTmpPath = $_FILES[AnimalBuilder::IMAGE_REF]['tmp_name'];
            $imageName = basename($_FILES[AnimalBuilder::IMAGE_REF]['name']);
            $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
            $uniqueName = hash('sha256', time() . $imageName) . '.' . $fileExtension;
            $rootDir = dirname(__DIR__, 2);
            $movePath = $rootDir . '/images/' . $uniqueName;
            if ($_FILES[AnimalBuilder::IMAGE_REF]['error'] === UPLOAD_ERR_OK && move_uploaded_file($imageTmpPath, $movePath)) {
                $data[AnimalBuilder::IMAGE_REF] = 'images/' . $uniqueName;
            } else if ($_FILES[AnimalBuilder::IMAGE_REF]['error'] !== UPLOAD_ERR_OK) {
                 $data[AnimalBuilder::IMAGE_REF] = null;
            }
        } 
        $af = new AnimalBuilder($data);
        if($af->isValid()){
            $animal = $af->createAnimal();
            $id = $this->animalStorage->create($animal);
            $this->view->displayAnimalCreationSuccess($id);
        }
        else{
            if ($movePath !== null && $data[AnimalBuilder::IMAGE_REF] === null && file_exists($movePath)) {
                unlink($movePath); 
            }
            $this->view->prepareAnimalCreationPage($af);
        }
    }
}



?>
