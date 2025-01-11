<?php

    namespace App\Controllers;

    use App\Models\ModeloBuses;
    use App\Models\ModeloRutas;


    class CBuses extends BaseController {
        protected $modeloRutas;
        protected $modeloBuses;

        public function __construct(){
            $this->modeloBuses = new ModeloBuses();
            $this->modeloRutas = new ModeloRutas();
        }

        
        // Función que compruebe la validación de datos de un bus 'Tiene que tener 4 digitos y 3 letras'
        public function matriculaValida($matricula)
        {
            // Longitud
            if (strlen($matricula) != 7) {
                return false;
            }
            if (ctype_digit(substr($matricula, 0, 4)) && !ctype_digit(substr($matricula, 4))) {
                return true;
            }
            return false;
        }

        // Función que compruebe si una matricula ya existe en BD o no
        public function matriculaYaExiste($matricula)
        {
            $matriculaExiste = $this->modeloBuses->capacidadBus($matricula);
            if ($matriculaExiste == null) {
                return false;
            } else {
                return true;
            }
        }



        public function administracionBuses(){
            $datosBuses = $this->modeloBuses->datosBuses();

            // Añadir nuevo bus
            if (isset($_POST['aniadirBus'])) {  // igual a $this->request->getPost('aniadirBus')
                $matricula = $_POST['matricula'];

                $msg = '';
                if (!$this->matriculaValida($matricula)) {
                    $msg .= 'Matrícula errónea! (Tiene que tener 4 dígitos y 3 letras)<br>';
                }
                if ($this->matriculaYaExiste($matricula)) {
                    $msg .= 'Matrícula ya existe!';
                }

                if ($msg != '') {
                    return view('v_home', [
                        'datosBuses' => $datosBuses,
                        'msgErrorBus' => $msg
                    ]);
                } else {
                    // Configuración de subida 'caso haya subido algo'
                    $imgFile = $this->request->getFile('imagen');
                    if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
                        // Validar que sea una imagen
                        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!in_array($imgFile->getMimeType(), $tiposPermitidos)) {
                            return view('v_home', [
                                'datosBuses' => $datosBuses,
                                'msgErrorBus' => 'El archivo debe ser una imagen (JPG, PNG, GIF).'
                            ]);
                        }
                        // Mover la imagen y guardarla
                        $rutaDestino = WRITEPATH . '../public/images/buses/';
                        $nomImg = $imgFile->getName();  // Obtener el nombre original de la imagen
                        $imgFile->move($rutaDestino, $nomImg);

                        // Guardar los datos del autobús en la BD
                        $capacidad = $_POST['capacidad'];
                        $modelo = $_POST['modelo'];

                        $busInsertado = $this->modeloBuses->insertarBus($matricula, $capacidad, $modelo, $nomImg);
                        if ($busInsertado) {
                            return view('v_home', [
                                'datosBuses' => $datosBuses,
                                'msgMatriExito' => 'Autobús agregado correctamente'
                            ]);
                        } else {
                            return view('v_home', [
                                'datosBuses' => $datosBuses,
                                'msgErrorBus' => 'No se ha podido agregar el bus!'
                            ]);
                        }
                    } else {
                        // No se ha subido la imagen 'guardar el bus con imagen sinImg.png'
                        $capacidad = $_POST['capacidad'];
                        $modelo = $_POST['modelo'];
                        $busInsertado = $this->modeloBuses->insertarBus($matricula, $capacidad, $modelo, 'sinImg.png');
                        if ($busInsertado) {
                            return view('v_home', [
                                'datosBuses' => $datosBuses,
                                'msgMatriExito' => 'Autobús agregado correctamente'
                            ]);
                        } else {
                            return view('v_home', [
                                'datosBuses' => $datosBuses,
                                'msgErrorBus' => 'No se ha podido agregar el bus!'
                            ]);
                        }
                    }
                }
            }



            // Click sobre Borrar bus
            if (isset($_POST['borrarBus'])) {
                // Obtener la matricula
                $matricula = $_POST['matricula'];
                // Antes de eliminar un bus deberia checkear si esta usado en alguna ruta en una fecha del futuro o el mismo dia
                $busYaEnUso = $this->modeloRutas->busEnUso($matricula); // Bus se usa en fecha futura

                $busUsadoSoloPasado = $this->modeloRutas->busUsadoPasado($matricula);   // Bus ha sido usado antes y ya no
                if ($busUsadoSoloPasado) {
                    // Eliminar registros de rutas pasadas
                    $this->modeloRutas->eliminarRutasMatricula($matricula);
                    // Eliminar bus
                    $this->modeloBuses->eliminarBus($matricula);
                    return view('v_home', [
                                        'datosBuses' => $datosBuses,
                                        'msgExitoEliBus' => 'Bus eliminado correctamente junto con sus rutas pasadas'
                    ]);
                }
                if ($busYaEnUso) {
                    // obtener id_rutas de la matricula
                    $idRutas = $this->modeloRutas->dameRutasBus($matricula);
                    $rutasStr = '';
                    foreach ($idRutas as $ruta) {
                        $rutasStr .= $ruta->id_ruta . ',';
                    }
                    // Error no se puede eliminar el bus
                    $msj = 'No se puede eliminar el bus con la matricula: ' . $matricula . ' ya que esta en uso <br>
                        Considera eliminar primero las rutas que tiene asignado <br>
                        Nº de rutas: ' . $rutasStr . '<br><i> (Solo se eliminan buses con rutas antiguas de la fecha de hoy)</i>';
                    return view('v_home', [
                        'datosBuses' => $datosBuses,
                        'msgErrorEliBus' => $msj
                    ]);
                } else {
                    // Suprimir su imagen de images/buses
                    $busObj = $this->modeloBuses->dameDatosBus($matricula);
                    if ($busObj->imagen != 'sinImg.png') {      // Bus tiene imagen
                        $rutaCompleta = WRITEPATH . '../public/images/buses/' . $busObj->imagen ;
                        unlink($rutaCompleta);      // Eliminar img
                    }
                    // Eliminar el bus de BD
                    $eliminacionExito = $this->modeloBuses->eliminarBus($matricula);

                    return view('v_home', [
                        'datosBuses' => $datosBuses,
                        'eliminacionExito' => $eliminacionExito ? 'Bus eliminado correctamente junto con sus rutas pasadas' : 'No se ha podido eliminar el bus'
                    ]);
                }
            }

            // Lanzar la vista v_home
            return view('v_home', ['datosBuses' => $datosBuses]);
        
        }



        // Función que actualiza datos de un bus pasando su matricula
        public function modificarBus($matricula) {
            $bus = $this->modeloBuses->dameDatosBus($matricula);
              
            // Al click actualizar bus
            if (isset($_POST['actualizarBus'])) {
                
                // Obtener nuevos datos del bus
                $capacidad = $_POST['capacidad'];
                $modelo = $_POST['modelo'];

                // Validación de datos
                $msgErrModBus = '';
                if ($capacidad == '') {
                    $msgErrModBus .= 'Deberias introducir la capacidad! <br>';
                }
                if ($modelo == '') {
                    $msgErrModBus .= 'Deberias introducir el modelo del bus!';
                }
                if ($msgErrModBus != '') {
                    return view('v_home', ['busMod' => $bus,
                                        'msgErrModBus' => $msgErrModBus]);
                } else {
                    // Configuración de subida 'caso haya subido algo'
                    $imgFile = $this->request->getFile('imagen');
                    if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
                        // Validar que sea una imagen
                        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!in_array($imgFile->getMimeType(), $tiposPermitidos)) {
                            return view('v_home', [
                                'busMod' => $bus,
                                'msgErrModBus' => 'El archivo debe ser una imagen (JPG, PNG, GIF).'
                            ]);
                        }
                        // Mover la imagen y guardarla
                        $rutaDestino = WRITEPATH . '../public/images/buses/';
                        $nomImg = $imgFile->getName();  // Obtener el nombre original de la imagen
                        $imgFile->move($rutaDestino, $nomImg);

                        // suprimir la imagen antigua si la tenia
                        if ($bus->imagen != 'sinImg.png') {
                            $rutaCompleta = WRITEPATH . '../public/images/buses/' . $bus->imagen ;
                            unlink($rutaCompleta);      // Eliminar img
                        }

                        // Actualizar
                        $actualizado = $this->modeloBuses->actualizarBus($matricula, $capacidad, $modelo, $nomImg);
                        if ($actualizado) {
                            return view('v_home', ['busMod' => $bus,
                                                    'msgInfoModBus' => 'Datos actualizados correctamente']);
                        } else {
                            return view('v_home', ['busMod' => $bus,
                                                    'msgErrModBus' => 'Error al actualizar el bus BD!']);
                        }
                    } else {
                        // No se ha subido la imagen 'guardar el bus con imagen sinImg.png'
                        // Actualizar
                        $actualizado = $this->modeloBuses->actualizarBus($matricula, $capacidad, $modelo);
                        if ($actualizado) {
                            return view('v_home', ['busMod' => $bus,
                                                    'msgInfoModBus' => 'Datos actualizados correctamente']);
                        } else {
                            return view('v_home', ['busMod' => $bus,
                                                    'msgErrModBus' => 'Error al actualizar el bus BD!']);
                        }
                    }
                }
            }
                
            // Cargar la vista v_modBus
            return view('v_home', ['busMod' => $bus]);
        }



    }

?>