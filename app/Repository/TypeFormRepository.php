<?php

namespace App\Repository;

use App\Interface\TypeFormInterface;
use App\Models\TypeForm;

class TypeFormRepository implements TypeFormInterface 
{

    public function getAllTypeForms() 
    {
        return TypeForm::all();
    }

    public function getTypeFormById($typeFormId) 
    {
        return TypeForm::findOrFail($typeFormId);
    }

    public function deleteTypeForm($typeFormId) 
    {
        TypeForm::destroy($typeFormId);
    }

    public function createTypeForm(array $createTypeFormDetails) 
    {
        return TypeForm::create($createTypeFormDetails);
    }

    public function updateTypeForm($typeFormId, array $updateTypeFormDetails) 
    {
        return TypeForm::whereId($typeFormId)->update($updateTypeFormDetails);
    }

    public function getFulfilledTypeForms() 
    {
        return TypeForm::where('is_fulfilled', true);
    }

    public function checkTypeFormDuplicate($typeFormId){
        return TypeForm::where('type_form_id',$typeFormId)->first();
    }
}