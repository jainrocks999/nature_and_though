<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TypeFormResponse extends Model
{
    use HasFactory;
    protected $table = 'typeform_responses';
    protected $fillable = [
        'id',
        'response_id',
        'response_type',
        'form_id',
        'form_type',
        'form_title',
        'metadata',
        'hidden',
        'calculated',
        'answers',
        'landed_at',
        'submitted_at',
        'created_at',
        'updated_at'
    ];

    function setParams($formData, $postData){
        $answer = json_encode($postData->answers);
        // $results = $this->useradd($answer);
        return [
            'response_id' => $postData->response_id,
            'response_type' => $postData->response_type,
            'form_id' => $formData->id,
            'form_type' => $formData->type,
            'form_title' => isset($formData->title) ? $formData->title : '',
            'metadata' => json_encode($postData->metadata),
            'hidden' => json_encode($postData->hidden),
            'calculated' => json_encode($postData->calculated),
            'answers' => json_encode($postData->answers),
            'landed_at' => isset($postData->landed_at) ? $postData->landed_at : '',
            'submitted_at' => isset($postData->submitted_at) ? $postData->submitted_at : '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
    
    public function useradd($postData){
        $decodeRes = json_decode($postData);
        $params = [];
        if(isset($decodeRes) && $decodeRes){
            foreach($decodeRes as $val){
                if(isset($val->field) && $val->field->type == "rating"){
                    $params[$val->field->type] = $val->number;
                }
                if(isset($val->field) && $val->field->type == "short_text"){
                    $params['name'] = $val->text;
                }
                if(isset($val->field) && $val->field->type == "short_text"){
                    $params['name'] = $val->text;
                }
            }
        }
        $results = User::where('id',$user_id)->first();
        if($results){
            $results->name = $postData['name'];
        }
        return true;
    }
}
