<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once('/users/chaibse231/private/mysql_config.php');
require_once("Router.php");
require_once("PathInfoRouter.php");
require_once("model/AnimalStorageMySQL.php");
include('connection.php');

/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */
$options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

try {
    $dsn = MYSQL_HOST .MYSQL_PORT. MYSQL_DB;
    $connection = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD, $options);
    $dbh = $connection;
} catch (PDOException $e) {
    echo "Connexion à MySQL impossible : ", $e->getMessage();
    $dbh = null;
}
$animalStorage = new AnimalStorageMySQL($dbh);
$router = new PathInfoRouter();
$router->main($animalStorage);
?>
