<?php

    namespace MyApp\Model;

    use MyApp\Core\Model;

    class ProductCategories extends Model
    {
        /**
         * Criação do relacionamento entre produtos e categorias
         *
         * Método responsável por realizar a inserção do relacionamento
         * N:N no banco de dados, inserindo os valores de referencia de
         * categorias e produtos.
         *
         * @param Integer $id_product Id do produto a ser criado relacionamento.
         * @param Integer $id_categories Id da categoria a ser vinculada ao produto.
         **/
        public function createRelationship($id_product, $id_categories)
        {
            $sql = "INSERT INTO product_category (id_category, id_product) VALUES ( :id_cat, :id_prod)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id_cat", $id_categories);
            $stmt->bindValue(":id_prod", $id_product);
            $stmt->execute();
        }

        public function deleteRelationshipCategory($id)
        {
            $sql = "DELETE FROM product_category WHERE id_category = :id_cat";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id_cat", $id);
            $stmt->execute();
        }

        public function deleteRelationshipProduct($id)
        {
            $sql = "DELETE FROM product_category WHERE id_product = :id_prod";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id_prod", $id);
            $stmt->execute();
        }
    }