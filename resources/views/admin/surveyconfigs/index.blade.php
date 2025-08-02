@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" >Survey List</div>
            </div>
            <div class="card-body">
                  <div class="row">
                    <div class="col-lg-10">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('surveyConfig.getSurveyConfig') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 d-flex align-items-center justify-content-end mb-2">
                        <a   href="{{route('surveyConfig.createSurveyConfig')}}">
                            <button class="btn btn-success create-btn" id="refreshBtn"><i class="la la-plus"></i> Create</button>
                        </a>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">#</a></th>

                            <!-- <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'survey_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Survey Type</a></th> -->

                             <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Survey Type</a></th>
                               <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'type_form_title', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Name</a></th>
                               <!-- <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'type_form_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Type</a></th> -->
                            <th>Notification</th>
                            <!-- <th>Custom Day</th> -->
                            <!-- <th>Selected Email</th> -->
                            <!-- <th>Discount Code</th>
                            <th>Discount Type</th>
                            <th>Discount Price</th>
                            <th>Score</th> -->
                            <th>Reward Point for Survey Participation</th>
                            <th>Reword Point for Survey Result</th>
                            <th>Status</th>
                            <!-- <th>Created At</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($results) && !empty($results[0]->id))
                            @foreach($results as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>
                                        @if($val->user_type == "pre_purchase")
                                             {{ __('Pre-Purchase') }}
                                        @else
                                            {{ __('Post-Purchase') }}
                                        @endif
                                    </td>
                                    <td>{{ $val->type_form_title }}</td>
                                    <!-- <td>
                                        {{ $val->type_form_type }}
                                    </td> -->
                                    <td>
                                        @if($val->survey_notification_status == "multiple")
                                           <span class="badge badge-light">{{__('Recurring')}}</span>
                                        @else
                                         <span class="badge badge-light">{{__('One Time')}}</span>
                                        @endif
                                    </td>
                                    <!-- <td>{{ $val->custom_days}} </td> -->
                                    <!-- <td>
                                        @if($val->selected_email == "initial_email_send")
                                               <span class="badge badge-info">{{__('Initial')}}</span>
                                        @endif

                                        @if($val->selected_email == "reminder")
                                              <span class="badge badge-warning">{{__('Reminder')}}</span>
                                        @endif

                                        @if($val->selected_email == "follow_up")
                                              <span class="badge badge-primary">{{__('Follow-up')}}</span>
                                        @endif
                                    </td> -->
                                    <!-- <td>{{ $val->discount_code }}</td>
                                    <td>
                                        @if($val->discount_type == 'percentage')
                                            {{ __('Percentage') }}
                                        @else
                                            {{ __('Flat') }}
                                        @endif
                                    </td>
                                    <td>{{ $val->discount_value }}</td>
                                    <td>{{ $val->score }}</td> -->
                                    <td>  
                                        @if(isset($val->reward_points) && $val->reward_points > 0)
                                            {{ $val->reward_points }}
                                        @else
                                            {{ __('0') }}
                                        @endif 
                                    </td>
                                    <td>
                                        @if(isset($val->participation_points) && $val->participation_points > 0)
                                            {{ $val->participation_points }}
                                        @else
                                            {{ __('0') }}
                                        @endif 
                                    </td>
                                    <td>
                                        @if($val->status == "active")
                                            <span class="badge badge-success">{{__('Active')}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('InActive')}}</span>
                                        @endif
                                    </td>
                                    <!-- <td>{{ $val->created_at }}</td> -->
                                    <td class="earsh" colspan="2">
                                        <a href="{{ route('surveyConfig.editSurveyConfig', ['id' => $val->id]) }}" ><i class="la la-pencil"></i></a>
                                        <a href="{{ route('surveyConfig.deleteSurveyConfig', ['id' => $val->id]) }}" ><i class="la la-trash"></i></a>
                                    </td>
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
