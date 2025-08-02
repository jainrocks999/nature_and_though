@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" >Typeform List</div>
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
                                    <a href="{{ route('typeform.getTypeFormData') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 d-flex align-items-center justify-content-end mb-2">
                        <a   href="{{route('typeform.cloneTypeFormData')}}">
                            <button class="btn btn-success create-btn" id="refreshBtn"><i class="la la-refresh"></i>Sync</button>
                        </a>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">#</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'type_form_id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Id</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'title', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Name</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'type_form_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Type</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Created Date</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($results) && !empty($results[0]->id))
                            @foreach($results as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->type_form_id }}</td>
                                    <td>{{ $val->title }}</td>
                                    <td>{{ $val->type_form_type }}</td>
                                    <td>{{ $val->created_at }}</td>
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
