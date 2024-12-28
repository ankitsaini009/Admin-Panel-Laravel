@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Create Brand</h2><br>
                <form action="{{ route('car_model.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="car_model_id" value="{{(isset($Car_model)?$Car_model->id:'')}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{(isset($Car_model)?$Car_model->Name:old('name'))}}" autocomplete="off">
                            @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Brand" class="form-label">Brand</label>
                            <select name="Brand" class="form-control">
                                <option value="">Select Brand</option>

                                @foreach($brands as $brand)
                                <option value="{{$brand->name}}" {{ (isset($Car_model) && $Car_model->Brand == $brand->name) ? 'selected' : (old('Brand') == $brand->name ? 'selected' : '') }}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('Brand'))
                            <div class="text-danger">{{ $errors->first('Brand') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Vehicle_Type" class="form-label">Vehicle Type</label>
                            <select name="Vehicle_Type" class="form-control">
                                <option value="">Select Vehicle Type</option>

                                @foreach($vehicleTypes as $vehicleType)
                                <option value="{{ $vehicleType->Vehicle_Type}}" {{ (isset($Car_model) && $Car_model->Vehicle_Type == $vehicleType->Vehicle_Type) ? 'selected' : (old('Vehicle_Type') ==  $vehicleType->Vehicle_Type ? 'selected' : '') }}>{{ $vehicleType->Vehicle_Type }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('Vehicle_Type'))
                            <div class="text-danger">{{ $errors->first('Vehicle_Type') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (isset($Car_model) && $Car_model->status == 'active') ? 'selected' : (old('status') == 'active' ? 'selected' : '') }}>Active</option>
                                <option value="inactive" {{ (isset($Car_model) && $Car_model->status == 'inactive') ? 'selected' : (old('status') == 'inactive' ? 'selected' : '') }}>Inactive</option>
                            </select>
                            @if ($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{(isset($Car_model)? "Update" : "Create")}}</button>
                        <a href="{{ route('car_model.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection