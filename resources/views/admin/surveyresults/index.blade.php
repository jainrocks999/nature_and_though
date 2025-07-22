@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" >Survey Results Search</div>
                <div class="row">
                    <div class="col-lg-12">
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
                    <!-- <div class="col-lg-2">
                        <a   href="{{route('surveyConfig.createSurveyConfig')}}">
                            <button class="btn btn-success create-btn" id="refreshBtn"><i class="la la-plus"></i> Create</button>
                        </a>
                    </div> -->
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Survey Type</th>
                            <th>User Type </th>
                            <th>Score</th>
                            <th>Min Score</th>
                            <th>Max Score</th>
                            <th>Reward Points</th>
                            <th>Discount Code</th>
                            <th>Products</th>
                            <th>Reward Points</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($results) && !empty($results[0]->id))
                            @foreach($results as $val)
                                <tr>
                                   <td></td>
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
