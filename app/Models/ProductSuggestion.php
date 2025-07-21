<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSuggestion extends Model
{
    protected $table = 'survey_product_suggestion_tbl';
    protected $fillable = [
        'product_suggestion_id',
        'survey_id',
        'product_id',
        'min_score',
        'max_score',
        'created_at',
        'updated_at',
    ];
}
