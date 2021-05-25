<?php
    class ProductController extends Controller{
        public function index(){
            $data = [
                'page' => 'Produtos'
            ];
            $this->loadTemplate('Products', $data);
        }
        public function addScreen(){
            $data = [
                'page' => 'Adicionar Produtos'
            ];
            $this->loadTemplate('AddProduct', $data);
        }
        public function addProduct(){
            $status = true;
            $prodRepo = new ProductRepository();
            $image = new ImageController();
            //verificação dos campos digitados pelo usuário e inserção do produto ao banco de dados
            if((isset($_POST['sku']) && !empty($_POST['sku'])) &&
            (isset($_POST['name']) && !empty($_POST['name'])) &&
            (isset($_POST['price']) && !empty($_POST['price'])) &&
            (isset($_POST['quantity']) && !empty($_POST['quantity'])) &&
            (isset($_POST['category']) && !empty($_POST['category'])) &&
            (isset($_POST['description']) && !empty($_POST['description']))) {
                    
                $product = new Product();
                
                $sku = addslashes(strtoupper($_POST['sku']));
                $name = addslashes(ucwords($_POST['name']));
                $price = addslashes(floatval(str_replace(",", ".", $_POST['price'])));
                $category = $_POST['category'];
                $quantity = addslashes(intval(intval($_POST['quantity'])));
                $image = $_POST['category'];
                $description = addslashes(ucfirst($_POST['description']));

                //Função upload é executada para pegar a imagem selecionada pelo usuário e retornar o caminho da imagem
                $imageDirectory = $image->AddProductImage();
                if($prodRepo->createProduct($sku, $name, $price, $description, $imageDirectory, $quantity, $category)){
                    return $status;
                }
            }
        }
    }
   
?>