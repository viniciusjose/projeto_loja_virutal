<?php
    namespace MyApp\Model;

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
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":sku",$skuProd);
            $stmt->bindValue(":name_product",$name_prod);
            $stmt->bindValue(":price", $price_prod);
            $stmt->bindValue(":description_product",$desc_prod);
            $stmt->bindValue(":image_product",$image_prod);
            $stmt->bindValue(":quantity",$qtd_prod);
            $stmt->execute();
            $id_prod = intval($this->db->lastInsertId());
            for ($i = 0; $i < count($id_categories); $i++) {
                $this->insertCategoryInProduct($id_prod, $id_categories[$i]);
            }   
            return true;
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
        private function insertCategoryInProduct($id_product, $id_categories)
        {
            $sql = "INSERT INTO product_category (id_category, id_product) VALUES ( :id_cat, :id_prod)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id_cat", $id_categories);
            $stmt->bindValue(":id_prod", $id_product);
            $stmt->execute();
        }
        
    }