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
        'product_variants',
        'product_additional',
        'product_images',
        'created_at',
        'updated_at'
    ];
}
