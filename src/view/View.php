<?php

require_once "model/Animal.php";
require_once "model/AnimalBuilder.php";

class View{
    private String $title, $content, $menu;
    private $router;
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
            <link rel="stylesheet" href="/exoMVCR/skin/screen.css" />
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

    public function prepareAnimalCreationPage(AnimalBuilder $builder){
        $this->title = "Ajouter votre couleur";
		$s = '<form action="'.$this->router->getAnimalSaveURL().'" method="POST">'."\n";
		$s .= self::getFormFields($builder);
		$s .= "<button>Créer</button>\n";
		$s .= "</form>\n";
		$this->content = $s;
    }

    protected function getFormFields(AnimalBuilder $builder) {
        $data = $builder->getData();
        $s = "";

        $s .= '<p><label>Nom de l\'animal : <input type="text" name="'.AnimalBuilder::NAME_REF.'" value="';
        
        $s .= htmlspecialchars($data[AnimalBuilder::NAME_REF]);
        $s .= "\" />";

        $err = $builder->getErrors();
        if ($err !== null && key_exists(AnimalBuilder::NAME_REF, $err))
            $s .= ' <span class="error">'.$err[AnimalBuilder::NAME_REF].'</span>';
        $s .="</label></p>\n";

        $s .= '<p><label>Espece de l\'animal : <input type="text" name="'.AnimalBuilder::SPECIES_REF.'" value="';
        $s .= htmlspecialchars($data[AnimalBuilder::SPECIES_REF]);
        $s .= '" ';
        $s .= '	/>';
        if ($err !== null && key_exists(AnimalBuilder::SPECIES_REF, $err))
            $s .= ' <span class="error">'.$err[AnimalBuilder::SPECIES_REF].'</span>';
        $s .= '</label></p>'."\n";

        $s .= '<p><label>Age de l\'animal : <input type="text" name="'.AnimalBuilder::AGE_REF.'" value="';
        $s .= htmlspecialchars($data[AnimalBuilder::AGE_REF]);
        $s .= '" ';
        $s .= '	/>';
        if ($err !== null && key_exists(AnimalBuilder::AGE_REF, $err))
            $s .= ' <span class="error">'.$err[AnimalBuilder::AGE_REF].'</span>';
        $s .= '</label></p>'."\n";
        return $s;
    }

}

?>