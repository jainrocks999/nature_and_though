<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyConfig extends Model
{
    protected $table = 'survey_config_tbl';
    protected $fillable = [
       'id',
       'survey_type',
       'type_form_id',
       'type_form_title',
       'notification_freq',
       'custom_days',
       'survey_notification_status',
       'discount_code',
       'discount_type',
       'discount_user_type',
       'discount_value',
       'discount_status',
       'score',
       'reward_points',
       'status',
       'created_at',
       'updated_at'
    ];

    public function products()
    {
        return $this->belongsTo(ProductSuggestion::class);
    }

    public function setParam($postdata){
        return [
            // "user_type" => $postdata['user_type'],
            "type_form_id" => $postdata['type_form_id'],
            "survey_type" => $postdata['survey_type'],
            // "selected_email" => $postdata['selected_email'],
            "survey_notification_status" => isset($postdata['survey_notification_status']) ? $postdata['survey_notification_status'] : 'disable',
            "notification_freq" => $postdata['notification_freq'],
            // "custom_days" => $postdata['custom_days'],
            "discount_status" => $postdata['discount_status'],
            "discount_type" => $postdata['discount_type'],
            "discount_code" => $postdata['discount_code'],
            "discount_value" => $postdata['discount_value'],
            "reward_points" => $postdata['reward_points'],
            "status" => $postdata['status']
        ];
    }
}
