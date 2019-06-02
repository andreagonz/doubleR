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
		    <li class="uk-active"><a href="menu.php">Menu</a></li>
		    <li><a href="about.php">Sobre nosotros</a></li>
		    <!--li><a href="/admin.php">Admin</a></li-->
		</ul>
	    </div>
	</nav>
	<div style="padding:20px 100px 0px 100px;">
	    <h1>Menú de alimentos</h1>
	    <form method="POST">
		<input name="q" />
		<button type="submit">Filtrar</button>
	    </form>
	    <?php
	    $sql = "SELECT * FROM productos";
	    if(isset($_POST['q']))
		$sql = "SELECT * FROM productos WHERE lower(nombre) LIKE '%".$_POST['q']."%'";	    
            $con = new mysqli("localhost", "root", "B1gEd<3", "menu");
            if (mysqli_connect_errno()) { 
		printf("Error: %s\n", mysqli_connect_error());
            } else {
		$resultados = mysqli_query($con, $sql);
		if(!$resultados)
		    echo "Error: ".$con->error;
		else {
		    if(mysqli_num_rows($resultados) == 0)
			echo '<h3>No hay resultados</h3>';
		    else {
			echo '<div class="uk-child-width-1-2@s uk-child-width-1-6@m" uk-grid="masonry: true">';
			while($col = $resultados->fetch_assoc()) {
			    echo '<div>';
			    echo '<div class="uk-card uk-card-default uk-card-body" style="height: 300px" name="'.$col["id"].'"><center><h5><strong>'.$col["nombre"].'</strong></h5><br/><img src="imagenes/'.$col["imagen"].'" style="max-height:100px;border-radius:2px;" /><h5>Precio: $'.$col["precio"].'</h5>'.'</center></div>';
			    echo '</div>';
			}
			echo '</div>';
		    }
		}
	    }            
	    ?>
	</div>
    </body>
</html>
