<?php 
    require 'Classes/PHPExcel/IOFactory.php'; //Agregamos la librería 
	require 'conexion.php'; //Agregamos la conexión
	
	//Variable con el nombre del archivo
	$nombreArchivo = 'Excel/Conexion.xlsx';
	// Cargo la hoja de cálculo
	$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
	
	
echo "Productos"."\n";
$objPHPExcel->setActiveSheetIndex(0);
$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	
echo '<table border=1><tr><td>id_producto</td><td>id_almacen</td><td>id_aroma</td>
	<td>id_temporada</td><td>id_tamaño</td><td>id_marca</td><td>Nombre</td><td>precio_unitario</td><td>codigo_color</td><td>Cantidad</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_producto = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_almacen = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$id_aroma = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$id_temporada = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$id_tamano = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$id_marca = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		$Nombre = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		$precio_unitario = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
		$codigo_color = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
		$Cantidad = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'. $id_producto.'</td>';
		echo '<td>'. $id_almacen.'</td>';
		echo '<td>'. $id_aroma.'</td>';
		echo '<td>'. $id_temporada.'</td>';
		echo '<td>'. $id_tamano.'</td>';
		echo '<td>'. $id_marca.'</td>';
		echo '<td>'. $Nombre.'</td>';
		echo '<td>'. $precio_unitario.'</td>';	
		echo '<td>'. $codigo_color.'</td>';
		echo '<td>'. $Cantidad.'</td>';

		echo '</tr>';
		



		$sql = "INSERT INTO productos(id_almacen, id_aroma, id_temporada, id_tamano, id_marca, Nombre, precio_unitario, codigo_color, Cantidad) VALUES (".$id_almacen.",".$id_aroma.","
		.$id_temporada.",".$id_tamano.", ".$id_marca.",'".$Nombre."',".$precio_unitario.",".$codigo_color.",".$Cantidad.")";

		 
		$result = $mysqli->query($sql);
		echo mysqli_error($mysqli);	
}
echo '</table>';

echo ""."\n";
echo ""."\n";
echo "Clientes"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(21)->getHighestRow();
	
	echo '<table border=1><tr><td>id_Cliente</td><td>nombre</td><td>apellido_paterno</td>
	<td>apellido_materno</td><td>direccion</td><td>correo</td><td>telefono</td><td>cp</td><td>sexo</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_Cliente = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$apellido_paterno = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$apellido_materno = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$direccion = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$correo = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		$telefono = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		$cp = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
		$sexo = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_Cliente.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '<td>'. $apellido_paterno.'</td>';
		echo '<td>'. $apellido_materno.'</td>';
		echo '<td>'. $direccion.'</td>';
		echo '<td>'. $correo.'</td>';
		echo '<td>'. $telefono.'</td>';
		echo '<td>'. $cp.'</td>';	
		echo '<td>'. $sexo.'</td>';

		echo '</tr>';
		
		$sql = " INTO cliente (nombre, apellido_paterno,apellido_materno,direccion,correo) 
		VALUES('".$nombre."','".$apellido_paterno."','".$apellido_materno."','".$direccion."','".$correo."')";
		$result = $mysqli->query($sql);
	    echo mysqli_error($mysqli);
}
echo '</table>';


echo "Aromas"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(1)->getHighestRow();
	
	echo '<table border=1><tr><td>id_aroma</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_aroma = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_aroma.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO aromas (nombre) VALUES('".$nombre."')";
		$result = $mysqli->query($sql);
	    echo mysqli_error($mysqli);
}
echo '</table>';

echo "Turnos"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(2)->getHighestRow();
	
	echo '<table border=1><tr><td>id_turno</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_turno = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_turno.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
	
		$sql = "INSERT INTO turnos (Nombre) VALUES('".$nombre."')";
		 $result = $mysqli->query($sql);
		 echo mysqli_error($mysqli);	
	
}
echo '</table>';

echo "Marcas"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(3)->getHighestRow();
	
	echo '<table border=1><tr><td>id_marca</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_marca = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_marca.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO marcas (nombre) VALUES('".$nombre."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';


