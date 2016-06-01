<?php require('db.php'); @session_start();
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
                        header("Location: index.php");
			// Redireccionar
            }else{
                $imprimir_error = true;
				}
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ingresar</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<div class="form">
    <h1>
        <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x" style="color:cornflowerblue"></i>
            <i class="fa fa-sign-in fa-stack-1x" style="color:white"></i>
        </span>
        Ingresar</h1>
    <?php if($imprimir_error){ ?>
    <div class='form'>
        <h3>
        <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x" style="color:red"></i>
            <i class="fa fa-warning fa-stack-1x" style="color:white"></i>
        </span>
            Nombre/Clave son incorrectas</h3>
    </div>
    <?php } ?>
    <form action="login.php" method="post" name="login">
    <div class="input-group margin-bottom-sm">
        <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
            <input class="form-control" type="text" name="username" placeholder="Nombre" required />
    </div>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
            <input class="form-control" type="password" name="password" placeholder="Clave" required />
    </div>
    <input id="submit" name="submit" type="submit" value="Ingresar" />
    </form>
    <p>¿No estas registrado aún? <a href='registration.php'>Registrate aqui!</a></p>
</div>
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
