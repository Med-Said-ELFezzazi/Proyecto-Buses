<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ModeloRutas extends Model {

    protected $table      = 'rutas';
    protected $primaryKey = 'id_ruta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';   // Array de obj, como se le pasan o devuelve las filas de la tabla
    protected $useSoftDeletes = false;

    protected $allowedFields = ['matricula', 'ciudad_origin', 'ciudad_destino', 'hora_salida', 'hora_llegada', 'tarifa', 'fecha'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Obtener todas ciudades de origen
    public function ciudadesOrg() {
        $ciudadesOrg = $this
            ->select('id_ruta, ciudad_origin')
            ->groupBy('ciudad_origin')
            ->findAll();
        return $ciudadesOrg;
    }

    // Obtener todas ciudades de destino
    public function ciudadesDes() {
        $ciudadesDes = $this->select('id_ruta, ciudad_destino')
                    ->groupBy('ciudad_destino')
                    ->findAll();
        return $ciudadesDes;
    }

    // Obtener datos de rutas con datos seleccionados
    public function datosRutas($fecha, $ciudad_origin, $ciudad_destino) {
        $datosRutas = $this
            ->where('fecha', $fecha)
            ->where('ciudad_origin', $ciudad_origin)
            ->where('ciudad_destino', $ciudad_destino)
            ->orderBy('hora_salida', 'ASC')
            ->findAll();
        return $datosRutas;
    }
    
    // Obtener datos de tarifas segund ciudad origin
    public function datosTarifas() {
        $datosTarifas = $this
            ->distinct()
            ->select('ciudad_origin, ciudad_destino, tarifa')
            ->orderBy('ciudad_origin', 'ASC')
            ->findAll();
        return $datosTarifas;
    }


    // Función que obtiene la matricula del bus de la ruta pasada en el param
    public function matriculaRuta($id_ruta) {
        $matricula = $this
            ->select('matricula')
            ->where('id_ruta', $id_ruta)
            ->first();
        return $matricula->matricula;
    }


    // Función que obtiene datos de una ruta pasandole id_ruta
    public function dameDatosRuta($id_ruta) {
        $datosRuta = $this
            ->where('id_ruta', $id_ruta)
            ->first();
        return $datosRuta;
    }


    // Función que devuelve si un bus y esta en uso en viajes futuros 
    public function busEnUso($matricula) {
        $count = $this
            ->where('matricula', $matricula)
            ->where('fecha >=', date('Y-m-d'))
            ->countAllResults();
        return $count > 0;
    }

    // Función que comprueba si un bus ha sido usado en el pasado y no tiene ningún registro en fecha >= fecha actual
    public function busUsadoPasado($matricula) {
        $countPasado = $this
            ->where('matricula', $matricula)
            ->where('fecha <', date('Y-m-d'))
            ->countAllResults();
        return $countPasado > 0 && !$this->busEnUso($matricula);
    }


    // Función que obtiene las rutas que tiene un bus pasandole su matricula
    public function dameRutasBus($matricula) {
        $rutas = $this
                ->where('matricula', $matricula)
                ->findAll();
        return !empty($rutas) ? $rutas : null;
    }


    // Función que devuelve todas las rutas que hay en BD
    public function todasRutas() {
        return $this->findAll();
    }


    // Función que obtiene todas las distintas ciudades 'origin y destino'
    public function todasCiudades() {
        $ciudades = $this
        ->select('ciudad_origin, ciudad_destino')
        ->distinct()
        ->groupBy('ciudad_origin, ciudad_destino')
        ->findAll();
        return $ciudades;
    }


    // Función que devuelve datos de rutas seguna los filtros pasados
    public function datosRutasFiltrados($matricula, $ciudad, $hSalida, $hLlegada, $fecha, $tarifaMin, $tarifaMax) {
        $consulta = $this;
        if ($matricula != '') {
            $consulta->where('matricula', $matricula);
        }
   
        if ($ciudad != '0') {
            $consulta->groupStart() // Agrupa las condiciones OR
                     ->where('ciudad_origin', $ciudad)
                     ->orWhere('ciudad_destino', $ciudad)
                     ->groupEnd();
        }
        
        if ($hSalida != '') {
            $consulta->where('hora_salida', $hSalida);
        }   

        if ($hLlegada != '') {
            $consulta->where('hora_llegada', $hLlegada);
        }   

        if ($fecha != '') {
            $consulta->where('DATE(fecha)', $fecha);
        }

        if ($tarifaMin != '') {
            $consulta->where('tarifa >=', $tarifaMin);
        }

        if ($tarifaMax != '') {
            $consulta->where('tarifa <=', $tarifaMax);
        }

        $datos = $consulta->findAll();
        return $datos;
    }   




    // Función que elimna todas las rutas que tiene la matricula pasada en param
    public function eliminarRutasMatricula($matricula) {
        $this->where('matricula', $matricula)->delete();
    }


    // función que inserta a la BD una nueva ruta
    public function insertarRuta($matricula, $ciudadOrigen, $ciudadDestino, $horaSalida, $horaLlegada, $tarifa, $fecha) {
        $insertado = $this->insert([
            'matricula' => $matricula,
            'ciudad_origin' => $ciudadOrigen,
            'ciudad_destino' => $ciudadDestino,
            'hora_salida' => $horaSalida,
            'hora_llegada' => $horaLlegada,
            'tarifa' => $tarifa,
            'fecha' => $fecha
            ]);
        
        return $insertado;
    }


    // Función que elimina una ruta pasandole su id
    public function eliminarRuta($id) {
        return $this->where('id_ruta', $id)->delete();
    }

    // Función que actualiza una ruta pasandole los nuevos valores por param y su id   
    public function actualizarRuta($id_ruta, $matricula, $ciudad_origen, $ciudad_destino, $hora_salida, $hora_llegada, $tarifa, $fecha) {
        $data = [
            'matricula' => $matricula,
            'ciudad_origin' => $ciudad_origen,
            'ciudad_destino' => $ciudad_destino,
            'hora_salida' => $hora_salida,
            'hora_llegada' => $hora_llegada,
            'tarifa' => $tarifa,
            'fecha' => $fecha
        ];
    
        // Usa el método update() de CodeIgniter
        return $this->update($id_ruta, $data);
    }
    


    // Función que conprueba si hay alguna ruta con una matricula y datos fecha y hora igual in BD
    public function comprobarMatriculaExiste($matricula, $fecha, $horaSalida){
        $count = $this->where('matricula', $matricula)
                ->where('fecha',$fecha)
                ->where('hora_salida', $horaSalida)
            ->countAllResults();
        return $count == 1;

    }


    



    // Funcion que devuelve datos de una ruta pasado su id_ruta en param
    // public function viajesTranscuridos($id_ruta) {
    //     // fecha tiene que ser en el pasado o de hoy pero con hora_salida antes de la hora actual
    //     $fechaActual = date('Y-m-d');
    //     $horaActual = date('H:i');
    //     $data = $this->where('id_ruta', $id_ruta)
    //                 ->groupStart()
    //                     ->where('fecha <', $fechaActual)
    //                     ->orGroupStart()
    //                         ->where('fecha', $fechaActual)
    //                         ->where('hora_salida <', $horaActual)
    //                     ->groupEnd()
    //                 ->groupEnd()
    //                 ->findAll();

    //     return empty($data) ? [] : $data;
    // }



    // Función que devuelve las rutas transcurridas
    public function viajesTranscuridos($id_ruta) {

    }

    
    
}