<?php
//$id_foto_coment = $_REQUEST['foto_activo'];

extract($_POST);
if($_POST['act'] == 'add-com'):
	//$name = htmlentities($name);
    $id_foto_coment = htmlentities($email);
    $comment = htmlentities($comment);

	include('../config.php'); 
	
	//if(strlen($name) <= '1'){ $name = 'Guest';}
    
    $test = mysqli_query($conexion, "UPDATE registro SET comentario = '$comment' WHERE id_registro = $id_foto_coment");
    if(!mysql_errno()){
?>

    <div >
    	<img src="<?php //echo $grav_url; ?>" alt="" />
		<div >
	        <h5><?php //echo $name; ?></h5><span  ><?php //echo date('d-m-Y H:i'); ?></span>
	        
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div>

	<?php } ?>
<?php endif; ?>