@extends('layouts.admin')
@section('content')
<div class="content">
	<div class="container-fluid">
       
        <div class="card">
            <div class="card-header">
                <div class="card-title" >Type Form Response List</div>
                <div class="row">
                    <div class="col-lg-10">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                     <select name="type_form_id" id="type_form_id" class="form-control ">
                                        <option value="">Select type Form</option>
                                        @if(isset($data['typeFormLists']) && !empty($data['typeFormLists']))
                                            @foreach($data['typeFormLists'] as $val)
                                            <option value="{{$val->type_form_id}}" {{ $data['selected_typeform_id'] == $val->type_form_id ? 'selected' : '' }}><?php echo $val->title; ?> </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('typeform.getTypeFormResponse') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                     <div class="col-lg-2">
                        <a   href="{{route('typeform.cloneAllTypeFormResponse')}}">
                            <button class="btn btn-success create-btn" id="refreshBtn"><i class="la la-refresh"></i>Sync</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover responsive">
                    <thead>
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">#</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'form_id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Id</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'form_title', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Title</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'form_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Type</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'response_type', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Response</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'response_id', 'order' => (request('order') === 'asc' ? 'desc' : 'asc')]) }}">Typeform Response Id</a></th>
                            <th>Created At</th>
                            <th>Last Updated</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($results) && !empty($results[0]->id))
                        @foreach($results as $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ $val->form_id }}</td>
                                <td>{{ $val->form_title }}</td>
                                <td>{{ $val->form_type }}</td>
                                <td>{{ $val->response_type }}</td>
                                <td>{{ $val->response_id }}</td>
                                <td>{{ $val->created_at }}</td>
                                <td>{{ $val->landed_at }}</td>
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