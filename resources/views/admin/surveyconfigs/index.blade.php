@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" >Survey Config Search</div>
                <!-- <div class="row">
                    <div class="col-lg-10">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="la la-search"></i>Search</button>
                                    <a href="{{ route('surveyConfig.getSurveyConfig') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">
                        <a   href="{{route('surveyConfig.createSurveyConfig')}}">
                            <button class="btn btn-success create-btn" id="refreshBtn"><i class="la la-plus"></i> Create</button>
                        </a>
                    </div>
                </div> -->
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
                    <div class="col-lg-2">
                        <a   href="{{route('surveyConfig.createSurveyConfig')}}">
                            <button class="btn btn-success create-btn" id="refreshBtn"><i class="la la-refresh"></i>Sync</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">#</a></th>

                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'survey_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Survey Type</a></th>

                             <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">User Type</a></th>
                            <th>Typeform Title</th>
                            <th>TypeForm Type </th>
                            <th>Survey Notification</th>
                            <!-- <th>Custom Day</th> -->
                            <th>Selected Email</th>
                            <th>Discount Code</th>
                            <th>Discount Type</th>
                            <th>Discount Price</th>
                            <th>Score</th>
                            <th>Reward Points</th>
                            <th>Participation Points</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($results) && !empty($results[0]->id))
                            @foreach($results as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>
                                        @if($val->survey_type == "pre_purchase")
                                             {{ __('Pre-Purchase') }}
                                        @else
                                            {{ __('Post-Purchase') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($val->user_type == "pre_purchase")
                                             {{ __('Pre-Purchase') }}
                                        @else
                                            {{ __('Post-Purchase') }}
                                        @endif
                                    </td>
                                    <td>{{ $val->type_form_title }}</td>
                                    <td>
                                        {{ $val->type_form_type }}
                                    </td>
                                    <td>
                                        @if($val->survey_notification_status == "enable")
                                           <button class="btn btn-success btn-sm">{{ __('Enable') }}</button>
                                        @else
                                            <button class="btn btn-danger btn-sm">{{ __('Disable') }}</button>
                                        @endif
                                    </td>
                                    <!-- <td>{{ $val->custom_days}} </td> -->
                                    <td>
                                        @if($val->selected_email == "initial_email_send")
                                              {{ __('Initial') }}
                                        @endif

                                        @if($val->selected_email == "reminder")
                                             {{ __('Reminder') }}
                                        @endif

                                        @if($val->selected_email == "follow_up")
                                             {{ __('Follow-up') }}
                                        @endif
                                    </td>
                                    <td>{{ $val->discount_code }}</td>
                                    <td>
                                        @if($val->discount_type == 'percentage')
                                            {{ __('Percentage') }}
                                        @else
                                            {{ __('Flat') }}
                                        @endif
                                    </td>
                                    <td>{{ $val->discount_value }}</td>
                                    <td>{{ $val->score }}</td>
                                    <td>{{ $val->reward_points }}</td>
                                    <td>{{ $val->participation_points }}</td>
                                    <td>
                                        @if($val->status == "active")
                                            <button class="btn btn-success btn-sm">{{__('Active')}}</button>
                                        @else
                                            <button class="btn btn-danger btn-sm">{{__('InActive')}}</button>
                                        @endif
                                    </td>
                                    <td>{{ $val->created_at }}</td>
                                    <td>
                                        <a href="{{ route('surveyConfig.editSurveyConfig', ['id' => $val->id]) }}"><i class="la la-pencil"></i></a>
                                        <a href="{{ route('surveyConfig.deleteSurveyConfig', ['id' => $val->id]) }}"><i class="la la-trash"></i></a>
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
