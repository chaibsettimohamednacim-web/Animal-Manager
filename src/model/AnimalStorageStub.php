<?php
class AnimalStorageStub implements AnimalStorage{
    public Array $animalsTab;
    public function __construct(){
        $this->animalsTab = array(
                                'medor' => new Animal('Médor', 'chien', '6'),
                                'felix' => new Animal('Félix', 'chat','1'),
                                'denver' => new Animal('Denver', 'dinosaure', '50'),
                            );
    }
    public function read($id){
        if( key_exists($id, $this->animalsTab)){
            return $this->animalsTab[$id];
        }
        else{
            return null;
        }
    }
    public function readAll(){
        return $this->animalsTab;
    }
}
?>