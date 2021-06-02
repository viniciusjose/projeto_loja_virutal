<?php
    namespace MyApp\Model;

    use MyApp\Core\Model;
    
    interface categoryTemplate
    {
        public function insertCategory($cod, $name);
        public function updateCategory($id, $cod, $name);
        public function removeCategory($id);
    }

    /**
     * Classe responsável por realizar a persistência dos dados
     * relacionados a Categoria no banco de dados.
     */
    class CategoryRepository extends Model implements categoryTemplate
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
            $allCategory = [];
            $sql = "SELECT * FROM category";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            if ($sql->rowCount() > 0){
                $allCategory = $sql->fetchAll();
            }
            return $allCategory;
        }
        /**
         * Listagem da categoria selecionada pelo usuário para edição.
         * Método responsável por realizar a consulta da categoria selecionada pelo
         * usuário e retornar um array com todos os dados da categoria.
         * 
         * @param Integer $id número de identificação da categoria selecionada.
         * @return Array
         **/
        public function listCategoryById($id)
        {
            $sql = 'SELECT cod_category, name_category FROM category WHERE id = :id';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0){
                return $sql->fetch();
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
        public function insertCategory($cod, $name)
        {
            if ($this->checkCategory($cod, $name) == false) {
                return false;
            }
            $sql = $this->db->prepare("INSERT INTO category (cod_category, name_category) VALUES (:cod_category, :name_category)");
            $sql->bindValue(":cod_category", $cod);
            $sql->bindValue(":name_category", $name);
            $sql->execute();
            return true;
        }
        /**
         * Método de atualização de categorias cadastradas no banco de dados.
         *
         * Método recebe a requisição do controller com os dados da categoria
         * e realiza a ação de update das informações no banco de dados.
         *
         * @param Integer $id Id de identificação da categoria.
         * @param String $cod Código da categoria.
         * @param String $name Nome da categoria.
         * @return Boolean
         **/
        public function updateCategory($id, $cod, $name)
        {
            if($this->checkCategory($cod, $name) == true){
                $sql = "UPDATE category SET cod_category = :cod_cat, name_category = :name_cat WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":cod_cat", $cod);
                $sql->bindValue(":name_cat", $name);
                $sql->bindValue(":id", $id);
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
        public function removeCategory($id)
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
        private function checkCategory($cod, $name)
        {
            $sql="SELECT cod_category FROM category WHERE (cod_category = '$cod' OR name_category = '$name')";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0){
                return false;
            }
            return true;
        }
    }