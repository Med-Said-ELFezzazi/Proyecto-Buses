<?php
    namespace App\Controllers;

    use App\Models\ModeloReservas;
    use App\Models\ModeloRutas;
    use App\Models\ModeloBuses;
    use Config\Services;

    class CReserva extends BaseController {

        protected $modeloReservas;
        protected $modeloRutas;
        protected $modeloBuses;

        public function __construct() {
            $this->modeloReservas = new ModeloReservas();
            $this->modeloRutas = new ModeloRutas();
            $this->modeloBuses = new ModeloBuses();
        }

        public function reservar() {
            // Pasar todas las distintas ciudades origen y destino
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
                'ciudadesDes' => $ciudadesDes,
            ]);
        }
        public function servicios() {
            // Obtener datos a buscar
            // $fechaIda = $_POST['fecha_ida'];
            // $fechaVuelta = $_POST['fecha_vuelta'];
            $fecha = $_POST['fecha_ida'];
            $origen = $_POST['ciudad_origen'];
            $destino = $_POST['ciudad_destino'];
            $Numbilletes = $_POST['Numbilletes'];
            // $asiento = $_POST['asiento']; no importa ahora
            
            
            // Para rellenar los campos de origen y destino
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
            // DAtos de rutas segun los filtros seleccionados
            $datosRuta = $this->modeloRutas->datosRutas($fecha, $origen, $destino);
            $servicios = [];

            foreach ($datosRuta as $datos) {
                $id_ruta = $datos->id_ruta;
        
                // Disponibilidad de plazas
                $matriculaBusRuta = $this->modeloRutas->matriculaRuta($id_ruta);
                $capacidadMaxBus = $this->modeloBuses->capacidadBus($matriculaBusRuta);
                $cantidadReservas = $this->modeloReservas->numeroReservas($id_ruta);
        
                $hayPlazas = ($cantidadReservas + $Numbilletes <= $capacidadMaxBus);
        
                // Preparar datos a enviar en la variable servicios
                $servicios[] = [
                    'id_ruta' => $id_ruta,
                    'hora_salida' => $datos->hora_salida,
                    'hora_llegada' => $datos->hora_llegada,
                    'precio' => $datos->tarifa,
                    'plazas_libres' => $capacidadMaxBus - $cantidadReservas,
                    'hayPlazas' => $hayPlazas
                ];
            }

            return view("v_home", [
                'ciudadesOrg' => $ciudadesOrg,
                'ciudadesDes' => $ciudadesDes,
                'servicios' => $servicios
            ]);
        }


        public function enviarEmailCompra($emailCliente) {
            // Cuerpo del mensaje
            $mensaje = "<h1 style='color: green;'>Compra realizada correctamente</h1>
                        <p>Datos de la reserva:</p>
                        <table>
                            <thead>IDA</thead>
                        
                        </table>";


            $emailService = Services::emailService();
            $resultado = $emailService->sendEmail(
                $emailCliente,
                'Confirmación de compra',
                '<h1>Gracias por su compra</h1><p>Recuerde llevar su billete impreso o en su dispositivo móvil.</p>'
                );


            return $resultado;
        }

        // Función que registra la compra en la BD y manada correo al cliente
        public function realizarCompra() {
            // Obtener datos de la compra
            $id_ruta = $_POST['servicioSel'];
            // Asiento luego... 
            
            // Insertar la reserva en la BD
            $reservaGrabada = $this->modeloReservas->agregarReserva(
                session()->get('dniCliente'), $id_ruta, session()->get('numAsiento'));

            // Enviar correo al cliente 'methodo enviarcorreo
            $emailService = Services::emailService();
            $resultado = $emailService->sendEmail(
                'elfezzazimohamedsaid@gmail.com',
                'Asunto de Prueba',
                '<h1>Este es un mensaje de prueba</h1><p>Saludos desde tu aplicación web.</p>'
            );


            return view('v_home', ['compraOk' => $reservaGrabada,
                        'emailOk' => $resultado]);
                        
            // return view('v_home', ['emailOk' => $resultado]);
        }        
       
} 


?>