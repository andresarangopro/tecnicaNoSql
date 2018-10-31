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
$fechaDada = strtotime($_GET['fecha']);
$endOfDay   = strtotime("tomorrow", $fechaDada);
$statemen = new Cassandra\SimpleStatement("SELECT fecha, nombre, placa FROM infracciones_x_fecha WHERE dummy=22 AND fecha <=".$endOfDay."  AND fecha >=".$fechaDada.";");
$result  = $session->execute($statemen);

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
                        <th>PLACA</th>	
                        <th>FECHA</th>                     
                        <th>NOMBRE</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($result as $row) { 
                         $time = date( $row['fecha']);
                         $fecha = date('m/d/Y',$time);                        
                        ?>
                        <tr>     
                            <td><?php echo $row['placa'];?></td>   
                            <td><?php echo $fecha;?></td>                                             
                            <td><?php echo $row['nombre'];?></td>
                        </tr>
                    <?php } ?>
			  </tbody>
			</table>
		</div>
    

</body>
</html>