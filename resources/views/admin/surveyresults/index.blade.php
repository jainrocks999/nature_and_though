@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">User Survey Results</div>
                <div class="row">
                    <div class="col-lg-12">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('surveyResults.getSurveyResults') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Survey Type</th>
                            <th>Typeform Title</th>
                            <th>Typeform Type</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Phone</th>
                            <th>Email Status </th>
                            <th>Push Notification Status</th>
                            <th>Score</th>
                            <th>Discount Code</th>
                            <th>Discount Price</th>
                            <th>Reward Points</th>
                            <th>Response Type</th>
                            <th>Response Time</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($results) && !empty($results[0]->id))
                            @foreach($results as $val)
                                <tr>
                                   <td>{{$val->id}}</td>
                                   <td>{{$val->survey_type == 'pre_purchase' ? "Pre-Purchase" : "Post-Purchase";}}</td>
                                   <td>{{$val->typeform_title}}</td>
                                   <td>{{$val->typeform_type == 'quiz' ? 'Quiz' : ($val->typeform_type == 'score' ? 'Score' : 'Score Branching')}}</td>
                                   <td>{{$val->user_name}}</td>
                                   <td>{{$val->user_email}}</td>
                                   <td>{{$val->user_phone}}</td>
                                   <td>{{ $val->email_status == 'initial_email_send' ? 'Initial' : ($val->email_status == 'follow_up' ? 'Follow Up' : 'Reminder')}}</td>
                                   <td>{{$val->pushnotification_status == 'Disable' ? "Disable" : "Enable";}}</td>
                                   <td>{{$val->score}}</td>
                                   <td>{{$val->discount_code}}</td>
                                   <td>{{$val->discount_price}}</td>
                                   <td>{{$val->reward_points}}</td>
                                   <td>{{$val->response_type == 'completed' ? "Completed" : "Pending";}}</td>
                                   <td>{{$val->response_time}}</td>
                                   <td>{{$val->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td id="msg"> No Results </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                 <div class="d-flex justify-content-center">
                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.footer')
