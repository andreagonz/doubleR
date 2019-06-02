<html>
    <head>
	<title>Double R Diner</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.5/css/uikit.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.5/js/uikit.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.5/js/uikit-icons.min.js"></script>
	<link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
	<nav class="uk-navbar-container" uk-navbar>
	    <div class="uk-navbar-left">
		<ul class="uk-navbar-nav">
		    <li><a href="index.php">Inicio</a></li>
		    <li><a href="menu.php">Menu</a></li>
		    <li><a href="about.php">Sobre nosotros</a></li>
		    <!--li><a href="/admin.php">Admin</a></li-->
		</ul>
	    </div>
	</nav>
	<div style="padding:50px;">
	    <center>
		<?php
		if(isset($_GET['pass']) && isset($_GET['usr'])) {
		    $con = new mysqli("localhost", "root", "B1gEd<3", "menu");
		    if (mysqli_connect_errno())
			die("Error: ".mysqli_connect_error());
		    $usr = preg_replace("/[^\w,.*?¿(:);<>\/-_]+/", "", $_GET['usr']);
		    $pass = preg_replace("/[^\w,.*?¿(:;<)>\/-_]+/", "", $_GET['pass']);
		    $sql = "SELECT * FROM admins WHERE nombre='".$usr."'";
		    $res = mysqli_query($con, $sql);
		    if(!$res)
			echo "Error: ".$con->error;
		    else {
			if(mysqli_num_rows($res) > 0) {
			    $sql = "SELECT * FROM admins WHERE nombre='".$usr."' AND pass='".$pass."'";
			    $res = mysqli_query($con, $sql);
			    if(!$res)
				echo "Error: ".$con->error;
			    else {
				if(mysqli_num_rows($res) == 0) 
				    echo "Contraseña incorrecta";
				else {
				    header("Location: admin-exito.php");
				    die();
				}
			    }
			} else {
			    echo "El usuario ".$usr." no existe";
			}
		    }
		}
		?>
		<form>
		    <div class="uk-margin">
			<div class="uk-inline">
			    <span class="uk-form-icon" uk-icon="icon: user"></span>
			    <input name="usr" class="uk-input" type="text">
			</div>
		    </div>
		    <div class="uk-margin">
			<div class="uk-inline">
			    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
			    <input name="pass" class="uk-input" type="password">
			</div>
		    </div>
		    <button style="padding:10px;width:100px;">Aceptar</button>
		</form>
	    </center>
	</div>
    </body>
</html>
