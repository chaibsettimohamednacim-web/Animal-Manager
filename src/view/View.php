<?php

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

        public function prepareAnimalPage($name, $species){
            $this->title = "Page sur ".$name;
            $this->content = $name." est un animal de l'espèce ".$species ;
        }
        public function prepareUnknownPage(){
            $this->title = "Animal Inconnu";
            $this->content = "Cet Animal ne figure pas dans la base de donnees" ;
        }

}

?>