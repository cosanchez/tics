<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');

}
class Mysql extends CI_Controller
{

    public function LDSpa()
    {
        $datos['servicios'] = $this->M_Mysql->GetServiciosSQL();
        $datos2['anos']     = $this->M_Mysql->GetAñosSQL();
        $this->load->view('Mysql/LDSpa', $datos + $datos2);
    }

    public function CVXA()
    {
        $nom2  = $_POST['valor2'];
        $nom3  = $_POST['valor3'];
        $datos = $this->M_Mysql->CVXA($nom3, $nom2);
        echo json_encode($datos);
    }
    public function CVXAnterior()
    {
        $nom2   = $_POST['valor2'];
        $nom3   = $_POST['valor3'];
        $ante   = $nom3 - 1;
        $datos2 = $this->M_Mysql->CVXAnterior($ante, $nom2);
        echo json_encode($datos2);
    }
    public function CDSpa()
    {
        $this->load->view('Mysql/CDSpa');
    }
    public function clientes()
    {
        $resultado = $this->M_Mysql->clientes();
        print_r($resultado);
    }
    public function Pinsert()
    {
        $nom     = $_POST['valorCaja1'];
        $nom2    = $_POST['valorCaja2'];
        $aresult = $this->M_Mysql->metedatos($nom, $nom2);

    }

    public function MostrarAgenda()
    {
        $result = $this->M_Mysql->MostrarAgenda();
        echo json_encode($result);
    }

    public function EditarAgenda()
    {
        $result = $this->M_Mysql->EditarAgenda();
        echo json_encode($result);
    }

    public function ActualizarAgenda()
    {
        $result         = $this->M_Mysql->ActualizarAgenda();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function DeleteAgenda()
    {
        $result         = $this->M_Mysql->DeleteAgenda();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function MostrarClientes()
    {

        $result = $this->M_Mysql->MostrarClientes();
        echo json_encode($result);
    }

    public function Editarcliente()
    {
        $result = $this->M_Mysql->Editarcliente();
        echo json_encode($result);
    }

    public function ActualizarCliente()
    {
        $result         = $this->M_Mysql->ActualizarCliente();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function DeleteCliente()
    {
        $result         = $this->M_Mysql->DeleteCliente();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function MostrarCompras()
    {
        $result = $this->M_Mysql->MostrarCompras();
        echo json_encode($result);
    }

    public function EditarCompras()
    {
        $result = $this->M_Mysql->EditarCompras();
        echo json_encode($result);
    }

    public function ActualizarCompras()
    {
        $result         = $this->M_Mysql->ActualizarCompras();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function DeleteCompras()
    {
        $result         = $this->M_Mysql->DeleteCompras();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function MostrarProveedores()
    {
        $result = $this->M_Mysql->MostrarProveedores();
        echo json_encode($result);
    }

    public function EditarProveedor()
    {
        $result = $this->M_Mysql->EditarProveedor();
        echo json_encode($result);
    }

    public function ActualizarProveedores()
    {
        $result         = $this->M_Mysql->ActualizarProveedores();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function DeleteProveedores()
    {
        $result         = $this->M_Mysql->DeleteProveedores();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function MostrarVentas()
    {
        $result = $this->M_Mysql->MostrarVetas();
        echo json_encode($result);
    }
    public function EditarVentas()
    {
        $result = $this->M_Mysql->EditarVentas();
        echo json_encode($result);
    }

    public function ActualizarVentas()
    {
        $result         = $this->M_Mysql->ActualizarVentas();
        $msg['success'] = false;
        $msg['type']    = 'update';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function DeleteVentas()
    {
        $result         = $this->M_Mysql->DeleteVentas();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function SQLClientes()
    {

        $result = $this->M_Mysql->SQLClientes();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function SQLAgenda()
    {

        $result         = $this->M_Mysql->SQLAgenda();
        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function SQLCompras()
    {

        $result = $this->M_Mysql->SQLCompras();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function SQLProveedor()
    {

        $result = $this->M_Mysql->SQLProveedor();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function SQLVentas()
    {

        $result = $this->M_Mysql->SQLVentas();

        $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

///////////////////////////////
    //Elimina los refistros de clientes
    function deleteclientes(){
         $result = $this->M_Mysql->deleteclientes();
         $msg['success'] = false;
        $msg['type']    = 'add';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    } 

}
