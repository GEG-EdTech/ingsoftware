<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://use.fontawesome.com/5ab0d2bdb4.js"></script>
<style>
header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;	 
}
nav {
    line-height:30px;
    background-color:#eeeeee;
    height:300px;
    width:150px;
    float:left;
    padding:5px;	      
}
section {
    width:450px;
    float:left;
    padding:10px;	 	 
}
footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
    padding:5px;	 	 
}
</style>
</head>
<body>

<header>
</header>

<nav>
  

</nav>

<section>
<?php
	require('db.php');
    // se requiere para incluir informacion en la BBDD
    if (isset($_POST['username'])){
        $userName = $_POST['username'];
	$eMail = $_POST['email'];
        $password = $_POST['password'];
		$userName = stripslashes($userName);
		$userName = mysql_real_escape_string($userName);
		$eMail = stripslashes($eMail);
		$eMail = mysql_real_escape_string($eMail);
		$password = stripslashes($password);
		$password = mysql_real_escape_string($password);
		$trnDate = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$userName', '".md5($password)."', '$eMail', '$trnDate')";
        $result = mysql_query($query);
        if($result){
            echo "<div class='form'><h3>Fuistes registrado satisfactoriamente.</h3><br/>Has click aqui para <a href='login.php'>Ingresar</a></div>";
        }
    }else{
?>
<div class="form">
<h1>
    <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x" style="color:cornflowerblue"></i>
        <i class="fa fa-users fa-stack-1x" style="color:white"></i>
    </span>
    Registro</h1>

<form name="registration" action="" method="post">
    <div class="input-group margin-bottom-sm">
        <span class="input-group-addon"><i class="fa fa-user  fa-fw" aria-hidden="true"></i></span>
            <input class="form-control" type="text" name="username" placeholder="Nombre" required />
    </div>
    <div class="input-group margin-bottom-sm">
        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
            <input class="form-control" type="email" name="email" placeholder="Email" required />
    </div>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
            <input class="form-control" type="password" name="password" placeholder="Clave" required />
    </div>
    <input type="submit" name="submit" value="Registrar" />
</form>
<p>¿Ya estas registrado? <a href='login.php'>Ingresa aqui!</a></p>
</div>
<?php } ?>
</section>
 
<aside>

</aside>

<footer>
<span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x" style="color:purple"></i>
            <i class="fa fa-area-chart fa-stack-1x" style="color:white"></i>
        </span>
        Ayuda a tu estrategia de estudio
</footer>

</body>
</html>

