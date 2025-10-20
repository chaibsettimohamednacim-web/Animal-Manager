<?php

require_once "model/Animal.php";

class View{
        public String $title, $content;
        public function __construct(){

        }

        public function render(){
            echo <<<EOT
                <!doctype html>
                <html lang="fr">
                <head>
                <meta charset="utf-8">
                <title>{$this->title}</title>
                <link rel="stylesheet" href="style.css">
                <script src="script.js"></script>
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

}

?>