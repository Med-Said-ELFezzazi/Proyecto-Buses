<?php
    namespace App\Controllers;

    use App\Models\ModeloClientes;
    use App\Models\ModeloRutas;
    use App\Models\ModeloReservas;
    use App\Models\ModeloBuses;
    use stdClass;

    class CClientes extends BaseController {

        protected $modeloClientes;
        protected $modeloRutas;
        protected $modeloReservas;
        protected $modeloBuses;

        public function __construct() {
            $this->modeloClientes = new ModeloClientes();
            $this->modeloRutas = new ModeloRutas();
            $this->modeloReservas = new ModeloReservas();
            $this->modeloBuses = new ModeloBuses();
        }


        // Función que modifica los datos del cliente logeado
        public function modificarCliente() {
            // Compruebo se haya logeado el cliente o si no al login 'extra precaucion'
            if (session()->get('dniCliente') == null) {
                return redirect()->to(site_url('autenticacion'));
            } else {
                $dniCliente = session()->get("dniCliente"); // dni de la sesión
                $clienteObj = $this->modeloClientes->dameCliente($dniCliente);
                $msg = "";      // Msg de confirmacio/error de modificación
                // Comprueba si haya dado al btotón de modificar
                if ($this->request->getPost("submitModificar")) {
                    // Obtener los datos de los nuevos campos
                    $newNom = $this->request->getPost("modNom");
                    $newEmail = $this->request->getPost("modEmail");
                    // quitar los espacios al principio y al final del email
                    $newEmail = trim($newEmail);
                    $newTele = $this->request->getPost("modTele");
                    $newPwd = $this->request->getPost("modPwd");
                    // Hace la actualización en la BD
                    $actualizado = $this->modeloClientes->actualizarCliente($dniCliente ,$newNom, $newEmail, $newTele, $newPwd);
                    $msg .= $actualizado ? "Datos modificados correctamente" : "Error al modificar los datos!";
                }
                // Siempre es obligatorio pasar datos dentro un array asociativo
                return view("v_modificarCliente", 
                            ['clienteObj' => $clienteObj,
                            'msg' => $msg]);
            }
        }




        public function opinar() {
            // Obtener los datos necesarios desde la BD
            $dniCli = $this->session->get('dniCliente'); // bien
            $reservasHechas = $this->modeloReservas->dameReservasCliente($dniCli); // bien
        
            if (!empty($reservasHechas)) {
                $ids_rutas = [];
                $arr_ids_tickets = [];
                $arrAuxRutas = [];
                $data = [];  // array de datos a mandar
        
                foreach ($reservasHechas as $reserva) {
                    // Mirar si la ruta ya está procesada
                    if (!in_array($reserva->id_ruta, $arrAuxRutas)) {
                        // Consultar los viajes ya transcurridos para la ruta
                        $viajes = $this->modeloRutas->viajesTranscuridos($reserva->id_ruta);
                        
                        // Si existen viajes transcurridos, añadimos los datos
                        if (!empty($viajes)) {

                            foreach ($viajes as $v) {
                                // Obtener la información de la ruta
                                // $ruta = $this->modeloRutas->dameDatosRuta($v->id_ruta);
            
                                $img = $this->modeloBuses->dameDatosBus($v->matricula);


                                $ids_rutas[] = $reserva->id_ruta;
                                $arr_ids_tickets[] = $reserva->id_ticket;
            
                                // Construir el array con la información que queremos
                                $data[] = [
                                    'id_ticket' => $reserva->id_ticket,
                                    'id_ruta' => $v->id_ruta,
                                    'origen' => $v->ciudad_origin,
                                    'destino' => $v->ciudad_destino,
                                    'hLlegada' => $v->hora_llegada,
                                    'img' => $img->imagen
                                ];
                            }
                        }
                        
                        // Añadir la ruta al array para evitar dupli 
                        $arrAuxRutas[] = $reserva->id_ruta;
                    }
                }
     
                return view('v_home', ['opin' => $data]);
            } else {
           
                return view('v_home', ['opin' => 'No tiene reservas']);
            }
        
        

        // insertar opinion
        if (isset($_POST['btnOpinar'])) {
            // Obtenr dato
            // $opinion = $_POST['comentario'];
            $arrIdsTickets = $_POST['selected_tickets[]'];
            
            // // insertar al BD
            // $insertado = $this->modeloReservas->insertarOpinion($arrIdsTickets, $opinion);
            // if ($insertado) {
            //     return view('v_home', ['opin' => 'No tiene reservas',
            //                             'msg' => 'Bien isertado']);
            // } else {
            //     return view('v_home', ['opin' => 'No tiene reservas',
            //                         'msg' => 'Erro al insertar']);
            // }

            return view('v_home', ['opin' => 'No tiene reservas',
                                    'msg' => $arrIdsTickets]);

        }
    }


    public function opinaradd() {
        $dniCli = $this->session->get('dniCliente'); // bien
        $reservasHechas = $this->modeloReservas->dameReservasCliente($dniCli); // bien
    
        $data = [];  // array de datos a mandar
        if (!empty($reservasHechas)) {
            $ids_rutas = [];
            $arr_ids_tickets = [];
            $arrAuxRutas = [];
    
            foreach ($reservasHechas as $reserva) {
                // Mirar si la ruta ya está procesada
                if (!in_array($reserva->id_ruta, $arrAuxRutas)) {
                    // Consultar los viajes ya transcurridos para la ruta
                    $viajes = $this->modeloRutas->viajesTranscuridos($reserva->id_ruta);
                    
                    // Si existen viajes transcurridos, añadimos los datos
                    if (!empty($viajes)) {

                        foreach ($viajes as $v) {
                            // Obtener la información de la ruta
                            // $ruta = $this->modeloRutas->dameDatosRuta($v->id_ruta);
        
                            $img = $this->modeloBuses->dameDatosBus($v->matricula);


                            $ids_rutas[] = $reserva->id_ruta;
                            $arr_ids_tickets[] = $reserva->id_ticket;
        
                            // Construir el array con la información que queremos
                            $data[] = [
                                'id_ticket' => $reserva->id_ticket,
                                'id_ruta' => $v->id_ruta,
                                'origen' => $v->ciudad_origin,
                                'destino' => $v->ciudad_destino,
                                'hLlegada' => $v->hora_llegada,
                                'img' => $img->imagen
                            ];
                        }
                    }
                    
                    // Añadir la ruta al array para evitar dupli 
                    $arrAuxRutas[] = $reserva->id_ruta;
                }
            }
 
            return view('v_home', ['opin' => $data]);
        }


        $selectedTickets = $this->request->getPost('selected_tickets');

        return view('v_home', [
            'opin' => $data,
            'msg' => 'dsa'
        ]);

    }


    }
?>