<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Excel extends CI_Controller
{

    public function SPE()
    {
        $nom1 = $_POST['valor1'];
        $nom2 = $_POST['valor2'];
        $nom3 = $_POST['valor3'];

        $datos = $this->M_Excel->SPE($nom1, $nom2, $nom3);
        echo json_encode($datos);
    }

    public function DeleteMarca()
    {
        $result         = $this->M_Excel->DeleteMarca();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }


      public function DeleteDevolucion()
    {
        $result         = $this->M_Excel->DeleteDevolucion();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function serviciosxempleado($id)
    {
        $datos = $this->M_Excel->serviciosxempleado($id);
        echo json_encode($datos);
    }

    public function LDExcel()
    {
        $datosA['anos']       = $this->M_Mysql->GetAñosSQL();
        $datos['mes']         = $this->M_Excel->GetmesesSQL();
        $datos2['anos']       = $this->M_Excel->GetanosSQL();
        $datosE['empleados']  = $this->M_Excel->getEmpleados();
        $datosT['temporadas'] = $this->M_Posgres->GetTemporadasSQL();
        $this->load->view('Excel/LDExcel', $datosE + $datosT + $datosA + $datos);
    }
    public function CDExcel()
    {
        $this->load->view('Excel/CDExcel');
    }
    public function mostrarAlmacen()
    {
        $result = $this->M_Excel->mostrarAlmacen();
        echo json_encode($result);
    }

    public function EditarAlmacen()
    {
        $resultado = $this->M_Excel->EditarAlmacen();
        echo json_encode($resultado);
    }

    public function UpdateAlmacen()
    {

        $id_almacen   = $_POST['id_almacen'];
        $descripcion  = $_POST['descripcion'];
        $stock_min    = $_POST['stock_min'];
        $stock_max    = $_POST['stock_max'];
        $nombre       = $_POST['nombre'];
        $id_productos = $_POST['id_productos'];
        $result       = $this->M_Excel->UpdateAlmacenSQL($id_almacen, $id_productos, $stock_min, $stock_max, $nombre);

        $result = $this->M_Excel->UpdateAlmacen($id_almacen, $id_productos, $descripcion, $stock_min, $stock_max, $nombre);
        echo json_encode($result);
    }

    public function DeleteAlmacen()
    {
        $result         = $this->M_Excel->DeleteAlmacen();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function insertAlmacenSQL()
    {
        $nom1 = $_POST['valor1'];
        $nom2 = $_POST['valor2'];
        $nom3 = $_POST['valor3'];
        $nom4 = $_POST['valor4'];
        $nom5 = $_POST['valor5'];
        $nom6 = $_POST['valor6'];

        $aresult = $this->M_Excel->insertAlmacenSQL($nom1, $nom2, $nom3, $nom4, $nom5, $nom6);
    }

    public function insertTemporadaSQL()
    {
        $nom1 = $_POST['valor1'];
        $nom2 = $_POST['valor2'];

        $aresult = $this->M_Excel->insertTemporadaSQL($nom1, $nom2);
    }

    public function insertMarcaSQL()
    {
        $nom1 = $_POST['valor1'];
        $nom2 = $_POST['valor2'];

        $aresult = $this->M_Excel->insertMarcaSQL($nom1, $nom2);
    }

    public function insertDevolucionSQL()
    {
        $nom1    = $_POST['valor1'];
        $nom2    = $_POST['valor2'];
        $nom3    = $_POST['valor3'];
        $nom4    = date($_POST['valor4']);
        $nom5    = $_POST['valor5'];
        $nom6    = $_POST['valor6'];
        $aresult = $this->M_Excel->insertDevolucionSQL($nom1, $nom2, $nom3, $nom5, $nom6);
    }

    public function mostrarTemporada()
    {
        $result = $this->M_Excel->mostrarTemporada();
        echo json_encode($result);
    }

    public function EditarTemporada()
    {
        $resultado = $this->M_Excel->EditarTemporada();
        print_r($resultado);
    }

    public function UpdateTemporada()
    {
        $result = $this->M_Excel->UpdateTemporada();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function ActualizarTemporada()
    {
        $result         = $this->M_Excel->ActualizarTemporada();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function mostrarMarca()
    {
        $result = $this->M_Excel->mostrarMarca();
        echo json_encode($result);
    }

    public function EditarMarca()
    {
        $resultado = $this->M_Excel->EditarMarca();
        echo json_encode($resultado);

    }

    public function UpdateMarca()
    {
        $result = $this->M_Excel->UpdateMarca();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function ActualizarMarca()
    {
        $result         = $this->M_Excel->ActualizarMarca();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function mostrarDevolucion()
    {
        $result = $this->M_Excel->mostrarDevolucion();
        echo json_encode($result);
    }

    public function EditarDevolucion()
    {
        $resultado = $this->M_Excel->EditarDevolucion();
        echo json_encode($resultado);
    }

    public function UpdateDevolucion()
    {
        $result = $this->M_Excel->UpdateDevolucion();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function ActualizarDevolucion()
    {
        $result         = $this->M_Excel->ActualizarDevolucion();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    // function ActualizarAlmacen(){
    //     $result = $this->M_Excel->ActualizarAlmacen();
    //     $msg['success'] = false;
    //     $msg['type'] = 'update';
    //     if($result){
    //         $msg['success'] = true;
    //     }
    //     echo json_encode($msg);
    // }

    // public function Principal(){
    //     $this->load->view('Excel/excel');
    // }

    // function mostrarMarca(){
    //     $result = $this->M_Excel->mostrarMarca();
    //     echo json_encode($result);
    // }

    // function filaMarca(){
    //     $result = $this->M_Excel->filaMarca();
    //     echo json_encode($result);
    // }

    // function EditarMarca(){
    //     $result = $this->M_Excel->EditarMarca();
    //     echo json_encode($result);

    // }

    // function ActualizarMarca(){
    //     $result = $this->M_Excel->ActualizarMarca();
    //     $msg['success'] = false;
    //     $msg['type'] = 'update';
    //     if($result){
    //         $msg['success'] = true;
    //     }
    //     echo json_encode($msg);
    // }

    // function mostrarDevolucion(){
    //     $result = $this->M_Excel->mostrarDevolucion();
    //     echo json_encode($result);
    // }

    // function filaDevolucion(){
    // $result = $this->M_Excel->filaDevolucion();
    //     echo json_encode($result);
    // }

    // function EditarDevolucion(){
    //     $result = $this->M_Excel->EditarDevolucion();
    //     echo json_encode($result);

    // }

    // function ActualizarDevolucion(){
    //     $result = $this->M_Excel->ActualizarDevolucion();
    //     $msg['success'] = false;
    //     $msg['type'] = 'update';
    //     if($result){
    //         $msg['success'] = true;
    //     }
    //     echo json_encode($msg);
    // }

    // public function mostrarTemporada(){
    //     $result = $this->M_Excel->mostrarTemporada();
    //     echo json_encode($result);
    // }

    // function filaTemporada(){
    //     $result = $this->M_Excel->filaTemporada();
    //     echo json_encode($result);
    // }

    // function EditarTemporada(){
    //     $result = $this->M_Excel->EditarTemporada();
    //     echo json_encode($result);

    // }

    // function ActualizarTemporada(){
    //     $result = $this->M_Excel->ActualizarTemporada();
    //     $msg['success'] = false;
    //     $msg['type'] = 'update';
    //     if($result){
    //         $msg['success'] = true;
    //     }
    //     echo json_encode($msg);
    // }

    public function tablasexcel()
    {
        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $almacen = $pdo_conn->prepare("DELETE FROM almacen");
        $almacen->execute();

        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $marcas = $pdo_conn->prepare("DELETE FROM marcas");
        $marcas->execute();

        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $temporada = $pdo_conn->prepare("DELETE FROM temporada");
        $temporada->execute();

        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $devoluciones = $pdo_conn->prepare("DELETE FROM devoluciones");
        $devoluciones->execute();

        require 'Classes/PHPExcel/IOFactory.php'; //Agregamos la librería
        require 'conexion.php'; //Agregamos la conexión

        $nombreArchivo = 'Excel/ejemplo.xlsx';
        // Cargo la hoja de cálculo
        $objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        echo "Productos" . "\n";
        $objPHPExcel->setActiveSheetIndex(0);
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        for ($i = 2; $i <= $numRows; $i++) {

            $id_productos    = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_almacen      = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $id_aroma        = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $id_temporada    = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $id_tamano       = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $id_marca        = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
            $Nombre          = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
            $precio_unitario = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
            $codigo_color    = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
            $Cantidad        = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();

            $sql = "INSERT INTO productos(id_productos, id_almacen, id_aroma,id_temporada,id_tamano,id_marca,Nombre,precio_unitario,codigo_color,Cantidad)
        VALUES ('$id_productos','$id_almacen','$id_aroma','$id_temporada','$id_tamano',
        '$id_marca','$Nombre','$precio_unitario','$codigo_color','$Cantidad')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);
        }

        echo "Aromas" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(1)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_aroma = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO aromas (id_aroma,nombre) VALUES('$id_aroma','$nombre')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);
        }

        echo "Turnos" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(2)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_turno = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO turnos(id_turno,nombre) VALUES('$id_turno','$nombre')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);
        }

        echo "Marcas" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(3)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_marca = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $Nombre   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO marcas(id_marca,nombre) VALUES('$id_marca','$Nombre')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);
        }

        echo "Compras" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(4)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_compra   = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_provedor = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $Monto       = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $Fecha       = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

            $sql = "INSERT INTO compras(id_compra,id_provedor,monto,fecha)
        VALUES('$id_compra','$id_provedor','$Monto','$Fecha')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);
        }

        echo "Servicios" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(5)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_servicio = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $Nombre      = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $Descripcion = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $Precio      = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

            $sql = "INSERT INTO servicios(id_servicio,Nombre,Descripcion,Precio)
        VALUES('$id_servicio','$Nombre','$Descripcion','$Precio')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);
        }

        echo "Especialidad" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(6)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_especialidad = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $Tipo            = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO especialidad(id_especialidad,Tipo)
        VALUES('$id_especialidad','$Tipo')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "EmpleadosMateriales" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(7)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_materiales = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_empleado   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $Cantidad      = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $Fecha         = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

            $sql = "INSERT INTO empleadosmateriales(id_materiales,id_empleado,cantidad,fecha)
        VALUES('$id_materiales','$id_empleado','$Cantidad','$Fecha')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Temporada" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(8)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_temporada = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre       = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO temporada(id_temporada,nombre)
        VALUES('$id_temporada','$nombre')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Tamanos" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(9)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_tamano = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $tamano    = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO tamanos(id_tamano,tamano)
        VALUES('$id_tamano','$tamano')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Ventas" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(10)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_ventas   = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_producto = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $id_cliente  = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $id_empleado = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $cantidad    = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $fecha       = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

            $sql = "INSERT INTO ventas(id_ventas,id_producto,id_cliente,id_empleado,cantidad,fecha)
        VALUES('$id_ventas','$id_producto','$id_cliente','$id_empleado',
        '$cantidad','$fecha')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Devoluciones" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(11)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_devoluciones = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_productos    = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $id_empleado     = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $fecha           = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $cantidad        = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $descripcion     = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

            $sql = "INSERT INTO devoluciones(id_devoluciones,id_productos,id_empleado,fecha,cantidad,descripcion)
        VALUES('$id_devoluciones','$id_productos','$id_empleado','$fecha',
        '$cantidad','$descripcion')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Almacen" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(12)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_almacen   = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_productos = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $descripcion  = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $stock_min    = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $stock_max    = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $nombre       = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

            $sql = "INSERT INTO almacen(id_almacen,id_productos,descripcion,stock_min,stock_max,nombre)
        VALUES('$id_almacen','$id_productos','$descripcion','$stock_min',
        '$stock_max','$nombre')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Codigo Color" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(13)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_color = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO codigo_color(id_color,nombre)
        VALUES('$id_color','$nombre')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Materiales" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(14)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_materiales = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $descripcion   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

            $sql = "INSERT INTO materiales(id_materiales,descripcion)
        VALUES('$id_materiales','$descripcion')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Alta Inventario" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(15)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_producto = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_provedor = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $fecha       = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();

            $sql = "INSERT INTO altainventario(id_producto,id_provedor,fecha)
        VALUES('$id_producto','$id_provedor','$fecha')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Abonos" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(16)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_abono  = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_compra = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $monto     = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $fecha     = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

            $sql = "INSERT INTO abonos(id_abono,id_compra,monto,fecha)
        VALUES('$id_abono','$id_compra','$monto','$fecha')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Producto Servicios" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(17)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_servicio  = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_productos = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $id_empleado  = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $status       = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $fecha        = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $cantidad     = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

            $sql = "INSERT INTO productoservicio(id_servicio,id_productos,id_empleado,status,fecha,cantidad)
        VALUES('$id_servicio','$id_productos','$id_empleado','$status',
        '$fecha','$cantidad')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Pedido Proveedor" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(18)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_pedido    = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_productos = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $id_provedor  = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $id_compras   = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $fecha        = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $monto        = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
            $plazo        = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
            $cantidad     = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();

            $sql = "INSERT INTO pedidoprovedor(id_pedido,id_productos,id_provedor,id_compras,fecha,monto,plazo,cantidad)
        VALUES('$id_pedido','$id_productos','$id_provedor','$id_compras',
        '$fecha','$monto','$plazo','$cantidad')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Empleados" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(19)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_empleado      = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $id_turno         = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $id_especialidad  = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $id_servicio      = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $nombre           = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $apellido_paterno = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
            $apellido_materno = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
            $fecha_inicio     = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();

            $sql = "INSERT INTO empleados(id_empleado,id_turno,id_especialidad,id_servicio,nombre,apellido_paterno,apellido_materno,fecha_inicio)
        VALUES('$id_empleado','$id_turno','$id_especialidad','$id_servicio',
        '$nombre','$apellido_paterno','$apellido_materno','$fecha_inicio')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Proveedores" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(20)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_provedor = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre      = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $telefono    = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $direccion   = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $ciudad      = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $status      = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

            $sql = "INSERT INTO provedores(id_provedor,nombre,telefono,direccion,ciudad,status)
        VALUES('$id_provedor','$nombre','$telefono','$direccion',
        '$ciudad','$status')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

        echo "Clientes" . "\n";
        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(21)->getHighestRow();
        for ($i = 2; $i <= $numRows; $i++) {

            $id_cliente       = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre           = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $direccion        = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $correo           = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
            $telefono         = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
            $apellido_paterno = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $apellido_materno = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $cp               = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
            $sexo             = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();

            $sql = "INSERT INTO cliente(id_cliente,nombre,apellido_paterno,apellido_materno,direccion,correo,telefono,cp,sexo)
        VALUES('$id_cliente','$nombre','$apellido_paterno','$apellido_materno',
        '$direccion','$correo','$telefono','$cp','$sexo')";

            $result = $mysqli->query($sql);
            echo mysqli_error($mysqli);

        }

    }

    public function tablasfaltantes()
    {

        $valores = $this->M_Excel->tablasfaltantes();

        $datos = $this->M_Excel->Materiales($valores);

        $valores = $this->M_Excel->getaromas();

        $datos   = $this->M_Excel->Aromas($valores);
        $valores = $this->M_Excel->getServicios();

        $datos = $this->M_Excel->Servicios($valores);

        $valores = $this->M_Excel->getEmpleadoXMaterial();

        $datos = $this->M_Excel->EmpleadoxMaterial($valores);

    }

}
