<?php

require_once "view/View.php";
require_once "control/Controller.php";
require_once "model/AnimalStorageStub.php";

class Router{
    public function main($animalStorage){
        $view = new View($this);
        $controller = new Controller($view, $animalStorage);
        if(key_exists("id", $_GET)){
            $controller->showInformation($_GET["id"]);
        }
        else if(key_exists("action", $_GET) && $_GET["action"] === "liste" )
        {
            $controller->showList();
        }
        else{
            $controller->showWelcome();
        }
        $view->render();
    }

    public function getAnimalURL($id):String{
        return "site.php?id=".$id;
    }
}

?>