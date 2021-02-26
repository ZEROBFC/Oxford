<?php
	//Realizara todo esto solo si existe un metodo POST
	if(!empty($_POST)) {
		//Se llama al archivo conexion.php
		include "conexion.php";
		//Obtenemos los valores de todos los campos
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$nombres_completos = $nombre." ".$apellido;
		$dni = $_POST['dni'];
		$domicilio = $_POST['domicilio'];
		$telefono = $_POST['telefono'];
		$correo = $_POST['email'];
		$correodef = $_POST['emaild'];
		
		
		
		$reclamo = $_POST['reclamo'];
		//Obtenemos los datos del archivo que se ha cargado
		$foto=$_FILES['filename']['name'];
		//Este if es ya que subir un archivo no es un campo obligatorio por lo que si la varible foto es vacia no debe copiar en la carpeta imagenes, si no lo colocamos este if saldra un error
		if(strlen($foto) > 0 ){
	    	//Obtenemos la ruta del archivo
			$ruta=$_FILES['filename']['tmp_name'];
			$destino="imagenes_documentos/".$foto;
			//El archivo que se envia se coloca en la carptea images_documento que tenemos en el proyecto
	    	copy($ruta, $destino);
		}
		//Si foto es vacio en la base de datos se guarda la varible destino con el valor de Sin archivo
	    else {
	    	$destino = "Sin archivo";
	    }
	    
	    //Genera número aleatorio para la solicitud
		$aleatorio = rand(1,99999999);
		//Consultamos que el numero de solicitud no exista
		$query = mysqli_query($connection,"SELECT * FROM reclamos WHERE solicitud ='$aleatorio'");
	    $result = mysqli_fetch_array($query);
	    if($result > 0) {
	    	while ($result > 0) {
	    		//Generamos otro número aleatorio si es que el aleatorio anterior ya esta en la base de datos
	    		$aleatorio = rand(1,99999999);
				$query = mysqli_query($connection,"SELECT * FROM reclamos WHERE solicitud ='$aleatorio'");
				$result = mysqli_fetch_array($query);
	    	}
	    	//Cuando sale de este while la variable result es 0
	    }
	    //Por lo que va a entrar a este if
	    if($result <= 0) {
	    	//Inserta los valores a la base de datos
	    	$query_insert = mysqli_query($connection, "INSERT INTO reclamos(dni,nombres_completos,domicilio,telefono,correo,correodef,reclamo,solicitud,archivo) VALUES('$dni','$nombres_completos','$domicilio','$telefono','$correo','$correodef','$reclamo','$aleatorio','$destino')");
	    	//Este if no es neceserio 
			if($query_insert){
				//Contenido del mensaje que le llega al correo de la persona que presento el reclamo
				$header = 'From: ' . $correo .  "\r\n" .
						   'Reply-To: ' . $correodef . "\r\n" .
						   'Cci: ' . $correodef . "\r\n" .
						   'X-Mailer: PHP/' . phpversion();

			   
				/*$header = 'From: jady.cedano@gmail.com' . "\r\n";
				$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
				$header .= "Mime-Version: 1.0 \r\n";
				$header .= "Content-Type: text/plain";*/
				$mensaje = "Contenido de la forma Libro de Reclamaciones." . "\r\n";
				$mensaje .= "Nombres y Apellidos: " . $nombres_completos . "\r\n";
				$mensaje .= "Número de documento de identidad: " . $dni . "\r\n";
				$mensaje .= "domicilio: " . $domicilio . "\r\n";
				$mensaje .= "Correo electrónico: " . $correo . "\r\n";
				$mensaje .= "Mensaje: " . $reclamo . "\r\n\r\n";
				$mensaje .= "Telefono: " . $telefono . "\r\n";
				$mensaje .= "Número de solicitud: " . $aleatorio . "\r\n";
				$mensaje .= "Enviado el " . date('d/m/Y', time());
				$asunto = 'Libro de Reclamaciones Creditos Oxford';
				mail($correo, $asunto, utf8_decode($mensaje), $header);
				mail($correodef, $asunto, utf8_decode($mensaje), $header);
				//Este header la pueden colocar si quieren que los envien a otra pagina
				// header("Location:insex.html");
				$alert = "CORRECTO : Reclamo registrado Creditos - Oxford.";
				
			}
	    }
	    else {
			$alert = "ERROR : Reclamo no registrado.";
		}
	}
?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Game - Sector</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<!--Tiene que ir estos paramaetros enctype="multipart/form-data" en el form para que el archivo se guarde-->
			<form class="contact100-form validate-form" action="" method="POST" 
			autocomplete="off" enctype="multipart/form-data">
				<span class="contact100-form-title">
					Libro De Reclamaciones
				</span>

				<!--Es en div alert se genera el mensaje de error o correcto del envio del formulario-->
				<div class="alert" id="mensaje"><?php echo isset($alert) ?  $alert : '';?></div>
				<label class="label-input100" for="nombres">Nombres Completos *</label>
				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Campo obligatorio">
					<input id="nombre" class="input100" type="text" name="nombre" placeholder="Nombres" maxlength="25" onkeypress="return sololetras(event)" onpaste="return false">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 rs2-wrap-input100 validate-input" data-validate="Campo obligatorio">
					<input class="input100" type="text" name="apellido" placeholder="Apellidos" maxlength="25" onkeypress="return sololetras(event)" onpaste="return false">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="dni">Documento de Indentidad *</label>
				<div class="wrap-input100 validate-input" data-validate="Campo obligatorio">
					<input id="dni" class="input100" type="text" name="dni" placeholder="Ej. 12345678" maxlength="8" onkeypress="return solonumeros(event)" onpaste="return false">
					<span class="focus-input100"></span>
				</div>
				
				<label class="label-input100" for="domicilio">Domicilio *</label>
				<div class="wrap-input100 validate-input" data-validate="Campo obligatorio">
					<input id="domicilio" class="input100" type="text" name="domicilio" placeholder="Ej. Calle abc" maxlength="50">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="email">Correo Electrónico *</label>
				
				<div class="wrap-input100 validate-input" data-validate="Campo obligatorio">
					<input type="text" id="emaild" name="emaild" value="bryanfc26@hotmail.com" style="display: none">
					<input id="email" class="input100" type="text" name="email" placeholder="Ej. example@email.com" maxlength="50">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="telefono">Teléfono *</label>
				<div class="wrap-input100 validate-input" data-validate="Campo obligatorio">
					<input id="telefono" class="input100" type="text" name="telefono" placeholder="Ej. +1 800 000000" maxlength="9" onkeypress="return solonumeros(event)" onpaste="return false">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="reclamo">Reclamo *</label>
				<div class="wrap-input100 validate-input" data-validate="Campo obligatorio">
					<textarea id="reclamo" class="input100" name="reclamo" placeholder="Escribe tu reclamo aquí..." maxlength="200"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="input__row uploader">
  					<div id="inputval" class="input-value"></div>
  						<label for="file_1"></label>
  						<input id="file_1" class="upload" type="file" name="filename">
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Enviar
					</button>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('images/bg-01.jpg');">
				<div class="flex-w size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-map-marker"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Dirección
						</span>

						<span class="txt2">
							Santo Domingo de Marcona Mz K10 #243						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-phone-handset"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Contacto
						</span>

						<span class="txt3">
							+056 261464
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-envelope"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							E-mail 
						</span>

						<span class="txt3">
							contact@example.com
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
	<script>
		//Este if sirve para que el formulario no se reenvie cuando damos f5 -->
		if ( window.history.replaceState ) {
        	window.history.replaceState( null, null, window.location.href );
    	}
	</script>
</body>
</html>
