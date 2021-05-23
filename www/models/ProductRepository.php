<?php
    interface Product{
        public function insertProduct();
        public function updateProduct();
        public function deleteProduct();
    }
    class ProductRepository extends Model implements Product{
            public function insertProduct(){
                
            }
            public function updateProduct(){

            }
            public function deleteProduct(){

            }
    }
?>