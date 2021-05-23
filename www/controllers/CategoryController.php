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
        public function addCategory(){
            
            return true;
            /*$cateRepo = new CategoryRepository();
            $name = ucfirst(utf8_encode(addslashes($_POST['category-name'])));
            $cod = strtoupper($_POST['category-code']);
            $status = true;
            if($cateRepo->insertCategory($cod, $name)){
                return $status;
            }else{ 
                return $status;
            }*/
            
        }
        
    }
?>