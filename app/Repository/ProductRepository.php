<?php

namespace App\Repository;

use App\Interface\ProductInterface;
use App\Models\Product;
use App\Models\ProductSuggestion;

class ProductRepository implements ProductInterface 
{

    public function getAllProduct() 
    {
        return Product::all();
    }

    public function getProductById($productId) 
    {
        return Product::findOrFail($productId);
    }

    public function getProductByWhereId($shopifyProductId) 
    {
        return Product::where('shopify_product_id',$shopifyProductId)->first();
    }

    public function getProductByWhereIds($shopifyProductId) 
    {
        return Product::whereIn('shopify_product_id',$shopifyProductId)->get()->toArray();
    }


     public function getProductByWhere($where) 
    {
        return Product::where($where)->get();
    }

    public function deleteProduct($productId) 
    {
        Product::destroy($productId);
    }

    public function createProduct(array $createProductDetails) 
    {
        return Product::create($createProductDetails);
    }

    public function updateProduct($productId, array $updateProductDetails) 
    {
        return Product::whereId('shopify_product_id',$productId)->update($updateProductDetails);
    }





    //Product suggestion 
    public function getProductSugByWhere($where) 
    {
        return ProductSuggestion::where($where)->get();
    }

    public function deleteProductSug($productSugId) 
    {
        ProductSuggestion::destroy($productSugId);
    }

    public function createProductSuggestion(array $createProductSuggestion) 
    {
        return ProductSuggestion::create($createProductSuggestion);
    }

    public function updateProductSuggestion($productSugId, array $updateProductSuggestion) 
    {
        return ProductSuggestion::whereId($productSugId)->update($updateProductSuggestion);
    }
}