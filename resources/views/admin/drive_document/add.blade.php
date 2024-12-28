@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Create Driver Documnt</h2><br>
                <form action="{{ route('drive_document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="document_id" value="{{(isset($Driver_documnt)?$Driver_documnt->id:'')}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="Title" placeholder="Enter Title" value="{{(isset($Driver_documnt)?$Driver_documnt->title:old('Title'))}}" autocomplete="off">
                            @if ($errors->has('Title'))
                            <div class="text-danger">{{ $errors->first('Title') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (isset($Driver_documnt) && $Driver_documnt->status == 'active') ? 'selected' : (old('status') == 'active' ? 'selected' : '') }}>Active</option>
                                <option value="inactive" {{ (isset($Driver_documnt) && $Driver_documnt->status == 'inactive') ? 'selected' : (old('status') == 'inactive' ? 'selected' : '') }}>Inactive</option>
                            </select>
                            @if ($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{(isset($Driver_documnt)? "Update" : "Create")}}</button>
                        <a href="{{ route('drive_document.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection