<?php


$servidor 	= "localhost";
$usuario 	= "root";
$contraseña = "";
$BD  		= "oxford";

	$obj_conexion = mysqli_connect($servidor,$usuario,$contraseña,$BD);
	if(!$obj_conexion)
	{
		echo  "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
	}
	else
	{
		echo 	"<h3>Conexion Exitosa PHP - MySQL</h3><hr><br>";
	}


	  ?>


