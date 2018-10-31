<?php
$fecha = htmlspecialchars($_GET["fecha"]);
$lugar = htmlspecialchars($_GET["lugar"]);

if(is_null($fecha) or is_null($lugar)){
    echo "Por favor llene todos los campos";
    exit(0);
}

$conn = new mysqli('localhost:3306', 'root', 'your','fotodeteccionesbd');
if(!$conn)
    die("fallo conectando a la BD " . mysqli_connect_error());

$time_start = microtime(true); // Tiempo Inicial Proceso   


$sql = "SELECT Vehiculos_placa, velocidad, TIME(fecha) AS hora 
FROM fotodetecciones 
WHERE Lugares_idLugares = '".$lugar."' AND DATE(fecha) = '".$fecha."';";

$result = $conn -> query($sql);
echo mysqli_error($conn);

$conn->close();
?>

<html>		
<body>
<head>
  <meta charset="UTF-8">
  <title></title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<h2 style="text-align: center;"> Consulta velocidades por sitio</h2>
		</div>
<div class="row table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>	
						<th>PLACA</th>	
                        <th>VELOCIDAD</th>	
                        <th>HORA</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['Vehiculos_placa'];?></td>
                            <td><?php echo $row['velocidad'];?></td>
                            <td><?php echo $row['hora'];?></td>
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