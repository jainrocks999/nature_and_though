<?php

namespace App\Services;
use App\Interface\TypeFormInterface;
use DB;
class WebHookServices
{    
    public function __construct()
    {
        $this->accessToken = env('PERSONAL_ACCESS_TOKEN');
        $this->baseUrl = env('TYPEFORM_URL');
    }

    //Shopify webhooks call method
    public function storeOrderWebHooks($postData){
        $results = json_decode($postData);
        $setData = [
            'title' => 'order-create-update',
            'user_id' => 0,
            'product_id' => 0,
            'order_id' => $results->admin_graphql_api_id,
            'response' => $postData,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $tblName = 'shopify_webhooks_log';
        $response = $this->insertGetId($tblName,$setData);
         return ['status'=>$response, 'data'=>$results];
    }

    //Shopify webhooks call method
    public function storeCustomerWebHooks($postData){
        $results = json_decode($postData);
        $setData = [
            'title' => 'customer-create-update',
            'user_id' => $results->admin_graphql_api_id,
            'product_id' => 0,
            'order_id' =>0,
            'response' => $postData,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $tblName = 'shopify_webhooks_log';
        $response = $this->insertGetId($tblName,$setData);
         return ['status'=>$response, 'data'=>$results];
    }


    //Shopify Product webhooks 
    public function storeProducteWebHooks($postData){
        $results = json_decode($postData);
        $setData = [
            'title' => 'product-create-update',
            'user_id' => 0,
            'product_id' => $results->admin_graphql_api_id,
            'order_id' => 0,
            'response' => $postData,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $tblName = 'shopify_webhooks_log';
        $response = $this->insertGetId($tblName,$setData);
        return ['status'=>$response, 'data'=>$results];
    }


    public function insertGetId($tblName,$setData){
        return DB::table($tblName)->insert($setData);
    }

    public function updatedData($tblName, $where, $setData){
        return DB::table($tblName)->where($where)->update($setData);
    }
    
    public function getSingleData($tblName, $where){
        return DB::Table($tblName)->where($where)->first();
    }
    
}