<?php if (!extension_loaded("MongoDB")) die("Error: la extensi�n de Mongo es requerida."); ?>

<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$fecha = htmlspecialchars($_GET["fecha"]);
$filter = ['fecha' => $fecha];
$options = [
    'projection' => ['_id' => 0],
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
                        <th>LUGAR</th>	
                        <th>PLACA</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($cursor as $row) {  ?>
                        <tr>   
                            <td><?php echo $row ->hora ;?></td>  
                            <td><?php echo $row->lugar;?></td>  
                            <td><?php echo $row->placa;?></td> 
                        </tr>
                    <?php } ?>
			  </tbody>
			</table>
		</div>
    

</body>
</html>
