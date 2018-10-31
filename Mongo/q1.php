<?php if (!extension_loaded("MongoDB")) die("Error: la extensi�n de Mongo es requerida."); ?>

<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$fedesde = htmlspecialchars($_GET["fedesde"]);
$fehasta = htmlspecialchars($_GET["fehasta"]);
$placa = htmlspecialchars($_GET["placa"]);
$filter =['$and'=>[[
    'fecha' => ['$gt' => $fedesde],'fecha' =>[ '$lte' => $fehasta],
    'placa' => $placa]]
];

$options = [
    'projection' => ['_id' => 0],
 ];
 
$query = new MongoDB\Driver\Query($filter,$options);
//Se hace la consulta especificando la base de datos y la coleccion
$cursor = $manager->executeQuery('fotodeteccionesdb.fotoMultas', $query);
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
                        <th>FECHA</th>
                        <th>HORA</th>	
                        <th>LUGAR</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($cursor as $row) {  ?>
                        <tr>   
                            <td><?php echo $row ->fecha;?></td>  
                            <td><?php echo $row->hora;?></td>                     
                            <td><?php echo $row->lugar;?></td>
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

