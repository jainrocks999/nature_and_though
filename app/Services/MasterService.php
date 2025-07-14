<?php

namespace App\Services;
use App\Interface\TypeFormInterface;
use DB;
class MasterService
{    
    public function __construct(TypeFormInterface $typeFormInterface)
    {
        $this->accessToken = env('PERSONAL_ACCESS_TOKEN');
        $this->baseUrl = env('TYPEFORM_URL');
        $this->typeFormInterface = $typeFormInterface;
    }

    //Admin Details
    function adminDetails() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrl.'/me',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$this->accessToken,
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response);
        return $results;
    }


    //Clone type form data
    function getTypeFormData(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrl.'/forms?page=1&page_size=100',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$this->accessToken,
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response);
        return $results;
    }


    function getTypeFormResponseData($formId){
      //  $formId = 'k1mwz61y';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrl."/forms/{$formId}/responses",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$this->accessToken,
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response);
        return $results;
    }
    
    
}