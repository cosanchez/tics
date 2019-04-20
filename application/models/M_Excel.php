<?php
class M_Excel extends CI_Model
{

    public function serviciosxempleado($id)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT ds.IdServicio,s.Nombre from DetalleServicio ds join Empleado E on ds.IdEmpleado=" . $id . "
  join Servicio s on ds.IdServicio=s.IdServicio
  group by ds.IdServicio,s.Nombre")->result_array();
    }
    ////////////LD
    public function SPE($nom1, $nom2, $nom3)
    {
        $resultado = $this->load->database('sqlserver', true);

        return $query = $resultado->query("SELECT  s.Nombre, dt.IdServicio, sum(CantidadServicios) cantidad,e.Nombre NomE from DetalleServicio dt
inner join Servicio s on dt.IdServicio=s.IdServicio
inner join Empleado e on dt.IdEmpleado=e.IdEmpleado
where dt.IdEmpleado=" . $nom3 . " and  Year(dt.Fecha)=" . $nom1 . " and MONTH(dt.Fecha)=" . $nom2 . "
group by dt.IdServicio,s.Nombre,e.Nombre
order by dt.IdServicio")->result_array();
    }
    /////////////////7

    public function getEmpleados()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT * from Empleado")->result_array();

    }
    public function GetmesesSQL()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT DATENAME(MONTH,dt.Fecha) mes from DetalleServicio  dt");
    }
    public function GetanosSQL()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT DATENAME(YEAR,dt.Fecha) mes from DetalleServicio  dt");
    }

    public function UpdateAlmacenSQL($id_almacen, $id_productos, $stock_max, $stock_min, $nombre)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Almacen(IdAlmacen,IdProducto,StockMax,StockMin,nombre) values(" . $id_almacen . "," . $id_productos . "," . $stock_max . "," . $stock_min . ",'" . $nombre . "')");
    }
    public function UpdateAlmacen($id_almacen, $id_productos, $descripcion, $stock_min, $stock_max, $nombre)
    {
        include "db.php";

        $id_almacen  = $_POST['id_almacen'];
        $id_producto = $_POST['id_productos'];
        $descripcion = $_POST['descripcion'];
        $stock_min   = $_POST['stock_min'];
        $stock_max   = $_POST['stock_max'];
        $nombre      = $_POST['nombre'];

        $almacen = $pdo_conn->prepare("UPDATE almacen set stock_max=$stock_max,stock_min=$stock_min, descripcion='$descripcion',nombre='$nombre' where id_almacen=$id_almacen");

        $almacen->execute();

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Almacen
    (IdAlmacen,IdProducto,  StockMax, StockMin)
    VALUES(" . $id_almacen . "," . $id_producto . "," . $stock_max . "," . $stock_min . ")");

        return true;
    }
    public function insertAlmacenSQL($nom1, $nom2, $nom3, $nom4, $nom5, $nom6)
    {
        date_default_timezone_set("America/Mexico_City");
        $fecha        = date('Y-m-d');
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into almacen(IdAlmacen,IdProducto,StockMax,
        StockMin) values(" . $nom1 . "," . $nom2 . "," . $nom4 . "," . $nom5 . ")");
    }

    public function insertTemporadaSQL($nom1, $nom2)
    {

        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into temporada(id_Temporada,
        nombre) values(" . $nom1 . ",'" . $nom2 . "')");
    }

    public function insertMarcaSQL($nom1, $nom2)
    {
        date_default_timezone_set("America/Mexico_City");
        $fecha        = date('Y-m-d');
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Marca(IdMarca,
        Nombre) values(" . $nom1 . ",'" . $nom2 . "')");
    }

    public function insertDevolucionSQL($nom1, $nom2, $nom3, $nom5, $nom6)
    {
        $resultado = $this->load->database('sqlserver', true);
        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d');
        $nom4  = date($_POST['valor4']);
        echo $nom4;
        return $query = $resultado->query("INSERT into Devoluciones(IdDevolucion,IdProducto,IdEmpleado,Fecha,Cantidad) values(" . $nom1 . "," . $nom2 . "," . $nom3 . ",'" . $nom4 . "'," . $nom5 . ")");

    }

    public function DeleteAlmacen()
    {
        include "db.php";
        $id_almacen = $this->input->get('id_almacen');
        $almacen    = $pdo_conn->prepare("DELETE FROM almacen WHERE id_almacen='$id_almacen'");
        $almacen->execute();
        return true;

    }

    public function mostrarAlmacen()
    {
        include "db.php";
        $almacen = $pdo_conn->prepare("SELECT * FROM almacen");
        $almacen->execute();
        $result = $almacen->fetchAll();
        return $result;
    }

    public function EditarAlmacen()
    {

        $id_almacen = $this->input->get('id_almacen');
        include "db.php";
        $almacen = $pdo_conn->prepare("SELECT * FROM almacen where id_almacen='$id_almacen' ");
        $almacen->execute();
        $result = $almacen->fetchAll();
        return $result;

    }

    public function mostrarTemporada()
    {
        include "db.php";
        $temporada = $pdo_conn->prepare("SELECT * FROM temporada");
        $temporada->execute();
        $result = $temporada->fetchAll();
        return $result;

    }

    public function EditarTemporada()
    {

        $id_Temporada = $this->input->get('id_Temporada');
        include "db.php";
        $id_Temporada = $pdo_conn->prepare("SELECT * FROM temporada where id_Temporada='$id_Temporada'");
        $temporada->execute();
        $result = $temporada->fetchAll();

        return $result;
    }

    public function ActualizarTemporada()
    {
        include "db.php";
        $id_Temporada = $_POST['id_Temporada'];
        $nombre       = $_POST['nombre'];

        $temporada = $pdo_conn->prepare("UPDATE temporada set nombre=$nombre where id_Temporada=$id_Temporada");
        $temporada->execute();

        return true;
    }

    public function mostrarMarca()
    {
        include "db.php";
        $marcas = $pdo_conn->prepare("SELECT * FROM marcas");
        $marcas->execute();
        $result = $marcas->fetchAll();
        return $result;
    }

    public function EditarMarca()
    {
        include "db.php";
        $id_marca = $this->input->get('id_marca');
        $marcas   = $pdo_conn->prepare("SELECT * FROM marcas where id_marca='$id_marca' ");
        $marcas->execute();
        $result = $marcas->fetchAll();

        return $result;
    }

    public function ActualizarMarca()
    {
        include "db.php";
        $id_marca = $_POST['id_marca'];
        $Nombre   = $_POST['Nombre'];

        $marcas = $pdo_conn->prepare("UPDATE marcas set Nombre='$Nombre' where id_marca=$id_marca");
        $marcas->execute();
        return true;

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Marca
     (IdMarca,Nombre)
     VALUES(" . $id_marca . ",'" . $Nombre . "')");

    }

    public function ActualizarDevolucion()
    {
        include "db.php";
        $id_devoluciones = $_POST['id_devoluciones'];
        $id_productos    = $_POST['id_productos'];
        $id_empleado     = $_POST['id_empleado'];
        $fecha           = $_POST['fecha'];
        $cantidad        = $_POST['cantidad'];
        $descripcion     = $_POST['descripcion'];

        $devoluciones = $pdo_conn->prepare("UPDATE devoluciones set fecha='$fecha',cantidad=$cantidad, descripcion='$descripcion' where id_devoluciones=$id_devoluciones");
        $devoluciones->execute();
        return true;

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Devoluciones
     (IdDevolucion,IdProducto, IdEmpleado, Cantidad,Fecha)
     VALUES(" . $id_devoluciones . "," . $id_producto . "," . $id_empleado . "," . $cantidad . ",'" . $fecha . "')");
    }

    public function mostrarDevolucion()
    {
        include "db.php";
        $devoluciones = $pdo_conn->prepare("SELECT * FROM devoluciones");
        $devoluciones->execute();
        $result = $devoluciones->fetchAll();

        return $result;

    }

    public function EditarDevolucion()
    {

        $id_devoluciones = $this->input->get('id_devoluciones');
        include "db.php";
        $devoluciones = $pdo_conn->prepare("SELECT * FROM devoluciones where id_devoluciones='$id_devoluciones'");
        $devoluciones->execute();
        $result = $devoluciones->fetchAll();
        return $result;
    }

    public function Materiales($datos)
    {

        foreach ($datos as $key => $value) {

            $sqlserver = $this->load->database('sqlserver', true);
            $query     = $sqlserver->query("INSERT INTO Materiales
        (IdMaterial,Nombre) VALUES(" . $value['Id_materiales'] . ",'" . $value['descripcion'] . "')");
        }

    }

    public function tablasfaltantes()
    {
        include "db.php";
        $almacen = $pdo_conn->prepare("SELECT * FROM materiales");
        $almacen->execute();
        $result = $almacen->fetchAll();
        return $result;
    }

    public function getaromas()
    {
        include "db.php";
        $aromas = $pdo_conn->prepare("SELECT * FROM aromas");
        $aromas->execute();
        $result = $aromas->fetchAll();
        return $result;
    }

    public function getServicios()
    {
        include "db.php";
        $servicios = $pdo_conn->prepare("SELECT * FROM servicios");
        $servicios->execute();
        $result = $servicios->fetchAll();
        return $result;

    }

    public function Aromas($datos)
    {
        foreach ($datos as $key => $value) {

            $sqlserver = $this->load->database('sqlserver', true);
            $query     = $sqlserver->query("INSERT INTO Aromas
        (IdAroma,NombreAroma) VALUES(" . $value['id_aroma'] . ",'" . $value['Nombre'] . "')");
        }
    }

    public function getEmpleadoXMaterial()
    {

        include "db.php";
        $emat = $pdo_conn->prepare("SELECT * FROM empleadosmateriales");
        $emat->execute();
        $result = $emat->fetchAll();
        return $result;
    }

    public function Servicios($datos)
    {

        foreach ($datos as $key => $value) {

            $sqlserver = $this->load->database('sqlserver', true);
            $query     = $sqlserver->query("INSERT INTO Servicio
        (IdServicio,Nombre,Descripcion,Costo) VALUES(" . $value['id_servicio'] . ",'" . $value['nombre'] . "',
       '" . $value['descripcion'] . "'," . $value['precio'] . " )");
        }
    }

    public function EmpleadoXMaterial($datos)
    {
        foreach ($datos as $key => $value) {

            $sqlserver = $this->load->database('sqlserver', true);
            $query     = $sqlserver->query("INSERT INTO EmpleadoXMaterial
        (IdMaterial,IdEmpleado,Fecha) VALUES(" . $value['Id_materiales'] . "," . $value['id_empleado'] . ",
       '" . date($value['fecha']) . "')");
        }
    }



     public function DeleteDevolucion(){
        include "db.php";
        $id_devoluciones = $this->input->get('id_devoluciones');
        $devoluciones= $pdo_conn->prepare("DELETE FROM devoluciones WHERE id_devoluciones='$id_devoluciones'");
        $devoluciones->execute();
        return true;

    }



    public function DeleteMarca(){
        include "db.php";
        $id_marca = $this->input->get('id_marca');
        $marcas= $pdo_conn->prepare("DELETE FROM marcas WHERE id_marca='$id_marca'");
        $marcas->execute();
        return true;
    }



}
