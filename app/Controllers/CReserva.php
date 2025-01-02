<?php
    namespace App\Controllers;

    use App\Models\ModeloReservas;
    use App\Models\ModeloRutas;
    use stdClass;

    class CReserva extends BaseController {

        protected $modeloReservas;
        protected $modeloRutas;

        public function __construct() {
            $this->modeloReservas = new ModeloReservas();
            $this->modeloRutas = new ModeloRutas();
        }

        public function reservar() {
            $origins = $this->modeloRutas->ciudadesOrg();
            $ciudadesOrg = [];
            foreach($origins as $ciudad) {
                $ciudadesOrg[$ciudad->ciudad_origin] = $ciudad->ciudad_origin;
            }
            $destinos = $this->modeloRutas->ciudadesDes();
            $ciudadesDes = [];
            foreach($destinos as $ciudad) {
                $ciudadesDes[$ciudad->ciudad_destino] = $ciudad->ciudad_destino;
            }

            return view("v_home", [
                'ciudadesOrg' => $ciudadesOrg,
                'ciudadesDes' => $ciudadesDes
            ]);
        }
        
    }


?>