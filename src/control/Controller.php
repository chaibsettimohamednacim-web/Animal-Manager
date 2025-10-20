<?php

require_once "view/View.php";
require_once "model/Animal.php";

class Controller{
    public View $view;
    public Array $animalsTab ;
    public function __construct($view){
        $this->view = $view;
        $this->animalsTab = array(
                                'medor' => new Animal('Médor', 'chien', '6'),
                                'felix' => new Animal('Félix', 'chat','1'),
                                'denver' => new Animal('Denver', 'dinosaure', '50'),
                            );
    }
    public function showInformation($id) {
        if( key_exists($id, $this->animalsTab)){
            $this->view->prepareAnimalPage($this->animalsTab[$id]); 
        }
        else{
            $this->view->prepareUnknownAnimalPage();
        }
    }
    public function showWelcome(){
        $this->view->prepareWelcomePage();
    }
}

?>