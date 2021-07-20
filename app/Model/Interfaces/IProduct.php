<?php

namespace MyApp\Model\Interfaces;

interface IProduct
{
    public function listProduct();
    public function listProductById(int $id);
    public function insertProduct(array $productData, array $id_categories);
    public function editProduct(array $productData, array $id_categories);
    public function removeProduct(int $id);
}
