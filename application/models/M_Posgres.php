<?php
class M_Posgres extends CI_Model
{

    public function Prueba2()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query('SELECT *from prueba1')->result_array();
    }

    public function insertEmpleado($nom, $nom2)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into prueba1 (Nombre,apellido) values('" . $nom . "','" . $nom2 . "')");
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //Consulta Dinamicas
    public function GetProductoSQL()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT *from Marca")->result_array();
    }

    public function getProductoXMarca($idmarca)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT *from Productos where IdMarca =" . $idmarca)->result_array();
    }

    public function GetTemporadasSQL()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT *from Temporada")->result_array();
    }

    public function PVXT($idproducto, $idtemporada2, $fecha)
    {
        $fechas = $fecha;

        switch ($fechas) {
            case 2:
                $resultado    = $this->load->database('sqlserver', true);
                return $query = $resultado->query("SELECT t.Nombre, SUM(v.Cantidad) AS cantidadVendida, YEAR(v.Fecha) AS Fecha from Productos p JOIN Ventas v ON p.IdProducto=v.IdProducto join Temporada t on p.IdTemporada=t.IdTemporada
                    where p.IdProducto=" . $idproducto . " AND t.IdTemporada= " . $idtemporada2 . "
                    group by YEAR(v.Fecha),t.Nombre")->result_array();
                break;
            case 1:
                $resultado    = $this->load->database('sqlserver', true);
                return $query = $resultado->query("SELECT t.Nombre, SUM(v.Cantidad) AS cantidadVendida, CONVERT(varchar(11),
                    DATENAME(MONTH,v.Fecha))+' '+DATENAME(YEAR,v.Fecha) AS Fecha from Productos p JOIN Ventas v ON p.IdProducto=v.IdProducto join Temporada t on p.IdTemporada=t.IdTemporada
                    where p.IdProducto=" . $idproducto . " AND t.IdTemporada= " . $idtemporada2 . "
                    group by YEAR(v.Fecha), v.Fecha,t.Nombre order by v.Fecha")->result_array();
                break;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Insercion a SQL ///////////////////////////////////////////
    public function insertEmpleadoSQL($nom1, $nom2, $nom3, $nom4, $nom5, $nom6, $nom7, $nom8, $nom9, $nom10, $nom11)
    {
        date_default_timezone_set("America/Mexico_City");
        $fecha        = date('Y-m-d');
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Empleado(IdEmpleado,Nombre,IdTurno,IdEspecialidad,PrimerApellido,SegundoApellido,Domicilio,Correo,Telefono,CP,
Sexo,FechaContratacion) values(" . $nom1 . ",'" . $nom2 . "'," . $nom3 . "," . $nom4 . ",'" . $nom5 . "','" . $nom6 . "','" . $nom7 . "','" . $nom8 . "','" . $nom9 . "','" . $nom10 . "','" . $nom11 . "','" . $fecha . "')");
    }

    public function insertProductoSQL($nom1, $nom2, $nom3, $nom4, $nom5, $nom6, $nom7, $nom8, $nom9, $nom10, $nom11, $nom12)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Productos(IdProducto,Nombre,IdTemporada,IdMarca,Tamaño,Presentacion,IdColor,Cantidad,
Minimo,Maximo,FechaCaducidad,CostoCompra) values(" . $nom1 . ",'" . $nom2 . "'," . $nom3 . "," . $nom12 . ",'" . $nom4 . "','" . $nom5 . "'," . $nom6 . "," . $nom7 . "," . $nom8 . "," . $nom9 . ",'" . $nom10 . "'," . $nom11 . ")");
    }
    // [IdProducto]
    // , [Nombre]
    // , [IdTemporada]
    // , [IdMarca]
    // , [Tamaño]
    // , [Presentacion]
    // , [IdColor]
    // , [Cantidad]
    // , [Minimo]
    // , [Maximo]
    // , [FechaCaducidad]
    // , [CostoCompra]

    public function ActualizarEmpleadoSQL($id, $campos)
    {
        date_default_timezone_set("America/Mexico_City");
        $fecha        = date('Y-m-d');
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Empleado(IdEmpleado,Nombre,IdTurno,IdEspecialidad,PrimerApellido,SegundoApellido,Domicilio,Correo,Telefono,CP,
Sexo,FechaContratacion) values(" .
            $id . ",
'" . $campos['Nombre'] . "',
" . $campos['IdTurno'] . "," .
            $campos['IdEspecialidad'] . ",'" .
            $campos['PrimerApellido'] . "','" .
            $campos['SegundoApellido'] . "','" .
            $campos['Domicilio'] . "','" .
            $campos['Correo'] . "','" .
            $campos['Telefono'] . "','" .
            $campos['CP'] . "','" .
            $campos['Sexo'] . "','" .
            $fecha . "')");
    }
// IdEmpleado,
    // Nombre,
    // IdTurno,
    // IdEspecialidad,
    // PrimerApellido,
    // SegundoApellido,
    // Domicilio,
    // Correo ,
    // Telefono ,
    // CP,
    // Sexo ,
    // FechaContratacion
    public function insertCTColoresSQL($nom1, $nom2, $nom3)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into CT_Colores(IdColor,CodigoColor,Nombre)
            values(" . $nom1 . ",'" . $nom2 . "','" . $nom3 . "')");
    }

    public function insertEspecialidadSQL($nom1, $nom2)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into EspecialidadEmpleado(IdEspecialidad,Nombre)
            values(" . $nom1 . ",'" . $nom2 . "')");
    }

    public function insertTurnosSQL($nom1, $nom2)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Turnos(IdTurno,Nombre)
            values(" . $nom1 . ",'" . $nom2 . "')");
    }

    public function insertTemporadasSQL($nom1, $nom2)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Temporada(IdTemporada,Nombre)
            values(" . $nom1 . ",'" . $nom2 . "')");
    }

    public function ActualizarCTColorSQL($id, $datos)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into CT_Colores(IdColor,CodigoColor,Nombre)
            values(" . $id . ",'" . $datos['CodigoColor'] . "','" . $datos['Nombre'] . "')");
    }

    public function ActualizarEspecialidadSQL($id, $nombre)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into EspecialidadEmpleado(IdEspecialidad,Nombre)
            values(" . $id . ",'" . $nombre . "')");
    }

    public function ActualizarTurnoSQL($id, $nombre)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Turnos(IdTurno,Nombre)
            values(" . $id . ",'" . $nombre . "')");
    }

    public function ActualizarTemporadaSQL($id, $nombre)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("INSERT into Temporada(IdTemporada,Nombre)
            values(" . $id . ",'" . $nombre . "')");
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function FilasEmpleado()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT * FROM empleado2 where nombre ~ '[0-9%]' or primerapellido ~ '[0-9%]' or segundoapellido ~ '[0-9%]' or telefono  ~ '[a-zA-Z%]' or cp ~ '[a-zA-Z%]';")
        or die("No se pudo realizar la consulta");

        if (pg_num_rows($resultado) > 0) {
            return pg_num_rows($resultado);
        }

    }

    public function FilasProducto()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");
        $resultado = pg_exec($enlace, "SELECT * FROM productos2 where nombre ~ '[0-9%]' or presentacion ~ '[0-9%]' or tamaño ~ '[%$%]'  ;")
        or die("No se pudo realizar la consulta");

        if (pg_num_rows($resultado) > 0) {
            return pg_num_rows($resultado);
        }
    }

    public function FilasCTColores()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT * FROM ct_colores2 where nombre ~ '[0-9%]'
        or codigocolor ~ '[$&%]';")
        or die("No se pudo realizar la consulta");

        if (pg_num_rows($resultado) > 0) {
            return pg_num_rows($resultado);
        }
    }

    public function FilasTurnos()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT * FROM turnos2 where nombre ~ '[0-9%]' ;")
        or die("No se pudo realizar la consulta");

        if (pg_num_rows($resultado) > 0) {
            return pg_num_rows($resultado);
        }
    }
