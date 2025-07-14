<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeForm;

class MasterController extends Controller
{

    public function dashboard(Request $request){
      return view("welcome");
    }
   
    // public function surveyConfig(Request $request){
    //   return view("admin.user.index");
    // }
    
}
