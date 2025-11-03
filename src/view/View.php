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
            $this->title = "Page sur ".htmlspecialchars($animal->name);
            $this->content = htmlspecialchars($animal->name)." est un animal de l'espèce ".htmlspecialchars($animal->species)." agé(e) de ".htmlspecialchars($animal->age)  ;
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
                $this->content.="<li><a href='".$this->router->getAnimalURL($id)."'>Page sur ".htmlspecialchars($animal->name)."</a></li>";
            }
            $this->content.="</ul>";

        }

        public function prepareDebugPage($variable) {
            $this->title = 'Debug';
            $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
        }

        public function prepareAnimalCreationPage(array $data=array(),array $errors=array()){
            $name ='';
            $species ='';
            $age='';
            if(key_exists('name',$data)){
                $name = $data['name'];
            } 
            if( key_exists('species',$data)){
                $species = $data['species'];
            } 
            if( key_exists('age',$data)){
                $age = $data['age'];
            }
            $nameError ='';
            $speciesError ='';
            $ageError ='';
            if(key_exists('name',$errors)){
                $nameError = "<text id='error'>".$errors['name']."</text><br>";
            } 
            if( key_exists('species',$errors)){
                $speciesError = "<text id='error'>".$errors['species']."</text><br>";
            } 
            if( key_exists('age',$errors)){
                $ageError = "<text id='error'>".$errors['age']."</text><br>";
            }

            $this->title = 'Ajout';
            $this->content = <<<EOF
                <form action="{$this->router->getAnimalSaveURL()}" method="POST">
                    <label >nom animal:</label><br>
                    {$nameError}
                    <input type="text" id="nom" name="name" value="{$name}"><br>
                    <label >espece:</label><br>
                    {$speciesError}
                    <input type="text" id="espece" name="species" value="{$species}"><br>
                    <label >age:</label><br>
                    {$ageError}
                    <input type="text" id="age" name="age"value="{$age}"><br>
                    <button type="submit">confirmer</button>
                </form>
            EOF;
        }

}

?>