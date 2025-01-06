<?php

namespace App\Controllers;

use App\Models\ModeloBuses;
// use stdClass;

class CAdmin extends BaseController
{

    protected $modeloBuses;

    public function __construct()
    {
        $this->modeloBuses = new ModeloBuses();
    }


    public function index()
    {

        return view('v_home');
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

    // Función que lanza la vista home pasandole datosBuses para cargarlo en la vista v_buses

    public function administracionBuses() {
        $datosBuses = $this->modeloBuses->datosBuses();

        // Añadir nuevo bus
        if (isset($_POST['aniadirBus'])) {
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

        // Lanzar la vista v_home
        return view('v_home', ['datosBuses' => $datosBuses]);
    }

}
