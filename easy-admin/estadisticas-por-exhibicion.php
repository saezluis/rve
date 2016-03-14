<?php
session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

	}
	else{
	
		header('Content-Type: text/html; charset=UTF-8'); 	
		echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";
		echo "<br/>" . "<a href='login.html'>Hacer Login</a>";
		exit;
	}
	
	$now = time(); // checking the time now when home page starts

	if($now > $_SESSION['expire']){
		session_destroy();
		echo "<br/><br />" . "Su sesion a terminado, <a href='login.html'> Necesita Hacer Login</a>";
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Admin</title>
  </head>
  <body>
	<?php
		$nombre_user = $_SESSION['nombre_user'];
		$foto_perfil = $_SESSION['foto_perfil'];
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosExhibicion = mysqli_query($conexion,"SELECT * FROM exhibicion") or die("Problemas en el select de campana: ".mysqli_error($conexion));
		
		@$id_exhibicion_get = @$_REQUEST['exhibicion'];
		
	?>
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Exhibiciones 2016</h1>
			
			<form id="choose" method="post" action="estadisticas-por-exhibicion.php">
				<div class="campana">
                <h2>Seleccionar exhibición</h2>                
				<select class="select" name="exhibicion" onchange="this.form.submit()">
					<?php
						echo "<option value=\"\">Seleccione</option>";
						while($reg=mysqli_fetch_array($registrosExhibicion)){
							$nombre = $reg['nombre'];
							$id_exhibicion = $reg['id_exhibicion'];
							if(@$id_exhibicion_get==$id_exhibicion){
								echo "<option value=\"$id_exhibicion\" selected=selected>$nombre</option>";
							}else{
								echo "<option value=\"$id_exhibicion\">$nombre</option>";
							}
							
						}
					?>
				</select>				
              </div>
			</form>  
			  
			<div>
				<form method="post" action="exhibicion.php">
					<input type="submit" value="Volver">
					<input type="text" value="resetear" name="reset_inicio" hidden=hidden>
				</form>
			</div>
			<!--
            <form id="choose">
              <div class="campana">
                <h2>Seleccionar sala</h2>
                <select>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
              <div class="tienda">
                <h2>Seleccionar proveedor</h2>
                <select>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
              <div class="tienda">
                <h2>Estadísticas</h2>
                <select>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
            </form>
			-->
          </div>
        </aside>
      </div>
      <div class="ed-item base-80">
        <header class="int">
          <h1>Estadísticas por exhibición</h1>
          <div class="items-header">
            <div class="custion">
              <?php				
					echo "<div class=\"profile\"><img src=\"img/$foto_perfil\" alt=\"\" class=\"circulo\"></div>";
					echo "<p class=\"nombre\">¡Hola! $nombre_user.</p><a href=\"logout.php\" class=\"rejected\">Cerrar sesión</a>";
				?> 
            </div>
          </div>
        </header>
        <div class="content">
			<?php
				
				if(@$id_exhibicion_get!=''){
					
					$registrosRegistro = mysqli_query($conexion,"SELECT * FROM registro WHERE id_exhibicion = '$id_exhibicion_get'") or die("Problemas en el select de fotos Tienda: ".mysqli_error($conexion));
					
					$registroExhibicion = mysqli_query($conexion,"SELECT * FROM exhibicion WHERE id_exhibicion = '$id_exhibicion_get'") or die("Problemas en el select de exhibicion: ".mysqli_error($conexion));
					
					if($reg=mysqli_fetch_array($registroExhibicion)){
						$nombre = $reg['nombre'];
					}
					
					echo "<h2>$nombre</h2>";
					echo "<table class=\"table\">";
						echo "<thead>";
							echo "<tr>";
								echo "<th>Nº registro</th>";
								echo "<th>Foto</th>";
								echo "<th>Usuario</th>";
								echo "<th>Tienda</th>";
								echo "<th>Fecha</th>";
								echo "<th>Comentario</th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							
							while($reg2=mysqli_fetch_array($registrosRegistro)){
								$id_registro = $reg2['id_registro'];
								$nombre_foto = $reg2['nombre_foto']; 
								$id_member = $reg2['id_member'];
								$id_sala = $reg2['id_sala'];
								$fecha = $reg2['fecha'];
								$comentario = $reg2['comentario'];
								
								$registroMember = mysqli_query($conexion,"SELECT * FROM members WHERE id = '$id_member'") or die("Problemas en el select members: ".mysqli_error($conexion));
								
								if($rowM = mysqli_fetch_array($registroMember)){
									$nombre_M = $rowM['nombre'];
								}
								
								$registroTienda = mysqli_query($conexion,"SELECT * FROM sala WHERE id_sala = '$id_sala'") or die("Problemas en el select members: ".mysqli_error($conexion));
								
								if($rowT = mysqli_fetch_array($registroTienda)){
									$nombre_S = $rowT['nombre_sala'];
								}
								
								echo "<tr class=\"tr-center\">";																
									echo "<td style=\"width:10px;\">$id_registro</td>";
									echo "<td> <img src=\"../easy-web/images/$nombre_foto\" width=\"150\" height=\"150\" alt=\"\"></td>";
									echo "<td>$nombre_M</td>";
									echo "<td>$nombre_S</td>";
									echo "<td>$fecha</td>";
									echo "<td>$comentario</td>";
								echo "</tr>";
							}
							
						echo "</tbody>";
					echo "</table>";
				
				}
			?>  
		  <!--
          <section class="paginacion">
            <ul>
              <li><a href="#" class="activate">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">6</a></li>
              <li><a href="#">7</a></li>
              <li><a href="#">8</a></li>
              <li><a href="#">9</a></li>
              <li><a href="#">10</a></li>
            </ul>
          </section>
		  -->
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slides.js"></script>
  </body>
</html>