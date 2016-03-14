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
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosCampana = mysqli_query($conexion,"SELECT * FROM campana") or die("Problemas en el select de campana: ".mysqli_error($conexion));
		
		@$id_campana_get = @$_REQUEST['campana'];
		
	?>
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Campañas 2016</h1>
			
			<form id="choose" method="post" action="estadisticas-por-campana.php">
				<div class="campana">
                <h2>Seleccionar campaña</h2>                
				<select class="select" name="campana" onchange="this.form.submit()">
					<?php
						echo "<option value=\"\">Seleccione</option>";
						while($reg=mysqli_fetch_array($registrosCampana)){
							$nombre = $reg['nombre'];
							$id_campana = $reg['id_campana'];
							if(@$id_campana_get==$id_campana){
								echo "<option value=\"$id_campana\" selected=selected>$nombre</option>";
							}else{
								echo "<option value=\"$id_campana\">$nombre</option>";
							}
							
						}
					?>
				</select>				
              </div>
			</form>  
			  
			<div>
				<form method="post" action="visual.php">
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
          <h1>Estadísticas por campaña</h1>
          <div class="items-header">
            <div class="custion">
              <div class="profile"><img src="img/carita.jpg" alt="" class="circulo"></div>
              <p class="nombre">¡Hola! Elisa Correa S.</p><a href="#" class="rejected">Cerrar sesión</a>
            </div>
          </div>
        </header>
        <div class="content">
			<?php
				
				if(@$id_campana_get!=''){
					
					$registrosRegistro = mysqli_query($conexion,"SELECT * FROM registro WHERE id_campana = '$id_campana_get'") or die("Problemas en el select de fotos Tienda: ".mysqli_error($conexion));
					
					$registroCampana = mysqli_query($conexion,"SELECT * FROM campana WHERE id_campana = '$id_campana_get'") or die("Problemas en el select de fotos Tienda: ".mysqli_error($conexion));
					
					if($reg=mysqli_fetch_array($registroCampana)){
						$nombre = $reg['nombre'];
					}
					
					echo "<h2>$nombre</h2>";
					echo "<table class=\"table\">";
						echo "<thead>";
							echo "<tr>";
								echo "<th>Nº registro</th>";
								echo "<th>Foto</th>";
								echo "<th>Usuario</th>";
								echo "<th>Sala</th>";
								echo "<th>Fecha</th>";
								echo "<th>Comentario</th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							
							while($reg2=mysqli_fetch_array($registrosRegistro)){
								$id_registro = $reg2['id_registro'];
								$nombre_foto = $reg2['nombre_foto']; 
								$id_member = $reg2['id_member'];
								$id_campana = $reg2['id_campana'];
								$fecha = $reg2['fecha'];
								$comentario = $reg2['comentario'];
								
								echo "<tr class=\"tr-center\">";																
									echo "<td style=\"width:10px;\">$id_registro</td>";
									echo "<td> <img src=\"../easy-web/images/$nombre_foto\" width=\"150\" height=\"150\" alt=\"\"></td>";
									echo "<td>Luiz Sáez</td>";
									echo "<td>Sala X</td>";
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