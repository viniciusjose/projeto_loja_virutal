<?php

namespace MyApp\Model\Interfaces;

interface IProductCategory
{
    public function listRelationship(int $id);
    public function createRelationship(int $id_product, int $id_cateogory);
    public function deleteRelationshipProduct(int $id_product);
    public function deleteRelationshipCategory(int $id_cateogory);
}
