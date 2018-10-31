<?php

$placa = htmlspecialchars($_GET["placa"]);
$fedesde = htmlspecialchars($_GET["fedesde"]);
$fehasta = htmlspecialchars($_GET["fehasta"]);

if(is_null($placa) or is_null($fedesde) or is_null($fehasta)){
    echo "Por favor llene todos los campos";
    exit(0);
}

$conn = new mysqli('localhost:3306', 'root', 'your','fotodeteccionesbd');
if(!$conn)
    die("fallo conectando a la BD " . mysqli_connect_error());
    
$time_start = microtime(true); // Tiempo Inicial Proceso   

$sql = "SELECT DATE(fecha) AS fecha, TIME(fecha) AS hora, nombre 
FROM fotodetecciones 
INNER JOIN lugares ON fotodetecciones.Lugares_idLugares = lugares.idLugares
WHERE Vehiculos_placa = '".$placa."' and fecha >= '".$fedesde."' and fecha <= '".$fehasta."';";

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
                    <?php foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['fecha'];?></td>
                            <td><?php echo $row['hora'];?></td>
                            <td><?php echo $row['nombre'];?></td>
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