<?php

require_once "model/Animal.php";

class View{
        public String $title, $content;
        public Router $router;
        public function __construct($router){
            $this->title = "";
            $this->content = "";
            $this->router = $router;
        }

        public function render(){
            echo <<<EOT
                <!doctype html>
                <html lang="fr">
                <head>
                <meta charset="utf-8">
                <title>{$this->title}</title>
                </head>
                <body>
                    <h1>{$this->title}</h1>
                    {$this->content}
                </body>
                </html>

            EOT;
        }

        public function prepareTestPage(){      
            $this->title = "test";
            $this->content = "content test";
        }

        public function prepareAnimalPage($animal){
            $this->title = "Page sur ".$animal->name;
            $this->content = $animal->name." est un animal de l'espèce ".$animal->species." agé(e) de ".$animal->age  ;
        }
        public function prepareUnknownAnimalPage(){
            $this->title = "Animal Inconnu";
            $this->content = "Cet Animal ne figure pas dans la base de donnees" ;
        }
        public function prepareWelcomePage(){
            $this->title = "Page d'acceuil";
            $this->content = <<<EOT
                                <form method="GET">
                                    <input type="text" name="id">
                                    <button type="submit">Send</button>
                                </form>
                                EOT;
        }

        
        public function prepareListPage($animals){
            $this->title = "Liste des animaux";

            $this->content = "<ul>";
            foreach($animals as $id => $animal){
                $this->content.="<li><a href='".$this->router->getAnimalURL($id)."'>Page sur ".$animal->name."</a></li>";
            }
            $this->content.="</ul>";

        }

}

?>