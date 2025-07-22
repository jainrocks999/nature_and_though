<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    protected $table = 'survey_response_tbl';
    protected $fillable = [
     'survey_id',
      'user_id',
      'score',
      'min_score',
      'max_score',
      'reward_type',
      'reward_points',
      'discounct_code_id',
      'product_ids',
      'status',
      'created_at',
      'updated_at',

    ];

}
