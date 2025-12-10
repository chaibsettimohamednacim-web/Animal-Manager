<?php

require_once "view/ViewApi.php";
require_once "control/Controller.php";
require_once "model/AnimalStorageStub.php";

class RouterApi{
    public function main($animalStorage){
        $view = new ViewApi($this);
        $controller = new Controller($view, $animalStorage);
        if ( key_exists("collection",$_GET) && $_GET['collection'] === 'animaux' ) {
            if (key_exists("id",$_GET)) {
                $id = (int) $_GET['id']; 
                $controller->showInformation($id);  
            }
            else {
                $controller->showList();
            }
        }
        $view->render();
    }
}
?>