<?php
$host ="localhost"; 
$user = "root";
$password = "";
//Nombre de la base de datos
$db = "registro";
//Genera la conexion
$connection = mysqli_connect($host,$user,$password,$db) or die("error en la conexion");
?>