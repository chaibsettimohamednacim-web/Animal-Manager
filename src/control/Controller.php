<?php

require_once "view/View.php";

class Controller{
    public View $view;
    public Array $dbAnimals = array(
                                'medor' => array('Médor', 'chien'),
                                'felix' => array('Félix', 'chat'),
                                'denver' => array('Denver', 'dinosaure'),
                            );
    public function __construct($view){
        $this->view = $view;
    }
    public function showInformation($id) {
        if( key_exists($id, $this->dbAnimals)){
            $this->view->prepareAnimalPage("Médor", "chien"); 
        }
        else{
            $this->view->prepareUnknownAnimalPage();
        }
    }
}

?>