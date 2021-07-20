<?php

namespace MyApp\Model;

use MyApp\Core\Model;
use MyApp\Model\Interfaces\IProduct;
use MyApp\Model\ProductCategories;

/**
 * Classe responsável por realizar a persistência dos dados
 * relacionados a produtos no banco de dados.
 */
class ProductRepository extends Model implements IProduct
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
        if ($stmt->rowCount() > 0) {
            return $this->removeDuplicate($stmt->fetchAll());
        }
        return;
    }
    /**
     * Contagem de produtos cadastrados.
     *
     * executa query para contagem de todos os produtos
     * cadastrados no banco de dados e o disponibiliza
     * para a instanciação.
     *
     * @return Integer
     **/
    public function countProducts()
    {
        $sql = "SELECT count(*) as count_product FROM product";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
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
    public function listProductById(int $id)
    {
        $sql = "SELECT p.id, sku, name_product, name_category, price, description_product, image_product, quantity 
                FROM product as p LEFT JOIN product_category as pc ON p.id = pc.id_product 
                LEFT JOIN category as c ON pc.id_category = c.id WHERE p.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
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
     * @param Array $productData
     * @param Array $id_categories
     * @return Boolean boolean
     **/
    public function insertProduct(array $productData, array $id_categories)
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
        $stmt->bindValue(":sku", $productData["sku"]);
        $stmt->bindValue(":name_product", $productData["name"]);
        $stmt->bindValue(":price", $productData["price"]);
        $stmt->bindValue(":description_product", $productData["description"]);
        $stmt->bindValue(":image_product", $productData["image_path"]);
        $stmt->bindValue(":quantity", $productData["quantity"]);
        $stmt->execute();
        $id_prod = intval($this->db->lastInsertId());
        $relationship = new ProductCategories();
        for ($i = 0; $i < count($id_categories); $i++) {
            $relationship->createRelationship($id_prod, $id_categories[$i]);
        }
        return true;
    }
    /**
     * Edição de produto.
     *
     * Função responsável por receber a requisição da classe controller e
     * editar um produto previamente cadastrado no banco de dados.
     *
     * @param Array $productData
     * @param Array $id_categories
     * @return Boolean boolean
     **/
    public function editProduct(array $productData, array $id_categories)
    {

        $sql = "UPDATE product SET 
        sku = :sku, 
        name_product = :name_product, 
        price = :price, 
        description_product = :description_product,
        quantity = :quantity
        WHERE id = :id_product";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":sku", $productData["sku"]);
        $stmt->bindValue(":name_product", $productData["name"]);
        $stmt->bindValue(":price", $productData["price"]);
        $stmt->bindValue(":description_product", $productData["description"]);
        $stmt->bindValue(":quantity", $productData["quantity"]);
        $stmt->bindValue(":id_product", $productData["id"]);
        $stmt->execute();

        $relationship = new ProductCategories();
        $relationship->deleteRelationshipProduct($productData["id"]);

        for ($i = 0; $i < count($id_categories); $i++) {
            $relationship->createRelationship($productData["id"], $id_categories[$i]);
        }

        if ($productData["image_path"] === true) {
            return true;
        }
        $this->updateImage($productData["id"], $productData["image_path"]);
        return true;
    }
    /**
     * Atualiza a imagem do produto
     *
     * Recebe como parâmetro o id do produto e nome da imagem,
     * primeira ação a ser executada é a exclusão da antiga imagem
     * cadastrada para o produto e após a exclusão é realizada o
     * cadastrado da nova imagem do produto.
     *
     * @param Integer $id_prod Id do produto.
     * @param String $image nome da nova imagem a ser cadastrada.
     */
    private function updateImage($id_prod, $image)
    {

        $img_prod = $this->listProductById($id_prod);
        $img_prod = $img_prod[0]['image_product'];

        $this->unlinkImageProduct($img_prod);

        $sql = "UPDATE product SET image_product = :image_prod WHERE id = :id_prod";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":image_prod", $image);
        $stmt->bindValue(":id_prod", $id_prod);
        $stmt->execute();
    }
    /**
     * Remoção de produto cadastrado.
     *
     * Recebe o Id do produto como parâmetro e realiza a exclusão
     * do produto do banco de dados e apaga a imagem vinculada ao produto
     * armazenada na pasta de imagens de produtos.
     *
     * @param Integer $id Id do produto a ser excluído.
     **/
    public function removeProduct($id)
    {
        /**
         * Listagem do produto cadastrado para utilizar a função
         * unlink para excluir a imagem do produto da pasta de imagens.
         */
        $listProduct = $this->listProductById($id);

        $this->unlinkImageProduct($listProduct[0]['image_product']);

        $prodCategories = new ProductCategories();
        $prodCategories->deleteRelationshipProduct($id);

        $sql = "DELETE FROM product WHERE id = :id_prod";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_prod", $id);
        $stmt->execute();
    }
    /**
     * Deleta imagem da pasta Assets/images/product
     *
     * Recebe como parâmetro o nome da imagem a ser deletada
     * da pasta de armazenamento e executa o comando unlink
     * para deletar o arquivo para evitar problemas com excesso
     * de arquivos inutilizados.
     *
     * @param String $img_name Nome da imagem a ser deletada
     **/
    private function unlinkImageProduct($img_name)
    {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/Assets/images/product/' . $img_name);
    }
    /**
     * Remove a duplicação dos dados recebidos pelo banco dados.
     *
     * Ao entrar como parâmetro nesta  função os valores são duplicados,
     * pois podemos ter mais de 1 categoria associada em um produto, este método
     * realiza a remoção dos dados duplicados e disponibiliza todas as categorias
     * como um array multi dimensional.
     *
     * @param Array $query dados duplicados recebidos pelo banco de dados
     * @return Array
     **/
    private function removeDuplicate($query): array
    {
        $uniqueProducts = [];
        foreach ($query as $product) {
            if (!array_key_exists($product['id'], $uniqueProducts)) {
                array_push($uniqueProducts, $product['id']);
            }
        }
        $productData = [];
        foreach ($uniqueProducts as $product) {
            $productData[$product] = [];
            $productData[$product]['categories'] = [];
            foreach ($query as $register) {
                if ($register['id'] == $product) {
                    $productData[$product]['name_product'] = $register['name_product'];
                    $productData[$product]['sku'] = $register['sku'];
                    $productData[$product]['price'] = $register['price'];
                    $productData[$product]['quantity'] = $register['quantity'];
                    $productData[$product]['image_product'] = $register['image_product'];
                    $productData[$product]['id_prod'] = $register['id'];
                    $productData[$product]['number_products'] = $register['number_products'];
                    array_push($productData[$product]['categories'], $register['name_category']);
                }
            }
        }
        return $productData;
    }
}
