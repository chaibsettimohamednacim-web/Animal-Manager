<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

require_once("Router.php");
require_once("PathInfoRouter.php");
require_once("model/AnimalStorageMySQL.php");
include('connection.php');

$dbh = connecter();
$animalStorage = new AnimalStorageMySQL($dbh);
$router = new PathInfoRouter();
$router->main($animalStorage);
?>
