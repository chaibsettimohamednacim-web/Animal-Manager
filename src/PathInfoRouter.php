<?php

require_once "view/View.php";
require_once "control/Controller.php";
require_once "model/AnimalStorageStub.php";

class PathInfoRouter {
    public function main($animalStorage) {
        $view = new View($this);
        $controller = new Controller($view, $animalStorage);

        $path = $_SERVER['PATH_INFO'] ?? ''; 
        $path = str_replace('/site.php/',"", $path);  
        $path = trim($path, '/');
        if ($path === '') {
            $controller->showWelcome();
        } else if ($path === 'liste') {
            $controller->showList();
        } else if ($path === 'nouveau'){
            $controller->createNewAnimal();
        } else if ($path == 'sauverNouveau'){
            $controller->saveNewAnimal($_POST);
        }else {
            $controller->showInformation($path);
        }

        $view->render();
    }

    public function getAnimalURL($id): string {
        return "/exoMVCR/site.php/".$id; 
    }
    public function getAnimalListURL(): string {
        return "/exoMVCR/site.php/liste"; 
    }
    public function getAnimalCreationURL(){
        return "/exoMVCR/site.php/nouveau";
    }

    public function getAnimalSaveURL(){
        return "/exoMVCR/site.php/sauverNouveau";
    }
}
?>
