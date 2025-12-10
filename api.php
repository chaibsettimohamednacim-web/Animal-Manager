<?php
set_include_path("./src");

require_once("RouterApi.php");
require_once("model/AnimalStorageMySQL.php");
include('connection.php');

$dbh = connecter();
$animalStorage = new AnimalStorageMySQL($dbh);
$router = new RouterApi();
$router->main($animalStorage);

?>
