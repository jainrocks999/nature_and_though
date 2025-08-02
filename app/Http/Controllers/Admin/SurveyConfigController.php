<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TypeForm;
use Illuminate\Http\Request;
use App\Models\SurveyConfig;
use App\Models\User;
use App\Models\SurveyResult;
use App\Services\ConfigSurveyService;
use App\Interface\TypeFormInterface;
use App\Interface\ResponseTypeFormInterface;
use DB;
use Illuminate\Support\Arr;
class SurveyConfigController extends Controller
{
    public function __construct(SurveyConfig $surveyConfig, ConfigSurveyService $configSurveyService){
        $this->configSurveyService = $configSurveyService;    
        $this->surveyConfig = $surveyConfig;    
    }
     
    //TypeForm response
    public function getSurveyConfig(Request $request)
    {
      $query = SurveyConfig::query();
        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->where('type_form_title', 'LIKE', "%$search%");
                $q->OrWhere('survey_notification_status', 'LIKE', "%$search%");
                $q->OrWhere('selected_email', 'LIKE', "%$search%");
                $q->OrWhere('status', 'LIKE', "%$search%");
                $q->OrWhere('type_form_type', 'LIKE', "%$search%");
            });
        }
        if ($request->has('type_form_id') && $request->type_form_id != '') {
            $typeFormId = $request->type_form_id;
            $query->where(function($q) use ($typeFormId) {
                $q->where('type_form_id', 'LIKE', "%$typeFormId%");
            });
        }
        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);
        $results = $query->paginate(10)->appends($request->all());
        $data =  [];
        $data['typeFormLists'] = $this->configSurveyService->getAllTypeForms();
        $data['selected_typeform_id'] = isset($request->type_form_id) ? $request->type_form_id : "";
        return view('admin.surveyconfigs.index', compact('results', 'data'));
    }

    public function createSurveyConfig(Request $request)
    {
        $data =  [];
        $data['products'] = $this->configSurveyService->getAllProduct();
        $data['typeForms'] = $this->configSurveyService->getAllTypeForms();
        $data['typeFormstypes'] = collect($data['typeForms'])->unique('type_form_type')->values();
        $data['users'] = $this->configSurveyService->getAllUser();
        return view('admin.surveyconfigs.create', compact('data'));
    }

    public function storeSurveyConfig(Request $request)
    {
        $validated = $request->validate([
            'survey_type'         => 'required',
            'type_form_id'        => 'required|exists:survey_type_form_tbl,type_form_id',
            'survey_notification_status' => 'required',
            'product_id.*'        => 'required',
            'min_score.*'        => 'required|numeric|min:0',
            'max_score.*'          => 'required|numeric|gte:min_score.*',
        ]);
        
        $where['type_form_id'] = $request->type_form_id;
        $typeForms = $this->configSurveyService->getTypeFormByWhere($where);
        $request->merge(['type_form_title' => $typeForms->title]);
        $results = $this->configSurveyService->createSurveyConfig($request->all());
        if (isset($results) && !empty($results)) {
            $productId = $request->input('selected_product_value');
            $productIds = json_decode($productId);
            $minscore = $request->input('min_score');
            $maxscore = $request->input('max_score');
            if (isset($minscore) && !empty($minscore)) {
                $params = [];
                foreach ($minscore as $i => $val) {
                    $params['survey_id'] = $results->id;
                    $params['product_id'] = json_encode($productIds[$i]);
                    $params['min_score'] = $minscore[$i];
                    $params['max_score'] = $maxscore[$i];
                    $params['created_at'] = now();
                    $this->configSurveyService->createProductSuggestion($params);
                }
                session()->flash('success', 'Survey Configuration saved successfully.');
                return redirect()->route("surveyConfig.getSurveyConfig");
            } else {
                session()->flash('error', 'Product not found.');
               return redirect()->back()->withInput();
            }
        } else {
            session()->flash('error', 'Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function editSurveyConfig(Request $request)
    {
        $data = [];
        $results = $this->configSurveyService->getSurveyConfigById($request->id);
        if(isset($results) && !empty($results->id)){ 
            $where['survey_id'] = $request->id;
            $pSuggestions = $this->configSurveyService->getProductSugByWhere($where);
        }
        $data['products'] = $this->configSurveyService->getAllProduct();
        $data['typeForms'] = $this->configSurveyService->getAllTypeForms();
        $data['typeFormstypes'] = collect($data['typeForms'])->unique('type_form_type')->values();
        $data['users'] = $this->configSurveyService->getAllUser();
        return view('admin.surveyconfigs.edit', compact('data', 'results', 'pSuggestions'));
    }



    //Survey Config update
    public function updateSurveyConfig(Request $request){

        $newRequest = Arr::except($request->all(), ['_token']);
       
        $where = [];
        $where['type_form_id'] = $request->type_form_id;
        $typeForms = $this->configSurveyService->getTypeFormByWhere($where);
        $request->merge(['type_form_title' => $typeForms->title]);
        $setParams = $this->surveyConfig->setParam($newRequest);
        $results = $this->configSurveyService->updateSurveyConfig($request->input('survey_config_id'), $setParams);

         //create product suggestion
         $surveyId = $request->survey_config_id;
         $selectedProId = $request->input('selected_product_value');
         $selectedProIds = json_decode($selectedProId);
         $minScores = $request->input('min_score', []);
         $maxScores = $request->input('max_score', []);

         $params = [];
         foreach ($minScores as $i => $val) {
             if(isset($val) || !empty($val) || $val != null && 
                 !empty($selectedProIds[$i]) && !empty($minScores[$i]) && !empty($maxScores[$i])){
                 $params['survey_id'] = $surveyId;
                 $params['product_id'] = json_encode($selectedProIds[$i]);
                 $params['min_score'] = $minScores[$i];
                 $params['max_score'] = $maxScores[$i];
                 $params['created_at'] = now();
                $results = $this->configSurveyService->createProductSuggestion($params);
             }
         }
         
         // Remove product suggestion 
         $removeIds = $request->input('remove_product', []);
         if (!empty($removeIds)) {
             foreach ($removeIds as $removeId) {
                $results = $this->configSurveyService->deleteProductSug($removeId);
             }
         }

         //Update product suggestion
         $updateProductIds = $request->input('update_product_id', []);
         $updateIds = $request->input('update_product_sug_id', []);
         $minUpdated = $request->input('min_score_update', []);
         $maxUpdated = $request->input('max_score_update', []);
         if (!empty($updateIds)) {
             foreach ($updateIds as $i => $updateId) {
                 if(!empty($updateProductIds[$updateId]) && !empty($minUpdated[$i]) && !empty($maxUpdated[$i])){
                    $results = $this->configSurveyService->updateProductSuggestion($updateId, [
                         'product_id' => json_encode($updateProductIds[$updateId]) ?? null,
                         'min_score'  => $minUpdated[$i] ?? null,
                         'max_score'  => $maxUpdated[$i] ?? null,
                         'updated_at' => now(),
                     ]);
                 }
             }
         }

        if (!empty($results)) {
            session()->flash('success', 'Survey Configuration updated successfully.');
            return redirect()->route('surveyConfig.getSurveyConfig');
        }else{
            session()->flash('error', 'Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    //Survey Config delete 
    public function deleteSurveyConfig(Request $request, $id){
        $results = $this->configSurveyService->deleteSurveyConfig($id);
        if(isset($results) && !empty($results)){
            session()->flash('success', 'Survey Configuration remove successFully.');
            return redirect()->route("surveyConfig.getSurveyConfig");
        }else{
            session()->flash('error', 'Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    //Survey Response
    public function getSurveyResults(Request $request)
    {
      $query = SurveyResult::query();
        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->OrWhere('user_name', 'LIKE', "%$search%");
                $q->OrWhere('user_email', 'LIKE', "%$search%");
                $q->OrWhere('user_phone', 'LIKE', "%$search%");
                $q->OrWhere('survey_type', 'LIKE', "%$search%");
                $q->OrWhere('typeform_title', 'LIKE', "%$search%");
                $q->OrWhere('email_status', 'LIKE', "%$search%");
                $q->OrWhere('discount_code', 'LIKE', "%$search%");
                $q->OrWhere('discount_type', 'LIKE', "%$search%");
                $q->OrWhere('score', 'LIKE', "%$search%");
                $q->OrWhere('reward_points', 'LIKE', "%$search%");
                $q->OrWhere('response_type', 'LIKE', "%$search%");
                $q->OrWhere('status', 'LIKE', "%$search%");
            });
        }
        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);
        $results = $query->paginate(10)->appends($request->all());
       // dd($results);
        $data =  [];
        $data['typeFormLists'] = $this->configSurveyService->getAllTypeForms();
        $data['selected_typeform_id'] = isset($request->type_form_id) ? $request->type_form_id : "";
        return view('admin.surveyresults.index', compact('results', 'data'));
    }
   

    public function getSurveyResultsDetails(Request $request){
        //dd($request->id);
        $data = [];
        $surveyConfigResponses = $this->configSurveyService->getSurveyResultByWhereId('id',$request->id);
        if(isset($surveyConfigResponses) && !empty($surveyConfigResponses)){
            if(isset($surveyConfigResponses) && !empty($surveyConfigResponses->id)){ 
                $where['survey_id'] = $surveyConfigResponses->survey_id;
                $pSuggestions = $this->configSurveyService->getProductSugByWhere($where);
                $params =  [];
                if(isset($pSuggestions)){
                    foreach($pSuggestions as $key => $pSuggestion){
                        $productIds = json_decode($pSuggestion->product_id);
                        if($pSuggestion->min_score < $surveyConfigResponses->score && $pSuggestion->max_score >     $surveyConfigResponses->score){
                            $products = $this->configSurveyService->getProductByWhereIds($productIds);     
                            $data['product'] = $products;
                            $data['product_min_score'] = $pSuggestion->min_score;       
                            $data['product_max_score'] = $pSuggestion->max_score;       
                        }
                    }
                }
            }
            $data['typeForms'] = $this->configSurveyService->getAllTypeForms();
            $data['typeFormstypes'] = collect($data['typeForms'])->unique('type_form_type')->values();
            $data['users'] = $this->configSurveyService->getAllUser();
            return view('admin.surveyresults.survey_result_details', compact('data', 'surveyConfigResponses','pSuggestions'));
        }else{
            session()->flash('error', 'Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    //Survey Response
    public function getUserSurveyResults(Request $request)
    {
       $ids = SurveyResult::selectRaw('MAX(id) as id')
            ->groupBy('user_id')
            ->pluck('id');

        $query = SurveyResult::whereIn('id', $ids);

        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->orWhere('user_name', 'LIKE', "%$search%")
                ->orWhere('user_email', 'LIKE', "%$search%")
                ->orWhere('user_phone', 'LIKE', "%$search%");
            });
        }

        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);

        $results = $query->paginate(10)->appends($request->all());
        $data = [];
        if(isset($results) && !empty($results)){
            foreach($results as $key=> $val){
                $surveyResults  =  $this->configSurveyService->getUserSurveyResults($val->user_id);
                 $data['users'][] = $surveyResults;
            }
        }
      //  dd($data['users']);
        $data['typeFormLists'] = $this->configSurveyService->getAllTypeForms();
        $data['selected_typeform_id'] = isset($request->type_form_id) ? $request->type_form_id : "";
        return view('admin.surveyresults.user_result', compact('results', 'data'));
    }


    public function getUserSurveyResultsDetails(Request $request){
        $surveyResults  =  $this->configSurveyService->getUserSurveyResults($request->id);
        return view('admin.surveyresults.user_result_details', compact('surveyResults'));
    }


}
