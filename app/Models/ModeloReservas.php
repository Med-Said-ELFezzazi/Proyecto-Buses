<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ModeloReservas extends Model {

    protected $table      = 'reservas';
    protected $primaryKey = 'id_ticket';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';   // Array de obj, como se le pasan o devuelve las filas de la tabla
    protected $useSoftDeletes = false;

    protected $allowedFields = ['dni', 'id_ruta', 'num_asiento', 'fecha_reserva', 'opinion', 'fecha_opinion'];

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

    // Función que el número de reservas de un viaje
    public function numeroReservas($id_ruta) {
        $numReservas = $this
            ->where('id_ruta', $id_ruta)
            ->countAllResults();
        return $numReservas;
    }
    

    // Función que inserta una reserva
    public function agregarReserva($dni, $id_ruta, $num_asiento) {
        return $this->insert([
                // 'dni' => session()->get('dniCliente'),   // eso no pq Admin va a poder reservar con dnis de clientes
                'dni' => $dni,
                'id_ruta' => $id_ruta,
                'num_asiento' => $num_asiento,
                'fecha_reserva' => date('Y-m-d H:i:s')
            ]);
    }
}