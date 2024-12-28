@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Create Driver</h2><br>
                <form action="{{ route('all_drivers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="driver_id" value="{{(isset($DriverData)?$DriverData->id:'')}}">
                    <div class="card mb-4">
                        <div class="card-header text-white" style="background-color: #ff2c2c">
                            Driver Details
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Insert First Name" value="{{(isset($DriverData)?$DriverData->f_name:old('firstName'))}}">
                                    @if ($errors->has('firstName'))
                                    <div class="text-danger">{{ $errors->first('firstName') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Insert Last Name" value="{{(isset($DriverData)?$DriverData->l_name:old('lastName'))}}">
                                    @if ($errors->has('lastName'))
                                    <div class="text-danger">{{ $errors->first('lastName') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Insert Email" value="{{(isset($DriverData)?$DriverData->email:old('email'))}}">
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                @if(!isset($DriverData))
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Insert Password" value="{{(isset($DriverData)?$DriverData->password:old('password'))}}">
                                    @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Insert Phone Number" value="{{(isset($DriverData)?$DriverData->phone:old('phone'))}}">
                                    @if ($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="profileImage" class="form-label">Profile Image</label>
                                    @if(isset($DriverData) && $DriverData->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('images/' . $DriverData->image) }}" alt="User Image" class="img-thumbnail" width="100">
                                    </div>
                                    <input type="hidden" value="{{(isset($DriverData)?$DriverData->image:old('profileImage'))}}" class="form-control" name="profileImage" autocomplete="off">
                                    @endif
                                    <input type="file" class="form-control" name="profileImage" autocomplete="off">
                                    @if ($errors->has('profileImage'))
                                    <div class="text-danger">{{ $errors->first('profileImage') }}</div>
                                    @endif

                                </div>
                            </div>
                            <div class="form-check  col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ (isset($DriverData) && $DriverData->status == 'active') ? 'selected' : (old('status') == 'active' ? 'selected' : '') }}>Active</option>
                                    <option value="inactive" {{ (isset($DriverData) && $DriverData->status == 'inactive') ? 'selected' : (old('status') == 'inactive' ? 'selected' : '') }}>Inactive</option>
                                </select>
                                @if ($errors->has('status'))
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Car Details Section -->
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #ff2c2c">
                            Car Details
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicleType" class="form-label">Vehicle Type</label>
                                    <select class="form-select" name="vehicleType" id="vehicleType">
                                        <option selected>Select Type</option>
                                        @foreach($vehicleTypes as $vehicleType)
                                        <option value="{{ $vehicleType->Vehicle_Type }}"
                                            {{ (isset($DriverData) && $DriverData->vehicle_type == $vehicleType->Vehicle_Type) 
                                ? 'selected' 
                                : (old('vehicleType') == $vehicleType->Vehicle_Type ? 'selected' : '') }}>
                                            {{ $vehicleType->Vehicle_Type }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicleType'))
                                    <div class="text-danger">{{ $errors->first('vehicleType') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <select class="form-select" name="brand" id="brand">
                                        <option selected>Select Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->name }}"
                                            {{ (isset($DriverData) && $DriverData->brand == $brand->name) 
                                ? 'selected' 
                                : (old('brand') == $brand->name ? 'selected' : '') }}>
                                            {{ $brand->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <select class="form-select" name="model" id="model">
                                        <option selected>Select Model</option>
                                        @foreach($carModels as $carModel)
                                        <option value="{{ $carModel->Name }}"
                                            {{ (isset($DriverData) && $DriverData->model == $carModel->Name) 
                                ? 'selected' 
                                : (old('model') == $carModel->Name ? 'selected' : '') }}>
                                            {{ $carModel->Name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="km" class="form-label">KM</label>
                                    <input type="text" class="form-control" name="km" id="km"
                                        placeholder="Insert Kilometer"
                                        value="{{ isset($DriverData) ? $DriverData->KM : old('km') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="mileage" class="form-label">Mileage</label>
                                    <input type="text" class="form-control" name="mileage" id="mileage"
                                        placeholder="Insert Mileage"
                                        value="{{ isset($DriverData) ? $DriverData->milage : old('mileage') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="numberPlate" class="form-label">Numberplate</label>
                                    <input type="text" class="form-control" name="numberPlate" id="numberPlate"
                                        placeholder="Insert Car Number"
                                        value="{{ isset($DriverData) ? $DriverData->numberplate : old('numberPlate') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control" name="color" id="color"
                                        placeholder="Insert Car Color"
                                        value="{{ isset($DriverData) ? $DriverData->color : old('color') }}">
                                </div>
                                @if ($errors->has('color'))
                                <div class="text-danger">{{ $errors->first('color') }}</div>
                                @endif
                                <div class="col-md-6 mb-3">
                                    <label for="passengers" class="form-label">Number of passengers</label>
                                    <input type="number" class="form-control" name="passengers" id="passengers"
                                        placeholder="Insert Number of Passengers"
                                        value="{{ isset($DriverData) ? $DriverData->number_passenger : old('passengers') }}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Car Details Section -->
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #ff2c2c">
                            Bank Details
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="km" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Insert Bank Name" value="{{(isset($DriverData)?$DriverData->bank_name:old('bank_name'))}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="color" class="form-label">Account Number</label>
                                    <input type="text" class="form-control" name="acount_number" id="acount_number" placeholder="Insert Account Number" value="{{(isset($DriverData)?$DriverData->account_number:old('account_number'))}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="mileage" class="form-label">Branch Name</label>
                                    <input type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Insert Branch Name" value="{{(isset($DriverData)?$DriverData->branch_name:old('branch_name'))}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="numberPlate" class="form-label">Holder Name</label>
                                    <input type="text" class="form-control" name="holder_name" id="holder_name" placeholder="Insert Holder Name" value="{{(isset($DriverData)?$DriverData->holder_name:old('holder_name'))}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="passengers" class="form-label">IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="Insert IFSC Code" value="{{(isset($DriverData)?$DriverData->IFSC_Code:old('ifsc_code'))}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="other_info" class="form-label">Other Information</label>
                                    <input type="text" class="form-control" name="other_info" id="other_info" placeholder="Insert Other Information" value="{{(isset($DriverData)?$DriverData->other_Information:old('other_info'))}}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{(isset($DriverData)? "Update" : "Create")}}</button>
                        <a href="{{ route('all_drivers.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection