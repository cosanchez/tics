<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Posgrees extends CI_Controller
{

    public function LDEstetica()
    {
        $datos['marcas']      = $this->M_Posgres->GetProductoSQL();
        $datos2['temporadas'] = $this->M_Posgres->GetTemporadasSQL();
        $this->load->view('Posgrees/LDEstetica', $datos + $datos2);
    }

    public function ProductosXMarca($idmarca)
    {
        header('Content-Type: application/json');
        $json = $this->M_Posgres->getProductoXMarca($idmarca);

        echo json_encode($json);
    }

    public function PVXT()
    {
        $nom1  = $_POST['valor1'];
        $nom2  = $_POST['valor2'];
        $nom3  = $_POST['valor3'];
        $datos = $this->M_Posgres->PVXT($nom1, $nom2, $nom3);
        echo json_encode($datos);
    }

    public function CDEstetica()
    {
        $this->load->view('Posgrees/CDEstetica');
    }
    public function Principal()
    {

        $this->load->view('Posgrees/posgrees');
        //$this->load->view('index');
    }

    public function prueba()
    {
        $result = $this->M_Posgres->Prueba2();
        print_r($result);
    }

    public function insertEmpleado()
    {
        $nom  = $_POST['valorCaja1'];
        $nom2 = $_POST['valorCaja2'];

        $aresult = $this->M_Posgres->insertEmpleado($nom, $nom2);
    }
///////////////////////////////////////Insesiones a SQL////////////////////////////////////////////////////////
    public function insertEmpleadoSQL()
    {
        $nom1  = $_POST['valor1'];
        $nom2  = $_POST['valor2'];
        $nom3  = $_POST['valor3'];
        $nom4  = $_POST['valor4'];
        $nom5  = $_POST['valor5'];
        $nom6  = $_POST['valor6'];
        $nom7  = $_POST['valor7'];
        $nom8  = $_POST['valor8'];
        $nom9  = $_POST['valor9'];
        $nom10 = $_POST['valor10'];
        $nom11 = $_POST['valor11'];

        $aresult = $this->M_Posgres->insertEmpleadoSQL($nom1, $nom2, $nom3, $nom4, $nom5, $nom6, $nom7, $nom8, $nom9, $nom10, $nom11);
    }

    public function insertProductoSQL()
    {
        $nom1  = $_POST['valor1'];
        $nom2  = $_POST['valor2'];
        $nom3  = $_POST['valor3'];
        $nom4  = $_POST['valor4'];
        $nom5  = $_POST['valor5'];
        $nom6  = $_POST['valor6'];
        $nom7  = $_POST['valor7'];
        $nom8  = $_POST['valor8'];
        $nom9  = $_POST['valor9'];
        $nom10 = $_POST['valor10'];
        $nom11 = $_POST['valor11'];
        $nom12 = $_POST['valor12'];

        $aresult = $this->M_Posgres->insertProductoSQL($nom1, $nom2, $nom3, $nom4, $nom5, $nom6, $nom7, $nom8, $nom9, $nom10, $nom11, $nom12);
    }

    public function insertCTColorSQL()
    {
        $nom1    = $_POST['valor1'];
        $nom2    = $_POST['valor2'];
        $nom3    = $_POST['valor3'];
        $aresult = $this->M_Posgres->insertCTColoresSQL($nom1, $nom2, $nom3);
    }

    public function insertEspecialidadSQL()
    {
        $nom1    = $_POST['valor1'];
        $nom2    = $_POST['valor2'];
        $aresult = $this->M_Posgres->insertEspecialidadSQL($nom1, $nom2);
    }

    public function insertTurnoSQL()
    {
        $nom1    = $_POST['valor1'];
        $nom2    = $_POST['valor2'];
        $aresult = $this->M_Posgres->insertTurnosSQL($nom1, $nom2);
    }

    public function insertTemporadaSQL()
    {
        $nom1    = $_POST['valor1'];
        $nom2    = $_POST['valor2'];
        $aresult = $this->M_Posgres->insertTemporadasSQL($nom1, $nom2);
    }

    public function ActEmpleadoSQL()
    {
        $id     = $this->input->post('id_empleado');
        $campos = array(
            'Nombre'          => $this->input->post('nombre'),
            'IdTurno'         => $this->input->post('id_turno'),
            'IdEspecialidad'  => $this->input->post('id_especialidad'),
            'PrimerApellido'  => $this->input->post('primerapellido'),
            'SegundoApellido' => $this->input->post('segundoapellido'),
            'Domicilio'       => $this->input->post('id_domicilio'),
            'Telefono'        => $this->input->post('telefono'),
            'Correo'          => $this->input->post('id_correo'),
            'CP'              => $this->input->post('cp'),
            'Sexo'            => $this->input->post('id_sexo'),
        );
        $result = $this->M_Posgres->ActualizarEmpleadoSQL($id, $campos);

        $id2     = $this->input->post('id_empleado');
        $campos2 = array(
            'nombre'          => $this->input->post('nombre'),
            'primerapellido'  => $this->input->post('primerapellido'),
            'segundoapellido' => $this->input->post('segundoapellido'),
            'telefono'        => $this->input->post('telefono'),
            'cp'              => $this->input->post('cp'),
        );
        $result = $this->M_Posgres->ActualizarEmpleado($id2, $campos2);
        echo $result;
    }

    public function ActCTColorSQL()
    {
        $id    = $this->input->post('idcolor');
        $datos = array(
            'CodigoColor' => $this->input->post('nombrectc'),
            'Nombre'      => $this->input->post('codigocolor'),
        );
        $result = $this->M_Posgres->ActualizarCTColorSQL($id, $datos);

        $id2    = $this->input->post('idcolor');
        $campos = array(
            'nombre'      => $this->input->post('nombrectc'),
            'codigocolor' => $this->input->post('codigocolor'),
        );
        $result = $this->M_Posgres->ActualizarCTColor($id2, $campos);
        echo $result;
    }

    public function ActCTEspecialidadSQL()
    {
        $id     = $this->input->post('idespecialidad');
        $nombre = $this->input->post('nomespecialidad');
        $result = $this->M_Posgres->ActualizarEspecialidadSQL($id, $nombre);

        $id2     = $this->input->post('idespecialidad');
        $nombre2 = $this->input->post('nomespecialidad');
        $result  = $this->M_Posgres->ActualizarEspecialidad($id, $nombre);
    }

    public function ActualizarTurnoSQL()
    {
        $id     = $this->input->post('idturno');
        $nombre = $this->input->post('nombreturno');
        $result = $this->M_Posgres->ActualizarTurnoSQL($id, $nombre);

        $id2     = $this->input->post('idturno');
        $nombre2 = $this->input->post('nombreturno');
        $result  = $this->M_Posgres->ActualizarTurno($id, $nombre);
    }

    public function ActualizarTemporadaSQL()
    {
        $id     = $this->input->post('idtemporada');
        $nombre = $this->input->post('nomtemporada');
        $result = $this->M_Posgres->ActualizarTemporadaSQL($id, $nombre);

        $id2     = $this->input->post('idtemporada');
        $nombre2 = $this->input->post('nomtemporada');
        $result  = $this->M_Posgres->ActualizarTemporada($id, $nombre);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function FilasEmpleados()
    {
        $result = $this->M_Posgres->FilasEmpleado();
        echo json_encode($result);
    }

    public function FilasProducto()
    {
        $result = $this->M_Posgres->FilasProducto();
        echo json_encode($result);
    }

    public function FilasCTColores()
    {
        $result = $this->M_Posgres->FilasCTColores();
        echo json_encode($result);
    }

    public function FilasTurnos()
    {
        $result = $this->M_Posgres->FilasTurnos();
        echo json_encode($result);
    }

    public function MostrarEmpleados()
    {
        $result = $this->M_Posgres->MostrarEmpleados();
        //$resultjson = json_encode($result);
        //echo "myjson " . $resultjson;
        //echo $resultjson;
        echo json_encode($result);
    }

    public function MostrarProdcutos()
    {
        $result = $this->M_Posgres->MostrarProdcutos();
        echo json_encode($result);
    }

    public function MostrarCtColores()
    {
        $result = $this->M_Posgres->MostrarCtColores();
        echo json_encode($result);
    }

    public function MostrarTurnos()
    {
        $result = $this->M_Posgres->MostrarTurnos();
        echo json_encode($result);
    }

    public function MostrarEspecialidad()
    {
        $result = $this->M_Posgres->MostrarEspe();
        echo json_encode($result);
    }

    public function MostrarTemporada()
    {
        $result = $this->M_Posgres->MostrarTemporadas();
        echo json_encode($result);
    }

    public function MostrarEmpleado()
    {
        $id     = $this->input->get('idempleado');
        $result = $this->M_Posgres->ObtenerEmpleado($id);

        echo json_encode($result);
    }

    public function MostrarProducto()
    {
        $id     = $this->input->get('idproducto');
        $result = $this->M_Posgres->ObtenerProducto($id);

        echo json_encode($result);
    }

    public function MostrarCTColor()
    {
        $id     = $this->input->get('idcolor');
        $result = $this->M_Posgres->ObtenerCTColor($id);

        echo json_encode($result);
    }
    public function MostrarTurno()
    {
        $id     = $this->input->get('idturno');
        $result = $this->M_Posgres->ObtenerTurno($id);
        //print_r($result);
        echo json_encode($result);
    }

    public function MostrarEsp()
    {
        $id     = $this->input->get('idespecialidad');
        $result = $this->M_Posgres->ObtenerEsp($id);
        //print_r($result);
        echo json_encode($result);
    }

    public function MostrarTemp()
    {
        $id     = $this->input->get('idtemporada');
        $result = $this->M_Posgres->ObtenerTemporada($id);
        //print_r($result);
        echo json_encode($result);
    }

    public function ActualizarEmpleado()
    {
        $id     = $this->input->post('id_empleado');
        $campos = array(
            'nombre'          => $this->input->post('nombre'),
            'primerapellido'  => $this->input->post('primerapellido'),
            'segundoapellido' => $this->input->post('segundoapellido'),
            'telefono'        => $this->input->post('telefono'),
            'cp'              => $this->input->post('cp'),
        );
        $result = $this->M_Posgres->ActualizarEmpleado($id, $campos);
        echo $result;

    }

    public function ActualizarCTColor()
    {
        $id     = $this->input->post('idcolor');
        $campos = array(
            'nombre'      => $this->input->post('nombrectc'),
            'codigocolor' => $this->input->post('codigocolor'),
        );
        $result = $this->M_Posgres->ActualizarCTColor($id, $campos);
        echo $result;
    }

    public function ActualizarEspecialidad()
    {
        $id2     = $this->input->post('idespecialidad');
        $nombre2 = $this->input->post('nomespecialidad');
        $result  = $this->M_Posgres->ActualizarEspecialidad($id2, $nombre2);
    }

    public function ActualizarProducto()
    {
        $id     = $this->input->post('idproducto');
        $campos = array(
            'nombre'       => $this->input->post('nombrep'),
            'presentacion' => $this->input->post('presentaciop'),
            'tamaño'       => $this->input->post('tamanop'),
        );
        $result = $this->M_Posgres->ActualizarProducto($id, $campos);
        echo $result;
    }

    public function EliminarEmpleado()
    {

        $id             = $this->input->get('idempleado');
        $result         = $this->M_Posgres->DeleteEmpleado($id);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function EliminarProducto()
    {
        $id             = $this->input->get('idproducto');
        $result         = $this->M_Posgres->DeleteProducto($id);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function EliminarCTColor()
    {
        $id             = $this->input->get('idcolor');
        $result         = $this->M_Posgres->EliminarCTColor($id);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function EliminarESP()
    {
        $id             = $this->input->get('idespecialidad');
        $result         = $this->M_Posgres->EliminarESP($id);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    public function EliminarTemporada()
    {
        $id             = $this->input->get('idtemporada');
        $result         = $this->M_Posgres->EliminarTemporada($id);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    public function EliminarTurno()
    {
        $id             = $this->input->get('idturno');
        $result         = $this->M_Posgres->EliminarTurno($id);
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

}
