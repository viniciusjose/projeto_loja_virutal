<?php
    namespace MyApp\Controller;

    use MyApp\Core\Controller;
    use MyApp\Model\ProductRepository;
    use MyApp\Controller\ImageController;
    
    /**
     * Classe responsável por todas as requisições de produtos do sistema.
     */
    class ProductController extends Controller
    {
        /**
         * Método de renderização da página principal de produtos.
         *
         * Responsável por requisitar para a camada view, o conteúdo a ser exibido
         * na tela de Produtos do sistema.
         *
         * @var Array $data Informações que serão inseridas na view Products.html
         **/
        public function index()
        {
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
        public function addScreen()
        {
            $data = [
                'title' => 'Adicionar Produtos',
                'BASE_URL' => BASE_URL,
                'scriptPage' => 'add/AddProductScreen'
            ];
            $this->loadTemplate('AddProduct', $data);
        }
        /**
         * Método de renderização da página de editar produtos.
         *
         * Responsável por realizar a requisição dos dados a serem
         * exibidos para o usuário e a chamada da tela de edição
         * de produtos.
         *
         * @var Array $data Informações que serão inseridas na view AddProduct.html
         **/
        public function editScreen($id)
        {   
            $prodRepo = new ProductRepository();
            $data = [
                'title' => 'Adicionar Produtos',
                'BASE_URL' => BASE_URL,
                'scriptPage' => 'add/AddProductScreen'
            ];
            $this->loadTemplate('AddProduct', $data);
        }
        public function listProduct()
        {
            $prodRepo = new ProductRepository();
            echo json_encode($prodRepo->listProduct());
        }
        /**
         * Método de renderização da página de Logs
         *
         * Responsável por requisitar para a camada view o conteúdo a ser
         * exibido na tela de Logs do sistema.
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
        public function addProduct()
        {
            $status = true;
            $prodRepo = new ProductRepository();
            $image = new ImageController();
            $sku = addslashes(strtoupper($_POST['sku']));
            $name = addslashes(ucwords($_POST['name']));
            $price = addslashes(
                floatval(str_replace(",", ".", $_POST['price']))
            );
            $quantity = addslashes(intval(intval($_POST['quantity'])));
            $category = $_POST['category'];
            $description = addslashes(ucfirst($_POST['description']));

            /**Função upload é executada para pegar a imagem selecionada 
             * pelo usuário e retornar o caminho da imagem
             */
            $imageDirectory = $image->AddProductImage();
            
            if ($prodRepo->insertProduct($sku, $name, $price, $description,
                $imageDirectory, $quantity, $category)) {
                return json_encode($status);
            }
            
        }
        /**
         * undocumented function summary
         *
         * Undocumented function long description
         *
         * @param Type $var Description
         * @return type
         * @throws conditon
         **/
        public function removeProduct($id)
        {
            $prodRepo = new ProductRepository();
            $prodRepo->removeProduct($id);
        }
    }