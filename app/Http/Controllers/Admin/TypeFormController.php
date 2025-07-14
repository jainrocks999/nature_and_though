<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TypeForm;
use App\Models\TypeFormResponse;
use Illuminate\Http\Request;
use App\Services\MasterService;
use App\Interface\TypeFormInterface;
use App\Interface\ResponseTypeFormInterface;
use DB;
class TypeFormController extends Controller
{
    public function __construct(MasterService $masterService,
       TypeFormInterface $typeFormInterface, 
       ResponseTypeFormInterface $responseTypeFormInterface
    ){
        $this->masterService = $masterService;
        $this->typeFormInterface = $typeFormInterface;
        $this->responseTypeFormInterface = $responseTypeFormInterface;    
    }
     
    //Type form response
    public function getTypeFormData(Request $request)
    {
       $query = TypeForm::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('type_form_id', 'LIKE', "%$search%")
                  ->orWhere('type_form_type', 'LIKE', "%$search%")
                  ->orWhere('title', 'LIKE', "%$search%");
            });
        }
        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);
        $results = $query->paginate(10)->appends($request->all());
        return view('admin.typeforms.index', compact('results'));
    }

    //Type form get data in typeform
    public function cloneTypeFormData(Request $request)
    {
        $typeFromResults =  $this->masterService->getTypeFormData($request->all());
        if(isset($typeFromResults) && !empty($typeFromResults->items)){
          $obj = new TypeForm();
          foreach($typeFromResults->items as $item){

            //Chekcing typeform data
            $checkingTypeForm = $this->typeFormInterface->checkTypeFormDuplicate($item->id);
            $setDataTypeForm = $obj->setParams($item);
            if(!isset($checkingTypeForm) && empty($checkingTypeForm->id)){
              $this->typeFormInterface->createTypeForm($setDataTypeForm);
            }
            
           // Chekcing typeform response
            $typeFormResponseResults =  $this->masterService->getTypeFormResponseData($item->id);
            if(isset($typeFormResponseResults) && !empty($typeFormResponseResults)){
              foreach($typeFormResponseResults->items as $val){
                $checkingTypeFormResponse = $this->responseTypeFormInterface->checkTypeFormResponseDuplicate($item->id, $val->response_id);
                $objResponse = new TypeFormResponse();
                if(!isset($checkingTypeFormResponse) && empty($checkingTypeFormResponse->id)){
                  $setDataTypeForm = $objResponse->setParams($item, $val);
                  $this->responseTypeFormInterface->createTypeFormResponse($setDataTypeForm);
                }
              }
            }
          }
        }
        $results = $this->typeFormInterface->getAllTypeForms();
        return view("admin.typeforms.index",compact('results'));
    }


    //Type Form Response List
    public function getTypeFormResponse(Request $request)
    {

      $query = TypeFormResponse::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('form_title', 'LIKE', "%$search%")
                  ->orWhere('form_id', 'LIKE', "%$search%")
                  ->orWhere('response_type', 'LIKE', "%$search%")
                  ->orWhere('response_id', 'LIKE', "%$search%");
            });
        }
        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);
        $results = $query->paginate(10)->appends($request->all());
        return view('admin.typeforms.response', compact('results'));
    }
    


}
