<?php

namespace App\Repository;

use App\Interface\ResponseTypeFormInterface;
use App\Models\TypeFormResponse;

class ResponseTypeFormRepository implements ResponseTypeFormInterface 
{

    public function getAllTypeFormResponse() 
    {
        return TypeFormResponse::all();
    }

    public function getTypeFormResponseById($typeFormResponseId) 
    {
        return TypeFormResponse::findOrFail($typeFormResponseId);
    }

    public function deleteTypeFormResponse($typeFormResponseId) 
    {
        TypeFormResponse::destroy($typeFormResponseId);
    }

    public function createTypeFormResponse(array $createTypeFormResponseDetails) 
    {
        return TypeFormResponse::create($createTypeFormResponseDetails);
    }

    public function updateTypeFormResponse($typeFormResponseId, array $updateTypeFormResponseDetails) 
    {
        return TypeFormResponse::whereId($typeFormResponseId)->update($updateTypeFormResponseDetails);
    }

    public function checkTypeFormResponseDuplicate($typeFormeId,$typeFormResponseId){
        return TypeFormResponse::where('form_id',$typeFormeId)
                                ->where('response_id',$typeFormResponseId)
                                ->first();
    }
}