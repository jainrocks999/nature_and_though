<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeForm extends Model
{
    use HasFactory;
    protected $table = 'survey_type_form_tbl';
    protected $fillable = [
        'type_form_id',
        'type_form_type',
        'title',
        'setting',
        'workspace',
        'self',
        'theme',
        '_links',
        'fields',
        'thankyou_screen',
        'created_at',
        'last_updated_at'
    ];

    function setParams($postData){
        return [
            'type_form_id' => $postData->id,
            'type_form_type' => $postData->type,
            'title' => $postData->title,
            'setting' => json_encode($postData->settings),
            'workspace' => isset($postData->workspace) ? $postData->workspace : '',
            'self' => json_encode($postData->self),
            'theme' => json_encode($postData->theme),
            '_links' => json_encode($postData->_links),
            'fields' => isset($postData->fields) ? $postData->fields : '',
            'thankyou_screen' => isset($postData->thankyou_screen) ? $postData->thankyou_screen : '',
            'created_at' => $postData->created_at,
            'last_updated_at' => $postData->last_updated_at
        ];
    }
}
