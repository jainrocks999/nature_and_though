<?php

namespace App\Interface;

interface SurveyConfigInterface
{
    public function getAllSurveyConfig();
    public function getSurveyConfigById($surveyConfigId);
    public function getSurveyConfigByWhereId($where, $surveyId);
    public function getSurveyConfigByWhere($where);
    public function deleteSurveyConfig($surveyConfigId);
    public function createSurveyConfig(array $createSurveyConfigDetails);
    public function updateSurveyConfig($surveyConfigId, array $updateSurveyConfigDetails);


    //Survey Config Results
    public function getAllSurveyResult();
    public function getSurveyResultByWhereId($where, $surveyId);
    public function getSurveyResultByWhere($where);
    public function createSurveyResult(array $createSurveyConfigDetails);

    //User Survey Results
    public function  getUserSurveyResults($userId);
    
}
