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
            $this->view->prepareAnimalPage($this->dbAnimals[$id][0], $this->dbAnimals[$id][1]); 
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