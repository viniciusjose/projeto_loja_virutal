<?php
    namespace MyApp\Models;

    use MyApp\Core\Model;

    class ProductRepository extends Model
    {

        /**
         * Inserção de produto.
         *
         * Função responsável por receber a requisição da classe controller e
         * inserir um novo produto ao banco de dados.
         * 
         * @param String $skuProd
         * @param String $name_prod
         * @param Float $price_prod
         * @param String $desc_prod
         * @param String $image_prod
         * @param Integer $qtd_prod
         * @param Array $id_categories
         * @return Boolean boolean
         **/
        public function insertProduct($skuProd, $name_prod, $price_prod, $desc_prod, 
        $image_prod, $qtd_prod, $id_categories)
        {
            $sql = "INSERT INTO product (
                sku, 
                name_product, 
                price, 
                description_product, 
                image_product, 
                quantity
            ) 
            VALUES (
                :sku, :name_product, 
                :price, 
                :description_product, 
                :image_product,
                :quantity
            )";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":sku",$skuProd);
            $sql->bindValue(":name_product",$name_prod);
            $sql->bindValue(":price", $price_prod);
            $sql->bindValue(":description_product",$desc_prod);
            $sql->bindValue(":image_product",$image_prod);
            $sql->bindValue(":quantity",$qtd_prod);
            $sql->execute();
            $id_prod = intval($database->lastInsertId());    
            $this->insertCategoryInProduct($id_prod, $id_categories);
            return true;
        }
        private insertCategoryInProduct($id_product, $id_categories)
        {
            for ($i = 0; $i < count($id_categories); $i++) {

                try {
                    $sql = "INSERT INTO product_category (id_category, id_product) 
                        VALUES (
                            '$id_categories[$i]',
                            '$id_prod'
                        )
                    ";
                    $sql = $this->db->query($query);
                } catch (PDOException $e) {
                    echo "Erro: ".$e->getMessage();
                }
            }
        }
        
    }