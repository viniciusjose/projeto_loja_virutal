<?php
    class CategoryRepository extends Model{

        public function insertCategory($cod, $name){
            if($this->checkCategory($cod, $name) == true){
                $sql = $this->db->prepare("INSERT INTO category (cod_category, name_category) VALUES (:cod_category, :name_category)");
                $sql->bindValue(":cod_category", $cod);
                $sql->bindValue(":name_category", $name);
                $sql->execute();
                return true;
            }else{
                return false;
            }
        }
        
        private function checkCategory($cod, $name){
            $sql="SELECT cod_category FROM category WHERE (cod_category = '$cod' OR name_category = '$name')";
            $sql = $this->db->query($sql);
            if($sql->rowCount() > 0){
                return false;
            }else{
                return true;
            }
        }
        public function updateProduct(){

        }
        public function deleteProduct(){

        }

    }
?>