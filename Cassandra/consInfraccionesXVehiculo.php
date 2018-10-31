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
$fedesde = strtotime($_GET['fedesde']);
$fehasta = strtotime($_GET['fehasta']);
$placa = $_GET['placa'];
$statemen = new Cassandra\SimpleStatement("SELECT * FROM infracciones_x_vehiculoyfecha WHERE placa= '".$placa."' AND fecha >= ".$fedesde." AND fecha<= ".$fehasta." ;");//AND fecha>= ".$fedesde." AND fecha<= ".$fehasta."
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
                        <th>FECHA</th>	
                        <th>HORA</th>
                        <th>LUGAR</th>					
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($result as $row) {                           
                            $time = date($row['fecha']);
                            $fecha = date('m/d/Y',$time);
                            $hora = date('h:i:s',$time);
                            ?>
                        <tr>
                            <td><?php echo $fecha?></td>
                            <td><?php echo $hora;?></td>
                            <td><?php echo $row['nombre'];?></td>
                        </tr>
                    <?php } ?>
			  </tbody>
			</table>
		</div>
    

</body>
</html>