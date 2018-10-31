<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
	
	Nota: En Archivo donde no hay que contabilizar los tiempos
*/

/*Se recuperan los argumentos*/
$lugar		= htmlspecialchars($_GET["lugar"]);
$id_fotodeteccion = htmlspecialchars($_GET["id_fotodeteccion"]);
$nombre = htmlspecialchars($_GET["nameLugar"]);
$placa		= htmlspecialchars($_GET["placa"]);
$tiempo		= htmlspecialchars($_GET["tiempo"]);
$fecha = date($tiempo);
$mes = date('m',$fecha);
$ano = date('Y',$fecha);

$velocidad	= htmlspecialchars($_GET["velocidad"]);
//$tiempo = $tiempo*1000;

/*Validación de argumentos*/
/*
echo 'lugar='. 		$lugar .'</br>';
echo 'placa='. 		$placa .'</br>';
echo 'tiempo='. 	$tiempo .'</br>';
echo 'velocidad='. 	$velocidad;'</br>';
*/

/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
// Seleccionar la base de datos
$session   = $cluster->connect("fotodeteccionesbd");


/* ==--> Se arma el Batch*/
$batch = new Cassandra\BatchStatement(Cassandra::BATCH_UNLOGGED);
$batchCounter = new Cassandra\BatchStatement(Cassandra::BATCH_COUNTER);


/*$q = "BEGIN BATCH	
	  Insert into reportemensual_x_vehiculo (fecha, lugar,placa,velocidad) Values(saf,656532156,57,2532);
	  APPLY BATCH;"; */
	  $batch -> add(
		"INSERT INTO infracciones_x_vehiculoyfecha(placa, fecha, id_fotodeteccion, nombre) VALUES ('${placa}', ${tiempo}, ${id_fotodeteccion}, '${nombre}')"
	);
	  	  
	$batch -> add(
		"INSERT INTO reporte_x_fechaylugar(id_lugar, fecha,id_fotodeteccion , placa, velocidad ) VALUES (${lugar}, ${tiempo},${id_fotodeteccion},'${placa}',${velocidad})"
	);
	
	$batch -> add(
		"INSERT INTO infracciones_x_fecha (dummy, fecha, id_fotodeteccion, nombre, placa)VALUES (22,${tiempo},${id_fotodeteccion},'${nombre}','${placa}')"
		//"INSERT INTO informacion_x_fotodeteccion (id_fotodeteccion, placa, fecha, velocidad, nombre)VALUES (5,'${placa}',${tiempo},${velocidad},'asd');"
	);
	$batch -> add(
		"INSERT INTO velmaxima_x_vehiculo (placa, nombre, id_fotodeteccion, velocidad)VALUES ('${placa}','${nombre}',${id_fotodeteccion},${velocidad});"
	);	
	$batchCounter -> add(
	"UPDATE vehiculos_x_lugares SET placa += 1 WHERE nombre='${placa}' AND id_fotodeteccion = ${id_fotodeteccion} AND id_lugar =${lugar}"
	);

	$batchCounter -> add(	
	"UPDATE consolidadomensual_x_vehiculo SET nombre += 1 WHERE placa= '${placa}'  AND mes = ${mes} AND ano = ${ano} AND id_lugar ='${nombre}' "
	);

/* ==--> insertar el o los registros*/


//$statement = new Cassandra\SimpleStatement($q);
$session->execute($batch);
$session->execute($batchCounter);
$session->close();
/*retornar el texto con resultado*/
echo "OK";
?>