<?php

namespace App\Interface;

interface TypeFormInterface
{
    public function getAllTypeForms();
    public function getTypeFormById($typeFormId);
    public function deleteTypeForm($typeFormId);
    public function createTypeForm(array $createTypeFormDetails);
    public function updateTypeForm($typeFormId, array $updateTypeFormDetails);
    public function getFulfilledTypeForms();
    public function checkTypeFormDuplicate($typeFormId);
  
}
