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
     
    //TypeForm response
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
        $results = $query->paginate(100)->appends($request->all());
        return view('admin.typeforms.index', compact('results'));
    }

    //TypeForm get data in typeform
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
            
          }
        }
        return redirect()->route("typeform.getTypeFormData");
    }


    //TypeForm Response List
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
        if ($request->has('type_form_id') && $request->type_form_id != '') {
            $typeFormId = $request->type_form_id;
            $query->where(function($q) use ($typeFormId) {
                $q->where('form_id', 'LIKE', "%$typeFormId%");
            });
        }
        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);
        $results = $query->paginate(10)->appends($request->all());
        $data =  [];
        $data['typeFormLists'] = $this->typeFormInterface->getAllTypeForms();
        $data['selected_typeform_id'] = isset($request->type_form_id) ? $request->type_form_id : "";
        return view('admin.typeforms.response', compact('results', 'data'));
    }
    

    


     //TypeForm get data in typeform reponse
    public function cloneAllTypeFormResponse(Request $request)
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
        return redirect()->route("typeform.getTypeFormResponse");
    }

    //Get A single TypeForm list
    public function getSingleTypeFormResponse($typeFormId){
       $checkingTypeForm = $this->typeFormInterface->getTypeFormById($typeFormId);
       if(isset($checkingTypeForm) && !empty($checkingTypeForm)){
          // Chekcing typeform response
          $typeFormResponseResults =  $this->masterService->getTypeFormResponseData($typeFormId);
          if(isset($typeFormResponseResults) && !empty($typeFormResponseResults)){
            foreach($typeFormResponseResults->items as $val){
              $checkingTypeFormResponse = $this->responseTypeFormInterface->checkTypeFormResponseDuplicate($typeFormId, $val->response_id);
              $objResponse = new TypeFormResponse();
              if(!isset($checkingTypeFormResponse) && empty($checkingTypeFormResponse->id)){
                $setDataTypeForm = $objResponse->setParams($item, $val);
                $this->responseTypeFormInterface->createTypeFormResponse($setDataTypeForm);
              }
            }
          }else {
            return json_encode(['status'=>401,'msg'=>"TypeForm response empty."]); 
          }
       }else{
           return json_encode(['status'=>401,'msg'=>"TypeForm not found."]); 
       }
    }


}
