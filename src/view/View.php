<?php

require_once "model/Animal.php";

class View{
        public String $title, $content, $menu;
        public function __construct($router){
            $this->title = "";
            $this->content = "";
            $this->router = $router;
            $this->menu=<<<EOF
                            <nav class="menu">
                                    <ul>
                                    <li><a href=".">Accueil</a></li>
                                    <li><a href="{$this->router->getAnimalListURL()}">Liste des Animaux</a></li>
                                    <li><a href="{$this->router->getAnimalCreationURL()}">Nouvel animal</a></li>		
                                </ul>
                            </nav>
                        EOF;
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
                    {$this->menu}
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
            $this->content = "Bienvenue sur mon site";
        }

        
        public function prepareListPage($animals){
            $this->title = "Liste des animaux";

            $this->content = "<ul>";
            foreach($animals as $id => $animal){
                $this->content.="<li><a href='".$this->router->getAnimalURL($id)."'>Page sur ".$animal->name."</a></li>";
            }
            $this->content.="</ul>";

        }

        public function prepareDebugPage($variable) {
            $this->title = 'Debug';
            $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
        }

        public function prepareAnimalCreationPage(){
            $this->title = 'Ajout';
            $this->content = <<<EOF
                <form action="{$this->router->getAnimalSaveURL()}" method="POST">
                    <label >nom animal:</label><br>
                    <input type="text" id="nom" name="name"><br>
                    <label >espece:</label><br>
                    <input type="text" id="espece" name="species"><br>
                    <label >age:</label><br>
                    <input type="text" id="age" name="age"><br>
                    <button type="submit">confirmer</button>
                </form>
            EOF;
        }

}

?>