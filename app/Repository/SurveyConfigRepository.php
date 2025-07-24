<?php

namespace App\Repository;

use App\Interface\SurveyConfigInterface;
use App\Models\SurveyConfig;
use App\Models\SurveyResult;

class SurveyConfigRepository implements SurveyConfigInterface 
{

    public function getAllSurveyConfig() 
    {
        return SurveyConfig::all();
    }

    public function getSurveyConfigById($surveyConfigId) 
    {
        return SurveyConfig::findOrFail($surveyConfigId);
    }
    
    public function getSurveyConfigByWhereId($whereParams,$surveyConfigId) 
    {
        return SurveyConfig::where($whereParams,$surveyConfigId)->first();
    }

    public function getSurveyConfigByWhere($where) 
    {
        return SurveyConfig::where($where)->get();
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
    
}