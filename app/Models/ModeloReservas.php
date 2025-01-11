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


    // Función que el número de reservas de un viaje
    public function numeroReservas($id_ruta) {
        $numReservas = $this
            ->where('id_ruta', $id_ruta)
            ->countAllResults();
        return $numReservas;
    }
    

    // Función que inserta una reserva Y DEVUELVE true o false
    public function agregarReserva($dni, $id_ruta, $arrAsientos) {
        $this->db->transStart();
    
        foreach ($arrAsientos as $asiento) {
            $this->insert([
                'dni' => $dni,
                'id_ruta' => $id_ruta,
                'num_asiento' => $asiento,
                'fecha_reserva' => date('Y-m-d H:i:s')
            ]);
        }
    
        $this->db->transComplete();
    
        return $this->db->transStatus();
    }
    

    // Función que obtiene idTicket/num_asiento de una reserva    
    public function dameIdTicket($dni, $id_ruta, $fecha_reserva) {
        $tickets = $this
            ->select('id_ticket, num_asiento')
            ->where('dni', $dni)
            ->where('id_ruta', $id_ruta)
            ->where("DATE(fecha_reserva)", $fecha_reserva) // Comparar solo la fecha
            ->get()
            ->getResultArray(); // Devuelve el resultado en formato array
        
        // Devolver un array de resultados
        return empty($tickets) ? [] : $tickets;
    }  
        

    // Función que obtiene los numeros de asientos de una ruta pasada en el param
    public function asientosReservadosRuta($id_ruta) {
        $asientos = $this
            ->select('num_asiento')
            ->where('id_ruta', $id_ruta)
            ->findAll();
        return $asientos;       // Devuelve un array de objetos 'num asiento'
    }


    // Función que elimina reservas de ruta pasando su id_ruta en param
    public function eliminarReservasRuta($id_ruta) {
        $this->where('id_ruta', $id_ruta)
        ->delete('reservas');
    }

    // funcion que devuelve todas las reservas hechas por un cliente pasado en param
    public function dameReservasCliente($dni) {
        $reservas = $this
        ->where('dni', $dni)
        ->findAll();
        return empty($reservas) ? [] : $reservas;
    }

    public function dameRutasReservadas($dni, $id_ruta) {
        $reservas = $this
        ->where('dni', $dni)
        ->where('id_ruta', $id_ruta)
        ->findAll();
        return empty($reservas) ? [] : $reservas;

    }


    // funcion para insertar opinion
    public function insertarOpinion($id_tickets, $opinion) {
        $this->db->transStart();

        foreach ($id_tickets as $id_ticket) {
            $data = [
                'opinion' => $opinion,
                'fecha_opinion' => date('Y-m-d H:i:s')
            ];

            $this->where('id_ticket', $id_ticket)
                 ->update($data);
        }

        $this->db->transComplete();

        return $this->db->transStatus();
    }
}