<?php

namespace MyApp\Model;

use MyApp\Core\Model;
use MyApp\Model\Interfaces\IProductCategory;

/**
 *
 * Classe responsável por realizar toda a persistência entre
 * o relacionamento de produtos e categorias.
 *
 */
class ProductCategories extends Model implements IProductCategory
{
    /**
     * Listagem do relacionamento entre produtos e categorias.
     *
     * Baseado no id do produto fornecido na assinatura do método,
     * é realizado a consulta ao banco de dados, para listar todos
     * os relacionamentos com categorias um produto tem.
     *
     * @param Integer $id id do produto a ser consultado.
     * @return Array
     **/
    public function listRelationship(int $id)
    {
        $sql = "SELECT * FROM product_category WHERE id_product = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
    }
    /**
     * Criação do relacionamento entre produtos e categorias
     *
     * Método responsável por realizar a inserção do relacionamento
     * N:N no banco de dados, inserindo os valores de referencia de
     * categorias e produtos.
     *
     * @param Integer $id_product Id do produto a ser criado relacionamento.
     * @param Integer $id_category Id da categoria a ser vinculada ao produto.
    **/
    public function createRelationship(int $id_product, int $id_category)
    {
        $sql = "INSERT INTO product_category (id_category, id_product) VALUES ( :id_cat, :id_prod)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_cat", $id_category);
        $stmt->bindValue(":id_prod", $id_product);
        $stmt->execute();
    }
    /**
     * Exclusão do relacionamento de categorias com produtos.
     *
     * Método responsável por receber como parâmetro o id da
     * categoria e realizar a exclusão do relacionamento entre
     * categorias e produtos.
     *
     * @param Integer $id_category Id da categoria a ser excluída do
     *  relacionamento.
    **/
    public function deleteRelationshipCategory(int $id_category)
    {
        $sql = "DELETE FROM product_category WHERE id_category = :id_cat";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_cat", $id_category);
        $stmt->execute();
    }
    /**
     * Exclusão do relacionamento de produtos com categorias.
     *
     * Método responsável por receber como parâmetro o id do
     * produtos e realizar a exclusão do relacionamento entre
     * produtos e categorias.
     *
     * @param Integer $id_category Id da categoria a ser excluída do
     *  relacionamento.
    **/
    public function deleteRelationshipProduct(int $id_product)
    {
        $sql = "DELETE FROM product_category WHERE id_product = :id_prod";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_prod", $id_product);
        $stmt->execute();
    }
}
