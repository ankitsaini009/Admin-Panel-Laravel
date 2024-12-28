@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Create Vehicle Type</h2><br>
                <form action="{{ route('vehicle_type.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="Setting_vehicle_type_id" value="{{(isset($Setting_vehicle_type)?$Setting_vehicle_type->id:'')}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Vehicle_Type" class="form-label">Vehicle Type</label>
                            <input type="text" class="form-control" name="Vehicle_Type" placeholder="Enter Vehicle Type" value="{{(isset($Setting_vehicle_type)?$Setting_vehicle_type->Vehicle_Type:old('Vehicle_Type'))}}" autocomplete="off">
                            @if ($errors->has('Vehicle_Type'))
                            <div class="text-danger">{{ $errors->first('Vehicle_Type') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (isset($Setting_vehicle_type) && $Setting_vehicle_type->Status == 'active') ? 'selected' : (old('status') == 'active' ? 'selected' : '') }}>Active</option>
                                <option value="inactive" {{ (isset($Setting_vehicle_type) && $Setting_vehicle_type->Status == 'inactive') ? 'selected' : (old('status') == 'inactive' ? 'selected' : '') }}>Inactive</option>
                            </select>
                            @if ($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Image</label>
                            @if(isset($Setting_vehicle_type) && $Setting_vehicle_type->image)
                            <div class="mb-2">
                                <img src="{{ asset('images/' . $Setting_vehicle_type->image) }}" alt="User Image" class="img-thumbnail" width="100">
                            </div>
                            <input type="hidden" value="{{(isset($Setting_vehicle_type)?$Setting_vehicle_type->image:old('image'))}}" class="form-control" name="image" autocomplete="off">
                            @endif
                            <input type="file" class="form-control" name="image" autocomplete="off">
                            @if ($errors->has('image'))
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="Delivery_Charge" class="form-label">Delivery Charge Per KM</label>
                            <input type="number" class="form-control" name="Delivery_Charge" placeholder="Enter Delivery Charge Per KM" value="{{(isset($Setting_vehicle_type)?$Setting_vehicle_type->Delivery_Charge:old('Delivery_Charge'))}}" autocomplete="off">
                            @if ($errors->has('Delivery_Charge'))
                            <div class="text-danger">{{ $errors->first('Delivery_Charge') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="Minimum_Delivery_Charge" class="form-label">Minimum Delivery Charge</label>
                            <input type="number" class="form-control" name="Minimum_Delivery_Charge" placeholder="Enter Minimum Delivery Charge" value="{{(isset($Setting_vehicle_type)?$Setting_vehicle_type->Minimum_Delivery_Charge:old('Minimum_Delivery_Charge'))}}" autocomplete="off">
                            @if ($errors->has('Minimum_Delivery_Charge'))
                            <div class="text-danger">{{ $errors->first('Minimum_Delivery_Charge') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="Minimum_Delivery_Charge_Within_KM" class="form-label">Minimum Delivery Charge Within KM</label>
                            <input type="number" class="form-control" name="Minimum_Delivery_Charge_Within_KM" placeholder="Enter Minimum Delivery Charge Within KM" value="{{(isset($Setting_vehicle_type)?$Setting_vehicle_type->Minimum_Delivery_Charge_Within_KM:old('Minimum_Delivery_Charge'))}}" autocomplete="off">
                            @if ($errors->has('Minimum_Delivery_Charge_Within_KM'))
                            <div class="text-danger">{{ $errors->first('Minimum_Delivery_Charge_Within_KM') }}</div>
                            @endif
                        </div>
                    </div><br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{(isset($Setting_vehicle_type)? "Update" : "Create")}}</button>
                        <a href="{{ route('vehicle_type.index') }}" class="btn btn-secondary">Back to Users</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection