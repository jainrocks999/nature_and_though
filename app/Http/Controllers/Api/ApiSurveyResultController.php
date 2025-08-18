<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ConfigSurveyService;
use App\Models\SurveyConfig;
use App\Models\Product;


class ApiSurveyResultController extends Controller 
{
    public function __construct(ConfigSurveyService $configSurveyService) 
    {
        $this->configSurveyService = $configSurveyService;
    }

    public function getUserSurveyResult(Request $request)
    {
        $where = ["user_email"=>$request->email];
        $surveyResults =  $this->configSurveyService->getSurveyResultByWhere($where);
        $params = [];
        if(isset($surveyResults) && !empty($surveyResults)){
            foreach($surveyResults as $key => $surveyResult){
                $params['survey_response'][] =  $surveyResult;
               
                $survey = $this->configSurveyService->getSurveyConfigById($surveyResult->survey_id);
                $params['survey_details'][$key] =  $survey;

                //Get Product suggestion
                $where = ["survey_id"=>$survey->id];
                $productSuggestions = $this->configSurveyService->getProductSugByWhere($where);

                if(isset($productSuggestions) && !empty($productSuggestions)){
                    $params['product_suggestion'] =  $productSuggestions;
                    $productData = [];
                    foreach($productSuggestions as $productSuggestion){
                        $productIds = json_decode($productSuggestion->product_id);
                        foreach($productIds as $productId){
                            $products = Product::where('shopify_product_id', $productId)->first();
                            $productData[] = $products;
                        }
                    }
                }
                $params['product'][$key] =  $productData;
            }
            // return json_encode(['status'=>200,'data'=>$params,'msg'=>'Survey results data']);
            return response()->json(['status'=>200,'data'=>$params,'msg'=>'Survey results data'],
            200,['Access-Control-Allow-Origin' => '*']);
        }else{
            //return json_encode(['status'=>201,'data'=>[],'msg'=>'Survey results not found']);
            return response()->json(['status'=>201,'data'=>[],'msg'=>'Survey results not found'],
                200,['Access-Control-Allow-Origin' => '*']);
        }
    }









   
}