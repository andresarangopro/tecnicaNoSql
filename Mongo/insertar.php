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
$fecha = date('Y/m/d',$tiempo);
$hora = date('h:i:s',$tiempo);
$nameLugar = htmlspecialchars($_GET["nameLugar"]);


/*Validación de argumentos

echo 'lugar='. 		$lugar .'</br>';
echo 'placa='. 		$placa .'</br>';
echo 'tiempo='. 	$tiempo .'</br>';
echo 'velocidad='. 	$velocidad;'</br>';*/



/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");



/* ==--> Se arma el Json*/


// Armar el JSon Para insertar

$documento = ['placa' => $placa, 'lugar_id' => $lugar ,'lugar' => $nameLugar, 'fecha' => $fecha,'hora' => $hora, 'velocidad' => $velocidad];



/* ==--> insertar el o los registros*/

$bulk = new MongoDB\Driver\BulkWrite;
$id_documento = $bulk->insert($documento);
var_dump($id_documento);
$result = $manager->executeBulkWrite('fotodeteccionesdb.fotoMultas', $bulk);

/*retornar el texto con resultado*/
echo "OK";
?>