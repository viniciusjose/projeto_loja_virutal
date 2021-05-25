<?php

    class ProductRepository extends Model{

        /**
         * Inserção de produto.
         *
         * Função responsável por receber os dados do formulário de produto e adicionar ao banco de dados.
         * 
         * @param Type $skuProd, $name_prod, $price_prod, $desc_prod, $image_prod, $qtd_prod, $id_categorias
         * @return type boolean
         **/
        public function insertProduct($skuProd, $name_prod, $price_prod, $desc_prod, $image_prod, $qtd_prod, $id_categorias){
            $id_product;
            $sql = "INSERT INTO product (sku, name_product, price, description_product, image_product, quantity) VALUES (:sku, :name_product, :price, :description_product, :image_product, :quantity)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":sku",$skuProd);
            $sql->bindValue(":name_product",$name_prod);
            $sql->bindValue(":price", $price_prod);
            $sql->bindValue(":description_product",$desc_prod);
            $sql->bindValue(":image_product",$image_prod);
            $sql->bindValue(":quantity",$qtd_prod);
            $sql->execute();
            $id_prod = intval($database->lastInsertId());
            
            for($i = 0; $i < count($id_categorias); $i++){

                try {
                    $query = "INSERT INTO product_category (id_category, id_product) VALUES ('$id_categorias[$i]','$id_prod')";
                    $query = $database->query($query);
                } catch (PDOException $e) {
                    echo "Erro: ".$e->getMessage();
               }
            }
            
            return true;
        }
        
    }
?>