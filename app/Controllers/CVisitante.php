<?php
    namespace App\Controllers;

    use App\Models\ModeloRutas;
    // use stdClass;

    class CVisitante extends BaseController {

        protected $modeloRutas;

        public function __construct() {
            $this->modeloRutas = new ModeloRutas();
        }
        

        
    }


?>