<?php

namespace MyApp\Model;

use MyApp\Core\Model;
use MyApp\Model\Interfaces\ICategory;

/**
 * Classe responsável por realizar a persistência dos dados
 * relacionados a Categoria no banco de dados.
 */
class CategoryRepository extends Model implements ICategory
{
    /**
     * Listagem de todas as categorias cadastradas no banco de dados
     *
     * Método responsável por realizar a consulta de todas categorias cadastradas
     * no banco de dados e retornar um array para a classe controller.
     *
     * @return Array
     **/
    public function listCategory()
    {
        $sql = "SELECT * FROM category";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return;
    }
    /**
     * Listagem da categoria selecionada pelo usuário para edição.
     * Método responsável por realizar a consulta da categoria selecionada pelo
     * usuário e retornar um array com todos os dados da categoria.
     *
     * @param Integer $id número de identificação da categoria selecionada.
     * @return Array
     **/
    public function listCategoryById(int $id)
    {
        $sql = 'SELECT cod_category, name_category FROM category WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }
    }
    /**
     * Método de inserção de novas categorias ao banco de dados.
     *
     * Ao entrar com todas as informações de categoria, primeiramente
     * é realizado uma verificação de categorias pré cadastradas no
     * banco de dados para evitar duplicidade de categorias cadastradas.
     *
     * @param Type $cod Código da categoria.
     * @param Type $name Nome da categoria.
     * @return type Boolean
     **/
    public function insertCategory(array $categoryData)
    {

        if ($this->checkCategory($categoryData['cod'], $categoryData['name']) == false) {
            return false;
        }
        $sql = $this->db->prepare("INSERT INTO category (cod_category, name_category) VALUES (:cod_category, :name_category)");
        $sql->bindValue(":cod_category", $categoryData['cod']);
        $sql->bindValue(":name_category", $categoryData['name']);
        $sql->execute();
        return true;
    }
    /**
     * Método de atualização de categorias cadastradas no banco de dados.
     *
     * Método recebe a requisição do controller com os dados da categoria
     * e realiza a ação de update das informações no banco de dados.
     *
     * @param Array $categoryData Array com todas as informações da
     * categoria editada.
     * @return Boolean
     **/
    public function updateCategory(array $categoryData)
    {
        if ($this->checkCategory($categoryData["cod"], $categoryData["name"]) == true) {
            $sql = "UPDATE category SET cod_category = :cod_cat, name_category = :name_cat WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_cat", $categoryData["cod"]);
            $sql->bindValue(":name_cat", $categoryData["name"]);
            $sql->bindValue(":id", $categoryData["id"]);
            $sql->execute();
            return true;
        }
        return false;
    }
    /**
     * Exclusão de categoria.
     *
     * Método responsável por realizar a remoção da categoria selecionada no banco
     * de dados.
     *
     * @param Integer $id Id de identificação do produto
     */
    public function removeCategory(int $id)
    {
        $sql = "DELETE FROM category WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
    /**
     * Checagem de categorias já cadastradas
     *
     * Realiza a verificação de categorias com nome e código
     * de categoria já existentes no banco de dados.
     *
     * @param Integer $cod Código da categoria.
     * @param String $name Nome da categoria.
     * @return Boolean
     **/
    private function checkCategory(string $cod, string $name)
    {
        $sql = "SELECT cod_category FROM category WHERE (cod_category = '$cod' AND name_category = '$name')";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return false;
        }
        return true;
    }
}
