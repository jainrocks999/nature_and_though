@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Survey Insights Results</div>
            </div>
            <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                 <div class="col-md-3">
                                    <select name="typeform_id" class="form-control">
                                    @if (!empty($data['typeFormLists']))
                                        <option value="">Select Typeform</option>
                                        @foreach ($data['typeFormLists'] as $val)
                                            <option value="{{ $val->type_form_id }}" 
                                                {{ isset($data['selected_typeform_id']) && $data['selected_typeform_id'] == $val->type_form_id ? 'selected' : '' }}>
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
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('surveyResults.getSurveyResults') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">#</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'survey_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Survey Type</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'typeform_title', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Name</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_name', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">User Name</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_email', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">User Email</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'user_phone', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">User Phone</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'score', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}"> Score </a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'reward_points', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Reward Points</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'response_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Survey Attempt</a></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($results) && !empty($results[0]->id))
                            @foreach($results as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>
                                        {{ $val->survey_type == 'pre_purchase' ? 'Pre-Purchase' : 'Post-Purchase' }}
                                    </td>
                                    <td>{{ $val->typeform_title }}</td>

                                    {{-- typeform_type badge --}}
                                    
                                    <td>{{ $val->user_name }}</td>
                                    <td>{{ $val->user_email }}</td>
                                    <td>{{ $val->user_phone }}</td>
                                    <td>{{ $val->score }}</td>
                                    <td>{{ isset($val->reward_points) ? $val->reward_points : "0"  }}</td>

                                    {{-- response_type badge --}}
                                    <td>
                                        <span class="badge badge-{{ $val->response_type == 'completed' ? 'success' : 'warning' }}">
                                            {{ $val->response_type == 'completed' ? 'Completed' : 'Pending' }}
                                        </span>
                                    </td>

                                    <!-- <td>{{ $val->response_time }}</td> -->
                                    <td>
                                        <a href="{{ route('surveyResults.getSurveyResultsDetails', ['id' => $val->id]) }}">
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
