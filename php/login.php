 <?php

include("conexion.php"); // sirver para incluir  un archivo de conexion

// declarando variables para recibir y guardar los datos enviados desde el formulario

$nickName		$_POST[nickname];
$nombre			$_POST["nombre"];
$apellidos		$_POST["apellidos"];
$edad			$_POST["edad"];
$email			$_POST["email"];
$password		$_POST[password];

$passwordHash = password_hash($password, PASSWORD_BCRYPT);  //BCRYPT ES EL AGORITMO DE ENCRIPTACION DEVUELVE UNA CADENA DE 60 CARACTERES

// VERIFICAR SI YA EXISTE UN NICKNAME CON ESE MISMO VALOR

$consultaId = "SELECT Nickname
				FROM usuarios
				WHERE Nickname = "´$nickname´";
				"
$consultaId = mysqli_query($conexion, $consultaId); // devuelve  un objeto con el resultado, false si hay error, true si se ejecuta
$consultaId = mysqli_fetch_array($consultaId); //devuelve un ARRAY O  NULL

if(!$consultaId){  // si la consulta esta vacia entonces significada que  no existe el nickname y podemos crear uno nuevo

$sql = "INSERT INTO usuarios VALUES( `$nickname`,`$nombre`,`$apellidos`,`$edad`,`$email`,`$password`)";

//ejecutamos y verificamos si se guardaron los datos
if (mysqli_query($conexion, $sql)){
	mkdir("../img/$nickname"); 	//creamos una carpeta con el nombre del usuario ingresado
	//copiamos  nuestra foto por default
	copy("../img/default.jpg", "../img/$nickname/perfil.jpg"); 

	echo "tu cuenta ha sido creada";
	echo "string";
}	
else{
	echo "el nickname ya existe";
	echo "<a href=`index.html`> intentalo denuevo.</a></div>";

}

//cerrando sesion
mysqli_close($conexion);

    ?>