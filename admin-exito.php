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
	<div style="padding:20px 100px 50px 100px;">
	    <?php	    
	    $con = new mysqli("localhost", "root", "B1gEd<3", "menu");
	    if (mysqli_connect_errno())
		die("Error: ".mysqli_connect_error());
	    else {
		if(isset($_POST["submit"])) {
		    if ($_FILES["imagen"]["size"] > 1024 * 1024 * 3) {
  			echo "Error: Archivo demasiado grande";
		    }  else {
			$dir = "imagenes/";
			$archivo = $dir . basename($_FILES["imagen"]["name"]);
			$nom = preg_replace("/[^\w,.!?¿ -_]+/", "", $_POST['nombre']);
			$precio = preg_replace("/[^\d.]+/", "", $_POST['precio']);
			$img = preg_replace("/[^\w.-_]+/", "", $_FILES["imagen"]["name"]);
			if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo)) {
			    $sql = "INSERT INTO productos (nombre,precio,imagen) VALUES ('".$nom."',".$precio.",'".$img."')";
			    $res = mysqli_query($con, $sql);
			    if(!$res)
				echo "Error: ". $con->error;
			} else {
			    echo "Error al subir imagen";
			}
		    }
		}
		echo "<h2>Bienvenid@ admin!!</h2>";
		echo "<h3>Productos del menú</h3>";
		$sql = "SELECT * FROM productos";
		$resultados = mysqli_query($con, $sql);
		if(!$resultados)
		    echo "Error: ". $con->error;
		else {
		    if(mysqli_num_rows($resultados) == 0)
			echo '<h3>No hay nigún producto</h3>';
		    else {
			echo '<table class="uk-table uk-table-divider">';
			echo '<thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Imágen</th></tr></thead><tbody>';
			while($col = $resultados->fetch_assoc()) {
			    echo '<tr>';
			    echo '<td>'.$col["id"].'</td>';
			    echo '<td>'.$col["nombre"].'</td>';
			    echo '<td>'.$col["precio"].'</td>';
			    echo '<td>'.$col["imagen"].'</td>';
			    echo '</tr>';
			}
			echo '</tbody></table>';
		    }
		}		    
	    }
	    ?>	    
	    <h3>Agrega un nuevo producto</h3>
	    <form method="post" enctype="multipart/form-data" class="uk-form-horizontal uk-margin-small">
		<div class="uk-margin">
		    <label class="uk-form-label" for="nombre">Nombre</label>
		    <div class="uk-form-controls">
			<input name="nombre" class="uk-input uk-form-width-medium" id="nombre" type="text" placeholder="Nombre de producto">
		    </div>
		</div>
		<div class="uk-margin">
		    <label class="uk-form-label" for="precio">Precio</label>
		    <div class="uk-form-controls">
			<input name="precio" type="number" min="0" class="uk-input uk-form-width-medium" id="precio" placeholder="Ingresa un número">
		    </div>
		</div>
		Imagen: <input type="file" name="imagen"><br/><br/>
		<button name="submit" type="submit" style="padding:10px;width:100px">Aceptar</button>
	    </form>	    
	</div>
    </body>
</html>
