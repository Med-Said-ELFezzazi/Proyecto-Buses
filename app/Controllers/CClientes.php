<?php
    namespace App\Controllers;

    use App\Models\ModeloClientes;
    use stdClass;

    class CClientes extends BaseController {

        protected $modeloClientes;

        public function __construct() {
            $this->modeloClientes = new ModeloClientes();
        }


        // public function autenticacion($email, $cp) {
        //     $cliente = $this->modeloClientes
        //         ->select('id')
        //         ->where('email', $email)
        //         ->where('cp', $cp)
        //         ->first();

        //     return $cliente ? $cliente['id'] : null;   // Devuelve el id sino existe null
        // }



        // public function nuevo() {
        //     // Trae datos personales
        //     if ($this->request->getPost("submit1")) {
        //         // Creo el objeto sin necesitar crear una clase cliente
        //         if ($this->session->get("newCliente")) {
        //             $this->session->set("paso", 0);
        //         }
        //         $cliente = new stdClass();
        //         $cliente->nombre = $this->request->getPost("nombre");
        //         $cliente->apellido1 = $this->request->getPost("apellido1");
        //         $cliente->apellido2 = $this->request->getPost("apellido2");
        //         if (!$this->request->getPost("sexo")) {
        //             $this->session->setFlashData('Debes marcar uno de los dos botones');
        //             return redirect()->back();
        //         }
        //         $cliente->sexo = $this->request->getPost("sexo");
        //         $cliente->email = $this->request->getPost("email");
                
        //         $this->session->set("newCliente", $cliente);
        //         $this->session->set("paso", 1);
        //     }

        //     // Trae datos de direccion -> session
        //     if ($this->request->getPost("submit2")) {
        //         $cliente = $this->session->get("newCliente");
        //         $cliente->nombre = $this->request->getPost("domicilio");
        //         $cliente->municipio = $this->request->getPost("municipio");
        //         $cliente->provincia = $this->request->getPost("provincia");
        //         $cliente->cp = $this->request->getPost("cp");
        //         $this->session->set("paso", 2);
        //     }

        //     if ($this->request->getPost("submit3")) {
        //         // Calcular un ranking para el cliente en función de los datos introducidoas en los 'inputs range'
        //         helper("util");
        //         $aficEnviadas = $this->request->getPost();
        //         unset($aficEnviadas['submit3']);
        //         $valoracion = 0;
        //         foreach ($aficEnviadas as $nombreAfic => $valor) {
        //             $valoracion += $valor * aficiones()[$nombreAfic] / 100;
        //         }
        //         $cliente = $this->session->get("newCliente");
        //         $cliente->ranking = $valoracion;

        //         // Cliente ready lo insertamos en la BD
        //         $this->modeloClientes->insert($cliente);

        //         // Resetear datos de sesión
        //         $this->session->remove("newCliente");
        //         $this->session->remove("paso");

        //         return redirect("/clientes/Nuevo");
        //     }

        //     switch($this->session->get("paso")) {
        //         case 0:
        //             return view("vnewcliente1");
        //             break;
        //         case 1:
        //             return view("vnewcliente2");
        //             break;
        //         case 2:
        //             return view("vnewcliente3");
        //             break;
        //     }
        //     return view("vnewcliente1");
        // }
    }
?>