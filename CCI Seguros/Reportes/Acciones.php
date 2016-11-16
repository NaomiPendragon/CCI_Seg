
<!DOCTYPE html>
<html>
<head>
	<title>CCI Seguros</title>
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

<section>
<?php 
	
	$Documento = $_POST['documento'];
	$Poliza=$_POST["numero"];
	$Opcion=$_POST["Option"];

$conexion = new mysqli("localhost","root","","cci");

	if ($Opcion=='Modificar') {


		$consulta = "select Id_usuario, fechacompra, fechainicia, fechafin, alarma, primaneta, gastos, tipopoliza_id_poliza, estado_id_estado, empresa_id_emp_exp, ciudad_id_ciudad from venta_poliza where num_poliza=" .$Poliza;
		$res_cosulta = $conexion->query($consulta);
		$rows = $res_cosulta->fetch_assoc();  

		$Compra=$rows['fechacompra'];
		$Inicia=$rows['fechainicia'];
		$Fin=$rows['fechafin'];
		$Alarma=$rows['alarma'];
		$Prima=$rows['primaneta'];
		$Gastos=$rows['gastos'];
		$TipoPoliza=$rows['tipopoliza_id_poliza'];
		$Estado=$rows['estado_id_estado'];
		$Ciudad=$rows['ciudad_id_ciudad'];
		$Empresa=$rows['empresa_id_emp_exp'];

				$consulta = "SELECT id_usuario, nombres FROM usuarios;";
				$res_cosulta = $conexion->query($consulta);?>

				<form method="post" action="acciones.php"> 							
				<?php echo "\nModificando la póliza número: ", $Poliza; ?>
				<label for="id_usuario">Usuario:</label>


				<select name="id_usuario" id="id_usuario">
				<?php 

				while($rows = $res_cosulta->fetch_assoc()){
				if ($rows['id_usuario']==$Documento) {
				?> <option selected value="<?php echo $rows['id_usuario'] ?>"> <?php echo $rows['nombres'] ?> </option> <?php

					}else{ ?> <option value="<?php echo $rows['id_usuario'] ?>"> <?php echo $rows['nombres'] ?> </option> 
				<?php }} ?> </select>

			<label for="fechacompra">Fecha de Compra de la P&oacute;liza:</label>
			<input type="text" name="fechacompra" id="fechacompra" value=" <?php echo $Compra ?> "/>
			<label for="fechainicia">Fecha de inicio de la P&oacute;liza:</label>
			<input type="text" name="fechainicia" id="fechainicia" value=" <?php echo $Inicia ?> "/>
			<label for="fechafin">Fecha de finalizaci&oacute;n de la P&oacute;liza:</label>
			<input type="text" name="fechafin" id="fechafin" value=" <?php echo $Fin ?> "/>
			<label for="alarma">Alarma de la P&oacute;liza:</label>
			<input type="text" name="alarma" id="alarma" value=" <?php echo $Alarma ?> "/>
			<label for="primaneta">Prima Neta:</label>
			<input type="text" name="primaneta" id="primaneta" value=" <?php echo $Prima ?> "/>
			<label for="gastos">Gastos:</label>
			<input type="text" name="gastos" id="gastos" value=" <?php echo $Gastos ?> "/>

		<?php   $consulta = "SELECT id_poliza, descripcion_poliza FROM tipopoliza;";
				$res_cosulta = $conexion->query($consulta);
				?>
				
				
				<label for="id_poliza">Tipo de P&oacute;liza:</label>
				<select name="id_poliza" id="id_poliza">



				<?php while($rows = $res_cosulta->fetch_assoc()){
					if ($rows['id_poliza']==$TipoPoliza) {
				?> <option selected value="<?php echo $rows['id_poliza'] ?>"> <?php echo $rows['descripcion_poliza'] ?> </option> <?php
					}else{ ?> <option value="<?php echo $rows['id_poliza'] ?>"> <?php echo $rows['descripcion_poliza'] ?> </option> 
				<?php }} ?> </select> <?php

				$consulta = "SELECT id_estado, descripcion_estado FROM estado;";
				$res_cosulta = $conexion->query($consulta);?>
				
				<label for="id_estado">Estado de la P&oacute;liza:</label>
				<select name="id_estado" id="id_estado">

				<?php while($rows = $res_cosulta->fetch_assoc()){
					if ($rows['id_estado']==$Estado) {
				?> <option selected value="<?php echo $rows['id_estado'] ?>"> <?php echo $rows['descripcion_estado'] ?> </option> <?php
					}else{ ?> <option value="<?php echo $rows['id_estado'] ?>"> <?php echo $rows['descripcion_estado'] ?> </option> 
				<?php }} ?> </select> <?php

				$consulta = "SELECT id_emp_exp, nomempresa FROM empresa;";
				$res_cosulta = $conexion->query($consulta);?>
				
				<label for="id_emp_exp">Empresa expendedora:</label>
				<select name="id_emp_exp" id="id_emp_exp" >

				<?php while($rows = $res_cosulta->fetch_assoc()){
					if ($rows['id_emp_exp']==$Empresa) {
				?> <option selected value="<?php echo $rows['id_emp_exp'] ?>"> <?php echo $rows['nomempresa'] ?> </option> <?php
					}else{ ?> <option value="<?php echo $rows['id_emp_exp'] ?>"> <?php echo $rows['nomempresa'] ?> </option> 
				<?php }} ?> </select> <?php

				$consulta = "SELECT id_ciudad, ciudad FROM ciudad;";
				$res_cosulta = $conexion->query($consulta);?>
				
				<label for="id_ciudad">Ciudad:</label>
				<select name="id_ciudad" id="id_ciudad" value=" <?php echo $Ciudad ?>>

				<?php while($rows = $res_cosulta->fetch_assoc()){
					if ($rows['id_ciudad']==$Ciudad) {
				?> <option selected value="<?php echo $rows['id_ciudad'] ?>"> <?php echo $rows['ciudad'] ?> </option> <?php
					}else{ ?> <option value="<?php echo $rows['id_ciudad'] ?>"> <?php echo $rows['ciudad'] ?> </option> 
				<?php }} ?> </select>
			<input type="hidden" name="documento" value="<?php echo $Documento ?>" >
			<input type="hidden" name="numero" value=" <?php echo $Poliza ?> ">
			<input type="submit" name="Option" value="Actualizar">
			</form>

<?php

	}elseif ($Opcion=='Eliminar') {
		


		$consulta = "Delete from venta_poliza where num_poliza=".$Poliza ;
		$resultado = $conexion->query($consulta);

		?>
		<form method="post" action="Reportes.php"> 
		<?php echo "Se ha eliminado correctamente la póliza"; ?>
		<input type="hidden" name="documento" value="<?php echo $Documento ?>" >
		<input type="Submit" name="enviar" value="Continuar">
		</form> <?php

	}elseif ($Opcion=='Actualizar'){
	
		$TipoPoliza=$_POST['id_poliza'];
		$Compra=$_POST['fechacompra'];
		$Inicia=$_POST['fechainicia'];
		$Fin=$_POST['fechafin'];
		$Alarma=$_POST['alarma'];
		$Prima=$_POST['primaneta'];
		$Gastos=$_POST['gastos'];
		$Estado=$_POST['id_estado'];
		$Ciudad=$_POST['id_ciudad'];
		$Empresa=$_POST['id_emp_exp'];
		
		$consulta = "UPDATE venta_poliza set tipopoliza_id_poliza = '$TipoPoliza',  Id_usuario= '$Documento', fechacompra='$Compra', fechainicia='$Inicia', fechafin='$Fin', alarma='$Alarma', primaneta='$Prima', gastos='$Gastos', estado_id_estado='$Estado', empresa_id_emp_exp='$Empresa', ciudad_id_ciudad='$Ciudad' where num_poliza=" .$Poliza;
		$resultado = $conexion->query($consulta);

		?>
		<form method="post" action="Reportes.php"> 
		<?php echo "Se ha modificado correctamente la póliza"; ?>
		<input type="hidden" name="documento" value="<?php echo $Documento ?>" >
		<input type="Submit" name="enviar" value="Continuar">
		</form> <?php



		}elseif ($Opcion=='Agregar') {


		$consulta = "SELECT id_usuario, nombres FROM usuarios;";
				$res_cosulta = $conexion->query($consulta);?>
			
				<form method="post" action="Acciones.php">

				<label for="numero">Numero de poliza:</label>
				<input type="text" name="numero" id="numero" placeholder=" Numero de Poliza " />

				<label for="id_usuario">Usuario:</label>
				<select name="id_usuario" id="id_usuario">
				<?php while($rows = $res_cosulta->fetch_assoc()){
					if ($rows['id_usuario']==$Documento) {
				?> <option selected value="<?php echo $rows['id_usuario'] ?>"> <?php echo $rows['nombres'] ?> </option> <?php
					}else{ ?> <option value="<?php echo $rows['id_usuario'] ?>"> <?php echo $rows['nombres'] ?> </option> 
				<?php }}

			 ?> </select>

			<label for="fechacompra">Fecha de Compra de la P&oacute;liza:</label>
			<input type="text" name="fechacompra" id="fechacompra" placeholder=" AA/MM/DD " />
			<label for="fechainicia">Fecha de inicio de la P&oacute;liza:</label>
			<input type="text" name="fechainicia" id="fechainicia" placeholder=" AA/MM/DD " />
			<label for="fechafin">Fecha de finalizaci&oacute;n de la P&oacute;liza:</label>
			<input type="text" name="fechafin" id="fechafin" placeholder=" AA/MM/DD " />
			<label for="alarma">Alarma de la P&oacute;liza:</label>
			<input type="text" name="alarma" id="alarma" placeholder=" AA/MM/DD " />
			<label for="primaneta">Prima Neta:</label>
			<input type="text" name="primaneta" id="primaneta" placeholder=" Prima Neta " />
			<label for="gastos">Gastos:</label>
			<input type="text" name="gastos" id="gastos" placeholder=" Gastos " />

		<?php   $consulta = "SELECT id_poliza, descripcion_poliza FROM tipopoliza;";
				$res_cosulta = $conexion->query($consulta);?>
				
				<label for="id_poliza">Tipo de P&oacute;liza:</label>
				<select name="id_poliza" id="id_poliza">

				<?php while($rows = $res_cosulta->fetch_assoc()){ ?>
				<option value="<?php echo $rows['id_poliza'] ?>"><?php echo $rows['descripcion_poliza']?></option>

				<?php } ?> </select> <?php

				$consulta = "SELECT id_estado, descripcion_estado FROM estado;";
				$res_cosulta = $conexion->query($consulta);?>
				
				<label for="id_estado">Estado de la P&oacute;liza:</label>
				<select name="id_estado" id="id_estado">

				<?php while($rows = $res_cosulta->fetch_assoc()){ ?>
				<option value="<?php echo $rows['id_estado'] ?>"><?php echo $rows['descripcion_estado'] ?></option>

				<?php } ?> </select> <?php

				$consulta = "SELECT id_emp_exp, nomempresa FROM empresa;";
				$res_cosulta = $conexion->query($consulta);?>
				
				<label for="id_emp_exp">Empresa expendedora:</label>
				<select name="id_emp_exp" id="id_emp_exp">

				<?php while($rows = $res_cosulta->fetch_assoc()){ ?>
				<option value="<?php echo $rows['id_emp_exp'] ?>"><?php echo $rows['nomempresa'] ?></option>

				<?php } ?> </select> <?php

				$consulta = "SELECT id_ciudad, ciudad FROM ciudad;";
				$res_cosulta = $conexion->query($consulta);?>
				
				<label for="id_ciudad">Ciudad:</label>
				<select name="id_ciudad" id="id_ciudad">

				<?php while($rows = $res_cosulta->fetch_assoc()){ ?>
				<option value="<?php echo $rows['id_ciudad'] ?>"><?php echo $rows['ciudad'] ?></option>

				<?php } ?> </select>

			<input type="hidden" name="documento" value="<?php echo $Documento ?>" >
			<input type="submit" name="Option" value="Nuevo">


			</form>

			



<?php

		
		}elseif ($Opcion=='Nuevo') {
		
		$TipoPoliza=$_POST['id_poliza'];
		$Usuario=$_POST['id_usuario'];
		$Compra=$_POST['fechacompra'];
		$Inicia=$_POST['fechainicia'];
		$Fin=$_POST['fechafin'];
		$Alarma=$_POST['alarma'];
		$Prima=$_POST['primaneta'];
		$Gastos=$_POST['gastos'];
		$Estado=$_POST['id_estado'];
		$Ciudad=$_POST['id_ciudad'];
		$Empresa=$_POST['id_emp_exp'];					
			

		$consulta = "INSERT INTO venta_poliza set num_poliza = '$Poliza', tipopoliza_id_poliza = '$TipoPoliza',  Id_usuario= '$Usuario', fechacompra='$Compra', fechainicia='$Inicia', fechafin='$Fin', alarma='$Alarma', primaneta='$Prima', gastos='$Gastos', estado_id_estado='$Estado', empresa_id_emp_exp='$Empresa', ciudad_id_ciudad='$Ciudad'";
		$resultado = $conexion->query($consulta);


		?>
		<form method="post" action="Reportes.php"> 
		<?php echo "Se agregó correctamente la póliza"; ?>
		<input type="hidden" name="documento" value="<?php echo $Usuario ?>" >
		<input type="Submit" name="enviar" value="Continuar">
		</form> <?php

		



		}

	

?> 
</section>
</body>
</html>
