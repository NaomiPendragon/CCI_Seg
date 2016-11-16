<?php 
$documento = $_POST['documento'];
?>


<html>
<head>

	<title> CCI Seguros </title>
	<link rel="shortcut icon" type="image/x-icon" href="Resources/Logo.ico"> 
	<link rel="stylesheet" type="text/css" href="../Css/reportes.css">
</head>
<body>
	
	<header>
		<div ><img src="../Resources/seguros.jpg"/></div>

		<nav>
			<ul>
				<li><a href="#" class="Buttom">Salir</a></li>
				<li><a href="#" class="here">Reportes</a></li>
				<li><a href="#" class="Buttom">P&oacute;lizas</a></li>
				<li><a href="#" class="Buttom">Cotizaci&oacute;n</a></li>
				<li><a href="#" class="Buttom">Facturaci&oacute;n</a></li>
			</ul>
		</nav>

	</header>

	<?php 
	$conexion = new mysqli("localhost","root","BDatos*2016","cci");
	$consulta = "Select descripcion_poliza from tipopoliza";
	$res_cosulta =  $conexion->query($consulta); ?>

<form method="post" action="acciones.php"> 
<select name="Opcion">

	<?php while($rows = $res_cosulta->fetch_assoc()){ ?>
		<option><label><?php echo $rows['descripcion_poliza']?></label></option>
			</form>
				
		
	<?php }
	mysqli_close($conexion);
	?>

</table>
</body>
</html>