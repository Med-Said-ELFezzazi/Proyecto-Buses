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

    
    // Función que obtiene todos los datos de buses en formato obj
    public function datosBuses() {
        return $this->findAll();
    }
    

    // Función que inserta un nuevo autobús
    public function insertarBus($matricula, $capacidad, $modelo, $img) {
        $datos = [
            'matricula' => trim(strtoupper($matricula)),
            'capacidad' => $capacidad,
            'modelo' => $modelo,
            'imagen' => $img
        ];

        if ($this->insert($datos)) {
            return true;
        } else {
            return false;
        }
    }

        
    // Función que elimina un bus pasandole la matricula
    public function eliminarBus($mat) {
        $eliminado = $this->where('matricula', $mat)->delete();
        return $eliminado;
    }

    // Función que devuelve datos de un bus pasandole su matricula
    public function dameDatosBus($matricula) {
        $bus = $this->where('matricula', $matricula)->first();
        return $bus;
    }
    

}