<?php 

function connecter(): ?PDO
{
    require_once('../../../private/mysql_config.php');

    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
        $dsn = MYSQL_HOST .MYSQL_PORT. MYSQL_DB;
        $connection = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD, $options);
        return $connection;
    } catch (PDOException $e) {
        echo "Connexion à MySQL impossible : ", $e->getMessage();
        return null;
    }
}
?>