@extends('layouts.admin')
@section('content')
    <style>
       

        h4, h5, h3 {
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            text-align: left;
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 30px;
        }
        .footer {
            font-size: 14px;
            color: #777;
        }
        .label {
            font-weight: bold;
            width: 200px;
            display: inline-block;
        }
    </style>
<div class="content">
	<div class="container-fluid">
        <div class="card">
              <div class="card-body">
                    <div class="header">
                        <h4>Survey Results</h4>
                        <!-- <p>Invoice ID: #{{ $surveyConfigResponses->id }}</p> -->
                        <p>Date: {{ $surveyConfigResponses->created_at->format('Y-m-d') }}</p>
                    </div>

                 <div class="section">
                    <h5>User Information</h5>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                        </tr>
                        <tr>
                            <td>{{ ucfirst($surveyConfigResponses->user_name) }}</td>
                            <td>{{ $surveyConfigResponses->user_email }}</td>
                            <td>{{ $surveyConfigResponses->user_phone }}</td>
                            <td>{{ ucfirst($surveyConfigResponses->user_type) }}</td>
                        </tr>
                    </table>
                </div>


                <div class="section">
                    <h5>Survey Information</h5>
                    <table>
                        <tr>
                            <th>Survey ID</th>
                            <th>Survey Type</th>
                            <th>Typeform Title</th>
                            <th>Typeform Type</th>
                            <th>Response Type</th>
                            <th>Response Time</th>
                        </tr>
                        <tr>
                            <td>{{ $surveyConfigResponses->survey_id }}</td>
                            <td>{{ ucfirst($surveyConfigResponses->survey_type)}}</td>
                            <td>{{ $surveyConfigResponses->typeform_title }}</td>
                            <td>{{ ucfirst($surveyConfigResponses->typeform_type) }}</td>
                            <td>{{ ucfirst($surveyConfigResponses->response_type) }}</td>
                            <td>{{ $surveyConfigResponses->response_time }}</td>
                        </tr>
                    </table>
                </div>


                <div class="section">
                <h5>Rewards & Discounts</h5>
                <table>
                    <tr>
                        <th>Discount Code</th>
                        <th>Discount Type</th>
                        <th>Discount Price</th>
                        <th>Reward Points</th>
                        <th>Score</th>
                    </tr>
                    <tr>
                        <td>{{ $surveyConfigResponses->discount_code ?? 'N/A' }}</td>
                        <td>{{ ucfirst($surveyConfigResponses->discount_type) ?? 'N/A' }}</td>
                        <td>${{ number_format($surveyConfigResponses->discount_price, 2) }}</td>
                        <td>{{ $surveyConfigResponses->reward_points }}</td>
                        <td>{{ $surveyConfigResponses->score }}</td>
                    </tr>
                </table>
            </div>
            <div class="section">
                <h5>Product Suggestion</h5>
                <table>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Title</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Score </th>
                        <th>Score Range</th>
                    </tr>
                    @if(isset($data['product']) && !empty($data['product']))
                     @foreach ($data['product'] as $index => $product)
                        @php 
                            $pimages = json_decode($product['product_images']);
                            $productImg = isset($pimages[$index]->src) ? $pimages[$index]->src : '';
                        @endphp
                        <tr>
                           
                            <td>
                            @if ($product['product_images'])
                                <image src="{{$productImg}}" alt="Product Image" height="100px" width="150px">
                            @else
                                N/A
                            @endif
                            </td>
                            <td>{{  $product['product_title'] }}</td>
                            <td>{{  $product['product_sku'] }}</td>
                            <td>{{  $product['product_price'] }}</td>
                            <td>{{ $surveyConfigResponses->score }}</td>
                            <td>{{ $data['product_min_score'] }} - {{ $data['product_max_score'] }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="6">No Results </td></tr>
                    @endif
                </table>
            </div>

            <div class="section">
                <h5>Status & Notifications</h5>
                <table>
                    <tr>
                        <th>Email Sent</th>
                        <th>Push Notification</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                    </tr>
                    <tr>
                        <td>{{ $surveyConfigResponses->email_status ? 'Yes' : 'No' }}</td>
                        <td>{{ $surveyConfigResponses->pushnotification_status ? 'Yes' : 'No' }}</td>
                        <td>{{ ucfirst($surveyConfigResponses->status) }}</td>
                        <td>{{ $surveyConfigResponses->updated_at->format('Y-m-d H:i') }}</td>
                    </tr>
                </table>
            </div>


                    <div class="footer">
                        Thank you for completing the survey.
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.footer')