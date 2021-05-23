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
            
            $cateRepo = new CategoryRepository();
            $name = ucfirst(utf8_encode(addslashes($_POST['category-name'])));
            $cod = strtoupper($_POST['category-code']);
            if($cateRepo->insertCategory($cod, $name)){
                echo "Produto cadastrado com sucesso";
            }else{ 
                echo "Nome ou Código de categorias já existem no banco de dados";
            }
            
        }
        
    }
?>