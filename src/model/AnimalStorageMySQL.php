<?php

/* Inclusion des dépendances de cette classe */
require_once("model/Animal.php");
require_once("model/AnimalStorage.php");
require_once("model/AnimalStorageStub.php");


class AnimalStorageMySQL implements AnimalStorage {

    protected $dbh;
	protected $tab;
	/**
	 * Construit une nouvelle instance.
	 * Si une base existe en session, elle est utilisée. Sinon,
	 * une nouvelle base est reconstruite en utilisant AnimalStorageStub.
	 */
	public function __construct($dbh) {
		$this->dbh = $dbh;	
		$this->tab = array();
	}

	/** Sérialise et stocke la base avant de détruire l'instance. */
	public function __destruct() {
		//throw new Exception('NOT YET');
	}
	/** Implémentation de la méthode de AnimalStorage */
	public function read($id) {
		$requete = 'SELECT name, species, age FROM animals WHERE id = :id';
		$stmt = $this->dbh->prepare($requete);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT); 
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			return new Animal($row['name'], $row['species'], $row['age']);
		} else {
			return null;
		}
	}

	/** Implémentation de la méthode de AnimalStorage */
	public function readAll() {
		$sth = $this->dbh->prepare('SELECT * FROM animals');
		$sth->execute();
		$db = $sth->fetchAll();
		foreach ($db as $key => $value) {
			$animal = new Animal($value["name"],$value["species"],$value["age"]);
			$this->tab[$value["id"]] = $animal;
		}
		return $this->tab;
	}

	/** Implémentation de la méthode de AnimalStorage */
	public function create(Animal $a) {
		$name = $a->getName();
		$species = $a->getSpecies();
		$age = $a->getAge();
		$sth = $this->dbh->prepare('INSERT INTO animals (name, species,age) VALUES ( :name,:species,:age);');
		$sth->bindValue(":name", $name, PDO::PARAM_STR);
    	$sth->bindValue(":species", $species, PDO::PARAM_STR);
		$sth->bindValue(":age", $age, PDO::PARAM_STR);
		$sth->execute();
		return $this->dbh->lastInsertId();
		
	}

	/** Implémentation de la méthode de AnimalStorage */
	public function update($id, Animal $a) {
		throw new Exception('NOT YET');
	}

	/** Implémentation de la méthode de AnimalStorage */
	public function delete($id) {
		throw new Exception('NOT YET');
	}

}
