<?php
    
namespace MyApp\Controller;

use MyApp\Core\Controller;
use MyApp\Model\ProductRepository;
use MyApp\Controller\ImageController;
use MyApp\Model\ProductCategories;
use MyApp\Model\CategoryRepository;

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
        $listProduct = $prodRepo->listProductById($id);

        $prodCategories = new ProductCategories();
        $listRelationship = $prodCategories->listRelationship($id);

        foreach ($listRelationship as $productCategory) {
            $product_categories_id[] = $productCategory['id_category'];
        }
        $cateRepo = new CategoryRepository();
        $listCategory = $cateRepo->listCategory();

        $categories = '';
        foreach($listCategory as $category){
            $check = (in_array($category['id'], $product_categories_id) ? 'selected=1' : '');
            $categories .= "<option $check value='{$category['id']}'>{$category['name_category']}</option>";
        }
        $data = [
            'title'       => 'Editar Produtos',
            'BASE_URL'    =>  BASE_URL,
            'scriptPage'  => 'edit/EditProductScreen',
            'SKU'         => $listProduct[0]['sku'],
            'NAME'        => $listProduct[0]['name_product'], 
            'QUANTITY'    => $listProduct[0]['quantity'],
            'PRICE'       => number_format($listProduct[0]['price'], 2, ',', '.'),
            'DESCRIPTION' => $listProduct[0]['description_product'],
            'NAME_IMAGE'  => $listProduct[0]['image_product'],
            'option'      => $categories
        ];
        $this->loadTemplate('EditProduct', $data);
    }
    /**
     * Listagem de produtos
     * 
     * Método responsável por receber a requisição ajax e fornecer
     * todos os dados dos produtos cadastrados no banco de dados.
     * 
     * @var Array $listProduct Lista de produtos cadastrados no banco de dados. 
     * @var Array $map Tratamento da lista de produtos para padrão brasileiro
     * de moeda.
     */
    public function listProduct()
    {
        $prodRepo = new ProductRepository();
        $listProduct = $prodRepo->listProduct();
        /**
         * Mapeando o array para tratar o preço do produto para o padrão
         * de moeda brasileiro.
         */
        $map = array_map(function($value){
            $value['price'] = number_format($value['price'], 2, ',', '.');
            return $value;
        }, $listProduct);
        echo json_encode($map);
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
     * Remoção de produtos
     *
     * Método responsável por receber a requisição AJAX
     * e requisitar a exclusão do produto para a classe
     * responsável pelo dados da aplicação.
     *
     * @param Integer $id Id do produto a ser excluído
     **/
    public function removeProduct($id)
    {
        $prodRepo = new ProductRepository();
        $prodRepo->removeProduct($id);
    }
}