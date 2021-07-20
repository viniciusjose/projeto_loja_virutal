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
     **/
    public function editScreen(int $id)
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
        foreach ($listCategory as $category) {
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
     */
    public function listProduct()
    {
        $prodRepo = new ProductRepository();
        $listProduct = $prodRepo->listProduct();
        /**
         * Mapeando o array para tratar o preço do produto para o padrão
         * de moeda brasileiro.
         */
        $map = array_map(function ($value) {
            $value['price'] = number_format($value['price'], 2, ',', '.');
            return $value;
        }, $listProduct);
        echo json_encode($map);
    }
    /**
     * Listagem de produto pelo ID de identificação.
     *
     * Método responsável por receber a requisição ajax e fornecer
     * todos os dados dos produtos cadastrados no banco de dados.
     *
     */
    public function imageProductEditScreen(int $id)
    {
        $prodRepo = new ProductRepository();
        $product = $prodRepo->listProductById($id);
        echo json_encode($product[0]["image_product"]);
    }
    /**
     * Método de adicionar produtos ao banco de dados.
     *
     * responsável por receber o requisição ajax
     * e chamar o model responsável pela persistência
     * de produtos no banco de dados.
     *
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
        $array_category = $_POST['category'];
        $description = addslashes(ucfirst($_POST['description']));

        /**
         * Função upload é executada para pegar a imagem selecionada
         * pelo usuário e retornar o caminho da imagem, caso o arquivo
         * escolhido não seja do formato suportado retorna falso para
         * o front-end tratar a exceção.
         */
        $imageDirectory = $image->addProductImage();


        $productFormData  = [
            "sku" => $sku,
            "name" => $name,
            "price" => $price,
            "description" => $description,
            "image_path" => $imageDirectory,
            "quantity" => $quantity,
        ];

        if ($imageDirectory != false) {
            if ($prodRepo->insertProduct($productFormData, $array_category)) {
                echo json_encode($status);
                return;
            }
        }
        $status = false;
        echo json_encode($status);
        return;
    }
    /**
     * Método de editar produtos do banco de dados.
     *
     * responsável por receber o requisição ajax
     * e chamar o model responsável pela alteração
     * de produtos cadastrados no banco de dados.
     *
     **/
    public function editProduct(int $id_product)
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

        /**
         * Função upload é executada para pegar a imagem selecionada
         * pelo usuário e retornar o caminho da imagem
         */
        $imageDirectory = $image->addProductImage();

        $productFormData  = [
            "id" => $id_product,
            "sku" => $sku,
            "name" => $name,
            "price" => $price,
            "description" => $description,
            "image_path" => $imageDirectory,
            "quantity" => $quantity,
        ];
        if ($imageDirectory != false) {
            if ($prodRepo->editProduct($productFormData, $category)) {
                echo json_encode($status);
                return;
            }
        }
        $status = false;
        echo json_encode($status);
        return;
    }
    /**
     * Remoção de produtos
     *
     * Método responsável por receber a requisição AJAX
     * e requisitar a exclusão do produto para a classe
     * responsável pelo dados da aplicação.
     *
     * @param Int $id Id do produto a ser excluído
     **/
    public function removeProduct(int $id)
    {
        $prodRepo = new ProductRepository();
        $prodRepo->removeProduct($id);
    }
}
