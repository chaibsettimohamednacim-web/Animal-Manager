<?php

require_once "view/View.php";
require_once "control/Controller.php";

class Router{
    public function main(){
        $view = new View();
        $controller = new Controller($view);
        if(key_exists("id", $_GET)){
            $controller->showInformation($_GET["id"]);
        }
        else{
            $controller->showWelcome();
        }
        $view->render();
    }
}

?>