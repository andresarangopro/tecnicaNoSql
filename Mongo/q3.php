<?php if (!extension_loaded("MongoDB")) die("Error: la extensi�n de Mongo es requerida."); ?>

<?php
$time_start = microtime(true); // Tiempo Inicial Proceso
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$fecha = htmlspecialchars($_GET["fecha"]);
$lugar = htmlspecialchars($_GET["lugar"]);
$filter = ['$and' =>[['fecha' => $fecha],['lugar_id' => $lugar]]];
$options = [
    'projection' => ['_id' => 0,'hora'=>1,'placa'=>'1','velocidad'=>1],
 ];

$query = new MongoDB\Driver\Query($filter,$options);
//Se hace la consulta especificando la base de datos y la coleccion
$cursor = $manager->executeQuery('fotodeteccionesdb.fotoMultas', $query);
//print_r($cursor->toArray());
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
                        <th>HORA</th>
                        <th>PLACA</th>	
                        <th>VELOCIDAD</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($cursor as $row) {  ?>
                        <tr>   
                            <td><?php echo $row ->hora ;?></td>  
                            <td><?php echo $row->placa;?></td>  
                            <td><?php echo $row->velocidad;?></td> 
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


