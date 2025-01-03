<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ModeloBuses extends Model {

    protected $table      = 'buses';
    protected $primaryKey = 'matricula';

    protected $useAutoIncrement = false;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['capacidad', 'modelo', 'imagen'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Función que obtiene la capacidad maxima de un bus
    public function capacidadBus($matricula) {
        $capacidad = $this
            ->select('capacidad')
            ->where('matricula', $matricula)
            ->first();
        return $capacidad ? $capacidad->capacidad : null;
    }
    
}