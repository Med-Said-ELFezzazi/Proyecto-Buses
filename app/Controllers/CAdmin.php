<?php
    namespace App\Controllers;

    use App\Models\ModeloBuses;
    // use stdClass;

    class CAdmin extends BaseController {

        protected $modeloBuses;

        public function __construct() {
            $this->modeloBuses = new ModeloBuses();
        }


        public function index() {

            return view('v_home');
        }

        // Función que lanza la vista home pasandole datosBuses para cargarlo en la vista v_buses
        public function administracionBuses() {
            $datosBuses = $this->modeloBuses->datosBuses();
            // Lanazo la vista v_buses
            return view('v_home', ['datosBuses' => $datosBuses]);
        }













    }


?>