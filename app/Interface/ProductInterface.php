<?php

namespace App\Interface;

interface ProductInterface
{
    public function getAllProduct();
    public function getProductById($productId);
    public function getProductByWhere($where);
    public function deleteProduct($productId);
    public function createProduct(array $createProductDetails);
    public function updateProduct($productId, array $updateProductDetails);

    public function getProductSugByWhere($where);
    public function deleteProductSug($productSugId);
    public function createProductSuggestion(array $createProductSuggestion);
    public function updateProductSuggestion($productSugId, array $updateProductSuggestion);


  
}
