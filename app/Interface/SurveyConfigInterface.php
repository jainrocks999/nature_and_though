<?php

namespace App\Interface;

interface SurveyConfigInterface
{
    public function getAllSurveyConfig();
    public function getSurveyConfigById($surveyConfigId);
    public function deleteSurveyConfig($surveyConfigId);
    public function createSurveyConfig(array $createSurveyConfigDetails);
    public function updateSurveyConfig($surveyConfigId, array $updateSurveyConfigDetails);
  
}