/*
or idtemporada ~ '[a-z%]'
or tamaño ~ '[@$#&%]'
or presentacion ~ '[0-9%]'
or idcolor ~ '[a-z%]'
or cantidad ~ '[a-z%]'
or minimo ~ '[a-z%]'
or maximo ~ '[a-z%]'
or fechacaducidad ~ '[@#$%]'
or costocompra ~ '[a-z%]'
or idmarca ~ '[a-z%]'
 */

    public function MostrarEmpleados()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT * FROM empleado2 ")
        or die("No se pudo realizar la consulta");

        $resultArray = array(pg_num_rows($resultado));
        if (pg_num_rows($resultado) > 0) {

            for ($i = 0; $i < pg_num_rows($resultado); $i++) {
                $resultArray[$i] = pg_fetch_array($resultado, $i, PGSQL_ASSOC);
            }
            return $resultArray; // pg_fetch_array($resultado);
        } else {
            return $resultArray;
        }

    }

    public function MostrarProdcutos()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT * FROM productos2;")
        or die("No se pudo realizar la consulta");

        $resultArray = array(pg_num_rows($resultado));
        if (pg_num_rows($resultado) > 0) {

            for ($i = 0; $i < pg_num_rows($resultado); $i++) {
                $resultArray[$i] = pg_fetch_array($resultado, $i, PGSQL_ASSOC);
            }
            return $resultArray; // pg_fetch_array($resultado);
        } else {
            return $resultArray;
        }
    }

    public function MostrarCtColores()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT *FROM ct_colores2;")
        or die("No se pudo realizar la consulta");

        $resultArray = array(pg_num_rows($resultado));
        if (pg_num_rows($resultado) > 0) {

            for ($i = 0; $i < pg_num_rows($resultado); $i++) {
                $resultArray[$i] = pg_fetch_array($resultado, $i, PGSQL_ASSOC);
            }
            return $resultArray; // pg_fetch_array($resultado);
        } else {
            return $resultArray;
        }
    }

    public function MostrarTurnos()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT *FROM turnos2;")
        or die("No se pudo realizar la consulta");

        $resultArray = array(pg_num_rows($resultado));
        if (pg_num_rows($resultado) > 0) {

            for ($i = 0; $i < pg_num_rows($resultado); $i++) {
                $resultArray[$i] = pg_fetch_array($resultado, $i, PGSQL_ASSOC);
            }
            return $resultArray; // pg_fetch_array($resultado);
        } else {
            return $resultArray;
        }
    }

    public function MostrarEspe()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT *FROM especialidadempleado2;")
        or die("No se pudo realizar la consulta");

        $resultArray = array(pg_num_rows($resultado));
        if (pg_num_rows($resultado) > 0) {

            for ($i = 0; $i < pg_num_rows($resultado); $i++) {
                $resultArray[$i] = pg_fetch_array($resultado, $i, PGSQL_ASSOC);
            }
            return $resultArray; // pg_fetch_array($resultado);
        } else {
            return $resultArray;
        }
    }

    public function MostrarTemporadas()
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT *FROM temporada2;")
        or die("No se pudo realizar la consulta");

        $resultArray = array(pg_num_rows($resultado));
        if (pg_num_rows($resultado) > 0) {

            for ($i = 0; $i < pg_num_rows($resultado); $i++) {
                $resultArray[$i] = pg_fetch_array($resultado, $i, PGSQL_ASSOC);
            }
            return $resultArray; // pg_fetch_array($resultado);
        } else {
            return $resultArray;
        }
    }

    public function ObtenerEmpleado($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT *FROM empleado2 where idempleado=" . $id . ";")
        or die("No se pudo realizar la consulta");

        return pg_fetch_array($resultado, 0, PGSQL_ASSOC);

    }

    public function ObtenerProducto($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT idproducto,nombre,idtemporada,tamaño,presentacion,idcolor,cantidad,minimo,maximo,fechacaducidad,costocompra,idmarca FROM productos2 where idproducto=" . $id . ";")
        or die("No se pudo realizar la consulta");

        return pg_fetch_array($resultado, 0, PGSQL_ASSOC);
    }

    public function ObtenerCTColor($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT  *FROM ct_colores2 where idcolor=" . $id . ";")
        or die("No se pudo realizar la consulta");

        return pg_fetch_array($resultado, 0, PGSQL_ASSOC);
    }

    public function ObtenerTurno($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT  *FROM turnos2 where idturno=" . $id . ";")
        or die("No se pudo realizar la consulta");

        return pg_fetch_array($resultado, 0, PGSQL_ASSOC);
    }

    public function ObtenerEsp($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT  *FROM especialidadempleado2 where idespecialidad=" . $id . ";")
        or die("No se pudo realizar la consulta");

        return pg_fetch_array($resultado, 0, PGSQL_ASSOC);
    }

    public function ObtenerTemporada($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "SELECT  *FROM temporada2 where idtemporada=" . $id . ";")
        or die("No se pudo realizar la consulta");

        return pg_fetch_array($resultado, 0, PGSQL_ASSOC);
    }

    public function ActualizarEmpleado($id, $campos)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "UPDATE empleado2 set nombre='" . $campos['nombre'] . "',primerapellido='" . $campos['primerapellido'] . "',segundoapellido='" . $campos['segundoapellido'] . "',telefono='" . $campos['telefono'] . "',cp='" . $campos['cp'] . "' WHERE  idempleado=" . $id . ";")
        or die("No se pudo realizar la consulta");

        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ActualizarProducto($id, $campos)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "UPDATE productos2 set nombre='" . $campos['nombre'] . "',presentacion='" . $campos['presentacion'] . "',tamaño='" . $campos['tamaño'] . "' WHERE  idproducto=" . $id . ";")
        or die("No se pudo realizar la consulta");

        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ActualizarCTColor($id, $campos)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "UPDATE ct_colores2 set nombre='" . $campos['nombre'] . "',codigocolor='" . $campos['codigocolor'] . "' WHERE  idcolor=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ActualizarEspecialidad($id, $nombre)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "UPDATE especialidadempleado2 set nombre='" . $nombre . "' WHERE  idespecialidad=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ActualizarTurno($id, $nombre)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "UPDATE turnos2 set nombre='" . $nombre . "' WHERE  idturno=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ActualizarTemporada($id, $nombre)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "UPDATE temporada2 set nombre='" . $nombre . "' WHERE  idtemporada=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function DeleteEmpleado($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "DELETE from empleado2 WHERE  idempleado=" . $id . ";")
        or die("No se pudo realizar la consulta");

        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function DeleteProducto($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "DELETE from productos2 WHERE  idproducto=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function EliminarCTColor($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "DELETE from ct_colores2 WHERE  idcolor=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function EliminarESP($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "DELETE from especialidadempleado2 WHERE  idespecialidad=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function EliminarTemporada($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "DELETE from temporada2 WHERE  idtemporada=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function EliminarTurno($id)
    {
        $servidorBD = "127.0.0.1";
        $usuario    = "postgres";
        $clave      = "karlosomar";
        $BD         = "Estetica";
        $enlace     = 0;

        $enlace = pg_connect("host=" . $servidorBD . " port= 5432" . " dbname=" . $BD . " user=" . $usuario . " password=" . $clave)
        or die("Existio un error al intentar conectarse al servidor de base de datos");

        $resultado = pg_exec($enlace, "DELETE from turnos2 WHERE  idturno=" . $id . ";")
        or die("No se pudo realizar la consulta");
        if (pg_affected_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
