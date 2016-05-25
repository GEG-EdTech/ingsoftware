<?php
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    
    $to = "somebody@example.com";
    $subject = "Notificacion de estudio";
    $txt = "Hello world!";
    $headers = "From: admin@example.com";

    mail($to,$subject,$txt,$headers);
?>