<?php
    class CategoryController extends Controller{
        public function index(){
            $data = [
                'page' => 'Categorias'
            ];
            $this->loadTemplate('Categories', $data);
        }
        public function add(){
            $data = [
                'page' => 'Categorias'
            ];
            $this->loadTemplate('AddCategory', $data);
        }
    }
?>