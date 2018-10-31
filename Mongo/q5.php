<?php if (!extension_loaded("MongoDB")) die("Error: la extensi�n de Mongo es requerida."); ?>

<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$placa = htmlspecialchars($_GET["placa"]);
$query = new MongoDB\Driver\Command(['aggregate' => 'fotoMultas',
'pipeline' => [
    [
        '$match' => [
            'placa' => $placa
        ]
    ],
    [
        '$group' => ['_id'=>'$lugar','velocidad'=>['$max'=>'$velocidad']]

    ]

    ],
    'cursor' => new stdClass,
]);
//Se hace la consulta especificando la base de datos y la coleccion
$cursor = $manager->executeCommand('fotodeteccionesdb', $query);
//print_r($cursor->toArray());
//$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_PRIMARY);
//$cursor = $manager->executeQuery('fotodeteccionesdb.fotoMultas', $query, $readPreference);

echo '
<html>
<head>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<title>Document</title>
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
                        <th>Lugar</th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>	
						<th>Velocidad</th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>				
					</tr>
				</thead>
				<tbody>';
foreach ($cursor as $row) {
    
	//var_dump( $row  );	
    echo '<tr>';
    echo '<td>' . $row ->_id. "</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>";
	echo '<td>' . $row->velocidad. "</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>";
	echo "</tr>"; 
}
echo '</tbody>
</table>
</div>
</body>
</html>';