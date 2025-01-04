<?php
    namespace App\Controllers;

    use App\Models\ModeloReservas;
    use App\Models\ModeloRutas;
    use App\Models\ModeloBuses;
    use App\Models\ModeloClientes;
    use Config\Services;

    class CReserva extends BaseController {

        protected $modeloReservas;
        protected $modeloRutas;
        protected $modeloBuses;
        protected $modeloClientes;

        public function __construct() {
            $this->modeloReservas = new ModeloReservas();
            $this->modeloRutas = new ModeloRutas();
            $this->modeloBuses = new ModeloBuses();
            $this->modeloClientes = new ModeloClientes();
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

        // Función que envía un correo al cliente con los detalles de la compra
        public function enviarEmailCompra($emailCliente, $fechaIda, $horaSalidaIda, $origen, $destino,$numTicket, $asiento) {
            // Formatear la hora a H:i
            $horaSalidaIda = date('H:i', strtotime($horaSalidaIda));
            // Cuerpo del mensaje
            $cuerpo = "<h1 style='color: green;'>Compra realizada correctamente</h1>
                <p>Datos de la reserva:</p><br><br>
                <div style='border: 2px dashed black; width: 450px; padding: 10px;'>
                    <table border='0' style='border-collapse: collapse; width: 100%;'>
                    <tbody>
                        <tr>
                            <td alight='center' colspan='100'><b><i>IDA</i></b></td>
                        </tr>
                        <tr>
                            <td>FECHA</td>
                            <td align='left'><b>{$fechaIda}</b></td>
                            <td>&nbsp;</td>
                            <td>HORA</td>
                            <td align='left'><b>{$horaSalidaIda}</b></td>
                        </tr>
                        <tr>
                            <td>SERVICIO</td>
                            <td align='left' colspan='100'><b>{$origen} - {$destino}</b></td>
                        </tr>
                        <tr>
                            <td>NUM.ASIENTO</td>
                            <td align='left'><b>{$asiento}</b></td>
                            <td>NUM.TICKET</td>
                            <td align='left'><b>{$numTicket}</b></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <br>
                <b><i>Muchas gracias por la compra ¡Buen viaje!</i></b>
            ";

            $emailService = Services::emailService();
            $resultado = $emailService->sendEmail(
                $emailCliente,
                'Confirmacion de compra',
                $cuerpo
                );
            return $resultado;
        }

        // Función que registra la compra en la BD y manada correo al cliente
        public function realizarCompra() {
            // Obtener datos de la compra
            $id_ruta = $_POST['servicioSel'];
            // Asiento luego... 
            
            // Insertar la reserva en la BD
            $asiento = session()->get('numAsiento');
            $reservaGrabada = $this->modeloReservas->agregarReserva(
                session()->get('dniCliente'), $id_ruta, $asiento);

            // Enviar correo al cliente 'methodo enviarcorreo
            $datosRuta = $this->modeloRutas->dameDatosRuta($id_ruta);

            $emailCliente = $this->modeloClientes->dameCliente(session()->get('dniCliente'))->email;
            $fechaIda = $datosRuta->fecha;
            $horaSalidaIda = $datosRuta->hora_salida;
            $origen = $datosRuta->ciudad_origin;
            $destino = $datosRuta->ciudad_destino;
            $numTicket = $this->modeloReservas->dameIdTicket(session()->get('dniCliente'), $id_ruta, date('Y-m-d'));
            
            $emailEnviado = $this->enviarEmailCompra($emailCliente, $fechaIda, $horaSalidaIda, $origen, $destino,$numTicket, $asiento);


            return view('v_home', ['compraOk' => $reservaGrabada,
                        'emailOk' => $emailEnviado]);
        }        
       
} 


?>