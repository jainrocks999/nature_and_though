<?php

namespace App\Services;
use App\Interface\TypeFormInterface;
use DB;
class MasterService
{    
    public function __construct(TypeFormInterface $typeFormInterface)
    {
        $this->accessToken = env('PERSONAL_ACCESS_TOKEN');
        $this->baseUrlTypeForm = env('TYPEFORM_URL');
        $this->baseUrlShopify = env('SHOPIFY_BASE_URL');
        $this->XShopifyAccessToken = env('XSHOPIFY_STOREFRONT_ACCESSTOKEN');
        $this->typeFormInterface = $typeFormInterface;
    }

    //Admin Details
    function adminDetails() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrlTypeForm.'/me',
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

    //typeform url set
    function setTypeFormUrl($postData)
    {
        if (empty($postData['url']) || empty($postData['form_id']) || empty($postData['tag'])) {
           return 'Missing required parameters: url, form_id, or tag.';
        }
        $payload = json_encode([
            'url' => $postData['url'],
            'enabled' => true
        ]);

        $webhookUrl = 'https://api.typeform.com/forms/' . $postData['form_id'] . '/webhooks/' . $postData['tag'];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $webhookUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->accessToken,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if ($error) {
            throw new Exception("cURL Error: $error");
        }
        return $response; 
    }



    //Clone TypeForm data
    function getTypeFormData(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrlTypeForm.'/forms?page=1&page_size=100',
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
     //   $formId = 'k1mwz61y';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrlTypeForm."/forms/{$formId}/responses",
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


    //get Response Id 
    function getTypeFormResponse($formId, $responseId){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrlTypeForm."/forms/{$formId}/responses?included_response_ids={$responseId}",
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
    
    
    function getAllProductShopify(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->baseUrlShopify.'/admin/api/2024-04/products.json',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-Shopify-Access-Token: '.$this->XShopifyAccessToken,
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response);
        return ['status'=>$response, 'data'=>$results];
        return $results;
    }


    function shopifyRegister($postData)
    {
        $firstName = $postData['name'];
        $lastName = $postData['lastname'];
        $email = $postData['email'];
        $phone = "+91".$postData['phone_no']; 
        $password = $postData['password']; 
        $acceptsMarketing = true;
        $graphqlQuery = [
            'query' => 'mutation customerCreate($input: CustomerCreateInput!) { 
                            customerCreate(input: $input) { 
                                customer { 
                                    firstName 
                                    lastName 
                                    email 
                                    phone 
                                    acceptsMarketing 
                                    id
                                } 
                                customerUserErrors { 
                                    field 
                                    message 
                                    code 
                                } 
                            } 
                        }',
            'variables' => [
                'input' => [
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => $password,
                    'acceptsMarketing' => $acceptsMarketing,
                ]
            ]
        ];
    
        // Initialize cURL
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrlShopify."/api/2024-04/graphql.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, 
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($graphqlQuery), 
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-Shopify-Storefront-Access-Token: a81612f9bfbfa71a08588954dd31fe43',
            ],
        ]);
    
        // Execute the cURL request
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return response()->json(['error' => 'cURL error: ' . $error_msg], 500);
        }
    
        // Close the cURL connection
        curl_close($curl);
        $responseData = json_decode($response, true);
        if (isset($responseData['errors'])) {
            $data = ['status'=>401, 'error' => $responseData['errors']];
            return $data;
        }
        if (isset($responseData['data']['customerCreate']['customerUserErrors']) && 
            count($responseData['data']['customerCreate']['customerUserErrors']) > 0) {
            $data = ['status'=>401, 'error' => $responseData['data']['customerCreate']['customerUserErrors']];
            return $data;
        }

        $customerid = $responseData['data']['customerCreate']['customer']['id'];
        return ['status'=>200, 'shopify_customer_id'=>$customerid];
    }


    //shopify login 
    function shopifyLogin($email, $pass)
    {
        $query = [
            'query' => 'mutation customerAccessTokenCreate {
                customerAccessTokenCreate(input: {email: "' . $email . '", password: "' . $pass . '"}) {
                    customerAccessToken {
                        accessToken
                    }
                    customerUserErrors {
                        message
                    }
                }
            }'
        ];
        
        // Convert the array to a JSON string
        $jsonData = json_encode($query);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->shopUrl."/api/2024-04/graphql.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData, // Send JSON data properly
            CURLOPT_HTTPHEADER => [
                'X-Shopify-Storefront-Access-Token: ' . $this->accessToken,
                'Content-Type: application/json',
            ],
        ]);
        
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
        $logdatas = [
            'api_name' => 'Shopify-Login-Api', 
            'api_request' => json_encode($query),
            'api_response' => json_encode($responseData)
        ];
        DB::table('lms_error_logs')->insert($logdatas);
        if (isset($responseData['data']['customerCreate']['customerUserErrors'][0]['message']) && 
            count($responseData['data']['customerCreate']['customerUserErrors'][0]['message']) > 0) {
                
            $data = [
                'status'=>400,
                'error' => $responseData['data']['customerCreate']['customerUserErrors']
            ];
        }else{
            if($responseData['data']['customerAccessTokenCreate']['customerAccessToken'] != "" &&
                $responseData['data']['customerAccessTokenCreate']['customerAccessToken'] != null){  
                $data = [
                    'status'=>200,
                    'token' => $responseData['data']['customerAccessTokenCreate']['customerAccessToken']['accessToken']
                ];
            }else{
                
                 $data = [
                    'status'=>400,
                    'error' => 'Shopify user not login.'
                ];
            }
        }
       
        return $data;
    }

}