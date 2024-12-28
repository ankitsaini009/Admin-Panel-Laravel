@extends('admin.layout.main')

@section('manage_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .color-picker {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        display: inline-block;
    }

    .section-title {
        background-color: #ff6a00;
        padding: 10px;
        color: white;
        font-weight: bold;
    }

    .form-section {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .file-upload {
        display: flex;
        align-items: center;
    }

    .file-upload img {
        width: 40px;
        height: 40px;
        margin-left: 10px;
    }
</style>
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="container mt-5">
            <h3>Settings</h3>

            <!-- Settings Section -->
            <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="settings_id" value="{{ isset($Setting) ? $Setting->id : '' }}">

                <div class="form-section">
                    <div class="section-title">Settings</div><br>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="adminPanelTitle" class="form-label">Admin panel title</label>
                            <input type="text" class="form-control" name="adminPanelTitle" id="adminPanelTitle" value="{{ isset($Setting) ? $Setting->adminPanelTitle : '' }}">
                        </div>
                        <div class="col-md-6">
                            <label for="adminPanelFooter" class="form-label">Admin panel footer</label>
                            <input type="text" class="form-control" id="adminPanelFooter" name="adminPanelFooter" value="{{ isset($Setting) ? $Setting->adminPanelFooter : '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="customerAppColor" class="form-label">Customer App Color</label>
                            <input type="color" class="form-control color-picker" id="customerAppColor" name="customerAppColor" value="{{ isset($Setting) ? $Setting->customerAppColor : '' }}">
                        </div>
                        <div class="col-md-6">
                            <label for="driverAppColor" class="form-label">Driver App color</label>
                            <input type="color" class="form-control color-picker" id="driverAppColor" name="driverAppColor" value="{{ isset($Setting) ? $Setting->driverAppColor : '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="adminPanelColor" class="form-label">Admin panel color</label>
                            <input type="color" class="form-control color-picker" id="adminPanelColor" name="adminPanelColor" value="{{ isset($Setting) ? $Setting->adminPanelColor : '' }}">
                        </div>
                        <div class="col-md-6">
                            <label for="driverRadius" class="form-label">Driver Radius</label>
                            <input type="number" class="form-control" id="driverRadius" name="driverRadius" value="{{ isset($Setting) ? $Setting->driverRadius : '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 file-upload">
                            <label for="adminPanelLogo" class="form-label">Admin Panel Logo</label>
                            <input type="file" class="form-control" name="adminPanelLogo" value="{{ isset($Setting) ? $Setting->adminPanelLogo : '' }}">
                            <div class="mb-2">
                                <img src="{{ asset('images/' . $Setting->adminPanelLogo) }}" alt="User Image" class="img-thumbnail" width="100px">
                            </div>
                        </div>
                        <div class="col-md-6 file-upload">
                            <label for="toggleMenuLogo" class="form-label">Toggle menu logo</label>
                            <input type="file" class="form-control" name="toggleMenuLogo" value="{{ isset($Setting) ? $Setting->toggleMenuLogo : '' }}">
                            <div class="mb-2">
                                <img src="{{ asset('images/' . $Setting->toggleMenuLogo) }}" alt="User Image" class="img-thumbnail" width="100px">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-section">
                    <div class="section-title">Google Map API Key</div><br>
                    <div class="mb-3">
                        <label for="googleMapApiKey" class="form-label">Google Map API Key</label>
                        <input type="password" class="form-control" id="googleMapApiKey" name="googleMapApiKey" value="{{ isset($Setting) ? $Setting->googleMapApiKey : '' }}">
                    </div>

                </div>

                <div class="form-section">
                    <div class="section-title">Ride Settings</div><br>

                    <div class="mb-3">
                        <label for="googleMapApiKey" class="form-label">Trip Accept/Reject Duration For Driver in Seconds</label>
                        <input type="text" class="form-control" id="Duration_For_Driver" name="Duration_For_Driver" value="{{ isset($Setting) ? $Setting->Duration_For_Driver : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="googleMapApiKey" class="form-label">Show Ride Otp Feature</label>
                        <select class="form-control" name="Otp_Feature" id="Otp_Feature">
                            <option value="YAS">YAS</option>
                            <option value="No">NO</option>
                        </select>
                    </div>

                </div>

                <div class="form-section">
                    <div class="section-title">Delivery Charge Distance</div><br>

                    <div class="mb-3">
                        <label for="googleMapApiKey" class="form-label">Distance</label>
                        <select class="form-control" name="Distance" id="Distance">
                            <option value="KM">KM</option>
                            <option value="Miles">Miles</option>
                        </select>
                    </div>

                </div>

                <div class="form-section">
                    <div class="section-title">Wallet Settings (For Driver)</div><br>

                    <div class="mb-3">
                        <label for="googleMapApiKey" class="form-label">Minimum wallet amount to receiving Ride (For Driver)</label>
                        <input type="text" class="form-control" id="Minimum_wallet_amount" name="Minimum_wallet_amountRide" value="{{ isset($Setting) ? $Setting->Minimum_wallet_amountRide : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="googleMapApiKey" class="form-label">Minimum wallet amount to withdrawal (For Driver)</label>
                        <input type="text" class="form-control" id="Minimum_wallet_amountwithdrawal" name="Minimum_wallet_amountwithdrawal" value="{{ isset($Setting) ? $Setting->Minimum_wallet_amountwithdrawal : '' }}">
                    </div>

                </div>

                <div class="form-section">
                    <div class="section-title">Referral Settings</div><br>
                    <div class="mb-3">
                        <label for="referralAmount" class="form-label">Referral Amount</label>
                        <input type="text" class="form-control" id="referralAmount" name="referralAmount" placeholder="Enter referral amount" value="{{ isset($Setting) ? $Setting->referralAmount : '' }}">
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-title">Contact Us</div><br>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="contactEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="contactEmail" name="contactEmail" value="{{ isset($Setting) ? $Setting->contactEmail : '' }}" placeholder="Enter email address">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contactPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="contactPhone" name="contactPhone" value="{{ isset($Setting) ? $Setting->contactPhone : '' }}" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="contactAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="contactAddress" name="contactAddress" value="{{ isset($Setting) ? $Setting->contactAddress : '' }}" placeholder="Enter contact address">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-title">Version</div><br>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="appVersion" class="form-label">App Version</label>
                            <input type="text" class="form-control" id="appVersion" name="appVersion" value="{{ isset($Setting) ? $Setting->appVersion : '' }}" placeholder="Enter app version">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="webVersion" class="form-label">Web Version</label>
                            <input type="text" class="form-control" id="webVersion" name="webVersion" value="{{ isset($Setting) ? $Setting->webVersion : '' }}" placeholder="Enter web version">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-title">Web View Pages</div><br>

                    <div class="mb-3">
                        <label for="aboutPage" class="form-label">About</label>
                        <input type="text" class="form-control" id="aboutPage" name="aboutPage" value="{{ isset($Setting) ? $Setting->aboutPage : '' }}" placeholder="Enter about page URL">
                    </div>
                    <div class="mb-3">
                        <label for="helpPage" class="form-label">Help</label>
                        <input type="text" class="form-control" id="helpPage" name="helpPage" value="{{ isset($Setting) ? $Setting->helpPage : '' }}" placeholder="Enter help page URL">
                    </div>
                    <div class="mb-3">
                        <label for="termsPage" class="form-label">Terms and Conditions</label>
                        <input type="text" class="form-control" id="termsPage" name="termsPage" value="{{ isset($Setting) ? $Setting->termsPage : '' }}" placeholder="Enter terms and conditions URL">
                    </div>
                    <div class="mb-3">
                        <label for="privacyPolicyPage" class="form-label">Privacy Policies</label>
                        <input type="text" class="form-control" id="privacyPolicyPage" name="privacyPolicyPage" value="{{ isset($Setting) ? $Setting->privacyPolicyPage : '' }}" placeholder="Enter privacy policies URL">
                    </div>
                    <div class="mb-3">
                        <label for="howItWorksPage" class="form-label">How It Works</label>
                        <input type="text" class="form-control" id="howItWorksPage" name="howItWorksPage" value="{{ isset($Setting) ? $Setting->howItWorksPage : '' }}" placeholder="Enter how it works page URL">
                    </div>
                    <div class="mb-3">
                        <label for="outstationFaqsPage" class="form-label">Outstation FAQs</label>
                        <input type="text" class="form-control" id="outstationFaqsPage" name="outstationFaqsPage" value="{{ isset($Setting) ? $Setting->outstationFaqsPage : '' }}" placeholder="Enter outstation FAQs URL">
                    </div>
                    <div class="mb-3">
                        <label for="partnerCarePage" class="form-label">Partner Care</label>
                        <input type="text" class="form-control" id="partnerCarePage" name="partnerCarePage" value="{{ isset($Setting) ? $Setting->partnerCarePage : '' }}" placeholder="Enter partner care page URL">
                    </div>
                    <div class="mb-3">
                        <label for="covid19Page" class="form-label">COVID-19</label>
                        <input type="text" class="form-control" id="covid19Page" name="covid19Page" value="{{ isset($Setting) ? $Setting->covid19Page : '' }}" placeholder="Enter COVID-19 page URL">
                    </div>
                </div>

                <div class="form-section mb-4">
                    <div class="section-title">Ride Inclusions</div><br>
                    <div class="mb-3">
                        <label for="rideInclusions" class="form-label">Ride Inclusions</label>
                        <div id="ride-inclusions-container">
                            @if(isset($Setting) && !empty(json_decode($Setting->rideInclusions, true)))
                            @foreach(json_decode($Setting->rideInclusions, true) as $rideInclusion)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="rideInclusions[]" value="{{ $rideInclusion }}" placeholder="Enter ride inclusions">
                                <a class="btn btn-danger remove-btn" href="{{route('rideInclusions_remove', ['value' => $rideInclusion , 'id' => $Setting->id])}}">X</a>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-danger" id="add-ride-inclusion-btn"><i class="fa-solid fa-plus"></i> Add</button>
                    </div>
                </div>

                <div class="form-section mb-4">
                    <div class="section-title">Rules & Restrictions</div><br>
                    <div class="mb-3">
                        <label for="rulesRestrictions" class="form-label">Rules & Restrictions</label>
                        <div id="rules-restrictions-container">
                            @if(isset($Setting) && !empty(json_decode($Setting->rulesRestrictions, true)))
                            @foreach(json_decode($Setting->rulesRestrictions, true) as $ruleRestriction)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="rulesRestrictions[]" value="{{ $ruleRestriction }}" placeholder="Enter rules and restrictions">
                                <a class="btn btn-danger remove-btn" href="{{route('rulesRestrictions_remove', ['value' => $ruleRestriction , 'id' => $Setting->id])}}">X</a>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-danger" id="add-rules-restrictions-btn"><i class="fa-solid fa-plus"></i> Add</button>
                    </div>
                </div>

                <div class="form-section mb-4">
                    <div class="section-title">Terms and Conditions</div><br>
                    <div class="mb-3">
                        <label for="termsConditions" class="form-label">Terms and Conditions</label>
                        <div id="terms-conditions-container">
                            @if(isset($Setting) && !empty(json_decode($Setting->termsConditions, true)))
                            @foreach(json_decode($Setting->termsConditions, true) as $termCondition)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="termsConditions[]" value="{{ $termCondition }}" placeholder="Enter terms and conditions">
                                <a class="btn btn-danger remove-btn" href="{{route('termsConditions_remove_remove', ['value' => $termCondition , 'id' => $Setting->id])}}">X</a>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-danger" id="add-terms-conditions-btn"><i class="fa-solid fa-plus"></i> Add</button>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-danger">Save</button>
                    <a href="{{ route('settings.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#add-ride-inclusion-btn').click(function() {
            $('#ride-inclusions-container').append(`
          <div class="mb-3 input-group">
            <input type="text" class="form-control" name="rideInclusions[]" placeholder="Enter Ride Inclusion">
            <button class="btn btn-danger remove-btn" type="button">X</button>
          </div>
        `);
        });

        $('#add-rules-restrictions-btn').click(function() {
            $('#rules-restrictions-container').append(`
          <div class="mb-3 input-group">
            <input type="text" class="form-control" name="rulesRestrictions[]" placeholder="Enter Rule or Restriction">
            <button class="btn btn-danger remove-btn" type="button">X</button>
          </div>
        `);
        });

        $('#add-terms-conditions-btn').click(function() {
            $('#terms-conditions-container').append(`
          <div class="mb-3 input-group">
            <input type="text" class="form-control" name="termsConditions[]" placeholder="Enter Term or Condition">
            <button class="btn btn-danger remove-btn" type="button">X</button>
          </div>
        `);
        });

        // Remove the input field when the X button is clicked
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endsection