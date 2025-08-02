<?php

namespace App\Repository;

use App\Interface\SurveyConfigInterface;
use App\Models\SurveyConfig;
use App\Models\SurveyResult;
use App\Models\ProductSuggestion;
use App\Models\Product;
use App\Models\User;

class SurveyConfigRepository implements SurveyConfigInterface 
{

    public function getAllSurveyConfig() 
    {
        return SurveyConfig::where('status','active')->all();
    }

    public function getSurveyConfigById($surveyConfigId) 
    {
        return SurveyConfig::findOrFail($surveyConfigId);
    }
    
    public function getSurveyConfigByWhereId($whereParams,$surveyConfigId) 
    {
        return SurveyConfig::where('status','active')->where($whereParams,$surveyConfigId)->first();
    }

    public function getSurveyConfigByWhere($where) 
    {
        return SurveyConfig::where('status','active')->where($where)->get();
    }


    public function deleteSurveyConfig($surveyConfigId) 
    {
        SurveyConfig::destroy($surveyConfigId);
    }

    public function createSurveyConfig(array $createSurveyConfigDetails) 
    {
        return SurveyConfig::create($createSurveyConfigDetails);
    }

    public function updateSurveyConfig($surveyConfigId, array $updateSurveyConfigDetails) 
    {
        return SurveyConfig::whereId($surveyConfigId)->update($updateSurveyConfigDetails);
    }

   


    public function getAllSurveyResult() 
    {
        return SurveyResult::all();
    }
    public function getSurveyResultByWhereId($whereParams,$surveyConfigId) 
    {
        return SurveyResult::where($whereParams,$surveyConfigId)->first();
    }
    public function getSurveyResultByWhere($where) 
    {
        return SurveyResult::where($where)->get();
    }
    public function createSurveyResult(array $createSurveyResultDetails) 
    {
        return SurveyResult::create($createSurveyResultDetails);
    }
    

    //User Survey results
    public function getUserSurveyResults($userId){
       $params = [];

       $surveyConfigs = SurveyConfig::where('status','active')->get();
       $surveyConfigsCount = $surveyConfigs->count();

       $surveyResults = SurveyResult::where('user_id',$userId)->get();
       $surveyResultsCount = $surveyResults->count();

       $surveyResultsIds = SurveyResult::where('user_id',$userId)->pluck('survey_id');
   
       $user = User::where('id',$userId)->first();
       $rewardPoints = $surveyResults->sum('reward_points');
       $participtionPoints = $surveyResults->sum('participation_points');
       $total = $surveyResults->sum('score');

       $productSuggestion = ProductSuggestion::whereIn('survey_id',$surveyResultsIds)->get();
       if($productSuggestion){
           $product_suggestions = [];
           $proData = [];
            if (!empty($productSuggestion)) {
                foreach ($productSuggestion as $pSuggestion) {
                    $productIds = json_decode($pSuggestion->product_id, true);
                    if (!empty($productIds)) {
                        $products = Product::whereIn('shopify_product_id', $productIds)->get();
                        foreach($products as $proVal){
                            $proImages = json_decode($proVal->product_images, true);
                            $productImg = isset($proImages[0]['src']) ? $proImages[0]['src'] : '';
                            $proData['product_id'] =  $proVal->shopify_product_id;
                            $proData['product_title'] =  $proVal->product_title;
                            $proData['product_sku'] =  $proVal->product_sku;
                            $proData['product_price'] =  $proVal->product_price;
                            $proData['product_image'] =  $productImg;
                            $proData['product_min_score'] = $pSuggestion->min_score;
                            $proData['product_max_score'] = $pSuggestion->max_score;
                            $params['suggested_products'][] = $proData;
                        }
                    }
                }
            }
                
        }
       $params['total_survey'] =  $surveyConfigsCount;
       $params['complete_survey'] = $surveyResultsCount;
       $params['incomplete_survey'] = $surveyConfigsCount - $surveyResultsCount;
       $params['total_score'] =  $surveyResults->sum('score');
       $params['total_reward_points'] =  $participtionPoints + $rewardPoints;
       $params['user_id'] = $user->id;
       $params['user_name'] = $user->name;
       $params['user_email'] = $user->email;
       $params['user_phone'] = $user->phone_no;
       $params['survey_result'] = $surveyResults;
       $params['survey_configs'] = $surveyConfigs;
       $params['product_suggestions'] = $productSuggestion;
       return $params;
    }


}