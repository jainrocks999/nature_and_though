<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MasterService;

class ApiTypeFormController extends Controller 
{
    public function __construct(MasterService $masterService) 
    {
        $this->masterService = $masterService;
    }

    public function cloneTypeFormData(Request $request)
    {
        $results =  $this->masterService->cloneTypeFormData($request->all());
        return $results;
    }









   
}