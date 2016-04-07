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
<html ng-app lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<script src="http://code.jquery.com/jquery-latest.js"></script>

	<link rel="stylesheet" href="css/styles.css">
	
	<link href="//cdn.rawgit.com/noelboss/featherlight/1.3.5/release/featherlight.min.css" type="text/css" rel="stylesheet" />
	
    <title>Administrador General del Sistema RVE</title>

	<link rel="stylesheet" href="css2/global.css">
	
  </head>
  <body>
	<?php
		$nombre_user = $_SESSION['nombre_user'];
		$foto_perfil = $_SESSION['foto_perfil'];
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosMembers = mysqli_query($conexion,"SELECT * FROM sala") or die("Problemas en el select de sala: ".mysqli_error($conexion));
		
		//-------------- INICIO Paginador ------------------
		
		//Limito la busqueda a 10 registros por pagina
		$TAMANO_PAGINA = 15; 
		
		//examino la página a mostrar y el inicio del registro a mostrar 
		@$pagina = $_GET["pagina"]; 
		if (!$pagina) { 
			$inicio = 0; 
			$pagina=1; 
		} 
		else { 
			$inicio = ($pagina - 1) * $TAMANO_PAGINA; 
		}
		
		$num_total_registros = mysqli_num_rows($registrosMembers); 
		//calculo el total de páginas 
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
		
		//AND orden_sap IS NOT NULL AND orden_recepcion IS NOT NULL
		$ssql = "SELECT * FROM sala LIMIT " . $inicio . "," . $TAMANO_PAGINA; 
		//echo $ssql;
		$rss = mysqli_query($conexion,$ssql); 
		
		//-------------- FIN Paginador ------------------	
		
	?>
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Administrador</h1>
			<div class="init_inicio">
					<form method="post" action="admin-tiendas.php">
						<input type="submit" value="Volver">
						<input class="inicio_reset" type="text" value="resetear" name="reset_inicio" hidden=hidden>
					</form>
			</div>
          </div>
        </aside>
      </div>
      <div class="ed-item base-80">
        <header class="int">
          <h1>Administrador General</h1>
          <div class="items-header">
            <div class="custion">
			<?php
				
				echo "<div class=\"profile\"><img src=\"img/$foto_perfil\" alt=\"\" class=\"circulo\"></div>";
				echo "<p class=\"nombre\">¡Hola! $nombre_user.</p><a href=\"logout.php\" class=\"rejected\">Cerrar sesión</a>";
			?>  
            </div>
          </div>
        </header>
		
		<div id="container">
			<div id="example">
				<?php			
					echo "<br>";					
					echo "<h4>Modificar usuarios</h4>";
					echo "<p>Seleccione el ID de la tienda que desea modificar:</p>";

					echo "<table class=\"pure-table\">";
						echo "<thead>";
							echo "<tr>";
								echo "<th>ID Tienda</th>";								
								echo "<th>Nombre tienda</th>";
								/*
								echo "<th>Password</th>";
								echo "<th>Nombre</th>";
								echo "<!-- <th>Tipo de usuario</th> -->";
								echo "<th>Tienda</th>";
								echo "<th>Teléfono</th>";
								echo "<th>Anexo</th>";
								echo "<th>Cargo</th>";
								echo "<!-- <th>Foto perfil</th> -->";
								*/
							echo "</tr>";
						echo "</thead>";

						echo "<tbody>";
							
							while($reg=mysqli_fetch_array($rss)){
								$id_sala = $reg['id_sala'];
								$nombre_sala = $reg['nombre_sala'];
								
								echo "<tr>";
									//echo "<div id=\"orden--6S\"><a href=\"modificar-oc-detalle.php?oc_send=",urlencode($n_orden)," \">Editar</a></div>";
									echo "<td><a class=\"equis\" href=\"modificar-tienda-detalle.php?id_send=",urlencode($id_sala)," \">$id_sala</a></td>";
									echo "<td>$nombre_sala</td>";
									/*
									echo "<td>$password</td>";
									echo "<td>$nombre</td>";
									echo "<!-- <td>Administrador</td> -->";
									echo "<td>$nombre_sala</td>";
									echo "<td>$celular</td>";
									echo "<td>$anexo</td>";
									echo "<td>$cargo</td>";
									echo "<!-- <td>foto-perfil</td> -->";
									*/
								echo "</tr>";
							}
							
						echo "</tbody>";
					echo "</table>";
					
					echo "<div class=\"caja-100\">";
						echo "<div class=\"paginator-odd \">";					
						//muestro los distintos índices de las páginas, si es que hay varias páginas 
							if ($total_paginas > 1){ 
							for ($i=1;$i<=$total_paginas;$i++){ 
								if ($pagina == $i) 
									//si muestro el índice de la página actual, no coloco enlace 
									echo "<span class=\"active\">" . $pagina . "</span>" . " "; 
								else 
									//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 				
									echo "<a href='modificar-tiendas.php?pagina=" . $i . "'>"  . $i .  "</a> " ; 
								}   
							}	
						echo "</div>";				
					echo "</div>";
					
				?>
			</div>			
		</div>		
     </div>
    </div>
	<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	-->
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<!--
    <script src="js/scripts.js"></script>
	-->
	
	<script src="//cdn.rawgit.com/noelboss/featherlight/1.3.5/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  </body>
</html>