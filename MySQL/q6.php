<?php
$lugar = htmlspecialchars($_GET["lugar"]);

if(is_null($lugar)){
    echo "Por favor llene todos los campos";
    exit(0);
}

$conn = new mysqli('localhost:3306', 'root', '','fotodeteccionesbd');
if(!$conn)
    die("fallo conectando a la BD " . mysqli_connect_error());

$time_start = microtime(true);
    
$sql = "SELECT Vehiculos_placa, COUNT(*)  AS pasadas
FROM fotodetecciones 
WHERE Lugares_idLugares = '".$lugar."'
GROUP BY Vehiculos_placa 
ORDER BY pasadas DESC;";

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
			<h2 style="text-align: center;"> Pasos de vehiculos por lugar</h2>
		</div>
<div class="row table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>	
						<th>PLACA</th>	
                        <th>NUMERO DE PASADAS</th>						
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['Vehiculos_placa'];?></td>
                            <td><?php echo $row['pasadas'];?></td>
                        </tr>
                    <?php } ?>
			  </tbody>
			</table>
		</div>

<?php
$time_end = microtime(true); // Tiempo Final
$time = $time_end - $time_start; // Tiempo Consumido
echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";
?>
</body>
</html>