echo "Compras"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(4)->getHighestRow();
	
	echo '<table border=1><tr><td>id_compras</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_compras = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_compras.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO compras (nombre) VALUES('".$nombre."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Servicios"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(5)->getHighestRow();
	
	echo '<table border=1><tr><td>id_marca</td><td>nombre</td><td>descripcion</td><td>precio</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_servicios = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$descripcion = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$precio = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_servicios.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '<td>'. $descripcion.'</td>';
		echo '<td>'. $precio.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO servicios (nombre) VALUES('".$nombre."','".$descripcion."',
		".$precio.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';


echo "Especialidad"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(6)->getHighestRow();
	
	echo '<table border=1><tr><td>id_especialidad</td><td>tipo</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_especialidad = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$tipo = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_especialidad.'</td>';
		echo '<td>'. $tipo.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO especialidad (tipo) VALUES('".$tipo."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "EmpleadosMateriales"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(7)->getHighestRow();
	
	echo '<table border=1><tr><td>id_material</td><td>id_empleado</td><td>cantidad</td><td>fecha</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_material = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_empleado = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$cantidad = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$fecha = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();

		echo '<tr>';
		echo '<td>'.$id_material.'</td>';
		echo '<td>'. $id_empleado.'</td>';
		echo '<td>'. $cantidad.'</td>';
		echo '<td>'. $fecha.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO empleadosmateriales (id_material,id_empleado,cantidad,fecha) 
		VALUES(".$id_material.",".$id_empleado.",".$cantidad.",".$fecha.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Temporadas"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(8)->getHighestRow();
	
	echo '<table border=1><tr><td>id_temporada</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_temporada = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_temporada.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO temporada (nombre) VALUES('".$nombre."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Tamaños"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(9)->getHighestRow();
	
	echo '<table border=1><tr><td>id_tamano</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_tamano = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_tamano.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO tamanos (nombre) VALUES('".$nombre."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';


echo "Ventas"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(10)->getHighestRow();
	
	echo '<table border=1><tr><td>id_ventas</td><td>id_producto</td><td>id_cliente</td><td>id_empleado</td>
	<td>cantidad</td><td>fecha</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_ventas = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_producto = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$id_cliente = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$id_empleado = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$cantidad = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$fecha = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_ventas.'</td>';
		echo '<td>'.$id_producto.'</td>';
		echo '<td>'.$id_cliente.'</td>';
		echo '<td>'.$id_empleado.'</td>';
		echo '<td>'.$cantidad.'</td>';
		echo '<td>'. $fecha.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO ventas (id_ventas,id_producto,id_cliente,id_empleado,cantidad,fecha) 
		VALUES(".$id_empleado.",".$id_ventas.",".$id_producto.",".$id_cliente.",".$id_empleado.",
		".$cantidad.",".$fecha.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Devoluciones"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(11)->getHighestRow();
	
	echo '<table border=1><tr><td>id_devoluciones</td><td>id_producto</td><td>id_empleado</td>
	<td>fecha</td><td>cantidad</td><td>descripcion</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_devoluciones = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_producto = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	    $id_empleado = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$fecha = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$cantidad = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$descripcion = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();

		echo '<tr>';
		echo '<td>'.$id_devoluciones.'</td>';
		echo '<td>'.$id_producto.'</td>';
		echo '<td>'.$id_empleado.'</td>';
		echo '<td>'.$fecha.'</td>';
		echo '<td>'.$cantidad.'</td>';
		echo '<td>'. $descripcion.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO devoluciones (id_producto,id_empleado,fecha,cantidad,descripcion)
		VALUES(".$id_producto.",".$id_empleado.",".$fecha.",".$cantidad.",'".$descripcion."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Almacen"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(12)->getHighestRow();
	
	echo '<table border=1><tr><td>id_almacen</td>id_producto<td>descripcion</td><td>stock_min</td>
	<td>stock_max</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_almacen = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_producto = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$descripcion = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$stock_min = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$stock_max = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_almacen.'</td>';
		echo '<td>'.$id_producto.'</td>';
		echo '<td>'.$descripcion.'</td>';
		echo '<td>'.$stock_min.'</td>';
		echo '<td>'.$stock_max.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO almacen (id_producto,descripcion,stock_min,stock_max,nombre)
		 VALUES(".$id_producto.",'".$descripcion."',".$stock_min."".$stock_max.",
		 '".$nombre."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "CodigoColor"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(13)->getHighestRow();
	
	echo '<table border=1><tr><td>id_color</td><td>nombre</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_color = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_color.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO marcas (nombre) VALUES('".$nombre."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Materiales"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(14)->getHighestRow();
	
	echo '<table border=1><tr><td>id_material</td><td>descripcion</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_material = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$descripcion = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		echo '<tr>';
		echo '<td>'.$id_turno.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO materiales (descripcion) VALUES('".$descripcion."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Alta Inventario"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(15)->getHighestRow();
	
	echo '<table border=1><tr><td>id_producto</td><td>id_provedor</td><td>fecha</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_producto = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_provedor = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$fecha = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_producto.'</td>';
		echo '<td>'. $id_provedor.'</td>';
		echo '<td>'. $fecha.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO altainventario (id_producto,id_provedor,fecha) 
		VALUES(".$id_producto.",".$id_provedor.",".$fecha.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Abonos"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(16)->getHighestRow();
	
	echo '<table border=1><tr><td>id_abono</td><td>id_compras</td><td>monto</td>
	<td>fecha</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_abono = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_compras = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$monto = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$fecha = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_abono.'</td>';
		echo '<td>'.$id_compras.'</td>';
		echo '<td>'.$monto.'</td>';
		echo '<td>'. $fecha.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO abonos (id_compras,monto,fecha) 
		VALUES(".$id_compras.",".$monto.",".$fecha.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';
echo "Producto Servicios"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(17)->getHighestRow();
	
	echo '<table border=1><tr><td>id_servicio</td><td>id_producto</td><td>id_empleado</td>
	<td>status</td><td>fecha_entrega</td><td>cantidad</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_servicio = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_producto = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_empleado = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$status = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$fecha_entrega = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$cantidad = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_servicio.'</td>';
		echo '<td>'.$id_producto.'</td>';
		echo '<td>'.$id_empleado.'</td>';
		echo '<td>'.$status.'</td>';
		echo '<td>'. $fecha_entrega.'</td>';
		echo '<td>'. $cantidad.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO productosservicio (id_servicio,id_producto,id_empleado,status,fecha_entrega,cantidad) 
		VALUES(".$id_servicio.",".$id_producto.",".$id_empleado."'".$status."',".$fecha_entrega.",
		".$cantidad.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Pedido Proveedor"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(18)->getHighestRow();
	
	echo '<table border=1><tr><td>id_pedido</td><td>id_producto</td><td>id_provedor</td>
	<td>fecha</td><td>monto_total</td><td>plazo</td><td>cantidad</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_pedido = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_producto = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$id_provedor = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$fecha = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$monto_total = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$plazo = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		$cantidad = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_pedido.'</td>';
		echo '<td>'.$id_producto.'</td>';
		echo '<td>'.$id_provedor.'</td>';
		echo '<td>'.$fecha.'</td>';
		echo '<td>'.$monto_total.'</td>';
		echo '<td>'.$plazo.'</td>';
		echo '<td>'. $cantidad.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO pedidoprovedor(id_pedido,id_producto,id_provedor,fecha,plazo,monto_total,nombre)
		 VALUES(".$id_pedido.",".$id_producto.",".$id_provedor.",".$fecha.",".$monto_total.",'".$plazo."',
		 ".$cantidad.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Empleados"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(19)->getHighestRow();
	
	echo '<table border=1><tr><td>id_empleado</td><td>id_turno</td><td>id_especialidad</td>
	<td>id_servicios</td><td>nombre</td><td>apellido_paterno</td><td>apellido_materno</td>
	<td>fecha_inicio</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_empleado = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$id_turno = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$id_especialidad = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$id_servicios = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$apellido_paterno = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		$apellido_materno = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		$fecha_inicio = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
		
		
		echo '<tr>';
		echo '<td>'.$id_empleado.'</td>';
		echo '<td>'.$id_turno.'</td>';
		echo '<td>'.$id_especialidad.'</td>';
		echo '<td>'.$id_servicios.'</td>';
		echo '<td>'.$nombre.'</td>';
		echo '<td>'.$apellido_paterno.'</td>';
		echo '<td>'.$apellido_materno.'</td>';
		echo '<td>'. $fecha_inicio.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO empleados (id_turno,id_especialidad,id_servicios,nombre,apellido_paterno,apellido_materno,fecha_inicio) VALUES(".$id_turno.",".$id_especialidad.",".$id_servicios.",'".$nombre."',
		    '".$apellido_paterno."','".$apellido_materno."',".$fecha_inicio.")";
		$result = $mysqli->query($sql);
	
}
echo '</table>';

echo "Proveedores"."\n";
	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(20)->getHighestRow();
	
	echo '<table border=1><tr><td>id_provedores</td><td>nombre</td><td>telefono</td><td>direccion</td>
	<td>ciudad</td><td>status</td></tr>';
	
	for ($i = 2; $i <= $numRows; $i++) {
		
		$id_provedores = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$telefono = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$direccion = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$ciudad = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$status = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		
		echo '<tr>';
		echo '<td>'.$id_provedores.'</td>';
		echo '<td>'. $nombre.'</td>';
		echo '<td>'. $telefono.'</td>';
		echo '<td>'. $direccion.'</td>';
		echo '<td>'. $ciudad.'</td>';
		echo '<td>'. $status.'</td>';
		echo '</tr>';
		
		$sql = "INSERT INTO provedores (nombre,telefono,direccion,ciudad,status) 
		VALUES('".$nombre."',".$telefono.",'".$direccion."','".$ciudad."','".$status."')";
		$result = $mysqli->query($sql);
	
}
echo '</table>';
 ?>