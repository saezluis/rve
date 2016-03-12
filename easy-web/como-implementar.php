<?php
session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

	}
	else{
	
		header('Content-Type: text/html; charset=UTF-8'); 	
		echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";
		echo "<br/>" . "<a href='index.html'>Hacer Login</a>";
		exit;
	}
	
	$now = time(); // checking the time now when home page starts

	if($now > $_SESSION['expire']){
		session_destroy();
		echo "<br/><br />" . "Su sesion a terminado, <a href='index.html'> Necesita Hacer Login</a>";
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <title>Registro Visual Easy</title>
  </head>
  <body>
	<?php
	
		$campana_store = @$_REQUEST['campana'];		
		if($campana_store!=''){
			$_SESSION['c_store'] = $campana_store;
		}
		echo "session c_store lleva: ".$_SESSION['c_store'];
		echo "<br>";
		
		$exhibicion_store = @$_REQUEST['exhibicion'];
		if($exhibicion_store!=''){
			$_SESSION['e_store'] = $exhibicion_store;
		}
		echo "session store lleva: ".$_SESSION['e_store'];
		echo "<br>";
		
	?>
    <header>
      <div class="ed-container">
        <div class="ed-item base-100">
          <div class="logo__interiores"><img src="img/logo.png" alt=""></div>
        </div>
      </div>
    </header>
    <section class="content">
      <p>Cómo implementar en sala</p>
      <div class="ed-container">
        <div class="ed-item base-100 no-padding">
          <ul class="tabs">
            <li>
              <input id="tab1" type="radio" name="tabs" checked="">
              <label for="tab1">Buenas Prácticas</label>
              <div id="tab-content1" class="tab-content">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  <div class="ima-B-M"><img src="img/foto.jpg" alt=""></div>
                </p>
              </div>
            </li>
            <li>
              <input id="tab2" type="radio" name="tabs">
              <label for="tab2">Malas Prácticas</label>
              <div id="tab-content2" class="tab-content">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                  <div class="ima-B-M"><img src="img/foto.jpg" alt=""></div>
                </p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <section class="go">
  		<form method="post" action="take.php" class="vayale">
  			<input type="submit" value="Aceptar" class="aceptar-button">
  			<input type="text" value="si" name="aceptar_implementar" hidden=hidden>
  		</form>
		<!--
		<a href="take.php" class="aceptar">Aceptar</a>
		-->
	</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>