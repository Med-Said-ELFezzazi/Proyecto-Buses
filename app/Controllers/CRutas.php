<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloRutas;
use App\Models\ModeloBuses;
use App\Models\ModeloReservas;



class CRutas extends BaseController {

    protected $modeloRutas;
    protected $modeloBuses;
    protected $modeloReservas;

    public function __construct() {
        $this->modeloRutas = new ModeloRutas();
        $this->modeloBuses = new ModeloBuses();
        $this->modeloReservas = new ModeloReservas();
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
            // Comprobar si las 2 ciudades iguales
            if ($origen == $destino) {
                $msgErrorAltaRuta .= 'La ciudad origen y destino no pueden ser iguales! <br>';
            }
            if (!isset($hSalida)) {
                $msgErrorAltaRuta .= 'Deberias insertar la hora de salida! <br>';
            }
            if (!isset($hLlegada)) {
                $msgErrorAltaRuta .= 'Deberias insertar la hora de llegada! <br>';
            }
            // Comprabar si la hora de salida es menor que la hora de llegada
            if ($hSalida > $hLlegada) {
                $msgErrorAltaRuta .= 'La hora de salida no puede ser mayor que la hora de llegada!';
            }
            if ($fechaRuta == '') {
                $msgErrorAltaRuta .= 'Deberias insertar la fecha de viaje! <br>';
            }
            if ($tarifa == '') {
                $msgErrorAltaRuta .= 'Deberias defenir una tarifa de viaje! <br>';
            }

            // Según el msg lanzo a la vista
            if ($msgErrorAltaRuta == '') {      // todo ok
                // Comprobar si el bus ya tiene asignada un ruta en la misma fech-hora
                $busExiste = $this->modeloRutas->comprobarMatriculaExiste($MatriculaSel, $fechaRuta, $hSalida);
                if ($busExiste) {
                    return view('v_home', ['matriculasPaRutas' => $matriculas,
                                        'msgErrorRuta' => 'El bus ya tiene una ruta asignada con la fecha y la hora elegida!']);
                } else {
                    // Insertar en BD
                    $insertado = $this->modeloRutas->insertarRuta($MatriculaSel, $origen, $destino, $hSalida, $hLlegada, $tarifa, $fechaRuta);
                    if ($insertado) {
                        return view('v_home', ['matriculasPaRutas' => $matriculas,
                                            'msgInfoRuta' => 'Ruta añadida correctamente']);
                    } else {
                        return view('v_home', ['matriculasPaRutas' => $matriculas,
                                            'msgErrorRuta' => 'Error al añadir la ruta']);
                    }
                }

            } else {
                return view('v_home', ['matriculasPaRutas' => $matriculas,
                                    'msgErrorRuta' => $msgErrorAltaRuta]);
            }
         }

         $datosRutas = $this->modeloRutas->todasRutas();
         // Eliminación de ruta
         if ($this->request->getPost('id_rutaBorrar')){
            // id_ruta a eliminar
            $id_ruta = $_POST['id_rutaBorrar'];
            // Eliminar las reservas de ruta
            $this->modeloReservas->eliminarReservasRuta($id_ruta);
            // Eliminar de la ruta
            $eliminado = $this->modeloRutas->eliminarRuta($id_ruta);
            return view('v_home', ['datosRutas' => $datosRutas,
                                    'eliminacionRuta' => $eliminado,
                                    'todasCiudades' => $todasCiudades]);
         }

        return view('v_home', ['datosRutas' => $datosRutas, 
                            'todasCiudades' => $todasCiudades
                            ]);
    }


    // Función que lanza la vista para modificar una ruta
    public function modificarRuta($id_ruta) {
        // Obtener la ruta que se va a modificar
        $ruta = $this->modeloRutas->dameDatosRuta($id_ruta);
        $matriculas = $this->modeloBuses->datosBuses(); // PAra cargar dropdown

        // AL click actualizar ruta
        if ($this->request->getPost('actualizarRuta')) {
             // Obtener los datos actualizados
             $MatriculaSel = $_POST['MatriculaSel'];
             $origen = $_POST['cOrigen'];
             $destino = $_POST['cDestino']; 
             $hSalida = $_POST['horaSalida'];
             $hLlegada = $_POST['horaLlegada'];
             $fecha = $_POST['fecha'];
             $tarifa = $_POST['tarifa'];

             // Comprobar datos insertados
             $msgErrModRuta = '';
            if ($MatriculaSel == '0') {
                $msgErrModRuta .= 'Deberias seleccionar una matricula! <br>';
            }
            if ($origen == '') {
                $msgErrModRuta .= 'Deberias introducir el origen! <br>';
            }
            if ($destino == '') {
                $msgErrModRuta .= 'Deberias introducir el destino! <br>';
            }
            if ($destino = $origen) {
                $msgErrModRuta .= 'El origen y el destino no pueden ser iguales!';
            }
            if ($hSalida == '') {
                $msgErrModRuta .= 'Deberias introducir la hora de salida!';
            }
            if ($hLlegada == '') {
                $msgErrModRuta .= 'Deberias introducir la hora de llegada!';
            }
            if ($hLlegada < $hSalida) {
                $msgErrModRuta .= 'La hora de llegada no puede ser menor que la hora de salida!';
            }
            // Si la fecha insertada es menor que la fecha actual
            if ($fecha < date('Y-m-d')) {
                $msgErrModRuta .= 'La fecha no puede ser menor que la fecha actual!';
            }
            // Si la fecha es de hoy y la hora de salida menor que la hora actual
            if ($fecha == date('Y-m-d') && $hSalida < date('H:i')) {
                $msgErrModRuta .= 'La hora de salida no puede ser menor que la hora actual!';
            }
            if ($tarifa == '' || $tarifa <= 0) {
                $msgErrModRuta .= 'La tarifa no puede ser menor o igual a 0!';
            }

            if ($msgErrModRuta == '') {
                // Comprobar si el bus elegido ya tiene asignado una ruta en la fecha-hora elegidas
                $rutaExiste = $this->modeloBuses->comprobarMatriculaExiste($MatriculaSel, $fecha, $hSalida);
                if ($rutaExiste) {
                    return view('v_home', ['matriculas' => $matriculas,
                                            'rutaAmodificar' => $ruta,
                                            'msgInfoRuta' => 'El bus con la matricula: '.$MatriculaSel.
                                            ' ya tiene asignada una ruta en la fecha y la hora selecciondas!']);
                } else {
                    // Actualizar en BD
                    $actualizado = $this->modeloRutas->actualizarRuta($id_ruta, $MatriculaSel, $origen, $destino,
                     $hSalida, $hLlegada, $tarifa, $fecha);
                     if ($actualizado) {
                        $rutaActualizada = $this->modeloRutas->dameDatosRuta($id_ruta);
                        return view('v_home', ['matriculas' => $matriculas,
                                                'rutaAmodificar' => $rutaActualizada,
                                                'msgInfoRuta' => 'Ruta actualizada correctamente']);
                    } else {
                        return view('v_home', ['matriculas' => $matriculas,
                                                'rutaAmodificar' => $ruta,
                                                'msgInfoRuta' => 'Error al actualizar la ruta']);
                    }
                }
            } else {
                return view('v_home', ['matriculas' => $matriculas,
                                    'rutaAmodificar' => $ruta,
                                    'msgErrorRuta' => $msgErrModRuta]);
            }
        }

        return view('v_home', ['rutaAmodificar' => $ruta,
                                'matriculas' => $matriculas]);

    }

    
}
