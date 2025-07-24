<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\TypeformResponse;
use App\Services\WebHookServices;
use App\Services\MasterService;
use App\Services\ConfigSurveyService;
class WebhookController extends Controller
{
    public function __construct(WebHookServices $webHookServices,MasterService $masterService, ConfigSurveyService $configSurveyService)
    {
        $this->webHookServices = $webHookServices;
        $this->masterService = $masterService;
        $this->configSurveyService = $configSurveyService;
    }
    
    //Typeform Webhooks
    public function typeFormWebhooksHandle(Request $request)
    {
        $data = $request->getContent();
        $results = json_decode($data);
        $params = [
            'type_form_id' => $results->form_response->form_id,
            'type_form_title' => $results->form_response->definition->title,
            'type_form_type' => $results->event_type,
            'request' => $results->form_response->definition->title,
            'response' => $data,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('webhook_log')->insert($params);
        $resData = $this->storeSurveyConfigData($results->form_response);
        return $resData;
    }

    public function storeSurveyConfigData($postData){
        $params = [];
        if(isset($postData) && !empty($postData)){
            $typeFormId = $postData->form_id;
            $surveyResults = $this->configSurveyService->getSurveyConfigByWhereId('type_form_id',$typeFormId);
            if(isset($surveyResults) && !empty($surveyResults)){                
                $answers = $postData->answers;
                if(isset($answers) && !empty($answers)){
                    $uParams = [];
                    foreach ($answers as $answer) {
                        if ($answer->type == "text") {
                            if (empty($uParams['name'])) {
                                $uParams['name'] = $answer->text." ";
                            }else {
                                $uParams['name'] .= $answer->text . ' ';
                            // $uParams['lastname'] = $answer->text . ' ';
                            }
                        }
                        if ($answer->type == "phone_number") {
                            $uParams['phone_no'] = $answer->phone_number;
                        }
                        if ($answer->type == "email") {
                            $uParams['email'] = $answer->email;
                        }
                    }
                }else{
                    $responses =  ['status'=>202, 'msg'=>'answer not fount.'];
                    return json_encode($responses);
                }
               $users = $this->configSurveyService->getUserByWhereId('email', $uParams['email']);
               if(isset($users)) {
                    $uParams['user_id'] = $users->id;
                }else{
                    $uParams['password'] = Hash::make("123456");
                    $results = $this->webHookServices->insertGetId('users', $uParams);
                    if($results){
                        $users = $this->configSurveyService->getUserByWhereId('email', $uParams['email']);
                        $uParams['user_id'] = $users->id;
                    }
                } 
               $params['survey_id'] = $surveyResults->id;
               $params['user_id'] = $uParams['user_id'];
               $params['user_type'] = $surveyResults->user_type;
               $params['survey_type'] = $surveyResults->survey_type;
               $params['user_name'] = $uParams['name'];
               $params['user_email'] = $uParams['email'];
               $params['user_phone'] = $uParams['phone_no'];
               $params['email_status'] = $surveyResults->selected_email;
               $params['pushnotification_status'] = $surveyResults->survey_notification_status;
               $params['typeform_title'] = $surveyResults->type_form_title;
               $params['typeform_type'] = $surveyResults->type_form_type;
               $params['discount_code'] = $surveyResults->discount_code;
               $params['discount_type'] = $surveyResults->discount_type;
               $params['discount_price'] = $surveyResults->discount_value;
               $params['reward_points'] = $surveyResults->reward_points;
               $params['score'] = $postData->calculated->score;
               $params['response_type'] = "completed";
               $params['response_time'] = $postData->submitted_at;
               $params['status'] = "completed";
               $params['created_at'] = date('Y-m-d H:i:s');
               $results = $this->configSurveyService->createSurveyResult($params);
               $responses = ['status'=>200,'data'=>$results,'msg'=>'Survey Results create successFully..!'];
               return json_encode($responses);
            }else{
                $responses =  ['status'=>201, 'msg'=>'Survey not found.'];
                return json_encode($responses);
            }
            $responses = ['status'=>500,'msg'=>'Something went to wrong'];
            return json_encode($responses);
        }else{
            $responses = ['status'=>500,'msg'=>'Internal server error'];
            return json_encode($responses);
        }
    }

    
   

    //Shopify webhooks
    public function shopifyOrderWebhooksHandle(Request $request)
    {
        $data = $request->getContent();
        $results = $this->webHookServices->storeOrderWebHooks($data);
        return $results;
    }


    //Shopify webhooks users
    public function shopifyCustomerWebhooksHandle(Request $request)
    {
        $data = $request->getContent();
        $results = $this->webHookServices->storeCustomerWebHooks($data);
        if($results['status']){
            $postData = $results['data'];
            $params['name'] = !empty($postData->first_name) ? $postData->first_name." ".$postData->last_name: "";
            $params['email'] = !empty($postData->email) ? $postData->email : "";
            $params['password'] = Hash::make("123456");
            $params['phone_no'] = !empty($postData->phone) ? $postData->phone : 0;
            $params['shopify_user_id'] = !empty($postData->admin_graphql_api_id) ? $postData->admin_graphql_api_id : "";
            $params['created_at'] = date('Y-m-d H:i:s');
            $where['shopify_user_id']  =  $postData->admin_graphql_api_id;
            $checkProAvailability = $this->webHookServices->getSingleData('users', $where);
            if(isset($checkProAvailability) && !empty($checkProAvailability)){
                $results = $this->webHookServices->updatedData('users', $where, $params);
            }else{
                $results = $this->webHookServices->insertGetId('users', $params);
            }
        }
        return $results;
    }


    //Shopify webhooks Product
    public function shopifyProductWebhooksHandle(Request $request)
    {
        $data = $request->getContent();
        $results = $this->webHookServices->storeProducteWebHooks($data);
        if($results['status']){
            $postData = $results['data'];
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
            $where['shopify_product_id']  =  $postData->admin_graphql_api_id;
            $checkProAvailability = $this->webHookServices->getSingleData('product_tbl', $where);
            if(isset($checkProAvailability) && !empty($checkProAvailability)){
                $results = $this->webHookServices->updatedData('product_tbl', $where, $params);
            }else{
                $results = $this->webHookServices->insertGetId('product_tbl', $params);
               
            }
        }
        return $results;
    }
}
