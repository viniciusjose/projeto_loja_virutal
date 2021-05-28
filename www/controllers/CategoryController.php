<?php
    class CategoryController extends Controller{
        public function index(){
            $data = [
                'page' => 'Categorias'
            ];
            $this->loadTemplate('Categories', $data);
        }
        public function addScreen(){
            $data = [
                'page' => 'Categorias'
            ];
            $this->loadTemplate('AddCategory', $data);
        }
        public function addCategory(){
            $status = true;
            $cateRepo = new CategoryRepository();
            $name = ucfirst(addslashes($_POST['category-name']));
            $cod = strtoupper($_POST['category-code']);
            if($cateRepo->insertCategory($cod, $name)){
                echo json_encode($status);
            }else{ 
                $status = false;
                echo json_encode($status);
            }
            
        }
        
    }
?>