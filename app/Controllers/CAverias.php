<?php

namespace App\Controllers;

use App\Models\ModeloAverias;
// use App\Models\ModeloBuses;
// use stdClass;

class CAverias extends BaseController {

    // protected $modeloBuses;
    protected $modeloAverias;

    public function __construct()
    {
        // $this->modeloBuses = new ModeloBuses();
        $this->modeloAverias = new ModeloAverias();
    }


    // Función para mostrar los datos de averias
    public function gestionAverias() {
        $matricula = '';
        $estado = '';   //str
        $costeMin = '';     //str
        $costeMax = '';     //str
        $fecha = '';    //string(10) "2025-01-31
        $datosFiltrados = [];
        if ($this->request->getPost('aplicarFiltros')) {
            // Obtener los datos selecccionados
            $matricula = $_POST['matriculaAveria'];
            $estado= $_POST['estadoAveria'] ?? '';
            $fecha = $_POST['fechaAveria'];
            
            $costeMin = $_POST['costeMinAveria'];
            $costeMax = $_POST['costeMaxAveria'];

            // Hago la busqueda en BD
            $datosFiltrados = $this->modeloAverias->datosAveriasFiltrados($matricula, $fecha, $costeMin, $costeMax, $estado);

            return view('v_home', ['datosFiltrados' => $datosFiltrados]);
        }
        
        $datosAverias = $this->modeloAverias->datosAverias();

        return view('v_home', ['datosAverias' => $datosAverias]);
    }

}
