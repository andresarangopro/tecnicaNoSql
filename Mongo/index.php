<?PHP
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Home Practica - MongoDB</title>
<style type="text/css">
body {
	background: #ededed;
	width: 900px;
	margin: 30px auto;
	color: #999;
}
p {
	margin: 0 0 2em;
}
h1 {
	margin: 0;
}
a {
	color: #339;
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
div {
	padding: 20px 0;
	border-bottom: solid 1px #ccc;
}

/* button 
---------------------------------------------- */
.button {
	display: inline-block;
	zoom: 1; /* zoom and *display = ie7 hack for display:inline-block */
	*display: inline;
	vertical-align: baseline;
	margin: 0 2px;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	font: 14px/100% Arial, Helvetica, sans-serif;
	padding: .5em 2em .55em;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: .5em; 
	-moz-border-radius: .5em;
	border-radius: .5em;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	box-shadow: 0 1px 2px rgba(0,0,0,.2);
}
.button:hover {
	text-decoration: none;
}
.button:active {
	position: relative;
	top: 1px;
}

.bigrounded {
	-webkit-border-radius: 2em;
	-moz-border-radius: 2em;
	border-radius: 2em;
}
.medium {
	font-size: 12px;
	padding: .4em 1.5em .42em;
}
.small {
	font-size: 11px;
	padding: .2em 1em .275em;
}


/* mi_color */
.mi_color {
	color: #e9e9e9;
	border: solid 1px #555;
	background: #6e6e6e;
	background: -webkit-gradient(linear, left top, left bottom, from(#888), to(#575757));
	background: -moz-linear-gradient(top,  #888,  #575757);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#888888', endColorstr='#575757');
}
.mi_color:hover {
	background: #616161;
	background: -webkit-gradient(linear, left top, left bottom, from(#757575), to(#4b4b4b));
	background: -moz-linear-gradient(top,  #757575,  #4b4b4b);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#757575', endColorstr='#4b4b4b');
}
.mi_color:active {
	color: #afafaf;
	background: -webkit-gradient(linear, left top, left bottom, from(#575757), to(#888));
	background: -moz-linear-gradient(top,  #575757,  #888);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#575757', endColorstr='#888888');
}

</style>
</head>

<body>
<H1 class="mi_color">MongoDB</H1>
<!-- Formularios para la vista del usuario -->
<div>
<table>
<tr><th colspan="3"><H1>Usuario</H1></th></tr>
<tr>
	<td><H3>Consulta Infracciones</H3></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><H3>Estadistica Mensual</H3></td>
</tr>
<tr>
	<td>
		<!-- Consulta Infracciones - Recuerde cambiar la acción para llamar su programa -->
		<form name="q1" action="q1.php">
		<table>
		  <tr><td>Placa:</td><td><input type="text" name="placa" value="AAA111"  maxlength="6"></td></tr>
		  <tr><td>Fecha desde:</td><td><input type="text" name="fedesde" value="2018/10/01"  maxlength="10"></td></tr>
		  <tr><td>Fecha hasta:</td><td><input type="text" name="fehasta" value="2018/11/01"  maxlength="10"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Consulta Infracciones</button></td></tr>
		</table>  
		</form>
	</td>
	<td></td>
	<td>
		<!-- Estadistica Mensual - Recuerde cambiar la acción para llamar su programa -->
		<form name="q2" action="q2.php">
		<table>
		  <tr><td>Año:</td><td><input type="text" name="anio" value="2018"  maxlength="4"></td></tr>
		  <tr><td>Mes:</td><td><input type="text" name="mes" value="10"  maxlength="2"></td></tr>
		  <tr><td>Placa:</td><td><input type="text" name="placa" value="AAA111"  maxlength="6"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Estadistica Mensual</button></td></tr>
		</table>  
		</form>
	</td>
</tr>
</table>
</div>
</br>
<!-- Formularios para la vista del transito -->
<div>
<table>
<tr><th colspan="3"><H1>Agente del transito</H1></th></tr>
<tr>
	<td><H3>Consulta velocidades por sitio</H3></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><H3>Infracciones Velocidad</H3></td>
</tr>
<tr>
	<td>
		<!-- Consulta velocidades por sitio - Recuerde cambiar la acción para llamar su programa -->
		<form name="q3" action="q3.php">
		<table>
		  <tr><td>Fecha:</td><td><input type="text" name="fecha" value="2018/10/01"  maxlength="10"></td></tr>
		  <tr><td>Lugar:</td><td><input type="text" name="lugar" value="1"  maxlength="1"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Consulta velocidades por sitio</button></td></tr>
		</table>  
		</form>
	</td>
	<td></td>
	<td>
		<!-- Infracciones Velocidad - Recuerde cambiar la acción para llamar su programa -->
		<form name="q4" action="q4.php">
		<table>
		  <tr><td>Fecha:</td><td><input type="text" name="fecha" value="2018/10/01"  maxlength="10"></td></tr>
		  <tr><td colspan="2"><button class="button mi_color">Infracciones Velocidad</button></td></tr>
		</table>  
		</form>
	</td>
</tr>
</table>
</div>

</body>
</html>