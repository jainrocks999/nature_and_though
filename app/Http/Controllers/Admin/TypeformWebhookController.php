<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\TypeformResponse;

class TypeformWebhookController extends Controller
{
    public function webhooksHandle(Request $request)
    {
        $data = $request->getContent();
        $results = json_decode($data);
        $resultdatas =  DB::table('webhook_log')->insert([
            'type_form_id' => $results->form_response->form_id,
            'type_form_title' => $results->form_response->definition->title,
            'type_form_type' => $results->event_type,
            'request' => $results->form_response->definition->title,
            'response' => $data,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $resultdatas;
    }
}
