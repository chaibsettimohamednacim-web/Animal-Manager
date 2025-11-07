<?php
    class AnimalBuilder{

        public const NAME_REF= "nom";
        public const SPECIES_REF = "espece";
        public const AGE_REF = "age";
        protected $data;
        protected $errors;

        public function __construct($data=null){
            if ($data === null) {
                $data = array(
                    self::NAME_REF => "test",
                    /* valeur par défaut du code hexa tirée au hasard
                    * pour rendre les tests plus agréables */
                    self::SPECIES_REF => "testeur",
                    self::AGE_REF => 100
                );
		    }
            $this->data = $data;
            $this->errors = null;
        }

        public function isValid(){
            $this->errors = array();
            if (!key_exists(self::NAME_REF, $this->data) || $this->data[self::NAME_REF] === "")
                $this->errors[self::NAME_REF] = "Vous devez entrer un nom";
            if (!key_exists(self::SPECIES_REF, $this->data) || $this->data[self::SPECIES_REF] === "")
                $this->errors[self::SPECIES_REF] = "Vous devez entrer une espece";
            if( !key_exists(self::AGE_REF,$this->data) || !$this->data[self::AGE_REF] === "")
                $this->errors[self::AGE_REF] = "Vous devez entrer un age";
            else if( !is_numeric($this->data[self::AGE_REF]) || $this->data[self::AGE_REF] < 0)
                $this->errors[self::AGE_REF] = "Vous devez entrer un age correcte";
		    return count($this->errors) === 0;
        }

        public function createAnimal(): Animal{

            if (!key_exists(self::NAME_REF, $this->data) 
                || !key_exists(self::SPECIES_REF, $this->data)
                || !key_exists(self::AGE_REF, $this->data))
                throw new Exception("Missing fields for animal creation");
            return new Animal($this->data[self::NAME_REF], $this->data[self::SPECIES_REF], $this->data[self::AGE_REF]);
        }

        public function getData(){
            return $this->data;
        }

        public function getErrors(){
            return $this->errors;
        }
    }
?>