<?php

require_once "view/View.php";
require_once "control/Controller.php";
require_once "model/AnimalStorageStub.php";

class PathInfoRouter {
    public function main($animalStorage) {
        $view = new View($this);
        $controller = new Controller($view, $animalStorage);

        $path = $_SERVER['PATH_INFO'] ?? '/'; 
        $path = str_replace('/site.php/',"", $path);  
        if ($path === '') {
            $controller->showWelcome();
        } else if ($path === 'liste') {
            $controller->showList();
        } else {
            $controller->showInformation($path);
        }

        $view->render();
    }

    public function getAnimalURL($id): string {
        return "site.php/" . $id; 
    }
}
?>
