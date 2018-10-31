<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
*/

	/*Usted debe cambiar esto segun su configuracion del proyecto (ubicacion dentro del wampp y el puerto del pache*/
	$URL_HOME = 'http://localhost:9090/tecnicaNoSql/';

	/*Se recuperan los argumentos*/
	$bd = htmlspecialchars($_GET["bd"]);
	$registros = htmlspecialchars($_GET["registros"]);

	if( $registros < 1 or $registros > 9999999 ){
		echo "Error en el número de registros a generar. Valor=".$registros;
		exit(0);
	}

	/*Lista de Placas*/
	$listaPlacas = array(	
					"AAA111", "BBB111", "CCC111",
					"AAA222", "BBB222", "CCC222",
					"AAA333", "BBB333", "CCC333",
					"AAA444", "BBB444", "CCC444",
					"AAA555", "BBB555", "CCC555");
	$nroPlacas = count( $listaPlacas )-1;				
	/*Tiempo de Inicio*/
	$tiempo = time() - ($registros/2);
	$listaLugares = array(
		"La_Raya", "Sanjavier", "Olivares","San_Pedro", "Manrique",
		"Monteria","Santa_Maria","Belen","Bello","Itagui"
	);
	$nroLugares = count ($listaLugares)-1;
/*Formato en HTML*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Generación registros - NoSQL</title>
<style type="text/css">
body {
	background: #ededed;
	width: 900px;
	margin: 30px auto;
	color: #999;
}
p {
	margin: 0 0 2em;
}
h1 {
	margin: 0;
}
a {
	color: #339;
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
div {
	padding: 20px 0;
	border-bottom: solid 1px #ccc;
}
.bigrounded {
	-webkit-border-radius: 2em;
	-moz-border-radius: 2em;
	border-radius: 2em;
}
.medium {
	font-size: 12px;
	padding: .4em 1.5em .42em;
}
.small {
	font-size: 11px;
	padding: .2em 1em .275em;
}

table, th, td {
	color: black;
    border: 1px solid black;
    border-collapse: collapse;
}

/* blue */
.blue {
	color: #d9eef7;
	border: solid 1px #0076a3;
	background: #0095cd;
	background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
	background: -moz-linear-gradient(top,  #00adee,  #0078a5);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
}
.blue:hover {
	background: #007ead;
	background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
	background: -moz-linear-gradient(top,  #0095cc,  #00678e);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
}
.blue:active {
	color: #80bed6;
	background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
	background: -moz-linear-gradient(top,  #0078a5,  #00adee);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
}

</style>
</head>
<body>
<H1 class="blue">Insertar Masivo para <?=$bd;?>(registros:<?=$registros;?>)</H1>
<div>
<table style="width:100%">
<tr>
	<th>#</th>
    <th>URL</th>
    <th>Resultado</th>
</tr>
<?php
$time_start = microtime(true); // Tiempo Inicial Proceso

	/*Ciclo*/
	for( $i= 1 ; $i <= $registros ; $i++ ) {	
		/*Genera los valores de forma aleatoria*/
		$lugar = rand ( 0 , 9 );
		$id_fotodeteccion = rand (0, 99);
		$placa = $listaPlacas[ rand ( 0 , $nroPlacas ) ];
		$nameLugar = $listaLugares[$lugar];
		$tiempo = $tiempo + rand ( 0 , 1 );
		$velocidad = rand ( 80 , 100 );	
		/*Arma la cadena del llamado*/
		if($velocidad > 80){
			$url = 		$URL_HOME .
						$bd . '/insertar.php'.
						'?lugar='. $lugar .
						'&id_fotodeteccion='. $i.
						'&nameLugar='. $nameLugar .
						'&placa='. $placa .
						'&tiempo='. $tiempo .
						'&velocidad='. $velocidad;
			/*Se hace el llamado*/			
			$contents = file_get_contents( $url );
			/*Se imprime la fila de la tabla*/
			echo "<tr><td>$i</td><td>".$url . "</td><td>" . $contents . "</td></tr>\n";
		}
	}
?>
</table>
</div>
<?php
$time_end = microtime(true); // Tiempo Final
$time = $time_end - $time_start; // Tiempo Consumido
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>
