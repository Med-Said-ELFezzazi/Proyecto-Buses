<?php

    namespace App\Controllers;

    // use App\Models\ModeloCategorias;

    class CTst extends BaseController {

        // protected $modeloCategorias;

        public function __construct() {
            // $this->modeloCategorias = new ModeloCategorias();
        }

        public function index() {
            // $datos['categorias']= $this->modeloCategorias->findAll(); 
            return view("v_tst");
            
        }

        // public function borrar($id) {
        //     $this->modeloCategorias->delete($id);
        //     // Después de borrar vuelvo al index
        //     return $this->index();
        // }

        // public function nueva() {
        //     if ($this->request->is('post')) {
        //         $obj_categoria = (object)$_POST;
        //         $this->modeloCategorias->insert($obj_categoria);
        //         return redirect()->to("/categorias");
        //     } else {
        //         return view("v_newCategoria");
        //     }
        
}
?>