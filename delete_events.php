<?php
require('db.php');  //ingreso y conexion a la BBDD
include("auth.php"); //incluir auth.php en todas las paginas seguras

$userName = $_SESSION['username'];
$userName = stripslashes($userName);
$userName = mysql_real_escape_string($userName);
$queryId="SELECT id FROM users WHERE username='$userName'";
$resultId = mysql_query($queryId);
while ($fila = mysql_fetch_assoc($resultId)) {
	$id_u = $fila['id'];
}

$id = $_POST['id'];
// conexion db
try {
	$bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

//query de slq para borrar ramos

$sql = "DELETE from fecha WHERE id_fecha='$id' AND users_id='$id_u'";
$q = $bdd->prepare($sql);
$q->execute();

?>