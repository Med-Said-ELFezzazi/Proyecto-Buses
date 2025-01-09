<?php

namespace App\Controllers;

use App\Models\ModeloAverias;
use App\Models\ModeloBuses;
// use stdClass;

class CAverias extends BaseController {

    protected $modeloAverias;
    protected $modeloBuses;

    public function __construct()
    {
        $this->modeloAverias = new ModeloAverias();
        $this->modeloBuses = new ModeloBuses();
    }


    // Función para mostrar los datos de averias
    public function gestionAverias() {
        // Busqueda con filtros
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

        // Añadir avería
        // Mostrar formulario
        if ($this->request->getPost('mostrarForm')) {
            // Paso las matriculas que hay en la BD
            $matriculas = $this->modeloBuses->datosBuses();
            return view('v_home', ['matriculas' => $matriculas]);
        }
        // Formulario de añadir enviado
        if ($this->request->getPost('GuardarAveria')) {
            // Obtener los datos seleccinados
            $MatriculaSel = $_POST['MatriculaSel'];
            $descripcion = $_POST['descripcion'];
            // FEcha, comprobar si haya checkeado 'checkbox'
            $fecha = '';
            // $checkBox = $_POST['fechayhora_hoy'];
            if (isset($_POST['fechayhora_hoy'])) {  // Si esta marcado
                $fecha = date('Y-m-d H:i:s');
            } else {
                // Obtener la fecha del input
                $fecha = $_POST['fecha'];
            }
            $coste = $_POST['costeAveria'];
            $reparada = '';

            // Comprobación de datos insertados
            $msgErrAltaAveria = '';
            if ($MatriculaSel == '0') {
                $msgErrAltaAveria .= 'Deberias seleccionar una matricula! <br>';
            }
            if ($descripcion == '') {
                $msgErrAltaAveria .= 'Deberias introducir una descripción de la avería! <br>';
            }
            if ($fecha == '') {
                $msgErrAltaAveria .= 'Deberias indicar la fecha/hora de la avería! <br>';
            }
            if ($coste == '' || $coste <= 0) {
                $msgErrAltaAveria .= 'Deberias definir un coste a la avería! <br>';
            }
            if (!isset($_POST['reparadaAveria'])) {
                $msgErrAltaAveria .= 'Deberias indicar si la avería ya esta reparada o no! <br>';
            } else {
                $reparada = $_POST['reparadaAveria'];
            }

            // Según el msg lanzo a la vista
            $matriculas = $this->modeloBuses->datosBuses(); // PAra lanzar view
            if ($msgErrAltaAveria == '') {  // Ningun error
                // Insertar en BD
                $insertado = $this->modeloAverias->insertarAveria($MatriculaSel, $descripcion,
                            $fecha, $coste, $reparada);
                
                if ($insertado) {
                    return view('v_home', ['matriculas' => $matriculas,
                                            'msgInfoAveria' => 'Avería añadida correctamente']);
                } else {
                    return view('v_home', ['matriculas' => $matriculas,
                                        'msgErrorAveria' => 'Error al añadir la avería']);
                }
            } else {
                return view('v_home', ['matriculas' => $matriculas,
                                    'msgErrorAveria' => $msgErrAltaAveria]);
            }
        }

        $datosAverias = $this->modeloAverias->datosAverias();
        // Eliminar avería
        if ($this->request->getPost('id_averiaBorrar')) {
            // id_averia a eliminar
            $id_averia = $_POST['id_averiaBorrar'];
            // Eliminar de la BD
            $eliminado = $this->modeloAverias->eliminarAveria($id_averia);
            return view('v_home', ['datosAverias' => $datosAverias,
                                    'eliminacionAveria' => $eliminado]);
        }
        

        return view('v_home', ['datosAverias' => $datosAverias]);
    }



    // Función que recibe el id_averia obtiene sus datos de BD y los carga en la vista con formulario para modificar
    public function modificarAveria($id_averia) {
        $matriculas = $this->modeloBuses->datosBuses(); // PAra cargar dropdown
        $averia = $this->modeloAverias->dameAveria($id_averia);     // Datos de la averia

        // Button submit actualizar averia clickado
        if ($this->request->getPost('actualizarAveria')) {
            // Obtener los datos actualizados
            $MatriculaSel = $_POST['MatriculaSel'];
            $descripcion = $_POST['descripcion'];          
            // FEcha, comprobar si haya checkeado 'checkbox'
            $fecha = '';
            if (isset($_POST['fechayhora_hoy'])) {  // Si esta marcado
                $fecha = date('Y-m-d H:i:s');
            } else {
                // Obtener la fecha del input
                $fecha = $_POST['fecha'];
            }
            $coste = $_POST['costeAveria'];
            $reparada = $_POST['reparada'];

            // Validación de datos
            $msgErrModAveria = '';
            if ($MatriculaSel == '0') {
                $msgErrModAveria .= 'Deberias seleccionar una matricula! <br>';
            }
            if ($descripcion == '') {
                $msgErrModAveria .= 'Deberias introducir una descripción de la avería! <br>';
            }
            if ($fecha == '') {
                $msgErrModAveria .= 'Deberias indicar la fecha/hora de la avería! <br>';
            }
            if ($coste == '' || $coste <= 0) {
                $msgErrModAveria .= 'Deberias definir un coste a la avería! <br>';
            }

            if ($msgErrModAveria == '') {  // Ningun error
                // Actualizar en BD
                $actualizado = $this->modeloAverias->actualizarAveria($id_averia, $MatriculaSel, $descripcion, $fecha, $coste, $reparada);
                
                if ($actualizado) {
                    $averiaActualizada = $this->modeloAverias->dameAveria($id_averia);
                    return view('v_home', ['matriculas' => $matriculas,
                                            'averia' => $averiaActualizada,
                                            'msgInfoAveria' => 'Avería actualizada correctamente']);
                } else {
                    return view('v_home', ['matriculas' => $matriculas,
                                            'averia' => $averia,
                                            'msgInfoAveria' => 'Error al actualizar la avería']);
                }
            } else {
                return view('v_home', ['matriculas' => $matriculas,
                                    'averia' => $averia,
                                    'msgErrorAveria' => $msgErrModAveria]);
            }

        } else {
            // Cargar v_modAveria con campos repoblados
            return view('v_home', ['matriculas' => $matriculas,
                                'averia' => $averia]);
        }       
    }

}
