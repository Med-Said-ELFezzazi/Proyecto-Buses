<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ModeloAverias extends Model {

    protected $table      = 'averias';
    protected $primaryKey = 'id_averia';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['matricula', 'descripcion', 'fecha', 'coste', 'reparada'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    
    // Función que obtiene todos los datos de averias
    public function datosAverias() {
        return $this->findAll();
    }
    

    // Función que devuelve datos de averias seguna los filtros pasados
    public function datosAveriasFiltrados($matricula, $fecha, $costeMin, $costeMax, $reparada) {
        $consulta = $this;
        if ($reparada != '' && $reparada != 2) {
            $consulta->where('reparada', $reparada);
        }   
        if ($matricula != '') {
            $consulta->where('matricula', $matricula);
        }

        if ($costeMin != '') {
            $consulta->where('coste >=', $costeMin);
        }
        if ($costeMax != '') {
            $consulta->where('coste <=', $costeMax);
        }

        if ($fecha != '') {
            $consulta->where('DATE(fecha)', $fecha);
        }
        $datos = $consulta->find();
        return $datos;
    }    


    // Función que inserta una averia nueva a la BD
    public function insertarAveria($matricula, $descripcion, $fecha, $coste, $reparada){
        $datos = [
            'matricula' => $matricula,
            'descripcion' => $descripcion,
            'fecha' => $fecha,
            'coste' => $coste,
            'reparada' => $reparada
        ];

        if ($this->insert($datos)) {
            return true;
        } else {
            return false;
        }
    }


    // Función que elimina de la BD la averia pasado por param
    public function eliminarAveria($id){
        $this->delete($id);
        return true;
    }

    // Función que obtiene una avería pasandole el id_averia
    public function dameAveria($id_averia){
        return $this->find($id_averia);;
    }

    // Función que actualiza daos de una averia pasandole su id_averia
    public function actualizarAveria($id_averia, $matricula, $descripcion, $fecha, $coste, $reparada){
        return $this->update($id_averia, [
            'matricula' => $matricula,
            'descripcion' => $descripcion,
            'fecha' => $fecha,
            'coste' => $coste,
            'reparada' => $reparada
            ]);
    }

}