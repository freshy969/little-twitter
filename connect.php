<?php
/*$dbhost	= "webtp.fil.univ-lille1.fr";
$dbuser	= "shcherbakova";
$dbpass	= "kptngpzw";
$dbname	= "shcherbakova";

$conn = pg_connect("dbhost=$dbhost port=5432 dbname=$dbname user=$dbuser password=$dbpass");

//try {
	//$conn = new PDO("pgsql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//} catch (PDOException $e) {
//	echo "ERREUR CONNEXION" . $e->getMessage();
//	exit();
//}*/
$host = "webtp.fil.univ-lille1.fr";
$user = "shcherbakova";
$pass = "kptngpzw";
$db = "shcherbakova";

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n"); 
?>
