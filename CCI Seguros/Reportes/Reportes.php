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
				<li><a href="Reportes.html" class="here">Reportes</a></li>
				<li><a href="#" class="Buttom">P&oacute;lizas</a></li>
				<li><a href="#" class="Buttom">Cotizaci&oacute;n</a></li>
				<li><a href="#" class="Buttom">Facturaci&oacute;n</a></li>
			</ul>
		</nav>

	</header>

<table border="0" cellspacing="0">  
	<tr>
		<td colspan=6 align="center">
			<label class="titulos">RESULTADO CONSULTA DE POLIZAS</label>
		</td>
	</tr>
	
	<tr> <td><br/></td> </tr>

	<tr>
		<td><label class="titulos">No. poliza</label></td>
		<td><label class="titulos">Nombre</label></td>
		<td><label class="titulos">Tipo de poliza</label></td>
		<td><label class="titulos">Fecha Inicio</label></td>
		<td><label class="titulos">Fecha Fin</label></td>
		<td><label class="titulos">Actualizar</label></td>
		<td><label class="titulos">Eliminar</label></td>
		
	</tr>
	<br>
	<?php 
	$conexion = new mysqli("localhost","root","","cci");
	$consulta = "Select v.num_poliza, u.nombres, u.apellidos, t.descripcion_poliza, v.fechainicia, v.fechafin from (venta_poliza v join Usuarios u ON v.id_usuario=u.id_usuario) join tipopoliza t ON t.id_poliza=v.tipopoliza_id_poliza where v.Id_usuario=".$documento;
	$res_cosulta =  $conexion->query($consulta);
	while($rows = $res_cosulta->fetch_assoc()){ ?>
		<tr>
			<form method="post" action="Acciones.php"> 
			<td><label><?php echo $rows['num_poliza']?></label></td>
			<td><label><?php echo $rows['nombres'] ?> <?php echo $rows['apellidos']?></label></td>
			<td><label><?php echo $rows['descripcion_poliza']?></label></td>
			<td><label><?php echo $rows['fechainicia']?></label></td>
			<td><label><?php echo $rows['fechafin']?></label></td>
			<input type="hidden" name="documento" value="<?php echo $documento ?>" >
			<input type="hidden" name="numero" value="<?php echo $rows['num_poliza']?>" >
			<td><input type="submit" name="Option" value="Modificar"/></td>
			<td><input  type="submit" name="Option" value="Eliminar"/></td>
			</form>
			
				
		</tr>

	<?php } ?>
	<form method="post" action="Acciones.php">
	<input type="hidden" name="documento" value="<?php echo $documento ?>" >
	<input type="hidden" name="numero" value="0" >
	<tr> <td colspan=6 align="center"><input type="submit" name="Option" value="Agregar"/></td></tr>
	</form>
	</table>
	<?php


	mysqli_close($conexion);
	?>


</body>
</html>