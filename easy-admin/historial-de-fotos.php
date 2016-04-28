<form id="choose" method="post" action="admin.php">             
				  <div class="tienda">
					<h2>Historial de fotos:</h2>				
					<h2 style="margin-top: 14px;">Por tienda</h2>
					<select class="select" name="tienda" onchange="this.form.submit()">
						<?php
							echo "<option value=\"0\">Seleccione</option>";
							while($reg=mysqli_fetch_array($registrosSala)){
								$nombre_sala = $reg['nombre_sala'];
								$id_sala = $reg['id_sala'];
								if(@$id_tienda_get==$id_sala){
									echo "<option value=\"$id_sala\" selected=selected>$nombre_sala</option>";
								}else{
									echo "<option value=\"$id_sala\">$nombre_sala</option>";
								}
							}
						?>
					</select>
				  </div>
				  <div class="campana">
					<h2>Por campaña</h2>                
					<select class="select" name="campana" onchange="this.form.submit()">
						<?php
							echo "<option value=\"0\">Seleccione</option>";
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
				  <input type="text" value="2" name="reset_cualquiera" hidden=hidden>
				</form>