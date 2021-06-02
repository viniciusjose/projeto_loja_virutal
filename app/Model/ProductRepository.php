<?php
    namespace MyApp\Model;

    use MyApp\Core\Model;
    use MyApp\Model\ProductCategories;


    class ProductRepository extends Model
    {
        /**
         * Listagem de produtos cadastrados.
         *
         * Método responsável por realizar a busca de todos os
         * produtos cadastrados no banco de dados.
         *
         * @return Array.
         **/
        public function listProduct()
        {
            $sql = "SELECT p.id, sku, name_product, name_category, price, description_product, image_product, quantity 
                    FROM product as p LEFT JOIN product_category as pc ON p.id = pc.id_product 
                    LEFT JOIN category as c ON pc.id_category = c.id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
               return $this->removeDuplicate($stmt->fetchAll());
            }
            return;
        }
        /**
         * Busca por ID de produtos cadastrados.
         *
         * Método responsável por realizar a busca de um produto
         * especifico requisitado pelo Controller.
         *
         * @param Integer Id de identificação do produto.
         * @return Array.
         **/
        public function listProductById($id)
        {
            $sql = "";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }
            return;
        }
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
            $relationship = new ProductCategories();
            for ($i = 0; $i < count($id_categories); $i++) {
                $relationship->createRelationship($id_prod, $id_categories[$i]);
            }   
            return true;
        }
        /**
         * undocumented function summary
         *
         * Undocumented function long description
         *
         * @param Integer $id Id do produto a ser excluído.
         **/
        public function removeProduct($id)
        {
           $prodCategories = new ProductCategories();
           $prodCategories->deleteRelationshipProduct($id);
           $sql = "DELETE FROM product WHERE id = :id_prod";
           $stmt = $this->db->prepare($sql);
           $stmt->bindValue(":id_prod", $id);
           $stmt->execute();
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
        private function removeDuplicate($query):array
        {
            $uniqueProducts = [];
            foreach ($query as $product) { 
                if(!array_key_exists($product['id'], $uniqueProducts)){
                    array_push($uniqueProducts, $product['id']);
                }
            }
            $productData = [];
            foreach ($uniqueProducts as $product) {
                $productData[$product]= [];
                $productData[$product]['categories']= [];
                foreach ($query as $registro) {
                   
                    if($registro['id'] == $product){
                        $productData[$product]['name_product'] = $registro['name_product'];
                        $productData[$product]['sku'] = $registro['sku'];
                        $productData[$product]['price'] = $registro['price'];
                        $productData[$product]['quantity'] = $registro['quantity'];
                        $productData[$product]['image_product'] = $registro['image_product'];
                        $productData[$product]['id_prod'] = $registro['id'];                
                        array_push($productData[$product]['categories'], $registro['name_category']);
                    }
                }
            }
            return $productData;
        }
    }