<?php

require_once "view/View.php";
require_once "control/Controller.php";

class Router{
    public function main(){
        $view = new View();
        $controller = new Controller($view);
        $controller->showInformation("medor");
        $view->render();
    }
}

?>