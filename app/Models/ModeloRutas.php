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


    // Función que obtiene ciudades_origins disponibles pasandole la fecha 
    public function ciudadesOriginDisponibles($fecha) {
        $ciudades = $this
            ->select('ciudad_origin')
            ->where('fecha', $fecha)
            ->distinct()
            ->findAll();
        return $ciudades;
    }

    // Función que obtiene ciudades_destino disponibles pasandole la fecha y ciudad_origin
    public function ciudadesDestinoDisponibles($fecha, $ciudad_origin) {
        $ciudades = $this
            ->select('ciudad_destino')
            ->where('fecha', $fecha)
            ->where('ciudad_origin', $ciudad_origin)
            ->distinct()
            ->findAll();
        return $ciudades;
    }
    
}
?>