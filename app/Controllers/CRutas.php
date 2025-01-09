<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloRutas;
use App\Models\ModeloBuses;



class CRutas extends BaseController {

    protected $modeloRutas;
    protected $modeloBuses;

    public function __construct() {
        $this->modeloRutas = new ModeloRutas();
        $this->modeloBuses = new ModeloBuses();
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

        $matriculas = $this->modeloBuses->datosBuses();
        // Click añadir ruta, mostrar formulario
        if ($this->request->getPost('mostrarForm')) {
            // Paso las matriculas que hay en la BD
            return view('v_home', ['matriculasPaRutas' => $matriculas]);
        }
         // Formulario de añadir enviado
         if ($this->request->getPost('GuardarRuta')) {
            // Obtener los datos seleccinados
            $MatriculaSel = $_POST['MatriculaSel'];
            $origen = $_POST['cOrigin'];
            $destino = $_POST['cDestino'];
            $hSalida = $_POST['horaSalida'];
            $hLlegada = $_POST['horaLlegada'];
            $fechaRuta = $_POST['fecha'];
            $tarifa = $_POST['tarifa'];

            $msgErrorAltaRuta = '';
            if ($MatriculaSel == '0') {
                $msgErrorAltaRuta .= 'Deberias seleccionar una matricula! <br>';
            }
            if ($origen == '' || strlen($origen) < 3) {
                $msgErrorAltaRuta .= 'Deberias introducir una ciudad origen valida! <br>';
            }
            if ($destino == '' || strlen($destino) < 3) {
                $msgErrorAltaRuta .= 'Deberias introducir una ciudad destino valida! <br>';
            }
            if (!isset($hSalida)) {
                $msgErrorAltaRuta .= 'Deberias insertar la hora de salida! <br>';
            }
            if (!isset($hLlegada)) {
                $msgErrorAltaRuta .= 'Deberias insertar la hora de llegada! <br>';
            }
            if ($fechaRuta == '') {
                $msgErrorAltaRuta .= 'Deberias insertar la fecha de viaje! <br>';
            }
            if ($tarifa == '') {
                $msgErrorAltaRuta .= 'Deberias defenir una tarifa de viaje! <br>';
            }

            // Según el msg lanzo a la vista
            if ($msgErrorAltaRuta == '') {      // todo ok
                // Insertar en BD
                $insertado = $this->modeloRutas->insertarRuta($MatriculaSel, $origen, $destino, $hSalida, $hLlegada, $tarifa, $fechaRuta);
                if ($insertado) {
                    return view('v_home', ['matriculasPaRutas' => $matriculas,
                                        'msgInfoRuta' => 'Ruta añadida correctamente']);
                } else {
                    return view('v_home', ['matriculasPaRutas' => $matriculas,
                                        'msgErrorRuta' => 'Error al añadir la ruta']);
                }
            } else {
                return view('v_home', ['matriculasPaRutas' => $matriculas,
                                    'msgErrorRuta' => $msgErrorAltaRuta]);
            }
         }







        $datosRutas = $this->modeloRutas->todasRutas();


        return view('v_home', ['datosRutas' => $datosRutas, 
                            'todasCiudades' => $todasCiudades
                            ]);
    }

    
}
