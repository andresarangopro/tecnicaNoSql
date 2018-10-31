<?PHP
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
*/
$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
// Seleccionar la base de datos
$session   = $cluster->connect("fotodeteccionesbd");
$ano = $_GET['anio'];
$mes = $_GET['mes'];
$placa = $_GET['placa'];
$statemen = new Cassandra\SimpleStatement("SELECT nombre, id_fotodeteccion  FROM consolidadomensual_x_vehiculo WHERE placa= '".$placa."' AND ano=".$ano." AND mes=".$mes." ;");
$result    = $session->execute($statemen);
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
                        <th>ID FOTODETECCIÓN</th>
                        <th>PLACA</th>	
                        <th>REGISTROS</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($result as $row) {  ?>
                        <tr>   
                            <td><?php echo $row['id_fotodeteccion'];?></td>  
                            <td><?php echo $placa;?></td>                     
                            <td><?php echo $row['nombre'];?></td>
                        </tr>
                    <?php } ?>
			  </tbody>
			</table>
		</div>
    

</body>
</html>