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
class TypeformWebhookController extends Controller
{
    public function __construct(WebHookServices $webHookServices)
    {
        $this->webHookServices = $webHookServices;
    }
    
    //Typeform Webhooks
    public function typeFormWebhooksHandle(Request $request)
    {
        $data = $request->getContent();
        $results = json_decode($data);
        $resultData =  DB::table('webhook_log')->insert([
            'type_form_id' => $results->form_response->form_id,
            'type_form_title' => $results->form_response->definition->title,
            'type_form_type' => $results->event_type,
            'request' => $results->form_response->definition->title,
            'response' => $data,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $resultData;
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
