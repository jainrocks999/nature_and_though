<?php

namespace App\Services;
use App\Interface\TypeFormInterface;
use App\Interface\ResponseTypeFormInterface;
use App\Interface\SurveyConfigInterface;
use App\Interface\UserInterface;
use App\Interface\ProductInterface;
use DB;
class ConfigSurveyService 
{    
    protected TypeFormInterface $typeFormInterface;
    protected ResponseTypeFormInterface $responseTypeFormInterface;
    protected SurveyConfigInterface $surveyConfigInterface;
    protected UserInterface $userInterface;
    protected ProductInterface $productInterface;
    public function __construct(
        TypeFormInterface $typeFormInterface,
        ResponseTypeFormInterface $responseTypeFormInterface,
        SurveyConfigInterface $surveyConfigInterface,
        UserInterface $userInterface,
        ProductInterface $productInterface
    ){
        $this->typeFormInterface = $typeFormInterface;
        $this->responseTypeFormInterface = $responseTypeFormInterface;
        $this->surveyConfigInterface = $surveyConfigInterface;
        $this->userInterface = $userInterface;
        $this->productInterface = $productInterface;

    }

    //Typeform data provided
        public function getAllTypeForms(){
        return $this->typeFormInterface->getAllTypeForms();
    }
        //Single TypeForm get
        public function getTypeFormByWhere($where){
        return $this->typeFormInterface->getTypeFormByWhere($where);
    }

  





    //Survey Config method provide
    public function getAllSurveyConfig(){
        return $this->surveyConfigInterface->getAllSurveyConfig();
    }
    public function getSurveyConfigById($surveyId){
        return $this->surveyConfigInterface->getSurveyConfigById($surveyId);
    }  
    public function getSurveyConfigByWhereId($where, $surveyId){
        return $this->surveyConfigInterface->getSurveyConfigByWhereId($where, $surveyId);
    }
    public function getSurveyConfigByWhere($where){
        return $this->surveyConfigInterface->getSurveyConfigByWhere($where);
    }
    public function createSurveyConfig($postdata){
        return $this->surveyConfigInterface->createSurveyConfig($postdata);
    }
    public function updateSurveyConfig($surveyId, $postdata){
        return $this->surveyConfigInterface->updateSurveyConfig($surveyId, $postdata);
    }
    public function deleteSurveyConfig($surveyId){
        return $this->surveyConfigInterface->deleteSurveyConfig($surveyId);
    }

    //Survey Config results
    public function getAllSurveyResult(){
        return $this->surveyConfigInterface->getAllSurveyResult();
    }
  
    public function getSurveyResultByWhereId($where, $surveyResultId){
        return $this->surveyConfigInterface->getSurveyResultByWhereId($where, $surveyResultId);
    }
    public function getSurveyResultByWhere($where){
        return $this->surveyConfigInterface->getSurveyResultByWhere($where);
    }
    public function createSurveyResult($createSurveyConfigDetails){
        return $this->surveyConfigInterface->createSurveyResult($createSurveyConfigDetails);
    }

    //Survey User Results
    public function  getUserSurveyResults($userId){
         return $this->surveyConfigInterface->getUserSurveyResults($userId);
    }

    


    //Product method
    public function getAllUser(){
        return $this->userInterface->getAllUser();
    }
    public function getUserByWhereId($where, $userId){
        return $this->userInterface->getUserByWhereId($where, $userId);
    }



    //Products Method
    public function getAllProduct(){
        return $this->productInterface->getAllProduct();
    }
    public function getProductByWhereId($shopifyProductId){
        return $this->productInterface->getProductByWhereId($shopifyProductId);
    }
       public function getProductByWhereIds($shopifyProductId){
        return $this->productInterface->getProductByWhereIds($shopifyProductId);
    }
    public function getProductByWhere($where){
        return $this->productInterface->getProductByWhere($where);
    }
    public function createProduct($postData){
        return $this->productInterface->createProduct($postData);
    }
    public function updateProduct($shopifyProductId, $postData){
        return $this->productInterface->updateProduct($shopifyProductId, $postData);
    }




    //product suggestion method
    public function getProductSugByWhere($where){
        return $this->productInterface->getProductSugByWhere($where);
    }
    public function deleteProductSug($productSugId){
        return $this->productInterface->deleteProductSug($productSugId);
    }
    public function createProductSuggestion($postData){
        return $this->productInterface->createProductSuggestion($postData);
    }
    public function updateProductSuggestion($productSugId, $postData){
        return $this->productInterface->updateProductSuggestion($productSugId, $postData);
    }





    
}