<?php
class M_Mysql extends CI_Model
{
//////////////////////////////////////////////////////////////////////////////////////////////////
    public function GetServiciosSQL()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT *from Servicio")->result_array();
    }

    public function GetAñosSQL()
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT YEAR(Fecha) as ano from DetalleServicio
            group by YEAR(Fecha)")->result_array();
    }

    public function CVXA($nom3, $nom2)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT (  (sum(ds.CantidadServicios)*s.Costo)) as total, s.Nombre
  from DetalleServicio ds   join Servicio s on ds.IdServicio=s.IdServicio
  join Productos p on ds.idProducto=p.IdProducto
  where YEAR(ds.Fecha)=" . $nom3 . " and  p.IdTemporada=" . $nom2 . "
  group by s.IdServicio,s.Costo,s.Nombre,p.CostoCompra
  order by s.IdServicio")->result_array();
    }
    public function CVXAnterior($ante, $nom2)
    {
        $resultado    = $this->load->database('sqlserver', true);
        return $query = $resultado->query("SELECT (  (sum(ds.CantidadServicios)*s.Costo)) as total, s.Nombre
  from DetalleServicio ds   join Servicio s on ds.IdServicio=s.IdServicio
  join Productos p on ds.idProducto=p.IdProducto
  where YEAR(ds.Fecha)=" . $ante . " and  p.IdTemporada=" . $nom2 . "
  group by s.IdServicio,s.Costo,s.Nombre,p.CostoCompra
  order by s.IdServicio")->result_array();
    }

//////////////////////////////////////////////////////////////////////////////////////////////////
    public function metedatos($nom, $nom2)
    {

        $resultado = $this->load->database('sqlserver', true);

        return $query = $resultado->query("INSERT into prueba1 (Nombre,apellido) values('" . $nom . "','" . $nom2 . "')");

    }

    public function getRoles()
    {
        $this->db->order_by('IdRol', 'asc');
        $aResult = $this->db->get('roles');

        return $aResult->result_array();
    }

    public function clientes()
    {
        //funciones que trae los clientes de sql
        $sqlserver    = $this->load->database('sqlserver', true);
        return $query = $sqlserver->query('SELECT *FROM clientes')->result_array();
    }

    public function SQLClientes()
    {

        $mysql['Nombre']          = $_POST['Nombre'];
        $mysql['PrimerApellido']  = $_POST['PrimerApellido'];
        $mysql['SegundoApellido'] = $_POST['SegundoApellido'];
        $mysql['Direccion']       = $_POST['Direccion'];
        $mysql['Correo']          = $_POST['Correo'];
        $mysql['Telefono']        = $_POST['Telefono'];
        $mysql['Cp']              = $_POST['Cp'];
        $mysql['Sexo']            = $_POST['sexo'];

        $id_cliente      = $_POST['id_cliente'];
        $Nombre          = $_POST['Nombre'];
        $PrimerApellido  = $_POST['PrimerApellido'];
        $SegundoApellido = $_POST['SegundoApellido'];
        $Direccion       = $_POST['Direccion'];
        $Correo          = $_POST['Correo'];
        $Telefono        = $_POST['Telefono'];
        $Cp              = $_POST['Cp'];
        $sexo            = $_POST['sexo'];

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Cliente
    (IdCliente,Nombre,PrimerApellido,SegundoApellido,Direccion,Correo,Telefono,Cp,Sexo)
    VALUES(" . $id_cliente . ",'" . $Nombre . "','" . $PrimerApellido . "','" . $SegundoApellido . "','" . $Direccion . "','" . $Correo . "'," . $Telefono . "," . $Cp . ",'" . $sexo . "')");

        $this->db->where('id_cliente', $id_cliente);
        $this->db->update('clientes', $mysql);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function SQLAgenda()
    {

        $mysql['id_cliente']  = $_POST['id_cliente'];
        $mysql['id_empleado'] = $_POST['id_empleado'];
        $mysql['id_servicio'] = $_POST['id_servicio'];
        $mysql['Status']      = $_POST['Status'];
        $mysql['Hora']        = $_POST['Hora'];
        $mysql['Fecha']       = $_POST['Fecha'];

        $id_Agenda   = $_POST['id_Agenda'];
        $id_cliente  = $_POST['id_cliente'];
        $id_empleado = $_POST['id_empleado'];
        $id_servicio = $_POST['id_servicio'];
        $Status      = $_POST['Status'];
        $Hora        = $_POST['Hora'];
        $Fecha       = date($_POST['Fecha']);

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Agenda
    (IdAgenda,Fecha, Hora, IdCliente, IdEmpleado,IdServicio,Estado)
    VALUES(" . $id_Agenda . ",'" . $Fecha . "','" . $Hora . "'," . $id_cliente . "," . $id_empleado . "," . $id_servicio . ",'" . $Status . "')");

        $this->db->where('id_Agenda', $id_Agenda);
        $this->db->update('agenda', $mysql);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function SQLCompras()
    {

        $mysql['id_pedido'] = $_POST['id_pedido'];
        $mysql['monto']     = $_POST['monto'];
        $mysql['fecha']     = $_POST['fecha'];

        $id_compras = $_POST['id_compras'];
        $id_pedido  = $_POST['id_pedido'];
        $monto      = $_POST['monto'];
        $fecha      = date($_POST['fecha']);

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Compras
    (IdCompras,IdPedido, MontoTotal,Fechas)
    VALUES(" . $id_compras . "," . $id_pedido . "," . $monto . ",'" . $fecha . "')");

        $this->db->where('id_compras', $id_compras);
        $this->db->update('compras', $mysql);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function SQLProveedor()
    {

        $mysql['nombre']    = $_POST['nombre'];
        $mysql['direccion'] = $_POST['direccion'];
        $mysql['telefono']  = $_POST['telefono'];
        $mysql['cp']        = $_POST['cp'];

        $id_proveedor = $_POST['id_proveedor'];
        $nombre       = $_POST['nombre'];
        $direccion    = $_POST['direccion'];
        $telefono     = $_POST['telefono'];
        $cp           = $_POST['cp'];

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Provedores
    (IdProvedor,Nombre, Direccion,telefono,CP)
    VALUES(" . $id_proveedor . ",'" . $nombre . "','" . $direccion . "'," . $telefono . "," . $cp . ")");
        $this->db->where('id_proveedor', $id_proveedor);
        $this->db->update('proveedores', $mysql);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function SQLVentas()
    {

        $mysql['id_producto']   = $_POST['id_producto'];
        $mysql['id_empleado']   = $_POST['id_empleado'];
        $mysql['id_cliente']    = $_POST['id_cliente'];
        $mysql['cantidad']      = $_POST['cantidad'];
        $mysql['hora']          = $_POST['hora'];
        $mysql['fecha']         = $_POST['fecha'];
        $mysql['id_forma_pago'] = $_POST['id_forma_pago'];

        $id_venta      = $_POST['id_venta'];
        $id_producto   = $_POST['id_producto'];
        $id_empleado   = $_POST['id_empleado'];
        $id_cliente    = $_POST['id_cliente'];
        $cantidad      = $_POST['cantidad'];
        $hora          = $_POST['hora'];
        $fecha         = date($_POST['fecha']);
        $id_forma_pago = $_POST['id_forma_pago'];

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO Ventas
    (IdVenta,IdCliente, IdEmpleado, IdFormaPago, IdProducto,Cantidad,Fecha,Hora)
    VALUES(" . $id_venta . "," . $id_cliente . "," . $id_empleado . "," . $id_forma_pago . "," . $id_producto . ", " . $cantidad . ", '" . $fecha . "','" . $hora . "')");

        $this->db->where('id_venta', $id_venta);
        $this->db->update('ventas', $mysql);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function MostrarAgenda()
    {

        $query = $this->db->query("SELECT A.id_Agenda,A.id_cliente, A.id_empleado,A.id_servicio, A.Hora,A.Fecha, C.Nombre, C.PrimerApellido, E.nombre_E, E.PrimerApellido_E, S.nombre,A.Status FROM agenda A join clientes C on A.id_cliente=C.id_cliente join empleados E on A.id_empleado=E.id_empleado join servicios S on A.id_servicio=S.id_servicio");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

/*
function FilasAgenda(){

$query =$this->db->query("SELECT * FROM agenda  where Status!='pendiente' and Status!='realizado' and Status!='cancelado' ");

if($query->num_rows() > 0)
{
return $query->num_rows();
}

}
 */
    public function EditarAgenda()
    {
        $id_agenda = $this->input->get('id_agenda');
        $query     = $this->db->query("SELECT A.Fecha, A.id_agenda, C.Nombre, C.PrimerApellido, E.nombre_E, E.PrimerApellido_E, S.nombre,A.Status, S.id_servicio FROM agenda A join clientes C on A.id_cliente=C.id_cliente join empleados E on A.id_empleado=E.id_empleado join servicios S on A.id_servicio=S.id_servicio where id_agenda='$id_agenda' ");

        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        } else {
            return false;
        }
    }
    public function ActualizarAgenda()
    {
        $id_agenda   = $this->input->post('id_agenda');
        $id_servicio = $this->input->post('id_servicio');
        $campos      = array(
            'Status' => $this->input->post('status'),
        );

        $this->db->where('id_agenda', $id_agenda);
        $this->db->update('agenda', $campos);

        $campos2 = array(
            'nombre' => $this->input->post('servicio'),
        );

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

        $this->db->where('id_servicio', $id_servicio);
        $this->db->update('servicios', $campos2);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function DeleteAgenda()
    {
        $id_agenda = $this->input->get('id_agenda');
        $this->db->where('id_agenda', $id_agenda);
        $this->db->delete('agenda');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function MostrarClientes()
    {

        $query = $this->db->query("SELECT * FROM clientes");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
/*
function FilasClientes(){

$query =$this->db->query("SELECT id_cliente, Nombre, PrimerApellido, SegundoApellido, Telefono, Cp FROM clientes where telefono REGEXP '[a-z]' OR LENGTH (Telefono) != (10) OR Cp REGEXP '[a-z]' OR Cp='' OR LENGTH (Cp) != (5) OR PrimerApellido REGEXP '[0-9]' OR SegundoApellido REGEXP '[0-9]'OR PrimerApellido REGEXP '[áéíóú]' OR SegundoApellido REGEXP '[áéíóú]' OR Nombre REGEXP '[0-9]' OR Nombre  REGEXP '[áéíóú]'  ");

if ($query->num_rows() > 0){
return $query->num_rows();
}
}

 */
    public function Editarcliente()
    {
        $id_cliente = $this->input->get('id_cliente');
        $query      = $this->db->query("SELECT id_cliente, Nombre, PrimerApellido, SegundoApellido, Telefono, Cp FROM clientes where id_cliente='$id_cliente' ");

        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        } else {
            return false;
        }

    }
    public function ActualizarCliente()
    {
        $id_cliente = $this->input->post('id_cliente');
        $campos     = array(
            'Nombre'          => $this->input->post('nombre'),
            'PrimerApellido'  => $this->input->post('primerapellido'),
            'SegundoApellido' => $this->input->post('segundoapellido'),
            'Telefono'        => $this->input->post('telefono'),
            'Cp'              => $this->input->post('cp'),
        );
        $this->db->where('id_cliente', $id_cliente);
        $this->db->update('clientes', $campos);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function DeleteCliente()
    {
        $id_cliente = $this->input->get('id_cliente');
        $this->db->where('id_cliente', $id_cliente);
        $this->db->delete('clientes');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function MostrarCompras()
    {

        $query = $this->db->query("SELECT C.id_compras, C.id_pedido,E.nombre_E, E.PrimerApellido_E, C.monto, C.fecha FROM compras C join pedido_proveedor P on C.id_pedido=P.id_pedido join empleados E on P.id_empleado=E.id_empleado");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }
/*
function FilasCompras(){

$query =$this->db->query("SELECT C.id_pedido,E.nombre_E, C.monto, C.fecha FROM compras C join pedido_proveedor P on C.id_pedido=P.id_pedido join empleados E on P.id_empleado=E.id_empleado where monto<=0 ");

if($query->num_rows() > 0)
{
return $query->num_rows();
}

}*/

    public function EditarCompras()
    {

        $id_compras = $this->input->get('id_compras');
        $query      = $this->db->query("SELECT C.id_compras, C.id_pedido,E.nombre_E, E.PrimerApellido_E, C.monto, C.fecha FROM compras C join pedido_proveedor P on C.id_pedido=P.id_pedido join empleados E on P.id_empleado=E.id_empleado where id_compras='$id_compras'");

        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        } else {
            return false;
        }

    }
    public function ActualizarCompras()
    {

        $id_compras = $this->input->post('id_compras');
        $monto      = $this->input->post('monto');

        $campos = array('monto' => $this->input->post('monto'));

        $this->db->where('id_compras', $id_compras);
        $this->db->update('compras', $campos);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function DeleteCompras()
    {
        $id_compras = $this->input->get('id_compras');
        $this->db->where('id_compras', $id_compras);
        $this->db->delete('compras');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function MostrarProveedores()
    {
        $query = $this->db->query("SELECT * FROM proveedores");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

/*
function FilasProveedores(){

$query =$this->db->query("SELECT * FROM proveedores  where nombre REGEXP '[0-9]' OR nombre REGEXP  '[´?/*_-]' OR nombre REGEXP '[.,:;!ç]'  OR nombre REGEXP '[<>º¿=(&]'   OR nombre REGEXP '[@)~¬^|]' OR nombre REGEXP '[%$#!¡]' OR nombre='' OR telefono REGEXP '[a-z]' OR LENGTH (Telefono) != (10) OR Cp REGEXP '[a-z]' OR Cp='' OR LENGTH (Cp) != (5)");

if($query->num_rows() > 0)
{
return $query->num_rows();
}

}
 */
    public function EditarProveedor()
    {

        $id_proveedor = $this->input->get('id_proveedor');
        $query        = $this->db->query("SELECT id_proveedor, nombre, direccion, telefono, cp FROM proveedores where id_proveedor='$id_proveedor' ");

        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        } else {
            return false;
        }

    }

    public function ActualizarProveedores()
    {
        $id_proveedor = $this->input->post('id_proveedor');
        $campos       = array(
            'nombre'   => $this->input->post('proveedor'),
            'telefono' => $this->input->post('telefono'),
            'cp'       => $this->input->post('cp'),
        );
        $this->db->where('id_proveedor', $id_proveedor);
        $this->db->update('proveedores', $campos);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function DeleteProveedores()
    {
        $id_proveedor = $this->input->get('id_proveedor');
        $this->db->where('id_proveedor', $id_proveedor);
        $this->db->delete('proveedores');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
/*
function FilasVentas(){

$query =$this->db->query("SELECT * FROM ventas V join productos P on V.id_producto = P.id_producto join empleados E on V.id_empleado=E.id_empleado join clientes C on C.id_cliente=V.id_cliente where V.cantidad <= 0 OR V.fecha='' OR V.fecha REGEXP '[a-z]' OR LENGTH (V.fecha) !=(10)");

if($query->num_rows() > 0)
{
return $query->num_rows();
}
//([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))
}
 */
    public function MostrarVetas()
    {

        $query = $this->db->query("SELECT * FROM ventas V join productos P on V.id_producto = P.id_producto join empleados E on V.id_empleado=E.id_empleado join clientes C on C.id_cliente=V.id_cliente  ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function EditarVentas()
    {
        $id_venta = $this->input->get('id_venta');
        $query    = $this->db->query("SELECT V.id_venta, P.nombre, E.nombre_E, E.PrimerApellido_E, C.Nombre, C.PrimerApellido, V.cantidad, V.fecha FROM ventas V join productos P on V.id_producto = P.id_producto join empleados E on V.id_empleado=E.id_empleado join clientes C on C.id_cliente=V.id_cliente where id_venta='$id_venta' ");

        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        } else {
            return false;
        }
    }

    public function ActualizarVentas()
    {
        $id_venta = $this->input->post('id_venta');

        $campos = array('fecha' => $this->input->post('fecha'), 'cantidad' => $this->input->post('cantidad'));

        $this->db->where('id_venta', $id_venta);
        $this->db->update('ventas', $campos);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function DeleteVentas()
    {
        $id_ventas = $this->input->get('id_ventas');
        $this->db->where('id_venta', $id_ventas);
        $this->db->delete('ventas');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function detalleservicio()
    {

        //detalle servicio
        $query = $this->db->query("SELECT D.id_cliente,D.id_empleado,D.id_servicio,D.id_detalle_producto,D.duracion,D.fecha,D.id_forma_pago, D.cantidad_servicio,D.cantidad_producto, S.precio FROM  detalle_servicio D  join servicios S on  D.id_servicio=S.id_servicio");
        return $query->result_array();

    }

    public function formapago()
    {
        $query = $this->db->get("forma_pago");
        return $query->result_array();

    }

    public function mantenimiento()
    {
        $query = $this->db->get("mantenimiento");
        return $query->result_array();
    }

    public function merma()
    {
        $query = $this->db->get("merma");
        return $query->result_array();
    }

    public function pedido()
    {
        $query = $this->db->get("pedido_proveedor");
        return $query->result_array();
    }

    public function devolucion()
    {
        $query = $this->db->get("tipo_devolucion");
        return $query->result_array();
    }

    function deleteclientes(){
    $id=$_POST['id_cliente'];
    $this->db->where('id_cliente',$id);
    $this->db->delete('clientes');
     if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
