@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">User Survey Journey</div>
            </div>
            <div class="card-body">
                 <div class="row">
                    <div class="col-lg-12">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                  <!-- <div class="col-md-3">
                                    <select name="typeform_id" class="form-control">
                                    @if (!empty($data['typeFormLists']))
                                        <option value="">Select Typeform</option>
                                        @foreach ($data['typeFormLists'] as $val)
                                            <option value="{{ $val->id }}" 
                                                {{ isset($data['selected_typeform_id']) && $data['selected_typeform_id'] == $val->id ? 'selected' : '' }}>
                                                {{ $val->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                </div>
                                 <div class="col-md-3">
                                     <select name="survey_type" class="form-control">
                                        <option value="">Select Survey Type</option>
                                        <option value="pre_purchase" {{ (isset($data['select_survey_type']) && $data['select_survey_type'] === 'pre_purchase') ? 'selected' : '' }}>Pre-Purchase</option>
                                        <option value="post_purchase" {{ (isset($data['select_survey_type']) && $data['select_survey_type'] === 'post_purchase') ? 'selected' : '' }}>Post-Purchase</option>
                                    </select>
                                </div> -->
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('surveyResults.getUserSurveyResults') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">#</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_name', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">User Name</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_email', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">User Email</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_phone', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">User Phone</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'total_survey', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Total Survey </a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'complete_survey', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Complete Survey</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'incomplete_survey', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Incomplete Survey</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'total_score', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Total Score</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'total_reward_points', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Total Rewards Points</a></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data['users']) && !empty($data['users']))
                            @foreach($data['users'] as $val)
                               
                                <tr>
                                    <td>{{ $val['user_id'] }}</td>
                                    <td>{{ $val['user_name'] }}</td>
                                    <td>{{ $val['user_email'] }}</td>
                                    <td>{{ $val['user_phone'] }}</td>
                                    <td>{{ $val['total_survey'] }}</td>
                                    <td>{{ $val['complete_survey'] }}</td>
                                    <td>{{ $val['incomplete_survey'] }}</td>
                                    <td>{{ $val['total_score'] }}</td>
                                    <td>{{ $val['total_reward_points'] }}</td>
                                    <td>
                                        <a href="{{ route('surveyResults.getUserSurveyResultsDetails', ['id' => $val['user_id']]) }}">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            
                            @endforeach
                        @else
                            <tr>
                                <td id="msg" colspan="17" class="text-center text-muted">No Results</td>
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
