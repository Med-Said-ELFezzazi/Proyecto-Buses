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
    
}
?>