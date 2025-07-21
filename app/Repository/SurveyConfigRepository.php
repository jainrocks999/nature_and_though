<?php

namespace App\Repository;

use App\Interface\SurveyConfigInterface;
use App\Models\SurveyConfig;

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

   
}