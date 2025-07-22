<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product_tbl';
    protected $fillable = [
        'id',
        'shopify_product_id',
        'product_title',
        'product_type',
        'product_desc',
        'product_category',
        'product_collection',
        'product_tag',
        'product_sku',
        'product_price',
        'product_variants',
        'product_additional',
        'product_images',
        'created_at',
        'updated_at'
    ];

    public function setParam($postData){
        $params = [];
        $params['shopify_product_id'] = $postData->admin_graphql_api_id;
        $params['product_title'] = !empty($postData->title) ? $postData->title : "";
        $params['product_type'] = !empty($postData->product_type) ? $postData->product_type : "";
        $params['product_desc'] = !empty($postData->body_html) ? $postData->body_html : "";
        $params['product_category'] = !empty($postData->category) ? json_encode($postData->category) : "";
        $params['product_collection'] = !empty($postData->collection) ? $postData->collection : "";
        $params['product_tag'] = !empty($postData->tags) ? $postData->tags : "";
        $params['product_sku'] = !empty($postData->variants[0]->sku) ? $postData->variants[0]->sku : "";
        $params['product_price'] = !empty($postData->variants[0]->price) ? $postData->variants[0]->price : "";
        $params['product_variants'] = !empty($postData->variants) ? json_encode($postData->variants) : "";
        $params['product_additional'] = !empty($postData->additional) ? $postData->additional : "" ;
        $params['product_images'] = !empty($postData->images) ? json_encode($postData->images) : "";
        $params['created_at'] = date('Y-m-d H:i:s');
        return $params;
    }
    
}
