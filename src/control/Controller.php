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

        $allowedImageTypes = [
            IMAGETYPE_GIF, 
            IMAGETYPE_JPEG, 
            IMAGETYPE_PNG
        ];
        
        $movePath = null;
        $data[AnimalBuilder::IMAGE_REF] = null; 
        
        if (isset($_FILES[AnimalBuilder::IMAGE_REF])) {
            $fileInfo = $_FILES[AnimalBuilder::IMAGE_REF];
            if ($fileInfo['error'] === UPLOAD_ERR_OK) {
                
                $imageTmpPath = $fileInfo['tmp_name'];
                $imageType = exif_imagetype($imageTmpPath);
                
                if ($imageType !== false && in_array($imageType, $allowedImageTypes)) {
                    $fileExtension = image_type_to_extension($imageType, false);
                    $uniqueName = hash('sha256', time() . $fileInfo['name']) . '.' . $fileExtension;
                    $rootDir = dirname(__DIR__, 2); 
                    $movePath = $rootDir . '/images/' . $uniqueName; 
                    if (move_uploaded_file($imageTmpPath, $movePath)) {
                        $data[AnimalBuilder::IMAGE_REF] = 'images/' . $uniqueName;
                    }
                }
            } else if ($fileInfo['error'] !== UPLOAD_ERR_NO_FILE) {
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
            if ($movePath !== null && file_exists($movePath)) {
                unlink($movePath); 
            }
            $this->view->prepareAnimalCreationPage($af);
        }
    }

}



?>
