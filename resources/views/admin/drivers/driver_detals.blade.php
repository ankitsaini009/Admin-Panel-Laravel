@extends('admin.layout.main')
@section('manage_content')
<div class="content-body">
    <div class="container-fluid">
        <style>
            .driver-card {
                background-color: #f5f5f5;
                border-radius: 10px;
                padding: 20px;
            }

            .driver-image {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                overflow: hidden;
            }

            .driver-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .tab-content {
                margin-top: 20px;
            }
        </style>

        <div class="container mt-5">
            <a href="{{route('all_drivers.index')}}" class="btn btn-danger mb-3">
                <i class="fa-solid fa-backward"></i> Back
            </a>
            <h2>Driver Detail</h2>
            <div class="driver-card">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <div class="driver-image">
                            <img src="{{ asset('images/' . $DriverData->image) }}" alt="Driver Image">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <h4>{{ isset($DriverData) ? $DriverData->f_name . ' ' . $DriverData->l_name : 'Driver Name Not Available' }}</h4>

                    </div>
                </div>

                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="information-tab" data-toggle="tab" href="#information" role="tab">Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rides-tab" data-toggle="tab" href="#rides" role="tab">Rides</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="vehicle-tab" data-toggle="tab" href="#vehicle" role="tab">Vehicle</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="information" role="tabpanel">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p><strong>Phone:</strong> {{(isset($DriverData)?$DriverData->phone:old('phone'))}}</p>
                                <p><strong>Bank Name:</strong> {{(isset($DriverData)?$DriverData->bank_name:old('bank_name'))}}</p>
                                <p><strong>Status:</strong> <span class="badge badge-success"> {{($DriverData->status == "active"? "Active" : "InActive")}}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{(isset($DriverData)?$DriverData->email:old('email'))}}</p>
                                <p><strong>Branch Name:</strong> {{(isset($DriverData)?$DriverData->branch_name:old('branch_name'))}}</p>
                                <p><strong>Account Number:</strong> {{(isset($DriverData)?$DriverData->account_number:old('account_number'))}}</p>
                                <p><strong>IFSC Code:</strong> {{(isset($DriverData)?$DriverData->IFSC_Code:old('ifsc_code'))}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="rides" role="tabpanel">
                        <p>Rides Information will go here.</p>
                    </div>

                    <div class="tab-pane fade" id="vehicle" role="tabpanel">
                        <p>Vehicle Information will go here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection