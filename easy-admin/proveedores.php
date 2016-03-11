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
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Campañas 2016</h1>
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
            </form>
          </div>
        </aside>
      </div>
      <div class="ed-item base-80">
        <header class="int">
          <h1>Supervisor (Proveedores)</h1>
          <div class="items-header">
            <div class="custion">
              <div class="profile"><img src="img/carita.jpg" alt="" class="circulo"></div>
              <p class="nombre">¡Hola! Elisa Correa S.</p><a href="#" class="rejected">Cerrar sesión</a>
            </div>
          </div>
        </header>
        <div class="content">
          <div id="slides"><img src="http://placehold.it/940x400"><img src="http://placehold.it/940x400"><img src="http://placehold.it/940x400"><img src="http://placehold.it/940x400"><img src="http://placehold.it/940x400"></div>
          <p class="bottom-text">Imágen tomada por <span>Luis Sáez en </span><span>Easy Puente Alto </span>- Teléfono:  <span>09-234-8321</span></p>
        </div>
        <div class="content-caja-mensajes">
          <form id="message">
            <h3>Comentarios</h3>
            <textarea></textarea>
            <input type="submit" value="Enviar" class="enviar">
          </form>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slides.js"></script>
  </body>
</html>