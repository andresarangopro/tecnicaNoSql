<?php if (!extension_loaded("MongoDB")) die("Error: la extensi�n de Mongo es requerida."); ?>

<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$anio = htmlspecialchars($_GET["anio"]);
$mes = htmlspecialchars($_GET["mes"]);
$placa = htmlspecialchars($_GET["placa"]);
if($mes == 1 || $mes == 3 || $mes == 5 || $mes == 7 || $mes == 8 || $mes == 10 || $mes == 12){
    $fechadesde = $anio . '/' . $mes . '/' .'01';
    $fechahasta = $anio . '/' . $mes . '/' .'31';
}else if($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11){
    $fechadesde = $anio . '/' . $mes . '/' .'01';
    $fechahasta = $anio . '/' . $mes . '/' .'30';
}else if($mes == 2){
    $fechadesde = $anio . '/' . $mes . '/' .'01';
    $fechahasta = $anio . '/' . $mes . '/' .'29';
}


$query = new MongoDB\Driver\Command(['aggregate' => 'fotoMultas',
'pipeline' => [
    [
        '$match' => [
            'placa' => $placa,
            'fecha' => [
                '$gte' => $fechadesde, '$lte' => $fechahasta,
            ]
        ]
    ],
    [
        '$group' => ['_id'=>'$lugar','pasos'=>['$sum'=>1]]

    ]

    ],
    'cursor' => new stdClass,
]);
//Se hace la consulta especificando la base de datos y la coleccion
$cursor = $manager->executeCommand('fotodeteccionesdb', $query);
//print_r($cursor->toArray());
//$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_PRIMARY);
//$cursor = $manager->executeQuery('fotodeteccionesdb.fotoMultas', $query, $readPreference);
?>

<html>		
<body>
<head>
  <meta charset="UTF-8">
  <title>Document</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h2 style="text-align: center;"> Consulta Infracciones</h2>
		</div>
<div class="row table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
                        <th>LUGAR</th>
                        <th>PASOS</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($cursor as $row) {  ?>
                        <tr>   
                            <td><?php echo $row ->_id ;?></td>  
                            <td><?php echo $row->pasos;?></td>  
                        </tr>
                    <?php } ?>
			  </tbody>
			</table>
		</div>
        <?php $time_end = microtime(true); // Tiempo Final?>
        <?php $time = $time_end - $time_start; // Tiempo Consumido?>
        <?php echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";?>

</body>
</html>



