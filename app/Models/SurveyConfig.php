<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyConfig extends Model
{
    protected $table = 'survey_config_tbl';
    protected $fillable = [
        'id',
        'user_type',
        'type_form_id',
        'type_form_title',
        'type_form_type',
        'survey_type',
        'notification_freq',
        'custom_days',
        'survey_notification_status',
        'selected_email',
        'discount_code',
        'discount_type',
        'discount_user_type',
        'discount_value',
        'discount_status',
        'score',
        'reward_points',
        'participation_points',
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
            "type_form_type" => isset($postdata['type_form_type']) ? $postdata['type_form_type'] : '',
            "survey_type" => $postdata['survey_type'],
            // "selected_email" => $postdata['selected_email'],
            "survey_notification_status" => isset($postdata['survey_notification_status']) ? $postdata['survey_notification_status'] : 'disable',
            "notification_freq" => $postdata['notification_freq'],
            // "custom_days" => $postdata['custom_days'],
            "discount_status" => $postdata['discount_status'],
            "discount_type" => $postdata['discount_type'],
            "discount_code" => $postdata['discount_code'],
            "discount_value" => $postdata['discount_value'],
            "participation_points" => $postdata['participation_points'],
            "reward_points" => $postdata['reward_points'],
            "status" => $postdata['status']
        ];
    }
}
