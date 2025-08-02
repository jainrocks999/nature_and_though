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
                        <h4>User Survey Result Details</h4>
                        <!-- <p>Invoice ID: #</p> -->
                        <!-- <p>Date: </p> -->
                    </div>

                 <div class="section">
                    <h5>Survey User Results </h5>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total Survey</th>
                            <th>Complete Survey</th>
                            <th>Incomplete Survey</th>
                            <th>Total Score</th>
                            <th>Total Rewards Points</th>
                        </tr>
                        <tr>
                            <td>{{ ucfirst($surveyResults['user_name']) }}</td>
                            <td>{{ $surveyResults['user_email'] }}</td>
                            <td>{{ $surveyResults['user_phone'] }}</td>
                            <td>{{ $surveyResults['total_survey'] }}</td>
                            <td>{{ $surveyResults['complete_survey'] }}</td>
                            <td>{{ $surveyResults['incomplete_survey'] }}</td>
                            <td>{{ $surveyResults['total_score'] }}</td>
                            <td>{{ $surveyResults['total_reward_points'] }}</td>
                        </tr>
                    </table>
                </div>


                <div class="section">
                    <h5>Survey Information</h5>
                    <table>
                         <tr>
                            <th>Survey Type</th>
                            <th>Typeform Name</th>
                            <th>Typeform Type</th>
                            <th>Survey Attempt</th>
                            <th>Survey Time</th>
                        </tr>
                        @if(isset($surveyResults['survey_result']) && !empty($surveyResults['survey_result']))
                            @foreach($surveyResults['survey_result'] as $val)
                                <tr>
                                    <td>{{ ucfirst($val->survey_type)}}</td>
                                    <td>{{ $val->typeform_title }}</td>
                                    <td>{{ ucfirst($val->typeform_type) }}</td>
                                    <td>{{ ucfirst($val->response_type) }}</td>
                                    <td>{{ $val->response_time }}</td>
                                </tr>
                            @endforeach
                        @endif
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
                     @if(isset($surveyResults['survey_result']) && !empty($surveyResults['survey_result']))
                        @foreach($surveyResults['survey_result'] as $val)
                        <tr>
                            <td>{{ $val->discount_code ?? 'N/A' }}</td>
                            <td>{{ ucfirst($val->discount_type) ?? 'N/A' }}</td>
                            <td>${{ number_format($val->discount_price, 2) }}</td>
                            <td>{{ $val->reward_points }}</td>
                            <td>{{ $val->score }}</td>
                        </tr>
                        @endforeach
                    @endif
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
                        <th>Score Range</th>
                    </tr>
                    @if(isset($surveyResults['suggested_products']))
                        @foreach ($surveyResults['suggested_products'] as $productList)  
                          @foreach($surveyResults['survey_result'] as $val)
                            @if($productList['product_min_score'] < $val->score && $productList['product_max_score'] > $val->score )
                                <tr>
                                    <td>
                                        @if (!empty($productList['product_image']))
                                            <img src="{{ $productList['product_image'] ?? 'N/A' }}" alt="Product Image" height="100px" width="150px">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $productList['product_title'] ?? 'N/A' }}</td>
                                    <td>{{ $productList['product_sku'] ?? 'N/A' }}</td>
                                    <td>{{ $productList['product_price'] ?? 'N/A' }}</td>
                                    <td>{{ $productList['product_min_score'] }} - {{ $productList['product_max_score'] }}</td>
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        <tr><td colspan="6">No Results</td></tr>
                    @endif
                </table>
            </div>
            <div class="section">
                <h5>Status & Notifications</h5>
                <table>
                    <tr>
                        <th>Push Notification & Email Send</th>
                        <th>Status</th>
                        <th>Created Date</th>
                    </tr>
                    @foreach($surveyResults['survey_result'] as $val)
                    <tr>
                        <td>{{ $val['pushnotification_status'] }}</td>
                        <td>{{ $val['response_type'] }}</td>
                        <td>{{ $val['created_at'] }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
                </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.footer')