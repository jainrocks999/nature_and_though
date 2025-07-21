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
        //Single Type Form get
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
        public function createSurveyConfig($postdata){
        return $this->surveyConfigInterface->createSurveyConfig($postdata);
    }
       public function updateSurveyConfig($surveyId, $postdata){
        return $this->surveyConfigInterface->updateSurveyConfig($surveyId, $postdata);
    }
        public function deleteSurveyConfig($surveyId){
        return $this->surveyConfigInterface->deleteSurveyConfig($surveyId);
    }







    //Product method
        public function getAllUser(){
        return $this->userInterface->getAllUser();
    }
        public function getAllProduct(){
        return $this->productInterface->getAllProduct();
    }

       public function getProductByWhere($where){
        return $this->productInterface->getProductByWhere($where);
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