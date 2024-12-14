<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ModeloClientes extends Model {

    protected $table      = 'clientes';
    protected $primaryKey = 'dni';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';   // Array de obj, como se le pasan o devuelve las filas de la tabla
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'email', 'telefono', 'password'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


            // Función que obtiene el dni del cliente pasandolo el email y pwd sino null
    public function autenticacion($email, $pwd) {
        $cliente = $this
            ->select('dni')
            ->where('email', $email)
            ->where('password', $pwd)
            ->first();
        return $cliente ? $cliente->dni : null;   // Devuelve el id, sino existe null
    }
}
?>