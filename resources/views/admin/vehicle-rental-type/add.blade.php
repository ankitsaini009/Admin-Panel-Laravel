@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Outstation Vehicle Type</h2><br>
                <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="Vehicle_id" value="{{(isset($Vehicle_type)?$Vehicle_type->id:'')}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{(isset($Vehicle_type)?$Vehicle_type->Name:old('name'))}}" autocomplete="off">
                            @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Par_Day_Price" class="form-label">Par Day Price</label>
                            <input type="text" class="form-control" name="Par_Day_Price" placeholder="Enter Par Day Price" value="{{(isset($Vehicle_type)?$Vehicle_type->Par_Day_Price:old('Par_Day_Price'))}}" autocomplete="off">
                            @if ($errors->has('Par_Day_Price'))
                            <div class="text-danger">{{ $errors->first('Par_Day_Price') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Number_Of_Passenger" class="form-label">Number Of Passenger</label>
                            <input type="number" class="form-control" name="Number_Of_Passenger" placeholder="Enter Number Of Passenger" value="{{(isset($Vehicle_type)?$Vehicle_type->Number_Of_Passenger:old('Number_Of_Passenger'))}}" autocomplete="off">
                            @if ($errors->has('Number_Of_Passenger'))
                            <div class="text-danger">{{ $errors->first('Number_Of_Passenger') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Vehicle_Type" class="form-label">Vehicle Type</label>
                            <input type="text" class="form-control" name="Vehicle_Type" placeholder="Enter Vehicle Type" value="{{(isset($Vehicle_type)?$Vehicle_type->Vehicle_Type:old('Vehicle_Type'))}}" autocomplete="off">
                            @if ($errors->has('Vehicle_Type'))
                            <div class="text-danger">{{ $errors->first('Vehicle_Type') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (isset($Vehicle_type) && $Vehicle_type->Status == 'active') ? 'selected' : (old('status') == 'active' ? 'selected' : '') }}>Active</option>
                                <option value="inactive" {{ (isset($Vehicle_type) && $Vehicle_type->Status == 'inactive') ? 'selected' : (old('status') == 'inactive' ? 'selected' : '') }}>Inactive</option>
                            </select>
                            @if ($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image</label>
                            @if(isset($Vehicle_type) && $Vehicle_type->Image)
                            <div class="mb-2">
                                <img src="{{ asset('images/' . $Vehicle_type->Image) }}" alt="User Image" class="img-thumbnail" width="100">
                            </div>
                            <input type="hidden" value="{{(isset($Vehicle_type)?$Vehicle_type->Image:old('image'))}}" class="form-control" name="image" autocomplete="off">
                            @endif
                            <input type="file" class="form-control" name="image" autocomplete="off">
                            @if ($errors->has('image'))
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{(isset($Vehicle_type)? "Update" : "Create")}}</button>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection