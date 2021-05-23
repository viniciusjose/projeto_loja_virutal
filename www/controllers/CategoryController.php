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
            if(isset($_POST['category-name'], $_POST['category-code']) && (!empty($_POST['category-name']) && !empty($_POST['category-code']))){
                $cateRepo = new CategoryRepository();
                $name = ucfirst($_POST['category-name']);
                $cod = strtoupper($_POST['category-code']);
                if($cateRepo->insertCategory($name, $cod) == false){
                    return true;
                }else{
                    return false;
                }
                
                
            } 
        }
        
    }
?>