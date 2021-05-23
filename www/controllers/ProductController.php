<?php
    class ProductController extends Controller{
        public function index(){
            $data = [
                'page' => 'Produtos'
            ];
            $this->loadTemplate('Products', $data);
        }
        public function add(){
            $data = [
                'page' => 'Adicionar Produtos'
            ];
            $this->loadTemplate('AddProduct', $data);
        }
    }
   
?>