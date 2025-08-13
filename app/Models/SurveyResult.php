<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    protected $table = 'survey_response_tbl';
    protected $fillable = [
      'id',
      'survey_id',
      'user_id',
      'user_type',
      'typeform_id',
      'survey_type',
      'user_name',
      'user_email',
      'user_phone',
      'email_status',
      'pushnotification_status',
      'typeform_title',
      'typeform_type',
      'discount_code',
      'discount_type',
      'discount_price',
      'reward_points',
      'score',
      'response_type',
      'response_time',
      'status',
      'created_at',
      'updated_at'
    ];

}
