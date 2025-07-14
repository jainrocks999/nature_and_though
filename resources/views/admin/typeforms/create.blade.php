@extends('layouts.admin')
@section('content') 
<div class="content">
	<div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-12">
                <a href="{{ route('typeform.index') }}">
                    <button type="button" class="btn btn-default">{{ trans('global.back_to_list') }}</button>
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create TypeForm</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('typeform.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="basic" {{ old('type') == 'basic' ? 'selected' : '' }}>Basic</option>
                            <option value="advanced" {{ old('type') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting" class="form-label">Setting</label>
                        <input type="text" id="setting" name="setting" class="form-control" value="{{ old('setting') }}">
                        @error('setting')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection