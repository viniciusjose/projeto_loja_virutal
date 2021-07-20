<?php

namespace MyApp\Controller;

use MyApp\Core\Controller;
use MyApp\Model\CategoryRepository;
use MyApp\Model\ProductCategories;

/**
 * Realiza todas as implementações das páginas relacionadas a categorias.
 *
 * Classe responsável por conter toda a regra de negocio da implementação
 * de categorias no sistema.
**/
class CategoryController extends Controller
{
    /**
     * Página Principal de categorias do sistema.
     *
     * Método responsável por realizar a chamada do template e desenhar a pagina inicial
     * de categorias.
     *
     **/
    public function index()
    {
        $data = [
            'title' => 'Categorias',
            'BASE_URL' => BASE_URL,
            'scriptPage' => 'Category'
        ];
        $this->loadTemplate('Categories', $data);
    }
    /**
     * Página de adição de novas categorias da aplicação
     *
     * Método responsável por realizar a chamada do template e desenhar a
     * pagina de adição de novas categorias no sistema.
     *
     **/
    public function addScreen()
    {
        $data = [
            'title' => 'Adicionar Categoria',
            'BASE_URL' => BASE_URL,
            'scriptPage' => 'add/AddCategoryScreen'
        ];
        $this->loadTemplate('AddCategory', $data);
    }
    /**
     * Página de edição de categorias da aplicação.
     *
     * Método responsável por realizar a chamada do template e desenhar a pagina de edição
     * de novas categorias no sistema e imprimir os dados da categoria cadastradas selecionada.
     *
     * @param Integer $id número de identificação da categoria selecionada.
     **/
    public function editScreen(int $id)
    {
        $id = intval($id);
        $cateRepo = new CategoryRepository();
        $dataCategory = $cateRepo->listCategoryById($id);
        $data = [
            'title' => 'Editar Categoria',
            'BASE_URL' => BASE_URL,
            'scriptPage' => 'edit/EditCategoryScreen',
            'category-code' => $dataCategory['cod_category'],
            'category-name' => $dataCategory['name_category']
        ];
        $this->loadTemplate('EditCategory', $data);
    }
    /**
     * Método de persistência de novas categorias ao banco de dados.
     *
     * Método responsável por receber a requisição ajax do script Category.js, tratar as informações
     * e requisitar a função (insertCategory) de inserção de categoria ao banco de dados que esta localizada
     * na pasta Models/CategoryRepository.php
     *
     * @return Boolean
     **/
    public function addCategory()
    {
        $status = true;
        $cateRepo = new CategoryRepository();
        $name = ucfirst(addslashes($_POST['category-name']));
        $cod = strtoupper($_POST['category-code']);

        $categoryFormData = [
            "name" => $name,
            "cod"  => $cod
        ];
        if ($cateRepo->insertCategory($categoryFormData)) {
            echo json_encode($status);
            return;
        }
        $status = false;
        echo json_encode($status);
    }
    /**
     * Update de categorias
     *
     * Método responsável por receber a requisição ajax do front-end
     * com as informações a serem alteradas no banco de dados, e em
     * posse das mesmas requisita o método que altera as informações no banco.
     *
     * @param Integer $id Id de identificação da categoria recebido pela requisição ajax.
     *
     **/
    public function updateCategory(int $id)
    {
        $status = true;
        $cateRepo = new CategoryRepository();
        $id = addslashes($id);
        $name = ucfirst(addslashes($_POST['category-name']));
        $cod = strtoupper($_POST['category-code']);

        $categoryFormData = [
            "id"   => $id,
            "name" => $name,
            "cod"  => $cod
        ];
        if ($cateRepo->updateCategory($categoryFormData)) {
            echo json_encode($status);
            return;
        }
        $status = false;
        echo json_encode($status);
    }
    /**
     * Exclusão de categorias.
     *
     * Método responsável por receber a requisição ajax do Front-end e chamar
     * o método auxiliar de exclusão de categorias no banco de dados.
     *
     * @param Integer $id Id da categoria recebida pela requisição ajax.
     **/
    public function removeCategory(int $id)
    {
        $relationship = new ProductCategories();
        $relationship->deleteRelationshipCategory($id);

        $cateRepo = new CategoryRepository();
        $cateRepo->removeCategory($id);
    }
    /**
     * Função de listagem de categorias
     *
     * Função responsável por receber a requisição ajax e retornar em json
     * todas os dados de categorias cadastradas no banco de dados.
     *
     **/
    public function listCategory()
    {
        $jsonCategory = [];
        $cateRepo = new CategoryRepository();
        $dataCategory = $cateRepo->listCategory();
        echo json_encode($dataCategory, JSON_UNESCAPED_UNICODE);
    }
}
