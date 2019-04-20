<?php
class Login extends CI_Model
{

    public function agregar()
    {

        $this->db->where('etl', 3);
        $query  = $this->db->get('usuarios');
        $numero = $query->num_rows();

        $datos['nombre']      = $this->input->post("usuario");
        $datos['apellido']    = $this->input->post("apellido");
        $datos['contraseña'] = $this->input->post("contraseña");
        $datos['Rol']         = $this->input->post("rol");
        if ($numero > 0) {
            $datos['etl'] = 3;
        } else {
            $datos['etl'] = 4;
        }

        $datos2['nombre']      = $this->input->post("usuario");
        $datos2['apellido']    = $this->input->post("apellido");
        $datos2['contraseña'] = $this->input->post("contraseña");
        $datos2['Rol']         = $this->input->post("rol");

        if ($this->input->post("rol") == 1) {

            if ($this->input->post("usuario") != null && $this->input->post("apellido") != null && $this->input->post("contraseña") != null) {
                $this->db->insert('usuarios', $datos);

                if ($this->db->affected_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {

            if ($this->input->post("usuario") != null && $this->input->post("apellido") != null && $this->input->post("contraseña") != null) {
                $this->db->insert('usuarios', $datos2);

                if ($this->db->affected_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

    }

    public function ingresar($username, $password)
    {

        $this->db->where('nombre', $username);
        $this->db->where('contraseña', $password);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }

    }

    public function status()
    {
        $id_usuario = $this->session->userdata('id_usuario');

        $valor = array('etl' => 1);

        $this->db->where('id_suaurio', $id_usuario);
        $this->db->update('usuarios', $valor);
    }

    public function check_status($id_usuario)
    {
        $this->db->where('id_suaurio', $id_usuario);
        $query = $this->db->get('usuarios');
        return $query->result_array()[0];

    }

    public function TablasPostgress()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $empleado = pg_exec($enlace, "DROP TABLE IF EXISTS Empleado2;")
        or die("No se pudo realizar la consulta");
        $productos = pg_exec($enlace, "DROP TABLE IF EXISTS productos2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS ct_colores2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS especialidadempleado2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS incidentes2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS productoXservicio2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS servicioXcliente2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS detalleservicio2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS turnos2;")
        or die("No se pudo realizar la consulta");

        //las creo de nuevo
        /*$creacioEmpleado = pg_exec($enlace,"CREATE table Empleado(
        IdEmpleado int primary key GENERATED ALWAYS AS IDENTITY,
        Nombre varchar(85),
        IdTurno int,
        IdEspecialidad int,
        PrimerApellido varchar (30),
        SegundoApellido varchar (30),
        Domicilio varchar(250),
        Correo varchar(50),
        Telefono varchar(15),
        CP varchar(5),
        Sexo varchar(10)
        )");
        $creacioProducto = pg_exec($enlace,"CREATE table Productos(
        IdProducto int primary key GENERATED ALWAYS AS IDENTITY,
        Nombre varchar(85),
        IdTemporada int,
        Tamaño varchar(25),
        Presentacion varchar(25),
        IdColor int,
        Cantidad varchar(25),
        Minimo int,
        Maximo int,
        FechaCaducidad date,
        CostoCompra money,
        IdMarca Int
        )");
        $query = pg_exec($enlace,"INSERT INTO Original_Estetica.Empleado (IdEmpleado, Nombre, IdTurno,IdEspecialidad,PrimerApellido, SegundoApellido, Domicilio,Correo,Telefono,CP,Sexo) SELECT idempleado,nombre,idturno,idespecialidad,primerapellido,segundoapellido,domicilio,correo,telefono,cp,sexo FROM Estetica.Empleado");*/
        $query = pg_exec($enlace, "CREATE TABLE Empleado2 AS SELECT * from empleado;");
        $query = pg_exec($enlace, "CREATE TABLE Productos2 AS SELECT * from Productos;");
        $query = pg_exec($enlace, "CREATE TABLE ct_colores2 AS SELECT * from ct_colores;");
        $query = pg_exec($enlace, "CREATE TABLE detalleservicio2 AS SELECT * from detalleservicio;");
        $query = pg_exec($enlace, "CREATE TABLE especialidadempleado2 AS SELECT * from especialidadempleado;");
        $query = pg_exec($enlace, "CREATE TABLE incidentes2 AS SELECT * from incidentes;");
        $query = pg_exec($enlace, "CREATE TABLE productoXservicio2 AS SELECT * from productoXservicio;");
        $query = pg_exec($enlace, "CREATE TABLE servicioXcliente2 AS SELECT * from servicioXcliente;");
        $query = pg_exec($enlace, "CREATE TABLE turnos2 AS SELECT * from turnos;");

    }

    public function Cerrar_etl()
    {

        //Elimino las de Postgres
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $empleado = pg_exec($enlace, "DROP TABLE IF EXISTS Empleado2;")
        or die("No se pudo realizar la consulta");
        $productos = pg_exec($enlace, "DROP TABLE IF EXISTS productos2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS ct_colores2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS especialidadempleado2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS incidentes2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS productoXservicio2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS servicioXcliente2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS detalleservicio2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS turnos2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS temporada2;")
        or die("No se pudo realizar la consulta");
        //elimar tablas Mysql Excel
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

        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $devoluciones = $pdo_conn->prepare("DELETE FROM materiales");
        $devoluciones->execute();

        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $devoluciones = $pdo_conn->prepare("DELETE FROM aromas");
        $devoluciones->execute();

        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $devoluciones = $pdo_conn->prepare("DELETE FROM servicios");
        $devoluciones->execute();

        include "db2.php";
        //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        $devoluciones = $pdo_conn->prepare("DELETE FROM empleadosmateriales");
        $devoluciones->execute();
        //Elimina las tablas

         $query = $this->db->query("DROP TABLE IF EXISTS clientes");
        $query = $this->db->query("DROP TABLE IF EXISTS agenda");
        $query = $this->db->query("DROP TABLE IF EXISTS compras");
        $query = $this->db->query("DROP TABLE IF EXISTS proveedores");
        $query = $this->db->query("DROP TABLE IF EXISTS ventas");
        $query = $this->db->query("DROP TABLE IF EXISTS almacen");
        $query = $this->db->query("DROP TABLE IF EXISTS area");
        $query = $this->db->query("DROP TABLE IF EXISTS aromas");
        $query = $this->db->query("DROP TABLE IF EXISTS colores");
        $query = $this->db->query("DROP TABLE IF EXISTS detalle_servicio");
        $query = $this->db->query("DROP TABLE IF EXISTS devoluciones");
        $query = $this->db->query("DROP TABLE IF EXISTS empleados");
        $query = $this->db->query("DROP TABLE IF EXISTS empleado_material");
        $query = $this->db->query("DROP TABLE IF EXISTS especialidad");
        $query = $this->db->query("DROP TABLE IF EXISTS forma_pago");
        $query = $this->db->query("DROP TABLE IF EXISTS mantenimiento");
        $query = $this->db->query("DROP TABLE IF EXISTS marca");
        $query = $this->db->query("DROP TABLE IF EXISTS materiales");
        $query = $this->db->query("DROP TABLE IF EXISTS merma");
        $query = $this->db->query("DROP TABLE IF EXISTS nomina");
        $query = $this->db->query("DROP TABLE IF EXISTS pedido_proveedor");
        $query = $this->db->query("DROP TABLE IF EXISTS presentacion");
        $query = $this->db->query("DROP TABLE IF EXISTS productos");
        $query = $this->db->query("DROP TABLE IF EXISTS producto_servicio");
        $query = $this->db->query("DROP TABLE IF EXISTS servicios");
        $query = $this->db->query("DROP TABLE IF EXISTS tamaños");
        $query = $this->db->query("DROP TABLE IF EXISTS temporadas");
        $query = $this->db->query("DROP TABLE IF EXISTS tipo_devolucion");

        $valor = array('etl' => 2);
        $this->db->where('Rol !=', 1);
        $this->db->update('usuarios', $valor);

        $valor = array('etl' => 4);
        $this->db->where('Rol', 1);
        $this->db->update('usuarios', $valor);

    }

    public function ETL($id_usuario)
    {
        $this->db->where('id_suaurio', $id_usuario);
        $query = $this->db->get('usuarios');
        return $query->result_array()[0];
    }

    public function Tablas()
    {
        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $almacen = $pdo_conn->prepare("DELETE FROM almacen");
        // $almacen->execute();

        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $marcas = $pdo_conn->prepare("DELETE FROM marcas");
        // $marcas->execute();

        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $temporada = $pdo_conn->prepare("DELETE FROM temporada");
        // $temporada->execute();

        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $devoluciones = $pdo_conn->prepare("DELETE FROM devoluciones");
        // $devoluciones->execute();

        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $devoluciones = $pdo_conn->prepare("DELETE FROM materiales");
        // $devoluciones->execute();

        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $devoluciones = $pdo_conn->prepare("DELETE FROM aromas");
        // $devoluciones->execute();

        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $devoluciones = $pdo_conn->prepare("DELETE FROM servicios");
        // $devoluciones->execute();

        // include "db2.php";
        // //$productos=$pdo_conn->prepare("DROP TABLE IF EXISTS productos");
        // $devoluciones = $pdo_conn->prepare("DELETE FROM empleadosmateriales");
        // $devoluciones->execute();

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

        // echo "Turnos" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(2)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_turno = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $nombre   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO turnos(id_turno,nombre) VALUES('$id_turno','$nombre')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);
        // }

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

        // echo "Especialidad" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(6)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_especialidad = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $Tipo            = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO especialidad(id_especialidad,Tipo)
        // VALUES('$id_especialidad','$Tipo')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

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

        // echo "Temporada" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(8)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_temporada = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $nombre       = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO temporada(id_temporada,nombre)
        // VALUES('$id_temporada','$nombre')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

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

        // echo "Ventas" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(10)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_ventas   = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $id_producto = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
        //     $id_cliente  = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
        //     $id_empleado = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
        //     $cantidad    = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
        //     $fecha       = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO ventas(id_ventas,id_producto,id_cliente,id_empleado,cantidad,fecha)
        // VALUES('$id_ventas','$id_producto','$id_cliente','$id_empleado',
        // '$cantidad','$fecha')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

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

        // echo "Codigo Color" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(13)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_color = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $nombre   = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO codigo_color(id_color,nombre)
        // VALUES('$id_color','$nombre')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

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

        // echo "Alta Inventario" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(15)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_producto = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $id_provedor = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
        //     $fecha       = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO altainventario(id_producto,id_provedor,fecha)
        // VALUES('$id_producto','$id_provedor','$fecha')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

        // echo "Abonos" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(16)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_abono  = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $id_compra = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
        //     $monto     = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
        //     $fecha     = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO abonos(id_abono,id_compra,monto,fecha)
        // VALUES('$id_abono','$id_compra','$monto','$fecha')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

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

        // echo "Empleados" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(19)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_empleado      = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $id_turno         = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
        //     $id_especialidad  = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
        //     $id_servicio      = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
        //     $nombre           = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
        //     $apellido_paterno = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
        //     $apellido_materno = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
        //     $fecha_inicio     = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO empleados(id_empleado,id_turno,id_especialidad,id_servicio,nombre,apellido_paterno,apellido_materno,fecha_inicio)
        // VALUES('$id_empleado','$id_turno','$id_especialidad','$id_servicio',
        // '$nombre','$apellido_paterno','$apellido_materno','$fecha_inicio')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

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

        // echo "Clientes" . "\n";
        // //Asigno la hoja de calculo activa
        // $objPHPExcel->setActiveSheetIndex(0);
        // //Obtengo el numero de filas del archivo
        // $numRows = $objPHPExcel->setActiveSheetIndex(21)->getHighestRow();
        // for ($i = 2; $i <= $numRows; $i++) {

        //     $id_cliente       = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
        //     $nombre           = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
        //     $direccion        = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
        //     $correo           = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
        //     $telefono         = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
        //     $apellido_paterno = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
        //     $apellido_materno = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
        //     $cp               = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
        //     $sexo             = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();

        //     $sql = "INSERT INTO cliente(id_cliente,nombre,apellido_paterno,apellido_materno,direccion,correo,telefono,cp,sexo)
        // VALUES('$id_cliente','$nombre','$apellido_paterno','$apellido_materno',
        // '$direccion','$correo','$telefono','$cp','$sexo')";

        //     $result = $mysqli->query($sql);
        //     echo mysqli_error($mysqli);

        // }

        //Postgress borrado y llenado
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $empleado = pg_exec($enlace, "DROP TABLE IF EXISTS Empleado2;")
        or die("No se pudo realizar la consulta");
        $productos = pg_exec($enlace, "DROP TABLE IF EXISTS productos2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS ct_colores2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS especialidadempleado2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS incidentes2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS productoXservicio2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS servicioXcliente2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS detalleservicio2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS turnos2;")
        or die("No se pudo realizar la consulta");
        $ct_colores = pg_exec($enlace, "DROP TABLE IF EXISTS temporada2;")
        or die("No se pudo realizar la consulta");

        $query = pg_exec($enlace, "CREATE TABLE Empleado2 AS SELECT * from empleado;");
        $query = pg_exec($enlace, "CREATE TABLE Productos2 AS SELECT * from Productos;");
        $query = pg_exec($enlace, "CREATE TABLE ct_colores2 AS SELECT * from ct_colores;");
        $query = pg_exec($enlace, "CREATE TABLE detalleservicio2 AS SELECT * from detalleservicio;");
        $query = pg_exec($enlace, "CREATE TABLE especialidadempleado2 AS SELECT * from especialidadempleado;");
        $query = pg_exec($enlace, "CREATE TABLE incidentes2 AS SELECT * from incidentes;");
        $query = pg_exec($enlace, "CREATE TABLE productoXservicio2 AS SELECT * from productoXservicio;");
        $query = pg_exec($enlace, "CREATE TABLE servicioXcliente2 AS SELECT * from servicioXcliente;");
        $query = pg_exec($enlace, "CREATE TABLE turnos2 AS SELECT * from turnos;");
        $query = pg_exec($enlace, "CREATE TABLE temporada2 AS SELECT * from temporada;");

//Mysql borrado y llenado
        //Elimina las tablas
        $query = $this->db->query("DROP TABLE IF EXISTS clientes");
        $query = $this->db->query("DROP TABLE IF EXISTS agenda");
        $query = $this->db->query("DROP TABLE IF EXISTS compras");
        $query = $this->db->query("DROP TABLE IF EXISTS proveedores");
        $query = $this->db->query("DROP TABLE IF EXISTS ventas");
        $query = $this->db->query("DROP TABLE IF EXISTS almacen");
        $query = $this->db->query("DROP TABLE IF EXISTS area");
        $query = $this->db->query("DROP TABLE IF EXISTS aromas");
        $query = $this->db->query("DROP TABLE IF EXISTS colores");
        $query = $this->db->query("DROP TABLE IF EXISTS detalle_servicio");
        $query = $this->db->query("DROP TABLE IF EXISTS devoluciones");
        $query = $this->db->query("DROP TABLE IF EXISTS empleados");
        $query = $this->db->query("DROP TABLE IF EXISTS empleado_material");
        $query = $this->db->query("DROP TABLE IF EXISTS especialidad");
        $query = $this->db->query("DROP TABLE IF EXISTS forma_pago");
        $query = $this->db->query("DROP TABLE IF EXISTS mantenimiento");
        $query = $this->db->query("DROP TABLE IF EXISTS marca");
        $query = $this->db->query("DROP TABLE IF EXISTS materiales");
        $query = $this->db->query("DROP TABLE IF EXISTS merma");
        $query = $this->db->query("DROP TABLE IF EXISTS nomina");
        $query = $this->db->query("DROP TABLE IF EXISTS pedido_proveedor");
        $query = $this->db->query("DROP TABLE IF EXISTS presentacion");
        $query = $this->db->query("DROP TABLE IF EXISTS productos");
        $query = $this->db->query("DROP TABLE IF EXISTS producto_servicio");
        $query = $this->db->query("DROP TABLE IF EXISTS servicios");
        $query = $this->db->query("DROP TABLE IF EXISTS tamaños");
        $query = $this->db->query("DROP TABLE IF EXISTS temporadas");
        $query = $this->db->query("DROP TABLE IF EXISTS tipo_devolucion");

//crea y llena la tabla clientes
        $query = $this->db->query("CREATE TABLE tics.clientes SELECT * FROM original_tics.clientes");

        $query = $this->db->query("ALTER TABLE `clientes` ADD PRIMARY KEY (`id_cliente`)");

        $query = $this->db->query("ALTER TABLE `clientes` MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla agenda
        $query = $this->db->query("CREATE TABLE tics.agenda SELECT * FROM original_tics.agenda");
        $query = $this->db->query("ALTER TABLE `agenda` ADD PRIMARY KEY (`id_Agenda`)");
        $query = $this->db->query("ALTER TABLE `agenda` MODIFY `id_Agenda` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla compras
        $query = $this->db->query("CREATE TABLE tics.compras SELECT * FROM original_tics.compras");
        $query = $this->db->query("ALTER TABLE `compras` ADD PRIMARY KEY (`id_compras`)");
        $query = $this->db->query("ALTER TABLE `compras` MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla proveedores
        $query = $this->db->query("CREATE TABLE tics.proveedores SELECT * FROM original_tics.proveedores");
        $query = $this->db->query("ALTER TABLE `proveedores` ADD PRIMARY KEY (`id_proveedor`)");
        $query = $this->db->query("ALTER TABLE `proveedores` MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT");
        //crea y llena la tabla ventas
        $query = $this->db->query("CREATE TABLE tics.ventas SELECT * FROM original_tics.ventas");
        $query = $this->db->query("ALTER TABLE `ventas` ADD PRIMARY KEY (`id_venta`)");
        $query = $this->db->query("ALTER TABLE `ventas` MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla almacen
        $query = $this->db->query("CREATE TABLE tics.almacen SELECT * FROM original_tics.almacen");
        $query = $this->db->query("ALTER TABLE `almacen` ADD PRIMARY KEY (`id_almacen`)");
        $query = $this->db->query("ALTER TABLE `almacen` MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla area
        $query = $this->db->query("CREATE TABLE tics.area SELECT * FROM original_tics.area");
        $query = $this->db->query("ALTER TABLE `area` ADD PRIMARY KEY (`id_area`)");
        $query = $this->db->query("ALTER TABLE `area` MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla aromas
        $query = $this->db->query("CREATE TABLE tics.aromas SELECT * FROM original_tics.aromas");
        $query = $this->db->query("ALTER TABLE `aromas` ADD PRIMARY KEY (`id_aroma`)");
        $query = $this->db->query("ALTER TABLE `aromas` MODIFY `id_aroma` int(11) NOT NULL AUTO_INCREMENT");
          //crea y llena la tabla colores
        $query = $this->db->query("CREATE TABLE tics.colores SELECT * FROM original_tics.colores");
        $query = $this->db->query("ALTER TABLE `colores` ADD PRIMARY KEY (`id_color`)");
        $query = $this->db->query("ALTER TABLE `colores` MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT");
          //crea y llena la tabla detalle servicio
        $query = $this->db->query("CREATE TABLE tics.detalle_servicio SELECT * FROM original_tics.detalle_servicio");
        $query = $this->db->query("ALTER TABLE `detalle_servicio` ADD PRIMARY KEY (`id_detalle_servicio`)");
        $query = $this->db->query("ALTER TABLE `detalle_servicio` MODIFY `id_detalle_servicio` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla devoluciones
        $query = $this->db->query("CREATE TABLE tics.devoluciones SELECT * FROM original_tics.devoluciones");
        $query = $this->db->query("ALTER TABLE `devoluciones` ADD PRIMARY KEY (`id_devolucion`)");
        $query = $this->db->query("ALTER TABLE `devoluciones` MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla empleados
        $query = $this->db->query("CREATE TABLE tics.empleados SELECT * FROM original_tics.empleados");
        $query = $this->db->query("ALTER TABLE `empleados` ADD PRIMARY KEY (`id_empleado`)");
        $query = $this->db->query("ALTER TABLE `empleados` MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla empleado_material
        $query = $this->db->query("CREATE TABLE tics.empleado_material SELECT * FROM original_tics.empleado_material");
        $query = $this->db->query("ALTER TABLE `empleado_material` ADD PRIMARY KEY (`id_empleado_material`)");
        $query = $this->db->query("ALTER TABLE `empleado_material` MODIFY `id_empleado_material` int(11) NOT NULL AUTO_INCREMENT");


 //crea y llena la tabla especialidad
        $query = $this->db->query("CREATE TABLE tics.especialidad SELECT * FROM original_tics.especialidad");
        $query = $this->db->query("ALTER TABLE `especialidad` ADD PRIMARY KEY (`id_especialidad`)");
        $query = $this->db->query("ALTER TABLE `especialidad` MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT");

//crea y llena la tabla forma _pago
        $query = $this->db->query("CREATE TABLE tics.forma_pago SELECT * FROM original_tics.forma_pago");
        $query = $this->db->query("ALTER TABLE `forma_pago` ADD PRIMARY KEY (`id_forma_pago`)");
        $query = $this->db->query("ALTER TABLE `forma_pago` MODIFY `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla mantenimiento
        $query = $this->db->query("CREATE TABLE tics.mantenimiento SELECT * FROM original_tics.mantenimiento");
        $query = $this->db->query("ALTER TABLE `mantenimiento` ADD PRIMARY KEY (`id_mantenimiento`)");
        $query = $this->db->query("ALTER TABLE `mantenimiento` MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT");


         //crea y llena la tabla marca
        $query = $this->db->query("CREATE TABLE tics.marca SELECT * FROM original_tics.marca");
        $query = $this->db->query("ALTER TABLE `marca` ADD PRIMARY KEY (`id_marca`)");
        $query = $this->db->query("ALTER TABLE `marca` MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla materiales
        $query = $this->db->query("CREATE TABLE tics.materiales SELECT * FROM original_tics.materiales");
        $query = $this->db->query("ALTER TABLE `materiales` ADD PRIMARY KEY (`id_material`)");
        $query = $this->db->query("ALTER TABLE `materiales` MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla merma
        $query = $this->db->query("CREATE TABLE tics.merma SELECT * FROM original_tics.merma");
        $query = $this->db->query("ALTER TABLE `merma` ADD PRIMARY KEY (`id_merma`)");
        $query = $this->db->query("ALTER TABLE `merma` MODIFY `id_merma` int(11) NOT NULL AUTO_INCREMENT");


         //crea y llena la tabla nomina
        $query = $this->db->query("CREATE TABLE tics.nomina SELECT * FROM original_tics.nomina");
        $query = $this->db->query("ALTER TABLE `nomina` ADD PRIMARY KEY (`id_nomina`)");
        $query = $this->db->query("ALTER TABLE `nomina` MODIFY `id_nomina` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla pedido_proveedor
        $query = $this->db->query("CREATE TABLE tics.pedido_proveedor SELECT * FROM original_tics.pedido_proveedor");
        $query = $this->db->query("ALTER TABLE `pedido_proveedor` ADD PRIMARY KEY (`id_pedido`)");
        $query = $this->db->query("ALTER TABLE `pedido_proveedor` MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla presentacionpresentacion
        $query = $this->db->query("CREATE TABLE tics.presentacion SELECT * FROM original_tics.presentacion");
        $query = $this->db->query("ALTER TABLE `presentacion` ADD PRIMARY KEY (`id_presentacion`)");
        $query = $this->db->query("ALTER TABLE `presentacion` MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla productos
        $query = $this->db->query("CREATE TABLE tics.productos SELECT * FROM original_tics.productos");
        $query = $this->db->query("ALTER TABLE `productos` ADD PRIMARY KEY (`id_producto`)");
        $query = $this->db->query("ALTER TABLE `productos` MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT");
        //crea y llena la tabla producto_servicioproducto_servicio
        $query = $this->db->query("CREATE TABLE tics.producto_servicio SELECT * FROM original_tics.producto_servicio");
        $query = $this->db->query("ALTER TABLE `producto_servicio` ADD PRIMARY KEY (`id_detalle_producto_servicio`)");
        $query = $this->db->query("ALTER TABLE `producto_servicio` MODIFY `id_detalle_producto_servicio` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla servicios
        $query = $this->db->query("CREATE TABLE tics.servicios SELECT * FROM original_tics.servicios");
        $query = $this->db->query("ALTER TABLE `servicios` ADD PRIMARY KEY (`id_servicio`)");
        $query = $this->db->query("ALTER TABLE `servicios` MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT");

        //crea y llena la tabla tamaños
        $query = $this->db->query("CREATE TABLE tics.tamaños SELECT * FROM original_tics.tamaños");
        $query = $this->db->query("ALTER TABLE `tamaños` ADD PRIMARY KEY (`id_tamaño`)");
        $query = $this->db->query("ALTER TABLE `tamaños` MODIFY `id_tamaño` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla temporadas
        $query = $this->db->query("CREATE TABLE tics.temporadas SELECT * FROM original_tics.temporadas");
        $query = $this->db->query("ALTER TABLE `temporadas` ADD PRIMARY KEY (`id_temporada`)");
        $query = $this->db->query("ALTER TABLE `temporadas` MODIFY `id_temporada` int(11) NOT NULL AUTO_INCREMENT");

         //crea y llena la tabla tipo_devolucion
        $query = $this->db->query("CREATE TABLE tics.tipo_devolucion SELECT * FROM original_tics.tipo_devolucion");
        $query = $this->db->query("ALTER TABLE `tipo_devolucion` ADD PRIMARY KEY (`id_tipo_devolucion`)");
        $query = $this->db->query("ALTER TABLE `tipo_devolucion` MODIFY `id_tipo_devolucion` int(11) NOT NULL AUTO_INCREMENT");



        $valor = array('etl' => 0);
        $this->db->where('Rol !=', 1);
        $this->db->update('usuarios', $valor);

        $valor = array('etl' => 3);
        $this->db->where('Rol', 1);
        $this->db->update('usuarios', $valor);

        //borrado de tabla de sql server
        $empleado = $this->load->database('sqlserver', true);
        $query1   = $empleado->query("DELETE FROM Empleado;
            DELETE FROM CT_Colores;
            DELETE FROM EspecialidadEmpleado;
            DELETE FROM Productos;
            DELETE FROM Temporada;
            DELETE FROM Turnos;
            DELETE FROM Cliente;
            DELETE FROM Agenda;
            DELETE FROM Compras;
            DELETE FROM Provedores;
            DELETE FROM Ventas;
            DELETE FROM Marca;
            DELETE FROM Almacen;
            DELETE FROM Devoluciones;
            DELETE FROM DetalleServicio;
            DELETE FROM Merma;
            DELETE FROM Mantenimiento;
            DELETE FROM FormaPago;
            DELETE FROM PedidoXProvedor;
            DELETE FROM TipoDevolucion;
            DELETE FROM Aromas;
            DELETE FROM EmpleadoXMaterial;
            DELETE FROM Materiales;
            DELETE FROM Servicio;
            ");
    }

   

}
