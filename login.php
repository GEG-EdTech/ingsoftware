<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ingresar</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" />
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
<?php require('db.php');?>
   <?php @session_start();?>  
	<?php
    // Ingresa los datos
    if (isset($_POST['username'])){
        $userName = $_POST['username'];
        $password = $_POST['password'];
		$userName = stripslashes($userName);
		$userName = mysql_real_escape_string($userName);
		$password = stripslashes($password);
		$password = mysql_real_escape_string($password);
	//Revisa si el usuario ya existe
        $query = "SELECT * FROM `users` WHERE username='$userName' and password='".md5($password)."'";
		$result = mysql_query($query) or die(mysql_error());
		$rows = mysql_num_rows($result);
        if($rows==1){
			$_SESSION['username'] = $userName;
                        echo "<script type='text/javascript'> window.location='http://localhost/ingsoftware/index.php'; </script>";
			// Redireccionar
            }else{
				echo "<div class='form'><h3>Nombre/Clave son incorrectas</h3><br/>Has click aqui para <a href='login.php'>Ingresar</a></div>";
				}
    }else{
?>
<div class="form">
    <h1>Ingresar</h1>
    <form action="" method="post" name="login">
    <input type="text" name="username" placeholder="Nombre" required />
    <input type="password" name="password" placeholder="Clave" required />
    <input id="submit" name="submit" type="submit" value="Ingresar" />
    </form>
    <p>¿No estas registrado aún? <a href='registration.php'>Registrate aqui!</a></p>
</div>
<?php } ?>
</section>
 
<aside>

</aside>


<footer>
    Copyright
</footer>

</body>
</html>