<?php

namespace App\Interface;

interface ResponseTypeFormInterface
{
    public function getAllTypeFormResponse();
    public function getTypeFormResponseById($typeFormId);
    public function deleteTypeFormResponse($typeFormId);
    public function createTypeFormResponse(array $createTypeFormDetails);
    public function updateTypeFormResponse($typeFormId, array $updateTypeFormDetails);
    public function checkTypeFormResponseDuplicate($typeFormId,$typeFormResponseId);

  
}
