<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
	
	Nota: En Archivo donde no hay que contabilizar los tiempos
*/

/*Se recuperan los argumentos*/
$lugar		= htmlspecialchars($_GET["lugar"]);
$placa		= htmlspecialchars($_GET["placa"]);
$tiempo		= htmlspecialchars($_GET["tiempo"]);
$velocidad	= htmlspecialchars($_GET["velocidad"]);
$fecha = date("Y-m-d H:i:s", $tiempo);

/*Validación de argumentos*/
/*
echo 'lugar='. 		$lugar .'</br>';
echo 'placa='. 		$placa .'</br>';
echo 'tiempo='. 	$tiempo .'</br>';
echo 'velocidad='. 	$velocidad;'</br>';
*/

/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/

// Create connection (Puerto, Usuario, Clave y base datos)
//$conn = new mysqli('localhost:3306', 'root', '','fotodeteccionesbd');
$conn = new mysqli('localhost:3306', 'root', 'your','fotodeteccionesbd');
if(!$conn)
	die("fallo conectando a la BD " . mysqli_connect_error());

/* ==--> Se arma el Insert*/

//$sql = "INSERT INTO fotodetecciones (fecha, velocidad, Vehiculos_placa, Lugares_idLugares) VALUES('".$fecha."', '".$velocidad."', '".$placa."', '".$lugar."');";
$sql = "INSERT INTO fotodetecciones (Lugares_idLugares, Vehiculos_placa, fecha, velocidad) VALUES('".$lugar."', '".$placa."', '".$fecha."','".$velocidad."');";	
/* ==--> insertar el o los registros*/

$conn->query($sql);
echo mysqli_error($conn);
$conn->close();
/*retornar el texto con resultado*/
echo "OK";
?>