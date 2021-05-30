<?php
    namespace Controllers;
    /**
     * Classe responsável por todas as requisições de produtos do sistema.
     */
    class ProductController extends Controller{
        /**
         * Método de renderização da página principal de produtos.
         *
         * Responsável por requisitar para a camada view, o conteúdo a ser exibido
         * na tela de Produtos do sistema.
         *
         * @var Array $data Informações que serão inseridas na view Products.html
         **/
        public function index(){
            $data = [
                'title' => 'Produtos',
                'BASE_URL' => BASE_URL,
                'scriptPage' => 'Product'
            ];
            $this->loadTemplate('Products', $data);
        }
        /**
         * Método de renderização da página de adicionar produtos.
         *
         * Responsável por requisitar para a camada view o conteúdo a ser exibido
         * na tela adicionar novos produtos no sistema.
         *
         * @var Array $data Informações que serão inseridas na view AddProduct.html
         **/
        public function addScreen(){
            $data = [
                'title' => 'Adicionar Produtos',
                'BASE_URL' => BASE_URL,
                'scriptPage' => 'add/AddProductScreen'
            ];
            $this->loadTemplate('AddProduct', $data);
        }
        /**
         * Método de renderização da página de Logs
         *
         * Responsável por requisitar para a camada view o conteúdo a ser exibido
         * na tela de Logs do sistema.
         *
         * @var Boolean $status Status da transação com o banco de dados para ser
         * retornado em JSON para a requisição AJAX
         * @var Object $prodRepo Objeto instanciado da classe ProductRepository.
         * @var Object $image Objeto instanciado da classe ImageController.
         * @var String $sku Código SKU do produto.
         * @var String $name Nome do Produto.
         * @var Float $price Preço do produto.
         * @var Array $category Todas as categorias selecionadas para o produto.
         * @var Integer $quantity Quantidade de produtos em estoque.
         * @var String $image Caminho do arquivo onde a imagem foi salva.
         * @var String $description Descrição completa do produto.
         **/
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
                    return json_encode($status);
                }
            }
        }
    }
   
?>