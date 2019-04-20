<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Welcome extends CI_Controller
{

    public function llamatabla()
    {
        $this->Login->TablasPostgress();
    }

    public function index()
    {
        $datos['roles'] = $this->M_Mysql->getRoles();
        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('contraseña', 'Contraseña', 'required');
        if ($this->form_validation->run() == true) //Si el formulario es correcto envia los parametos
        {

            $user  = $_POST['usuario'];
            $pass  = $_POST['contraseña'];
            $datos = $this->Login->ingresar($user, $pass);

            $id_usuario = $datos['id_suaurio'];
            $nombre     = $datos['nombre'];
            $rol        = $datos['Rol'];

            if ($nombre == $user) {
                $this->session->set_userdata('id_usuario', $id_usuario);
                $this->session->set_userdata('nombre', $nombre);
                $this->session->set_userdata('rol', $rol);

            } else {
                $this->load->view('error');
                //redirect(base_url());
            }
        }
        $this->load->view('login2', $datos);
        //$this->load->view('index');

    }

    public function home()
    {

        $this->load->view('home');

    }

    public function CHECK()
    {
        $this->Login->status();
        redirect(base_url() . 'index.php/welcome/ETL');
    }

    /////////////////////////////////////////////////////////////

    public function insertarsqldirecto()
    {

        //tintos
        $valores = $this->M_Excel->tablasfaltantes();
        print_r($valores)
;        $datos   = $this->M_Excel->Materiales($valores);
        $valores = $this->M_Excel->getaromas();
        $datos   = $this->M_Excel->Aromas($valores);
        $valores = $this->M_Excel->getServicios();
        $datos   = $this->M_Excel->Servicios($valores);
        $valores = $this->M_Excel->getEmpleadoXMaterial();
        $datos   = $this->M_Excel->EmpleadoxMaterial($valores);
        // romero

               // detalle servicio
    $valores = $this->M_Mysql->detalleservicio();

    foreach ($valores as $valor) {
        $cliente           = $valor['id_cliente'];
        $empleado          = $valor['id_empleado'];
        $servicio          = $valor['id_servicio'];
        $producto          = $valor['id_detalle_producto'];
        $fecha             = $valor['fecha'];
        $duracion          = $valor['duracion'];
        $pago              = $valor['id_forma_pago'];
        $cantidad_producto = $valor['cantidad_producto'];
        $cantidad_servicio = $valor['cantidad_servicio'];
        $total             = $valor['precio'] * $cantidad_servicio;

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO DetalleServicio
    (IdCliente,IdEmpleado,IdServicio,IdProducto,Fecha,Duracion,CantidadServicios,Total,CantidadProducto,IdFormaPago)
    VALUES(" . $cliente . "," . $empleado . "," . $servicio . "," . $producto . ",'" . $fecha . "','" . $duracion . "'," . $cantidad_servicio . "," . $total . "," . $cantidad_producto . "," . $pago . ")");

    }



    // forma de pago
    $pago = $this->M_Mysql->formapago();

    foreach ($pago as $key => $value) {
        $id = $value["id_forma_pago"];
        if ($id == 1) {
            $id          = $value["id_forma_pago"];
            $descripcion = "contado";
            $sqlserver   = $this->load->database('sqlserver', true);
            $query       = $sqlserver->query("INSERT INTO FormaPago
    (IdFormaPago,Descripcion)
    VALUES(" . $id . ",'" . $descripcion . "')");

        } else {
            $id          = $value["id_forma_pago"];
            $descripcion = "credito";
            $sqlserver   = $this->load->database('sqlserver', true);
            $query       = $sqlserver->query("INSERT INTO FormaPago
    (IdFormaPago,Descripcion)
    VALUES(" . $id . ",'" . $descripcion . "')");

        }

    }


     // Mantenimiento

    $mantenimiento = $this->M_Mysql->mantenimiento();

    foreach ($mantenimiento as $key => $value) {
        $id_mantenimiento = $value['id_mantenimiento'];
        $id_empleado      = $value['id_empleado'];
        $id_area          = $value['id_area'];
        $fecha            = date($value['fecha']);
        $hora             = $value['hora'];
        $costo            = $value['costo'];
        $sqlserver        = $this->load->database('sqlserver', true);
        $query            = $sqlserver->query("INSERT INTO Mantenimiento
    (IdMantenimiento,IdEmpleado,IdArea,Fecha,Hora,costo)
    VALUES(" . $id_mantenimiento . "," . $id_empleado . "," . $id_area . ",'" . $fecha . "','" . $hora . "'," . $costo . ")");

    }


    //Merma

    $merma = $this->M_Mysql->merma();
    foreach ($merma as $key => $value) {
        $id_merma    = $value['id_merma'];
        $id_producto = $value['id_producto'];
        $cantidad    = $value['cantidad'];
        $fecha       = date($value['fecha']);
        $sqlserver   = $this->load->database('sqlserver', true);
        $query       = $sqlserver->query("INSERT INTO Merma
    (IdMerma, IdProducto, Cantidad, Fecha)
    VALUES(" . $id_merma . "," . $id_producto . "," . $cantidad . ",'" . $fecha . "')");
    }


     //pedido a proveedor

    $pedido = $this->M_Mysql->pedido();

    foreach ($pedido as $key => $value) {

        $id_pedido    = $value['id_pedido'];
        $id_empleado  = $value['id_empleado'];
        $id_proveedor = $value['id_proveedor'];
        $id_producto  = $value['id_producto'];
        $precio       = $value['precio'];
        $cantidad     = $value['cantidad'];
        $fecha        = date($value['fecha']);
        $status       = $value['status'];

        $sqlserver = $this->load->database('sqlserver', true);
        $query     = $sqlserver->query("INSERT INTO PedidoXProvedor
    (IdPedidoProvedor, IdProducto, IdProvedor,IdEmpleado,Cantidad, Fecha,Precio,Estado)
    VALUES(" . $id_pedido . "," . $id_producto . "," . $id_proveedor . "," . $id_empleado . "," . $cantidad . ",'" . $fecha . "'," . $cantidad . ",'" . $status . "')");

    }

        //DEvolucion
    $devolucion = $this->M_Mysql->devolucion();

    foreach ($devolucion as $key => $value) {
        $id = $value['id_tipo_devolucion'];

        if ($id == 1) {
            $id          = $value["id_tipo_devolucion"];
            $descripcion = "cliente";

            $sqlserver = $this->load->database('sqlserver', true);
            $query     = $sqlserver->query("INSERT INTO TipoDevolucion
    (IdTipoDevolucion,Devuelve)
    VALUES(" . $id . ",'" . $descripcion . "')");

        } else {
            $id          = $value["id_tipo_devolucion"];
            $descripcion = "proveedor";

            $sqlserver = $this->load->database('sqlserver', true);
            $query     = $sqlserver->query("INSERT INTO TipoDevolucion
    (IdTipoDevolucion,Devuelve)
    VALUES(" . $id . ",'" . $descripcion . "')");

        }

    }
////////////////////////////////////////////////////////////////////////


    }

    /////////////////////////////////////////////////////////////
    public function Tablas()
    {

        echo '<div style="width:100%;  margin-top:200px; ">

        <div style="align-items: center; padding-left: 650px">
        <p style="padding-left: 50px; color:white;">Cargando ETL</p>
        <img style="text-aling:center;  width="100" height="100"  src="../../mysql/img/carga1.gif">
        </div>
        <div>';
        $this->load->view('loadin');

        //src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/ab79a231234507.564a1d23814ef.gif

    }

    public function Done()
    {
        $this->Login->Tablas();
        $this->insertarsqldirecto();
        redirect(base_url() . 'index.php/welcome/ETL');

    }

    public function Cerrar_etl()
    {
        $this->Login->Cerrar_etl();
        redirect(base_url() . 'index.php/welcome/ETL');
    }

    public function ETL()
    {
        $id_usuario = $this->session->userdata('id_usuario');
        $status     = $this->Login->check_status($id_usuario);
        $status     = $status['etl'];

        switch ($status) {
            case 0:

                redirect(base_url() . 'index.php/welcome/home');

                break;
            case 1:
                $this->load->view('principal');
                break;
            case 2:
                $this->load->view('principal');
                break;
            case 3:
                $this->load->view('principal');
                break;
            case 4:
                $this->load->view('principal');
                break;

        }
    }

    public function registrar()
    {

        $result = $this->Login->agregar();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);

    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect(base_url());
    }

}
