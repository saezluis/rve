<?php

$id_camp = $_GET['id_send'];

include_once 'config.php';
	
$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
$acentos = $conexion->query("SET NAMES 'utf8'");

	$selectCampana = mysqli_query($conexion, "SELECT * FROM campana WHERE id_campana = $id_camp ") or die("Problemas con el select de campana: ".mysqli_error($conexion));

	if($reg=mysqli_fetch_array($selectCampana)){
		$archivo = $reg['archivo_pdf'];
	}

//echo "id campaña: ".$id_camp;

$file = "archivos/$archivo";
if (!unlink($file))
  {
  echo ("Error borrando archivo $file");
  }
else
  {
  echo ("Archivo eliminado");
  echo "<br>";
  }

  mysqli_query($conexion, "UPDATE campana SET archivo_pdf = '' WHERE id_campana = $id_camp ") or die("Problemas con el select de campana: ".mysqli_error($conexion));
  
echo "<form method=\"POST\" action=\"admin-practica-principal.php\">";
	echo "<input type=\"text\" name=\"id_campana\" value=\"$id_camp\" hidden=hidden>";
	echo "<input type=\"submit\" value=\"Volver\">";
echo "</form>";
  
?>