<script type="text/javascript">
	
	var wait=setTimeout("document.xyz.submit();",100);

</script>
<?php
	
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$id_proveedor = @$_REQUEST['id_proveedor_send'];
	$texto_bp = $_REQUEST['texto_bp'];
	$tipo_practica = $_REQUEST['tipo_practica'];
	$id_texto = $_REQUEST['id_texto_send'];
	
	$registrosTexto = mysqli_query($conexion,"SELECT * FROM textos WHERE id_texto = '$id_texto' ") or die("Problemas en el select de campana: ".mysqli_error($conexion));
	
	$contar_texto = mysqli_num_rows($registrosTexto);
	
	if($contar_texto==0){
		mysqli_query($conexion,"INSERT INTO textos (texto,id_proveedor,tipo_practica) VALUES ('$texto_bp','$id_proveedor','$tipo_practica')") or die("Problemas con el insert de fotos");
	}else{
		mysqli_query($conexion, "UPDATE textos SET texto='$texto_bp' WHERE id_texto = '$id_texto' ") or die("Problemas en el select de update parrilla".mysqli_error($conexion));
	}
	
	echo "<form name=\"xyz\" method=\"post\" action=\"buenas-practicas-pro.php\">";
		echo "<input type=\"text\" name=\"id_proveedor_send\" value=\"$id_proveedor\" hidden=hidden>";
	echo "</form>";

?>