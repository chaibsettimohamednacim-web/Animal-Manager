<?php

require_once "view/View.php";

class Router{
    public function main(){
        $view = new View();
        $view->prepareAnimalPage("Medor","Berger Allemend");
        $view->render();
    }
}

?>