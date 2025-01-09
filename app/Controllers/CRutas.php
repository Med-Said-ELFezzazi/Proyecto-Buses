<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloRutas;


class CRutas extends BaseController {

    protected $modeloRutas;

    public function __construct() {
        $this->modeloRutas = new ModeloRutas();
    }


    public function gestionRutas() {
        $todasCiudades = $this->modeloRutas->todasCiudades();

        // Busqueda con filtros, obtner datos
        $matricula = '';
        $ciudad = '';
        $h_salida = '';
        $h_llegada = '';
        $fecha = '';
        $tarifaMin = '';
        $tarifaMax = '';
        $datosFiltrados = [];
        if ($this->request->getPost('aplicarFiltros')) {
            // Obtener los datos selecccionados
            $matricula = $_POST['matriculaRuta'];
            $ciudad = $_POST['CiudadSel'];
            $h_salida = $_POST['horaSalida'];
            $h_llegada = $_POST['horaLlegada'];
            $fecha = $_POST['fechaRuta'];
            $tarifaMin = $_POST['tarifaMinRuta'];
            $tarifaMax = $_POST['tarifaMaxRuta'];

            // Hago la busqueda en BD
            $datosFiltradosRutas = $this->modeloRutas->datosRutasFiltrados($matricula, $ciudad, $h_salida, $h_llegada, $fecha, $tarifaMin, $tarifaMax);

            return view('v_home', ['datosFiltradosRutas' => $datosFiltradosRutas,
                                    'todasCiudades' => $todasCiudades]);
        }





        // Click añadir ruta
        // if ($this->request->getPost('mostrarForm')) {
        //     // Cargar la vista
        //     return view('v_home', ['']);
        // }


        $datosRutas = $this->modeloRutas->todasRutas();


        return view('v_home', ['datosRutas' => $datosRutas, 
                            'todasCiudades' => $todasCiudades
                            ]);
    }

    
}
