<?php
    namespace App\Controllers;

    use App\Models\ModeloClientes;
    use stdClass;

    class CLogin extends BaseController {

        protected $modeloClientes;

        public function __construct() {
            $this->modeloClientes = new ModeloClientes();
        }



        public function index() {
            // Al click login
            if ($this->request->getPost("submitLogin")) {
                $email = $this->request->getPost("loginEmail");
                $pwd = $this->request->getPost("loginPassword");
                // Primero compruebo si haya introducido algo en los campos
                if (empty($email) || empty($pwd)) {
                    // Envio el msg de error
                    $this->session->setFlashdata([
                        'error' => 'Debes introducir ambos campos!',
                        'email' => $email,                          // Guarda temporalmente los valores
                        'pwd' => $pwd
                    ]);
                    return redirect()->to(site_url('autenticacion'));
                } else {
                    // Compruebo si el cliente existe
                    $dniCliente = $this->modeloClientes->autenticacion($email, $pwd);
                    if ($dniCliente === null) {
                        // Envio el msg de error
                        $this->session->setFlashdata(['error' => 'Error cliente no existe!']);
                        return redirect()->to(site_url('autenticacion'));
                    } else {
                        // Si el cliente existe, guardo su DNI en la session
                        $this->session->set('dniCliente', $dniCliente);
                        // Cargo los nav y side bar con datos y cambio la vista principal a una de bienvenida por eje
                    }
                }
                
            }
            return view("v_login");
        }

    }
?>