<?php

namespace MyApp\Model\Interfaces;

interface ICategory
{
    public function insertCategory(array $categoryData);
    public function updateCategory(array $categoryData);
    public function removeCategory(int $id);
}
