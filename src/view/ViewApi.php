<?php

require_once "model/Animal.php";

class ViewApi {
    private $router;
    private String $content;

    public function __construct($router) {
        $this->router = $router;
        $this->content = "";
    }

    public function prepareUnknownAnimalPage() {

        http_response_code(404); 
        $this->content = json_encode([
            'message' => 'Animal not found'
        ], JSON_PRETTY_PRINT);
    }

    public function prepareAnimalPage($animal) {
        $this->content = json_encode([
            'nom' => $animal->getName(),
            'espece' => $animal->getSpecies(),
            'age' => $animal->getAge()
        ], JSON_PRETTY_PRINT);
    }

    public function prepareListPage($animals) {
         if (empty($animals)) {
            $this->content = json_encode([
                'message' => 'No animals found'
            ], JSON_PRETTY_PRINT);
        }else{
            $animalList = [];
            
            foreach ($animals as $id => $animal) {
                $animalList[] = [
                    'id' => $id,
                    'nom' => $animal->getName()
                ];
            }
            
            $this->content = json_encode($animalList, JSON_PRETTY_PRINT);
        }
    }
    public function render(){
        header('Content-Type: application/json');
        echo $this->content;
    }
}
?>
