<?php
    class CategoryRepository extends Model{
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
        public function insertCategory($cod, $name){

            if($this->checkCategory($cod, $name) == false){
                return false;
            }else{
                $sql = $this->db->prepare("INSERT INTO category (cod_category, name_category) VALUES (:cod_category, :name_category)");
                $sql->bindValue(":cod_category", $cod);
                $sql->bindValue(":name_category", $name);
                $sql->execute();
                return true;
            }
        }
        /**
         * Listagem de todas as categorias cadastradas no banco de dados
         *
         * Método responsável por realizar a consulta de todas categorias cadastradas
         * no banco de dados e retornar um array para a classe controller;
         *
         * @return Array
         **/
        public function listCategory()
        {   
            $allCategory = [];
            $sql = "SELECT * FROM category";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            if($sql->rowCount() > 0){
                $allCategory = $sql->fetchAll();
            }
            return $allCategory;
        }
        /**
         * Checagem de categorias já cadastradas
         *
         * Realiza a verificação de categorias com nome e código
         * de categoria já existentes no banco de dados.
         *
         * @param Type $cod Código da categoria.
         * @param Type $name Nome da categoria.
         * @return type Boolean
         **/
        private function checkCategory($cod, $name){
            $sql="SELECT cod_category FROM category WHERE (cod_category = '$cod' OR name_category = '$name')";
            $sql = $this->db->query($sql);
            if($sql->rowCount() > 0){
                return false;
            }else{
                return true;
            }
        }
        

    }
?>